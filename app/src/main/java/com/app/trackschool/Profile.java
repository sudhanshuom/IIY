package com.app.trackschool;

import android.content.Intent;
import android.content.SharedPreferences;
import android.net.Uri;
import android.os.Bundle;
import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.preference.PreferenceManager;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import com.app.trackschool.Model.Profile_model;
import com.bumptech.glide.Glide;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.firestore.DocumentSnapshot;
import com.google.firebase.firestore.FirebaseFirestore;

public class Profile extends AppCompatActivity {

    Uri profileimg;

    private TextView name, class_sec, admission_no, contact, father;
    private ImageView backimg, profile;

    private SharedPreferences sharedPreferences;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);
        sharedPreferences = PreferenceManager.getDefaultSharedPreferences(getBaseContext());
        final String uid = sharedPreferences.getString("admissionNo","NULL");

        if(uid == null || uid.equals("NULL")) {
            // Opens login/signup Activity
            Intent login_Session = new Intent(Profile.this, UserLogin.class);
            startActivity(login_Session);
            finish();
            return;
        }

        FirebaseFirestore db = FirebaseFirestore.getInstance();

        backimg = findViewById(R.id.back);
        profile = findViewById(R.id.profile_image);
        name = findViewById(R.id.name);
        class_sec = findViewById(R.id.class_sec);
        admission_no = findViewById(R.id.admission_no);
        contact = findViewById(R.id.contact);
        father = findViewById(R.id.father);


        db.collection("Parent").document("S"+uid)
                .get()
                .addOnCompleteListener(new OnCompleteListener<DocumentSnapshot>() {
                    @Override
                    public void onComplete(@NonNull Task<DocumentSnapshot> task) {
                        if (task.isSuccessful()) {
                            DocumentSnapshot document = task.getResult();
                            name.setText(document.get("student_name")+"");
                            class_sec.setText(document.get("student_class")+"");
                            admission_no.setText(uid+"");
                            contact.setText(document.get("student_contact")+"");
                            father.setText(document.get("student_fname")+"");

                            if(document.get("image") != null && document.get("image").toString().equalsIgnoreCase("default")) {
                                profileimg = Uri.parse(document.get("image").toString());
                                downloadProfileImage(profileimg);
                            }
                            Log.e("success", document.getId() + " => " + document.getData());

                        } else {
                            Log.e("error", "Error getting documents.", task.getException());
                        }
                    }
                });

        backimg.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                onBackPressed();
            }
        });

    }

    private void downloadProfileImage(Uri uri){

        profile.setImageURI(null);
        profile.setBackground(null);
        Glide.with(Profile.this)
                .load(uri)
                .asBitmap()
                .into(profile);

    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        finish();
    }
}
