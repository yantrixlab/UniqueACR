package com.uniqueacr.admin.model;

import com.google.gson.annotations.SerializedName;

public class EnquiryStats {

    @SerializedName("pending_bookings")
    private int pendingBookings;

    @SerializedName("completed_bookings")
    private int completedBookings;

    @SerializedName("pending_other")
    private int pendingOther;

    public int getPendingBookings() {
        return pendingBookings;
    }

    public int getCompletedBookings() {
        return completedBookings;
    }

    public int getPendingOther() {
        return pendingOther;
    }
}
