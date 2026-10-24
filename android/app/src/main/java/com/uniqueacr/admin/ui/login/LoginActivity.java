package com.uniqueacr.admin.ui.login;

import android.Manifest;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.os.Build;
import android.graphics.Matrix;
import android.graphics.RenderEffect;
import android.graphics.Shader;
import android.os.Bundle;
import android.text.TextUtils;
import android.graphics.drawable.Drawable;
import android.view.View;
import android.view.ViewGroup;
import android.view.animation.DecelerateInterpolator;
import android.widget.ImageView;
import android.widget.ProgressBar;
import android.widget.Toast;

import androidx.activity.result.ActivityResultLauncher;
import androidx.activity.result.contract.ActivityResultContracts;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.content.ContextCompat;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowCompat;
import androidx.core.view.WindowInsetsCompat;
import androidx.core.view.WindowInsetsControllerCompat;

import com.google.android.material.button.MaterialButton;
import com.google.android.material.card.MaterialCardView;
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

        setupWindow();
        setupGlassCard();
        if (savedInstanceState == null) {
            playEntrance();
        }
    }

    private void setupWindow() {
        WindowCompat.setDecorFitsSystemWindows(getWindow(), false);
        View root = findViewById(R.id.loginRoot);
        WindowInsetsControllerCompat controller = new WindowInsetsControllerCompat(getWindow(), root);
        controller.setAppearanceLightStatusBars(true);
        controller.setAppearanceLightNavigationBars(true);

        View scroll = findViewById(R.id.loginScroll);
        ViewCompat.setOnApplyWindowInsetsListener(scroll, (v, insets) -> {
            Insets bars = insets.getInsets(WindowInsetsCompat.Type.systemBars() | WindowInsetsCompat.Type.ime());
            v.setPadding(0, bars.top, 0, bars.bottom);
            return insets;
        });
    }

    /**
     * Frosted-glass card. Android cannot blur "what is behind" a view, so on Android 12+ the card
     * holds a blurred copy of the page background that is kept aligned with the real background.
     * Older versions fall back to a more opaque translucent white.
     */
    private void setupGlassCard() {
        View root = findViewById(R.id.loginRoot);
        ImageView background = findViewById(R.id.loginBackground);
        ImageView blur = findViewById(R.id.glassBlur);
        View content = findViewById(R.id.glassContent);

        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.S) {
            blur.setRenderEffect(RenderEffect.createBlurEffect(36f, 36f, Shader.TileMode.CLAMP));
            blur.setVisibility(View.VISIBLE);
            root.getViewTreeObserver().addOnPreDrawListener(() -> {
                alignGlass(background, blur, content);
                return true;
            });
        } else {
            content.setBackgroundResource(R.color.login_glass_tint_fallback);
        }
    }

    /**
     * Sizes the blurred layer to the card and shifts/scales its image (centerCrop maths) so each
     * pixel lines up with the full-screen background underneath, however the card is moved.
     */
    private void alignGlass(ImageView background, ImageView blur, View content) {
        Drawable drawable = background.getDrawable();
        int backgroundWidth = background.getWidth();
        int backgroundHeight = background.getHeight();
        int cardWidth = content.getWidth();
        int cardHeight = content.getHeight();
        if (drawable == null || backgroundWidth == 0 || cardWidth == 0 || cardHeight == 0) {
            return;
        }

        ViewGroup.LayoutParams params = blur.getLayoutParams();
        if (params.width != cardWidth || params.height != cardHeight) {
            params.width = cardWidth;
            params.height = cardHeight;
            blur.setLayoutParams(params);
        }

        float scale = Math.max(
                (float) backgroundWidth / drawable.getIntrinsicWidth(),
                (float) backgroundHeight / drawable.getIntrinsicHeight());
        float cropX = (backgroundWidth - drawable.getIntrinsicWidth() * scale) / 2f;
        float cropY = (backgroundHeight - drawable.getIntrinsicHeight() * scale) / 2f;

        int[] blurLocation = new int[2];
        int[] backgroundLocation = new int[2];
        blur.getLocationInWindow(blurLocation);
        background.getLocationInWindow(backgroundLocation);

        Matrix matrix = new Matrix();
        matrix.setScale(scale, scale);
        matrix.postTranslate(
                cropX - (blurLocation[0] - backgroundLocation[0]),
                cropY - (blurLocation[1] - backgroundLocation[1]));
        blur.setImageMatrix(matrix);
    }

    private void playEntrance() {
        float offset = 28f * getResources().getDisplayMetrics().density;
        View[] views = {findViewById(R.id.brandRow), findViewById(R.id.loginCard)};
        for (int i = 0; i < views.length; i++) {
            views[i].setAlpha(0f);
            views[i].setTranslationY(offset);
            views[i].animate()
                    .alpha(1f)
                    .translationY(0f)
                    .setStartDelay(i * 120L)
                    .setDuration(450)
                    .setInterpolator(new DecelerateInterpolator())
                    .start();
        }
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
                body.getUser().getName(),
                body.getUser().getEmail(),
                body.getUser().getRole()
        );

        // OneSignal blocks bare small-integer external IDs (e.g. "1") as a common
        // placeholder-value anti-pattern, which pauses its entire operation queue for the
        // device (including the tag call below) if we pass one. Prefix it so it never collides.
        OneSignal.login("uniqueacr-admin-" + body.getUser().getId());
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
