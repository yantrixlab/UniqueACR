package com.uniqueacr.admin.model;

public class LoginResponse {

    private String token;
    private AdminUser user;

    public String getToken() {
        return token;
    }

    public AdminUser getUser() {
        return user;
    }

    public static class AdminUser {
        private long id;
        private String name;
        private String email;
        private String role;

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
    }
}
