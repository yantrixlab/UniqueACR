package com.uniqueacr.admin;

import android.app.Application;

import com.onesignal.OneSignal;
import com.onesignal.debug.LogLevel;

public class MyApplication extends Application {

    @Override
    public void onCreate() {
        super.onCreate();

        if (BuildConfig.DEBUG) {
            OneSignal.getDebug().setLogLevel(LogLevel.VERBOSE);
        }

        OneSignal.initWithContext(this, BuildConfig.ONESIGNAL_APP_ID);
    }
}
