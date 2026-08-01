package com.uniqueacr.admin.network;

import com.uniqueacr.admin.model.Enquiry;
import com.uniqueacr.admin.model.LoginRequest;
import com.uniqueacr.admin.model.LoginResponse;
import com.uniqueacr.admin.model.PaginatedResponse;
import com.uniqueacr.admin.model.StatusUpdateRequest;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.DELETE;
import retrofit2.http.GET;
import retrofit2.http.PATCH;
import retrofit2.http.POST;
import retrofit2.http.Path;
import retrofit2.http.Query;

public interface ApiService {

    @POST("admin/login")
    Call<LoginResponse> login(@Body LoginRequest request);

    @POST("admin/logout")
    Call<Void> logout();

    @GET("admin/enquiries")
    Call<PaginatedResponse<Enquiry>> getEnquiries(@Query("page") int page);

    @GET("admin/enquiries/{id}")
    Call<EnquiryResponse> getEnquiry(@Path("id") long id);

    @PATCH("admin/enquiries/{id}")
    Call<EnquiryResponse> updateEnquiryStatus(@Path("id") long id, @Body StatusUpdateRequest request);

    @DELETE("admin/enquiries/{id}")
    Call<Void> deleteEnquiry(@Path("id") long id);

    class EnquiryResponse {
        private Enquiry data;

        public Enquiry getData() {
            return data;
        }
    }
}
