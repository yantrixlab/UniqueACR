package com.uniqueacr.admin;

import android.app.Application;
import android.app.NotificationChannel;
import android.app.NotificationManager;

import com.onesignal.OneSignal;
import com.onesignal.debug.LogLevel;

public class MyApplication extends Application {

    /** Must match OneSignalService::ANDROID_CHANNEL_ID on the server. */
    public static final String BOOKING_ALERTS_CHANNEL_ID = "new_bookings";

    @Override
    public void onCreate() {
        super.onCreate();

        createBookingAlertsChannel();

        if (BuildConfig.DEBUG) {
            OneSignal.getDebug().setLogLevel(LogLevel.VERBOSE);
        }

        OneSignal.initWithContext(this, BuildConfig.ONESIGNAL_APP_ID);
    }

    /**
     * IMPORTANCE_HIGH is what makes Android show a heads-up banner (and play the sound) while the
     * phone is in use. Importance cannot be raised once a channel exists, so this uses a new id.
     */
    private void createBookingAlertsChannel() {
        NotificationManager manager = getSystemService(NotificationManager.class);
        if (manager == null) {
            return;
        }

        NotificationChannel channel = new NotificationChannel(
                BOOKING_ALERTS_CHANNEL_ID,
                getString(R.string.channel_booking_alerts_name),
                NotificationManager.IMPORTANCE_HIGH);
        channel.setDescription(getString(R.string.channel_booking_alerts_description));
        channel.enableVibration(true);
        channel.setShowBadge(true);
        manager.createNotificationChannel(channel);
    }
}
