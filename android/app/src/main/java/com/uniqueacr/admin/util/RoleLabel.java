package com.uniqueacr.admin.util;

import java.util.Locale;

public final class RoleLabel {

    private RoleLabel() {
    }

    public static String format(String role) {
        if (role == null || role.isEmpty()) {
            return "";
        }
        switch (role) {
            case "super_admin":
                return "Super Admin";
            case "admin":
                return "Admin";
            case "editor":
                return "Editor";
            case "employee":
                return "Employee";
            default:
                String spaced = role.replace('_', ' ').toLowerCase(Locale.ROOT);
                return Character.toUpperCase(spaced.charAt(0)) + spaced.substring(1);
        }
    }
}
