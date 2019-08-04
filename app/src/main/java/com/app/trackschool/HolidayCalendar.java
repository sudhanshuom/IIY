package com.app.trackschool;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;
import com.imanoweb.calendarview.CalendarListener;
import com.imanoweb.calendarview.CustomCalendarView;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;
import java.util.Locale;


public class HolidayCalendar extends AppCompatActivity {

    CustomCalendarView calendarView;
    Calendar currentCalendar;
    ImageView bcimg;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_holiday_calendar);

        bcimg = findViewById(R.id.back);
        calendarView = findViewById(R.id.calendar);
        currentCalendar = Calendar.getInstance(Locale.getDefault());
        calendarView.setFirstDayOfWeek(Calendar.MONDAY);

        calendarView.setShowOverflowDate(false);
        calendarView.refreshCalendar(currentCalendar);


        calendarView.setCalendarListener(new CalendarListener() {
            @Override
            public void onDateSelected(Date date) {
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

        ArrayList<String> holidays = new ArrayList<>();
        holidays = getHolidayList(holidays);
        List decorators = new ArrayList<>();
        decorators.add(new ColorDecorator(holidays));
        holidays = getLeaveDates(holidays);
        decorators.add(new ColorDecorator(holidays));
        holidays = getAbsentDate(holidays);
        decorators.add(new ColorDecorator(holidays));
        calendarView.setDecorators(decorators);
        calendarView.refreshCalendar(currentCalendar);

    }

    /*
    * Append "/1" for holidays
    * Append "/2" for leaves
    * Append "/0" for absent
    * */
    private ArrayList<String> getHolidayList(ArrayList<String> al) {
        al.add("31/07/2019"+"/1");
        al.add("26/07/2019"+"/1");
        al.add("15/08/2019"+"/1");
        return al;
    }private ArrayList<String> getLeaveDates(ArrayList<String> al) {
        al.add("06/07/2019"+"/2");
        al.add("22/07/2019"+"/2");
        al.add("14/08/2019"+"/2");
        return al;
    }private ArrayList<String> getAbsentDate(ArrayList<String> al) {
        al.add("06/07/2019"+"/0");
        al.add("12/07/2019"+"/0");
        al.add("19/08/2019"+"/0");
        return al;
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        finish();
    }
}
