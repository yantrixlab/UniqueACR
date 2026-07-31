package com.uniqueacr.admin.ui.enquiries;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
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

    private final List<Enquiry> enquiries = new ArrayList<>();
    private final OnEnquiryClickListener listener;

    public EnquiryAdapter(OnEnquiryClickListener listener) {
        this.listener = listener;
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

    @NonNull
    @Override
    public EnquiryViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_enquiry, parent, false);
        return new EnquiryViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull EnquiryViewHolder holder, int position) {
        holder.bind(enquiries.get(position), listener);
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

        EnquiryViewHolder(@NonNull View itemView) {
            super(itemView);
            nameText = itemView.findViewById(R.id.nameText);
            statusText = itemView.findViewById(R.id.statusText);
            phoneText = itemView.findViewById(R.id.phoneText);
            messageText = itemView.findViewById(R.id.messageText);
            dateText = itemView.findViewById(R.id.dateText);
        }

        void bind(Enquiry enquiry, OnEnquiryClickListener listener) {
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
        }
    }
}
