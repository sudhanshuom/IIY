package com.app.trackschool;

import androidx.appcompat.app.AppCompatActivity;

import android.graphics.Color;
import android.os.Bundle;
import android.widget.CalendarView;

import com.imanoweb.calendarview.CalendarListener;
import com.imanoweb.calendarview.CustomCalendarView;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;
import java.util.Locale;


public class HolidayCalendar extends AppCompatActivity {

    CustomCalendarView calendarView;
    Calendar currentCalendar;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_holiday_calendar);

        calendarView = findViewById(R.id.calendar);
        currentCalendar = Calendar.getInstance(Locale.getDefault());
        calendarView.setFirstDayOfWeek(Calendar.MONDAY);

        calendarView.setShowOverflowDate(false);
        calendarView.refreshCalendar(currentCalendar);


        calendarView.setCalendarListener(new CalendarListener() {
            @Override
            public void onDateSelected(Date date) {
                calendarView.refreshCalendar(currentCalendar);
                return;
            }

            @Override
            public void onMonthChanged(Date date) {
                return;
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
}
