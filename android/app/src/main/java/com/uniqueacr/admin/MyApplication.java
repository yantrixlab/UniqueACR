package com.uniqueacr.admin;

import android.app.Application;
import android.app.NotificationChannel;
import android.app.NotificationManager;
import android.media.AudioAttributes;
import android.net.Uri;

import com.onesignal.OneSignal;
import com.onesignal.debug.LogLevel;

public class MyApplication extends Application {

    /** Must match OneSignalService::BOOKING_CHANNEL_ID / ENQUIRY_CHANNEL_ID on the server. */
    public static final String BOOKING_CHANNEL_ID = "booking_alerts";
    public static final String ENQUIRY_CHANNEL_ID = "enquiry_alerts";

    @Override
    public void onCreate() {
        super.onCreate();

        createNotificationChannels();

        if (BuildConfig.DEBUG) {
            OneSignal.getDebug().setLogLevel(LogLevel.VERBOSE);
        }

        OneSignal.initWithContext(this, BuildConfig.ONESIGNAL_APP_ID);
    }

    /**
     * IMPORTANCE_HIGH makes Android show a heads-up banner while the phone is in use. A channel's
     * sound and importance are fixed once created, which is why bookings get their own channel
     * (custom booking_alert.mp3, played once per notification) and why ids are never reused.
     */
    private void createNotificationChannels() {
        NotificationManager manager = getSystemService(NotificationManager.class);
        if (manager == null) {
            return;
        }

        // Replaced by the two channels below; remove it so it doesn't linger in the app's settings.
        manager.deleteNotificationChannel("new_bookings");

        NotificationChannel bookings = new NotificationChannel(
                BOOKING_CHANNEL_ID,
                getString(R.string.channel_bookings_name),
                NotificationManager.IMPORTANCE_HIGH);
        bookings.setDescription(getString(R.string.channel_bookings_description));
        bookings.enableVibration(true);
        bookings.setShowBadge(true);
        bookings.setSound(
                Uri.parse("android.resource://" + getPackageName() + "/" + R.raw.booking_alert),
                new AudioAttributes.Builder()
                        .setUsage(AudioAttributes.USAGE_NOTIFICATION)
                        .setContentType(AudioAttributes.CONTENT_TYPE_SONIFICATION)
                        .build());
        manager.createNotificationChannel(bookings);

        NotificationChannel enquiries = new NotificationChannel(
                ENQUIRY_CHANNEL_ID,
                getString(R.string.channel_enquiries_name),
                NotificationManager.IMPORTANCE_HIGH);
        enquiries.setDescription(getString(R.string.channel_enquiries_description));
        enquiries.enableVibration(true);
        enquiries.setShowBadge(true);
        manager.createNotificationChannel(enquiries);
    }
}
