package com.app.trackschool;

import android.app.DatePickerDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.RatingBar;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.firestore.DocumentSnapshot;
import com.google.firebase.firestore.FirebaseFirestore;

import java.util.Calendar;
import java.util.HashMap;

public class Feedback extends AppCompatActivity {

    private EditText feedbackk;
    private Button updateBtn;
    private FirebaseFirestore db = FirebaseFirestore.getInstance();
    private int year, month, day;
    Animation shakeAnimation;
    RatingBar ratingBar;
    ImageView back;
    HashMap<String, Object> hashMap = new HashMap<>();
    private SharedPreferences sharedPreferences;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_feedback);

        feedbackk = findViewById(R.id.feedback);
        updateBtn = findViewById(R.id.submit_feedback);
        ratingBar = findViewById(R.id.rating);
        ratingBar.setNumStars(5);
        back = findViewById(R.id.back);

        sharedPreferences = PreferenceManager.getDefaultSharedPreferences(getBaseContext());
        final String uid = sharedPreferences.getString("admissionNo","NULL");

        if(uid == null || uid.equals("NULL")) {
            // Opens login/signup Activity
            Intent login_Session = new Intent(Feedback.this, UserLogin.class);
            startActivity(login_Session);
            finish();
            return;
        }


        shakeAnimation = AnimationUtils.loadAnimation(this, R.anim.shake_animation);
        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                onBackPressed();
            }
        });

        updateBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String feedback = feedbackk.getText().toString();

                if(ratingBar.getRating() == 0){
                    ratingBar.startAnimation(shakeAnimation);
                    Toast.makeText(Feedback.this, "Please Rate...", Toast.LENGTH_SHORT).show();
                    return;
                }
                hashMap.clear();

                Calendar calendar = Calendar.getInstance();
                year = calendar.get(Calendar.YEAR);

                month = calendar.get(Calendar.MONTH) + 1;
                day = calendar.get(Calendar.DAY_OF_MONTH);

                hashMap.put("feedback", feedback);
                hashMap.put("date", day+"-"+month+"-"+year);
                hashMap.put("uid", uid);
                hashMap.put("rating", ratingBar.getRating());
                hashMap.put("name", PreferenceManager.getDefaultSharedPreferences(getBaseContext())
                                .getString("name","NOT FOUND"));


                if (!TextUtils.isEmpty(feedback) ){
                    db.collection("Feedback").document("S"+uid)
                            .set(hashMap).addOnCompleteListener(new OnCompleteListener<Void>() {
                        @Override
                        public void onComplete(@NonNull Task<Void> task) {
                            if (task.isSuccessful()){
                                Toast.makeText(Feedback.this, "Thank you for your valuable Feedback.", Toast.LENGTH_SHORT).show();
                                Intent intent = new Intent(Feedback.this, MainActivity.class);
                                intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK | Intent.FLAG_ACTIVITY_NEW_TASK);
                                startActivity(intent);
                                finish();
                            }
                        }
                    });

                }else {
                    feedbackk.setAnimation(shakeAnimation);
                    feedbackk.setError("Tell us Something");
                    Toast.makeText(Feedback.this, "Please Give Feedback", Toast.LENGTH_SHORT).show();
                }
            }
        });
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        finish();
    }
}
