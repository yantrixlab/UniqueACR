package com.uniqueacr.admin.util;

import android.view.View;
import android.view.ViewGroup;

import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

public final class WindowInsetsHelper {

    private WindowInsetsHelper() {
    }

    /**
     * Android 15+ draws apps edge to edge, so the status bar sits on top of the toolbar. This pushes
     * the toolbar's content down by the status bar height (and grows the toolbar to match). On older
     * versions the inset is zero, so nothing changes.
     */
    public static void padToolbarForStatusBar(View toolbar) {
        final int basePaddingTop = toolbar.getPaddingTop();
        final int baseHeight = toolbar.getLayoutParams().height;

        ViewCompat.setOnApplyWindowInsetsListener(toolbar, (view, insets) -> {
            Insets bars = insets.getInsets(WindowInsetsCompat.Type.statusBars() | WindowInsetsCompat.Type.displayCutout());
            view.setPadding(view.getPaddingLeft(), basePaddingTop + bars.top, view.getPaddingRight(), view.getPaddingBottom());

            ViewGroup.LayoutParams params = view.getLayoutParams();
            if (baseHeight > 0) {
                params.height = baseHeight + bars.top;
                view.setLayoutParams(params);
            }
            return insets;
        });
    }
}
