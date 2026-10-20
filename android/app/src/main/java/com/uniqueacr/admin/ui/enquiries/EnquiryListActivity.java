package com.uniqueacr.admin.ui.enquiries;

import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import com.google.android.material.appbar.MaterialToolbar;
import com.google.android.material.tabs.TabLayout;
import com.onesignal.OneSignal;
import com.uniqueacr.admin.R;
import com.uniqueacr.admin.model.Enquiry;
import com.uniqueacr.admin.model.EnquiryStats;
import com.uniqueacr.admin.model.PaginatedResponse;
import com.uniqueacr.admin.network.ApiClient;
import com.uniqueacr.admin.network.ApiService;
import com.uniqueacr.admin.network.AuthInterceptor;
import com.uniqueacr.admin.ui.login.LoginActivity;
import com.uniqueacr.admin.util.SessionManager;

import java.util.ArrayList;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class EnquiryListActivity extends AppCompatActivity implements AuthInterceptor.UnauthorizedListener {

    private SwipeRefreshLayout swipeRefresh;
    private RecyclerView recyclerView;
    private TextView emptyText;
    private TextView statPendingBookings;
    private TextView statCompletedBookings;
    private TextView statPendingOther;
    private TabLayout tabLayout;
    private EnquiryAdapter adapter;

    private static final String TYPE_BOOKING = "booking";
    private static final String TYPE_OTHER = "other";

    private String currentType = TYPE_BOOKING;
    private int currentPage = 1;
    private boolean hasMorePages = true;
    private boolean isLoading = false;
    // Bumped on every refresh/tab switch so a slow response for a previous tab is ignored.
    private int loadGeneration = 0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_enquiry_list);

        MaterialToolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        swipeRefresh = findViewById(R.id.swipeRefresh);
        recyclerView = findViewById(R.id.enquiryRecyclerView);
        emptyText = findViewById(R.id.emptyText);
        statPendingBookings = findViewById(R.id.statPendingBookings);
        statCompletedBookings = findViewById(R.id.statCompletedBookings);
        statPendingOther = findViewById(R.id.statPendingOther);
        tabLayout = findViewById(R.id.tabLayout);

        tabLayout.addOnTabSelectedListener(new TabLayout.OnTabSelectedListener() {
            @Override
            public void onTabSelected(TabLayout.Tab tab) {
                currentType = tab.getPosition() == 0 ? TYPE_BOOKING : TYPE_OTHER;
                emptyText.setText(tab.getPosition() == 0 ? R.string.empty_bookings : R.string.empty_enquiries);
                adapter.setEnquiries(new ArrayList<>());
                emptyText.setVisibility(View.GONE);
                loadEnquiries(1, true);
            }

            @Override
            public void onTabUnselected(TabLayout.Tab tab) {
            }

            @Override
            public void onTabReselected(TabLayout.Tab tab) {
                recyclerView.smoothScrollToPosition(0);
            }
        });

        boolean canDelete = SessionManager.getInstance(this).isSuperAdmin();
        adapter = new EnquiryAdapter(
                enquiry -> {
                    Intent intent = new Intent(this, EnquiryDetailActivity.class);
                    intent.putExtra(EnquiryDetailActivity.EXTRA_ENQUIRY_ID, enquiry.getId());
                    startActivity(intent);
                },
                this::confirmDeleteEnquiry,
                canDelete
        );

        LinearLayoutManager layoutManager = new LinearLayoutManager(this);
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setAdapter(adapter);
        recyclerView.addOnScrollListener(new RecyclerView.OnScrollListener() {
            @Override
            public void onScrolled(@NonNull RecyclerView rv, int dx, int dy) {
                if (dy <= 0 || isLoading || !hasMorePages) {
                    return;
                }
                int visibleItemCount = layoutManager.getChildCount();
                int totalItemCount = layoutManager.getItemCount();
                int firstVisible = layoutManager.findFirstVisibleItemPosition();
                if ((visibleItemCount + firstVisible) >= totalItemCount - 3) {
                    loadEnquiries(currentPage + 1, false);
                }
            }
        });

        swipeRefresh.setOnRefreshListener(() -> {
            loadEnquiries(1, true);
            loadStats();
        });
    }

    @Override
    protected void onResume() {
        super.onResume();
        ApiClient.setUnauthorizedListener(this);
        // Refresh every time the screen becomes visible so tapping a push notification
        // (or just switching back to the app) always shows the latest enquiries.
        loadEnquiries(1, true);
        loadStats();
        // Defensive re-tag: OneSignal.login() at sign-in time can race with the tag call
        // and silently drop it. Re-applying here on every resume is harmless (same value)
        // and guarantees the tag eventually sticks.
        OneSignal.getUser().addTag("role", "admin");
    }

    @Override
    protected void onPause() {
        super.onPause();
        ApiClient.setUnauthorizedListener(null);
    }

    private void loadStats() {
        ApiClient.getApiService(this).getEnquiryStats().enqueue(new Callback<ApiService.EnquiryStatsResponse>() {
            @Override
            public void onResponse(Call<ApiService.EnquiryStatsResponse> call, Response<ApiService.EnquiryStatsResponse> response) {
                if (!response.isSuccessful() || response.body() == null || response.body().getData() == null) {
                    return;
                }
                EnquiryStats stats = response.body().getData();
                statPendingBookings.setText(String.valueOf(stats.getPendingBookings()));
                statCompletedBookings.setText(String.valueOf(stats.getCompletedBookings()));
                statPendingOther.setText(String.valueOf(stats.getPendingOther()));
            }

            @Override
            public void onFailure(Call<ApiService.EnquiryStatsResponse> call, Throwable t) {
                // Keep the previous numbers; the list itself reports connectivity problems.
            }
        });
    }

    private void loadEnquiries(int page, boolean isRefresh) {
        if (isRefresh) {
            loadGeneration++;
        }
        final int generation = loadGeneration;

        isLoading = true;
        if (isRefresh) {
            swipeRefresh.setRefreshing(true);
        }

        ApiService apiService = ApiClient.getApiService(this);
        apiService.getEnquiries(page, currentType).enqueue(new Callback<PaginatedResponse<Enquiry>>() {
            @Override
            public void onResponse(Call<PaginatedResponse<Enquiry>> call, Response<PaginatedResponse<Enquiry>> response) {
                if (generation != loadGeneration) {
                    return;
                }
                isLoading = false;
                swipeRefresh.setRefreshing(false);

                if (!response.isSuccessful() || response.body() == null) {
                    Toast.makeText(EnquiryListActivity.this, R.string.error_loading_enquiries, Toast.LENGTH_SHORT).show();
                    return;
                }

                PaginatedResponse<Enquiry> body = response.body();
                currentPage = body.getCurrentPage();
                hasMorePages = body.hasMorePages();

                if (isRefresh) {
                    adapter.setEnquiries(body.getData());
                } else {
                    adapter.appendEnquiries(body.getData());
                }

                emptyText.setVisibility(adapter.getItemCount() == 0 ? View.VISIBLE : View.GONE);
            }

            @Override
            public void onFailure(Call<PaginatedResponse<Enquiry>> call, Throwable t) {
                if (generation != loadGeneration) {
                    return;
                }
                isLoading = false;
                swipeRefresh.setRefreshing(false);
                Toast.makeText(EnquiryListActivity.this, R.string.error_loading_enquiries, Toast.LENGTH_SHORT).show();
            }
        });
    }

    private void confirmDeleteEnquiry(Enquiry enquiry) {
        new AlertDialog.Builder(this)
                .setTitle(R.string.confirm_delete_enquiry_title)
                .setMessage(R.string.confirm_delete_enquiry_message)
                .setPositiveButton(R.string.action_delete_confirm, (dialog, which) -> deleteEnquiry(enquiry))
                .setNegativeButton(R.string.action_cancel, null)
                .show();
    }

    private void deleteEnquiry(Enquiry enquiry) {
        ApiClient.getApiService(this).deleteEnquiry(enquiry.getId()).enqueue(new Callback<Void>() {
            @Override
            public void onResponse(Call<Void> call, Response<Void> response) {
                if (response.isSuccessful()) {
                    adapter.removeEnquiry(enquiry.getId());
                    emptyText.setVisibility(adapter.getItemCount() == 0 ? View.VISIBLE : View.GONE);
                    loadStats();
                    Toast.makeText(EnquiryListActivity.this, R.string.enquiry_deleted, Toast.LENGTH_SHORT).show();
                } else {
                    Toast.makeText(EnquiryListActivity.this, R.string.error_deleting_enquiry, Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<Void> call, Throwable t) {
                Toast.makeText(EnquiryListActivity.this, R.string.error_deleting_enquiry, Toast.LENGTH_SHORT).show();
            }
        });
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_enquiry_list, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(@NonNull MenuItem item) {
        if (item.getItemId() == R.id.action_logout) {
            logout();
            return true;
        }
        return super.onOptionsItemSelected(item);
    }

    private void logout() {
        ApiClient.getApiService(this).logout().enqueue(new Callback<Void>() {
            @Override
            public void onResponse(Call<Void> call, Response<Void> response) {
                finishLogout();
            }

            @Override
            public void onFailure(Call<Void> call, Throwable t) {
                finishLogout();
            }
        });
    }

    private void finishLogout() {
        SessionManager.getInstance(this).clearSession();
        OneSignal.logout();
        goToLogin();
    }

    private void goToLogin() {
        Intent intent = new Intent(this, LoginActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
    }

    @Override
    public void onUnauthorized() {
        runOnUiThread(() -> {
            Toast.makeText(this, R.string.error_invalid_credentials, Toast.LENGTH_SHORT).show();
            goToLogin();
        });
    }
}
