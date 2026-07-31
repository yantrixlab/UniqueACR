package com.uniqueacr.admin.ui.enquiries;

import android.content.Context;

import androidx.core.content.ContextCompat;

import com.uniqueacr.admin.R;

final class EnquiryStatusColors {

    private EnquiryStatusColors() {
    }

    static int forStatus(Context context, String status) {
        int colorRes;
        switch (status) {
            case "contacted":
                colorRes = R.color.status_contacted;
                break;
            case "closed":
                colorRes = R.color.status_closed;
                break;
            case "pending":
            default:
                colorRes = R.color.status_pending;
                break;
        }
        return ContextCompat.getColor(context, colorRes);
    }
}
