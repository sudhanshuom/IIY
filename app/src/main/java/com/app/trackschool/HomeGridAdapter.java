package com.app.trackschool;

import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;

import androidx.cardview.widget.CardView;

import com.google.firebase.auth.FirebaseAuth;

import java.util.Calendar;

class HomeGridAdapter extends BaseAdapter {

    private Context mContext;

    // Constructor
    public HomeGridAdapter(Context c) {
        mContext = c;
    }

    public int getCount() {
        return mThumbIds.length;
    }

    public Object getItem(int position) {
        return null;
    }

    public long getItemId(int position) {
        return 0;
    }

    // create a new ImageView for each item referenced by the Adapter
    public View getView(final int position, View view, ViewGroup parent) {



        ImageView imageView = null;
        TextView tv = null;
        CardView rl = null;

        if (view == null)
            view = LayoutInflater.from(mContext).inflate(R.layout.grid_layout_item,parent,false);

        imageView = view.findViewById(R.id.iv);
        tv = view.findViewById(R.id.tv);
        rl = view.findViewById(R.id.rl);

        imageView.setImageResource(mThumbIds[position]);
        tv.setText(text[position]);
        rl.setBackground(mContext.getDrawable(Color[position]));

        return view;
    }

    // Keep all Images in array
    public Integer[] mThumbIds = {
            R.drawable.profile,
            R.drawable.tracking,
            R.drawable.apply_leave,
            R.drawable.academic_calendar,
            R.drawable.pay_fees,
            R.drawable.logout
    };

    public String[] text = {
            "Profile",
            "Track Bus",
            "Apply Leave",
            "Academic Calendar",
            "Pay Fees",
            "Log Out"
    };

    public Integer[] Color = {
        R.color.color1,
        R.color.color2,
        R.color.color3,
        R.color.color4,
        R.color.color5,
        R.color.color6
    };


}
