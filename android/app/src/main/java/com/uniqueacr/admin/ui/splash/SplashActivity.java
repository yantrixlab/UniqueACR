package com.uniqueacr.admin.ui.splash;

import android.content.Intent;
import android.os.Bundle;

import androidx.appcompat.app.AppCompatActivity;

import com.uniqueacr.admin.R;
import com.uniqueacr.admin.ui.enquiries.EnquiryListActivity;
import com.uniqueacr.admin.ui.login.LoginActivity;
import com.uniqueacr.admin.util.SessionManager;

public class SplashActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);

        boolean loggedIn = SessionManager.getInstance(this).isLoggedIn();

        Intent intent = new Intent(this, loggedIn ? EnquiryListActivity.class : LoginActivity.class);
        startActivity(intent);
        finish();
    }
}
