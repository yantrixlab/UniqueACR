package com.uniqueacr.admin.ui.enquiries;

import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import com.google.android.material.appbar.MaterialToolbar;
import com.onesignal.OneSignal;
import com.uniqueacr.admin.R;
import com.uniqueacr.admin.model.Enquiry;
import com.uniqueacr.admin.model.PaginatedResponse;
import com.uniqueacr.admin.network.ApiClient;
import com.uniqueacr.admin.network.ApiService;
import com.uniqueacr.admin.network.AuthInterceptor;
import com.uniqueacr.admin.ui.login.LoginActivity;
import com.uniqueacr.admin.util.SessionManager;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class EnquiryListActivity extends AppCompatActivity implements AuthInterceptor.UnauthorizedListener {

    private SwipeRefreshLayout swipeRefresh;
    private RecyclerView recyclerView;
    private TextView emptyText;
    private EnquiryAdapter adapter;

    private int currentPage = 1;
    private boolean hasMorePages = true;
    private boolean isLoading = false;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_enquiry_list);

        MaterialToolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        swipeRefresh = findViewById(R.id.swipeRefresh);
        recyclerView = findViewById(R.id.enquiryRecyclerView);
        emptyText = findViewById(R.id.emptyText);

        adapter = new EnquiryAdapter(enquiry -> {
            Intent intent = new Intent(this, EnquiryDetailActivity.class);
            intent.putExtra(EnquiryDetailActivity.EXTRA_ENQUIRY_ID, enquiry.getId());
            startActivity(intent);
        });

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

        swipeRefresh.setOnRefreshListener(() -> loadEnquiries(1, true));
    }

    @Override
    protected void onResume() {
        super.onResume();
        ApiClient.setUnauthorizedListener(this);
        // Refresh every time the screen becomes visible so tapping a push notification
        // (or just switching back to the app) always shows the latest enquiries.
        loadEnquiries(1, true);
    }

    @Override
    protected void onPause() {
        super.onPause();
        ApiClient.setUnauthorizedListener(null);
    }

    private void loadEnquiries(int page, boolean isRefresh) {
        isLoading = true;
        if (isRefresh) {
            swipeRefresh.setRefreshing(true);
        }

        ApiService apiService = ApiClient.getApiService(this);
        apiService.getEnquiries(page).enqueue(new Callback<PaginatedResponse<Enquiry>>() {
            @Override
            public void onResponse(Call<PaginatedResponse<Enquiry>> call, Response<PaginatedResponse<Enquiry>> response) {
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
                isLoading = false;
                swipeRefresh.setRefreshing(false);
                Toast.makeText(EnquiryListActivity.this, R.string.error_loading_enquiries, Toast.LENGTH_SHORT).show();
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
