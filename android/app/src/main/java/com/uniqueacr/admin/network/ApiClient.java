package com.uniqueacr.admin.network;

import android.content.Context;

import androidx.annotation.Nullable;

import com.uniqueacr.admin.BuildConfig;
import com.uniqueacr.admin.util.SessionManager;

import java.util.concurrent.TimeUnit;

import okhttp3.OkHttpClient;
import okhttp3.logging.HttpLoggingInterceptor;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class ApiClient {

    private static ApiService apiService;
    private static AuthInterceptor authInterceptor;

    public static synchronized ApiService getApiService(Context context) {
        if (apiService == null) {
            SessionManager sessionManager = SessionManager.getInstance(context.getApplicationContext());
            authInterceptor = new AuthInterceptor(sessionManager);

            HttpLoggingInterceptor logging = new HttpLoggingInterceptor();
            logging.setLevel(BuildConfig.DEBUG
                    ? HttpLoggingInterceptor.Level.BODY
                    : HttpLoggingInterceptor.Level.NONE);

            OkHttpClient client = new OkHttpClient.Builder()
                    .addInterceptor(authInterceptor)
                    .addInterceptor(logging)
                    .connectTimeout(20, TimeUnit.SECONDS)
                    .readTimeout(20, TimeUnit.SECONDS)
                    .build();

            Retrofit retrofit = new Retrofit.Builder()
                    .baseUrl(BuildConfig.API_BASE_URL)
                    .client(client)
                    .addConverterFactory(GsonConverterFactory.create())
                    .build();

            apiService = retrofit.create(ApiService.class);
        }

        return apiService;
    }

    /**
     * The active foreground activity should call this in onResume (and pass null in onPause)
     * so a 401 always routes through whichever screen is currently visible.
     */
    public static synchronized void setUnauthorizedListener(@Nullable AuthInterceptor.UnauthorizedListener listener) {
        if (authInterceptor != null) {
            authInterceptor.setUnauthorizedListener(listener);
        }
    }
}
