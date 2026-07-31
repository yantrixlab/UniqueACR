package com.uniqueacr.admin.model;

import java.util.List;

public class PaginatedResponse<T> {

    private List<T> data;

    @com.google.gson.annotations.SerializedName("current_page")
    private int currentPage;

    @com.google.gson.annotations.SerializedName("last_page")
    private int lastPage;

    public List<T> getData() {
        return data;
    }

    public int getCurrentPage() {
        return currentPage;
    }

    public int getLastPage() {
        return lastPage;
    }

    public boolean hasMorePages() {
        return currentPage < lastPage;
    }
}
