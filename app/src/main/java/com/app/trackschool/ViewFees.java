package com.app.trackschool;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.AppCompatTextView;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.view.View;
import android.widget.ImageView;
import android.widget.ProgressBar;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.firestore.DocumentSnapshot;
import com.google.firebase.firestore.FirebaseFirestore;

public class ViewFees extends AppCompatActivity {
    private ImageView backimg;
    AppCompatTextView fairtv;
    ProgressBar loadfair;

    private SharedPreferences sharedPreferences;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_view_fees);

        backimg = findViewById(R.id.back);
        fairtv = findViewById(R.id.fair);
        loadfair = findViewById(R.id.fairload);
        loadfair.setVisibility(View.VISIBLE);

        backimg.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                onBackPressed();
            }
        });

        sharedPreferences = PreferenceManager.getDefaultSharedPreferences(getBaseContext());
        final String uid = sharedPreferences.getString("admissionNo","NULL");

        if(uid == null || uid.equals("NULL")) {
            // Opens login/signup Activity
            Intent login_Session = new Intent(ViewFees.this, UserLogin.class);
            startActivity(login_Session);
            finish();
            return;
        }

        FirebaseFirestore db = FirebaseFirestore.getInstance();
        db.collection("Parent").document("S"+uid)
                .get()
                .addOnCompleteListener(new OnCompleteListener<DocumentSnapshot>() {
                    @Override
                    public void onComplete(@NonNull Task<DocumentSnapshot> task) {
                        if(task.isSuccessful()){
                            DocumentSnapshot document = task.getResult();

                            if(document.get("fair") != null) {
                                loadfair.setVisibility(View.GONE);
                                fairtv.setText(document.get("fair").toString());
                            }
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
