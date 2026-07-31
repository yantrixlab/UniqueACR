package com.uniqueacr.admin.ui.enquiries;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
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
import com.uniqueacr.admin.model.StatusUpdateRequest;
import com.uniqueacr.admin.network.ApiClient;
import com.uniqueacr.admin.network.ApiService;
import com.uniqueacr.admin.network.AuthInterceptor;
import com.uniqueacr.admin.ui.login.LoginActivity;
import com.uniqueacr.admin.util.SessionManager;

import java.util.Arrays;
import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class EnquiryDetailActivity extends AppCompatActivity implements AuthInterceptor.UnauthorizedListener {

    public static final String EXTRA_ENQUIRY_ID = "extra_enquiry_id";

    private TextView nameText;
    private TextView phoneText;
    private TextView emailText;
    private TextView messageText;
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
        toolbar.setNavigationOnClickListener(v -> finish());

        nameText = findViewById(R.id.nameText);
        phoneText = findViewById(R.id.phoneText);
        emailText = findViewById(R.id.emailText);
        messageText = findViewById(R.id.messageText);
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
        dateText.setText(enquiry.getCreatedAt());

        int index = statuses.indexOf(enquiry.getStatus());
        statusSpinner.setSelection(index >= 0 ? index : 0);
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
