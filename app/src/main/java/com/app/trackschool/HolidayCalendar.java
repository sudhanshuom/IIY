package com.app.trackschool;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;

import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.firestore.DocumentSnapshot;
import com.google.firebase.firestore.FirebaseFirestore;
import com.google.firebase.firestore.QuerySnapshot;
import com.imanoweb.calendarview.CalendarListener;
import com.imanoweb.calendarview.CustomCalendarView;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Locale;


public class HolidayCalendar extends AppCompatActivity {

    String month[] = new String[]{"Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"};
    CustomCalendarView calendarView;
    Calendar currentCalendar;
    ImageView bcimg;
    ArrayList<String> holidays = new ArrayList<>();
    List decorators = new ArrayList<>();
    HashMap<String, String> holidayReason = new HashMap<>();
    TextView reason;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_holiday_calendar);

        bcimg = findViewById(R.id.back);
        calendarView = findViewById(R.id.calendar);
        reason = findViewById(R.id.reason);
        currentCalendar = Calendar.getInstance(Locale.getDefault());
        calendarView.setFirstDayOfWeek(Calendar.MONDAY);

        calendarView.setShowOverflowDate(false);
        calendarView.refreshCalendar(currentCalendar);


        calendarView.setCalendarListener(new CalendarListener() {
            @Override
            public void onDateSelected(Date date) {
                String str[] = (date+"").split(" ");
                String mon="";
                for(int i = 0; i < 12; i++) {
                    if (month[i].equals(str[1])){
                        if(i+1 < 10)
                            mon = "0"+(i+1);
                        else
                            mon = i+"";
                        break;
                    }
                }
                String sear = str[2]+"-"+mon+"-"+str[5];

                Log.e("date", sear+holidayReason);
                if(holidayReason.get(sear) != null)
                    reason.setText(sear+": "+holidayReason.get(sear));
                else
                    reason.setText("");
                calendarView.refreshCalendar(currentCalendar);
            }

            @Override
            public void onMonthChanged(Date date) {

            }
        });
        bcimg.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                onBackPressed();
            }
        });


        FirebaseFirestore db = FirebaseFirestore.getInstance();
        db.collection("HolidayEvents")
                .get()
                .addOnCompleteListener(new OnCompleteListener<QuerySnapshot>() {
                    @Override
                    public void onComplete(@NonNull Task<QuerySnapshot> task) {
                        for(DocumentSnapshot ds : task.getResult()){
                            Log.e("holiday", ds.get("reason").toString());
                            holidays.add(ds.getId()+"-0");
                            holidayReason.put(ds.getId(), ds.get("reason").toString());
                        }

                        decorators.add(new ColorDecorator(holidays));
                        calendarView.setDecorators(decorators);
                        calendarView.refreshCalendar(currentCalendar);
                    }
                });


        //holidays = getHolidayList(holidays);
        //decorators.add(new ColorDecorator(holidays));
        //holidays = getLeaveDates(holidays);
        //decorators.add(new ColorDecorator(holidays));
        //holidays = getAbsentDate(holidays);


    }

    /*
    * Append "-1" for holidays
    * Append "-2" for leaves
    * Append "-0" for absent
    * */
    private ArrayList<String> getHolidayList(ArrayList<String> al) {
        al.add("31-07-2019"+"-0");
        al.add("26-07-2019"+"-0");
        al.add("15-08-2019"+"-0");
        return al;
    }private ArrayList<String> getLeaveDates(ArrayList<String> al) {

        return al;
    }private ArrayList<String> getAbsentDate(ArrayList<String> al) {

        return al;
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        finish();
    }
}
