package com.uniqueacr.admin.model;

import com.google.gson.annotations.SerializedName;

/** An admin user who has opened a booking (only ever sent to super admins). */
public class EnquiryViewer {

    private long id;
    private String name;
    private String email;
    private String role;

    @SerializedName("seen_at")
    private String seenAt;

    public long getId() {
        return id;
    }

    public String getName() {
        return name;
    }

    public String getEmail() {
        return email;
    }

    public String getRole() {
        return role;
    }

    public String getSeenAt() {
        return seenAt;
    }
}
