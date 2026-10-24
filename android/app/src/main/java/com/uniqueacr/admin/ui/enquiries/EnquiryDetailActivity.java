package com.uniqueacr.admin.ui.enquiries;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.GridLayout;
import android.widget.ProgressBar;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import com.google.android.material.appbar.MaterialToolbar;
import com.google.android.material.button.MaterialButton;
import com.uniqueacr.admin.R;
import com.uniqueacr.admin.model.Enquiry;
import com.uniqueacr.admin.model.EnquiryViewer;
import com.uniqueacr.admin.model.StatusUpdateRequest;
import com.uniqueacr.admin.network.ApiClient;
import com.uniqueacr.admin.network.ApiService;
import com.uniqueacr.admin.network.AuthInterceptor;
import com.uniqueacr.admin.ui.login.LoginActivity;
import com.uniqueacr.admin.util.RoleLabel;
import com.uniqueacr.admin.util.SessionManager;
import com.uniqueacr.admin.util.WindowInsetsHelper;

import java.time.OffsetDateTime;
import java.time.ZoneId;
import java.time.format.DateTimeFormatter;
import java.util.Arrays;
import java.util.List;
import java.util.Locale;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class EnquiryDetailActivity extends AppCompatActivity implements AuthInterceptor.UnauthorizedListener {

    public static final String EXTRA_ENQUIRY_ID = "extra_enquiry_id";

    private TextView nameText;
    private TextView phoneText;
    private TextView emailText;
    private TextView messageText;
    private TextView serviceLabel;
    private TextView serviceText;
    private TextView visitLabel;
    private TextView visitText;
    private TextView dateText;
    private Spinner statusSpinner;
    private MaterialButton updateStatusButton;
    private ProgressBar progressBar;

    private long enquiryId;
    private List<String> statuses;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_enquiry_detail);

        MaterialToolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        WindowInsetsHelper.padToolbarForStatusBar(toolbar);
        toolbar.setNavigationOnClickListener(v -> finish());

        nameText = findViewById(R.id.nameText);
        phoneText = findViewById(R.id.phoneText);
        emailText = findViewById(R.id.emailText);
        messageText = findViewById(R.id.messageText);
        serviceLabel = findViewById(R.id.serviceLabel);
        serviceText = findViewById(R.id.serviceText);
        visitLabel = findViewById(R.id.visitLabel);
        visitText = findViewById(R.id.visitText);
        dateText = findViewById(R.id.dateText);
        statusSpinner = findViewById(R.id.statusSpinner);
        updateStatusButton = findViewById(R.id.updateStatusButton);
        progressBar = findViewById(R.id.detailProgress);

        statuses = Arrays.asList(getResources().getStringArray(R.array.enquiry_statuses));
        ArrayAdapter<String> spinnerAdapter = new ArrayAdapter<>(this, android.R.layout.simple_spinner_item, statuses);
        spinnerAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        statusSpinner.setAdapter(spinnerAdapter);

        enquiryId = getIntent().getLongExtra(EXTRA_ENQUIRY_ID, -1);
        updateStatusButton.setOnClickListener(v -> updateStatus());

        loadEnquiry();
    }

    @Override
    protected void onResume() {
        super.onResume();
        ApiClient.setUnauthorizedListener(this);
    }

    @Override
    protected void onPause() {
        super.onPause();
        ApiClient.setUnauthorizedListener(null);
    }

    private void loadEnquiry() {
        setLoading(true);
        ApiService apiService = ApiClient.getApiService(this);
        apiService.getEnquiry(enquiryId).enqueue(new Callback<ApiService.EnquiryResponse>() {
            @Override
            public void onResponse(Call<ApiService.EnquiryResponse> call, Response<ApiService.EnquiryResponse> response) {
                setLoading(false);
                if (response.isSuccessful() && response.body() != null) {
                    bindEnquiry(response.body().getData());
                } else {
                    Toast.makeText(EnquiryDetailActivity.this, R.string.error_loading_enquiries, Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<ApiService.EnquiryResponse> call, Throwable t) {
                setLoading(false);
                Toast.makeText(EnquiryDetailActivity.this, R.string.error_loading_enquiries, Toast.LENGTH_SHORT).show();
            }
        });
    }

    private void bindEnquiry(Enquiry enquiry) {
        nameText.setText(enquiry.getName());
        phoneText.setText(enquiry.getPhone());
        emailText.setText(enquiry.getEmail());
        messageText.setText(enquiry.getMessage());
        String service = enquiry.getRequestedService();
        serviceText.setText(service);
        serviceLabel.setVisibility(service == null ? View.GONE : View.VISIBLE);
        serviceText.setVisibility(service == null ? View.GONE : View.VISIBLE);
        String visit = enquiry.getVisitSummary();
        visitText.setText(visit);
        visitLabel.setVisibility(visit == null ? View.GONE : View.VISIBLE);
        visitText.setVisibility(visit == null ? View.GONE : View.VISIBLE);
        dateText.setText(enquiry.getCreatedAt());
        bindSeenBy(enquiry);

        int index = statuses.indexOf(enquiry.getStatus());
        statusSpinner.setSelection(index >= 0 ? index : 0);
    }

    /**
     * "Seen by" grid. The server only sends the list to super admins, so for anyone else the
     * section simply stays hidden.
     */
    private void bindSeenBy(Enquiry enquiry) {
        View section = findViewById(R.id.seenSection);
        List<EnquiryViewer> viewers = enquiry.getSeenBy();
        if (viewers == null || !SessionManager.getInstance(this).isSuperAdmin()) {
            section.setVisibility(View.GONE);
            return;
        }

        ((TextView) findViewById(R.id.seenTitle))
                .setText(getString(R.string.seen_by_title) + " (" + viewers.size() + ")");

        GridLayout grid = findViewById(R.id.seenGrid);
        grid.removeAllViews();
        long currentUserId = SessionManager.getInstance(this).getUserId();
        int gap = (int) (4 * getResources().getDisplayMetrics().density);

        for (EnquiryViewer viewer : viewers) {
            View cell = LayoutInflater.from(this).inflate(R.layout.item_seen_by, grid, false);
            String email = viewer.getEmail() == null ? "" : viewer.getEmail();

            ((TextView) cell.findViewById(R.id.seenAvatar))
                    .setText(email.isEmpty() ? "?" : email.substring(0, 1).toUpperCase(Locale.ROOT));
            ((TextView) cell.findViewById(R.id.seenEmail)).setText(email);

            String role = RoleLabel.format(viewer.getRole());
            String when = formatSeenAt(viewer.getSeenAt());
            String meta = viewer.getId() == currentUserId ? getString(R.string.seen_by_you) : role;
            ((TextView) cell.findViewById(R.id.seenMeta)).setText(when.isEmpty() ? meta : meta + " · " + when);

            GridLayout.LayoutParams params = new GridLayout.LayoutParams(
                    GridLayout.spec(GridLayout.UNDEFINED, 1f),
                    GridLayout.spec(GridLayout.UNDEFINED, 1f));
            params.width = 0;
            params.setMargins(gap, gap, gap, gap);
            grid.addView(cell, params);
        }

        section.setVisibility(View.VISIBLE);
    }

    private String formatSeenAt(String iso) {
        if (iso == null || iso.isEmpty()) {
            return "";
        }
        try {
            return OffsetDateTime.parse(iso)
                    .atZoneSameInstant(ZoneId.systemDefault())
                    .format(DateTimeFormatter.ofPattern("d MMM, h:mm a", Locale.getDefault()));
        } catch (RuntimeException e) {
            return "";
        }
    }

    private void updateStatus() {
        String selectedStatus = (String) statusSpinner.getSelectedItem();
        setLoading(true);

        ApiService apiService = ApiClient.getApiService(this);
        apiService.updateEnquiryStatus(enquiryId, new StatusUpdateRequest(selectedStatus))
                .enqueue(new Callback<ApiService.EnquiryResponse>() {
                    @Override
                    public void onResponse(Call<ApiService.EnquiryResponse> call, Response<ApiService.EnquiryResponse> response) {
                        setLoading(false);
                        if (response.isSuccessful()) {
                            Toast.makeText(EnquiryDetailActivity.this, R.string.status_updated, Toast.LENGTH_SHORT).show();
                        } else {
                            Toast.makeText(EnquiryDetailActivity.this, R.string.status_update_failed, Toast.LENGTH_SHORT).show();
                        }
                    }

                    @Override
                    public void onFailure(Call<ApiService.EnquiryResponse> call, Throwable t) {
                        setLoading(false);
                        Toast.makeText(EnquiryDetailActivity.this, R.string.status_update_failed, Toast.LENGTH_SHORT).show();
                    }
                });
    }

    private void setLoading(boolean loading) {
        progressBar.setVisibility(loading ? View.VISIBLE : View.GONE);
        updateStatusButton.setEnabled(!loading);
    }

    @Override
    public void onUnauthorized() {
        runOnUiThread(() -> {
            SessionManager.getInstance(this).clearSession();
            Intent intent = new Intent(this, LoginActivity.class);
            intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
            startActivity(intent);
            finish();
        });
    }
}
