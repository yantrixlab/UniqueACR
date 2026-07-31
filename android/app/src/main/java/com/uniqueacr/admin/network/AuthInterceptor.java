package com.uniqueacr.admin.network;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

import com.uniqueacr.admin.util.SessionManager;

import java.io.IOException;

import okhttp3.Interceptor;
import okhttp3.Request;
import okhttp3.Response;

public class AuthInterceptor implements Interceptor {

    public interface UnauthorizedListener {
        void onUnauthorized();
    }

    private final SessionManager sessionManager;
    private volatile UnauthorizedListener unauthorizedListener;

    public AuthInterceptor(SessionManager sessionManager) {
        this.sessionManager = sessionManager;
    }

    public void setUnauthorizedListener(@Nullable UnauthorizedListener listener) {
        this.unauthorizedListener = listener;
    }

    @NonNull
    @Override
    public Response intercept(@NonNull Chain chain) throws IOException {
        Request.Builder builder = chain.request().newBuilder()
                .header("Accept", "application/json");

        String token = sessionManager.getToken();
        if (token != null) {
            builder.header("Authorization", "Bearer " + token);
        }

        Response response = chain.proceed(builder.build());

        if (response.code() == 401) {
            sessionManager.clearSession();
            UnauthorizedListener listener = unauthorizedListener;
            if (listener != null) {
                listener.onUnauthorized();
            }
        }

        return response;
    }
}
