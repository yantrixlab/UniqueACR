package com.uniqueacr.admin.ui.enquiries;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageButton;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.uniqueacr.admin.R;
import com.uniqueacr.admin.model.Enquiry;

import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

public class EnquiryAdapter extends RecyclerView.Adapter<EnquiryAdapter.EnquiryViewHolder> {

    public interface OnEnquiryClickListener {
        void onEnquiryClick(Enquiry enquiry);
    }

    public interface OnEnquiryDeleteListener {
        void onEnquiryDeleteClick(Enquiry enquiry);
    }

    private final List<Enquiry> enquiries = new ArrayList<>();
    private final OnEnquiryClickListener listener;
    private final OnEnquiryDeleteListener deleteListener;
    private final boolean canDelete;

    public EnquiryAdapter(OnEnquiryClickListener listener, OnEnquiryDeleteListener deleteListener, boolean canDelete) {
        this.listener = listener;
        this.deleteListener = deleteListener;
        this.canDelete = canDelete;
    }

    public void setEnquiries(List<Enquiry> newEnquiries) {
        enquiries.clear();
        enquiries.addAll(newEnquiries);
        notifyDataSetChanged();
    }

    public void appendEnquiries(List<Enquiry> more) {
        int start = enquiries.size();
        enquiries.addAll(more);
        notifyItemRangeInserted(start, more.size());
    }

    public void removeEnquiry(long enquiryId) {
        for (int i = 0; i < enquiries.size(); i++) {
            if (enquiries.get(i).getId() == enquiryId) {
                enquiries.remove(i);
                notifyItemRemoved(i);
                return;
            }
        }
    }

    @NonNull
    @Override
    public EnquiryViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_enquiry, parent, false);
        return new EnquiryViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull EnquiryViewHolder holder, int position) {
        holder.bind(enquiries.get(position), listener, deleteListener, canDelete);
    }

    @Override
    public int getItemCount() {
        return enquiries.size();
    }

    static class EnquiryViewHolder extends RecyclerView.ViewHolder {

        private final TextView nameText;
        private final TextView statusText;
        private final TextView phoneText;
        private final TextView messageText;
        private final TextView dateText;
        private final ImageButton deleteButton;

        EnquiryViewHolder(@NonNull View itemView) {
            super(itemView);
            nameText = itemView.findViewById(R.id.nameText);
            statusText = itemView.findViewById(R.id.statusText);
            phoneText = itemView.findViewById(R.id.phoneText);
            messageText = itemView.findViewById(R.id.messageText);
            dateText = itemView.findViewById(R.id.dateText);
            deleteButton = itemView.findViewById(R.id.deleteButton);
        }

        void bind(Enquiry enquiry, OnEnquiryClickListener listener, OnEnquiryDeleteListener deleteListener, boolean canDelete) {
            nameText.setText(enquiry.getName());
            phoneText.setText(enquiry.getPhone());
            messageText.setText(enquiry.getMessage());
            dateText.setText(enquiry.getCreatedAt());

            String status = enquiry.getStatus() == null ? "" : enquiry.getStatus();
            statusText.setText(status.toUpperCase(Locale.US));
            statusText.setTextColor(EnquiryStatusColors.forStatus(itemView.getContext(), status));

            itemView.setOnClickListener(v -> {
                if (listener != null) {
                    listener.onEnquiryClick(enquiry);
                }
            });

            deleteButton.setVisibility(canDelete ? View.VISIBLE : View.GONE);
            deleteButton.setOnClickListener(v -> {
                if (deleteListener != null) {
                    deleteListener.onEnquiryDeleteClick(enquiry);
                }
            });
        }
    }
}
