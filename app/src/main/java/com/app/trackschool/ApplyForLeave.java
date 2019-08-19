package com.app.trackschool;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.AppCompatTextView;

import android.app.DatePickerDialog;
import android.content.Intent;
import android.location.Address;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.Toolbar;

import com.app.trackschool.Model.Location;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.CameraPosition;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.database.annotations.Nullable;
import com.google.firebase.firestore.DocumentReference;
import com.google.firebase.firestore.DocumentSnapshot;
import com.google.firebase.firestore.EventListener;
import com.google.firebase.firestore.FirebaseFirestore;
import com.google.firebase.firestore.FirebaseFirestoreException;

import java.util.Calendar;
import java.util.HashMap;
import java.util.List;

public class ApplyForLeave extends AppCompatActivity {

    private EditText reason, from, to;
    private Button updateBtn;
    private FirebaseFirestore db = FirebaseFirestore.getInstance();
    private int year, month, day;
    String driverId = "default";
    HashMap<String, Object> hashMap = new HashMap<>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_apply_for_leave);

        reason = findViewById(R.id.reason_holiday);
        from = findViewById(R.id.holiday_from);
        to = findViewById(R.id.holiday_upto);
        updateBtn = findViewById(R.id.holiday_update_btn);

        from.setKeyListener(null);
        to.setKeyListener(null);
        from.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                SetDate(from);
            }
        });
        to.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                SetDate(to);
            }
        });

        updateBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String reason_holiday = reason.getText().toString();
                String holiday_from = from.getText().toString();
                String holiday_to = to.getText().toString();

                hashMap.clear();
                hashMap.put("reason", reason_holiday);
                hashMap.put("from", holiday_from);
                hashMap.put("to", holiday_to);


                if (!TextUtils.isEmpty(reason_holiday) || !TextUtils.isEmpty(holiday_from) ||
                        !TextUtils.isEmpty(holiday_to) ){

                    db.collection("Parent").document(FirebaseAuth.getInstance().getCurrentUser().getUid())
                            .get()
                            .addOnCompleteListener(new OnCompleteListener<DocumentSnapshot>() {
                                @Override
                                public void onComplete(@NonNull Task<DocumentSnapshot> task) {
                                    if (task.isSuccessful()) {
                                        Log.e("details", task.getResult()+"");
                                        DocumentSnapshot document = task.getResult();

                                        /*******************************************
                                         * TODO: Get assigned driver id
                                         */

                                        if(document.get("driver_id") != null)
                                            driverId = document.get("driver_id").toString();

                                        Log.e("driverid",driverId+"");
                                        hashMap.put("driver_id", driverId);
                                        db.collection("Holiday").document(FirebaseAuth.getInstance().getCurrentUser().getUid())
                                                .set(hashMap).addOnCompleteListener(new OnCompleteListener<Void>() {
                                            @Override
                                            public void onComplete(@NonNull Task<Void> task) {
                                                if (task.isSuccessful()){
                                                    Toast.makeText(ApplyForLeave.this, "Successfully updated", Toast.LENGTH_SHORT).show();
                                                    Intent intent = new Intent(ApplyForLeave.this, MainActivity.class);
                                                    intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_NEW_TASK);
                                                    startActivity(intent);
                                                }
                                            }
                                        });


                                    } else {
                                        Log.e("error", "Error getting documents.", task.getException());
                                    }
                                }
                            });


                }else {
                    Toast.makeText(ApplyForLeave.this, "Please fill all the fields", Toast.LENGTH_SHORT).show();
                }
            }
        });
    }

    public void SetDate(final EditText view) {
        Calendar calendar = Calendar.getInstance();
        year = calendar.get(Calendar.YEAR);

        month = calendar.get(Calendar.MONTH);
        day = calendar.get(Calendar.DAY_OF_MONTH);
            calendar.clear();
            calendar.set(year, month, day);


        final Calendar myCalendar = Calendar.getInstance();

        DatePickerDialog.OnDateSetListener date = new DatePickerDialog.OnDateSetListener() {
            @Override
            public void onDateSet(DatePicker arg0, int year, int month, int day) {
                Toast.makeText(ApplyForLeave.this, ""+day+"/"+(month+1)+"/"+year,Toast.LENGTH_SHORT).show();
                Calendar calendar = Calendar.getInstance();
                calendar.set(year, month, day);
                view.setText(day+"/"+(month+1)+"/"+year);
            }
        };


        long secondsSinceEpoch = calendar.getTimeInMillis();

        DatePickerDialog db = new DatePickerDialog(ApplyForLeave.this, date, myCalendar
                .get(Calendar.YEAR), myCalendar.get(Calendar.MONTH),
                myCalendar.get(Calendar.DAY_OF_MONTH));

        //db.getDatePicker().setMaxDate(secondsSinceEpoch+Long.parseLong("432000000"));
        db.getDatePicker().setMinDate(secondsSinceEpoch);
        db.show();
    }
}
