package com.uniqueacr.admin.model;

import com.google.gson.annotations.SerializedName;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Locale;

public class Enquiry {

    private long id;
    private String name;
    private String phone;
    private String email;
    private String message;

    @SerializedName("source_type")
    private String sourceType;

    @SerializedName("source_id")
    private Long sourceId;

    @SerializedName("preferred_date")
    private String preferredDate;

    @SerializedName("preferred_time")
    private String preferredTime;

    private String status;

    @SerializedName("created_at")
    private String createdAt;

    @SerializedName("updated_at")
    private String updatedAt;

    public long getId() {
        return id;
    }

    public String getName() {
        return name;
    }

    public String getPhone() {
        return phone;
    }

    public String getEmail() {
        return email;
    }

    public String getMessage() {
        return message;
    }

    public String getSourceType() {
        return sourceType;
    }

    public Long getSourceId() {
        return sourceId;
    }

    public String getPreferredDate() {
        return preferredDate;
    }

    public String getPreferredTime() {
        return preferredTime;
    }

    /** e.g. "Fri, 23 Oct 2026 · 11 AM – 1 PM"; null when the enquiry has no booked visit. */
    public String getVisitSummary() {
        if (preferredDate == null || preferredDate.isEmpty()) {
            return null;
        }

        String date = preferredDate;
        try {
            Date parsed = new SimpleDateFormat("yyyy-MM-dd", Locale.US).parse(preferredDate);
            if (parsed != null) {
                date = new SimpleDateFormat("EEE, dd MMM yyyy", Locale.US).format(parsed);
            }
        } catch (ParseException ignored) {
            // fall back to the raw value
        }

        return (preferredTime == null || preferredTime.isEmpty()) ? date : date + " · " + preferredTime;
    }

    public String getStatus() {
        return status;
    }

    public String getCreatedAt() {
        return createdAt;
    }

    public String getUpdatedAt() {
        return updatedAt;
    }
}
