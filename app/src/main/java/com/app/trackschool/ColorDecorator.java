package com.app.trackschool;

import android.graphics.Color;
import android.util.Log;

import com.imanoweb.calendarview.DayDecorator;
import com.imanoweb.calendarview.DayView;

import java.util.ArrayList;


public class ColorDecorator implements DayDecorator {
    String month[] = new String[]{"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"};
    ArrayList<String> holiday;
    int colo[] = {Color.rgb(255,0,0), Color.rgb(0,255,0), Color.rgb(0,0,255)};

    public ColorDecorator(){}
    public ColorDecorator(ArrayList<String> holiday){
        this.holiday = holiday;
    }

    @Override
    public void decorate(DayView cell) {
        String str[] = cell.getDate().toString().split(" ");
        String date = str[5]+str[1]+str[2];
        for(String s : holiday){
            String ss[] = s.trim().split("/");
            String dd = ss[2]+month[Integer.parseInt(ss[1]) - 1]+ss[0];
            int color = colo[Integer.parseInt(ss[3])];
            Log.e("curdt", date+"  "+dd);
            if(dd.equals(date)){
                cell.setBackgroundColor(color);
            }
        }
//        if(cell.getDate() == cell.getDate()){
//            Log.e("curdt", cell.getDate()+"");
//            int color = Color.rgb(255,0,0);
//            cell.setBackgroundColor(color);
//        }
    }
}
