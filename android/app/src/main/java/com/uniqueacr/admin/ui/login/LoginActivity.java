package com.uniqueacr.admin.ui.login;

import android.Manifest;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.os.Build;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.ProgressBar;
import android.widget.Toast;

import androidx.activity.result.ActivityResultLauncher;
import androidx.activity.result.contract.ActivityResultContracts;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.content.ContextCompat;

import com.google.android.material.button.MaterialButton;
import com.google.android.material.textfield.TextInputEditText;
import com.onesignal.OneSignal;
import com.uniqueacr.admin.R;
import com.uniqueacr.admin.model.LoginRequest;
import com.uniqueacr.admin.model.LoginResponse;
import com.uniqueacr.admin.network.ApiClient;
import com.uniqueacr.admin.network.ApiService;
import com.uniqueacr.admin.ui.enquiries.EnquiryListActivity;
import com.uniqueacr.admin.util.SessionManager;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class LoginActivity extends AppCompatActivity {

    private TextInputEditText emailInput;
    private TextInputEditText passwordInput;
    private MaterialButton loginButton;
    private ProgressBar progressBar;

    private final ActivityResultLauncher<String> notificationPermissionLauncher =
            registerForActivityResult(new ActivityResultContracts.RequestPermission(), granted -> {
                // Nothing to do either way; push still works, the user just won't see a
                // system tray notification on Android 13+ if permission is denied.
            });

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        emailInput = findViewById(R.id.emailInput);
        passwordInput = findViewById(R.id.passwordInput);
        loginButton = findViewById(R.id.loginButton);
        progressBar = findViewById(R.id.loginProgress);

        loginButton.setOnClickListener(v -> attemptLogin());
    }

    private void attemptLogin() {
        String email = emailInput.getText() != null ? emailInput.getText().toString().trim() : "";
        String password = passwordInput.getText() != null ? passwordInput.getText().toString() : "";

        if (TextUtils.isEmpty(email) || TextUtils.isEmpty(password)) {
            Toast.makeText(this, R.string.error_field_required, Toast.LENGTH_SHORT).show();
            return;
        }

        setLoading(true);

        ApiService apiService = ApiClient.getApiService(this);
        apiService.login(new LoginRequest(email, password)).enqueue(new Callback<LoginResponse>() {
            @Override
            public void onResponse(Call<LoginResponse> call, Response<LoginResponse> response) {
                setLoading(false);

                if (response.isSuccessful() && response.body() != null) {
                    onLoginSuccess(response.body());
                } else {
                    Toast.makeText(LoginActivity.this, R.string.error_invalid_credentials, Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<LoginResponse> call, Throwable t) {
                setLoading(false);
                Toast.makeText(LoginActivity.this, R.string.error_login_generic, Toast.LENGTH_SHORT).show();
            }
        });
    }

    private void onLoginSuccess(LoginResponse body) {
        SessionManager.getInstance(this).saveSession(
                body.getToken(),
                body.getUser().getId(),
                body.getUser().getName()
        );

        OneSignal.login(String.valueOf(body.getUser().getId()));
        OneSignal.getUser().addTag("role", "admin");

        requestNotificationPermissionIfNeeded();

        Intent intent = new Intent(this, EnquiryListActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
    }

    private void requestNotificationPermissionIfNeeded() {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.TIRAMISU) {
            if (ContextCompat.checkSelfPermission(this, Manifest.permission.POST_NOTIFICATIONS)
                    != PackageManager.PERMISSION_GRANTED) {
                notificationPermissionLauncher.launch(Manifest.permission.POST_NOTIFICATIONS);
            }
        }
    }

    private void setLoading(boolean loading) {
        progressBar.setVisibility(loading ? View.VISIBLE : View.GONE);
        loginButton.setEnabled(!loading);
    }
}
