package com.uniqueacr.admin.model;

import com.google.gson.annotations.SerializedName;

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
