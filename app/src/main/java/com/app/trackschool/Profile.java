package com.app.trackschool;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import com.app.trackschool.Model.Profile_model;
import com.bumptech.glide.Glide;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.OnFailureListener;
import com.google.android.gms.tasks.OnSuccessListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.firestore.DocumentSnapshot;
import com.google.firebase.firestore.FirebaseFirestore;
import com.google.firebase.storage.FirebaseStorage;
import com.google.firebase.storage.StorageReference;

public class Profile extends AppCompatActivity {

    FirebaseAuth mauth;
    FirebaseUser currentUser;
    FirebaseDatabase database;
    DatabaseReference myRef;
    Uri profileimg;

    private TextView name, class_sec, admission_no, contact, gender, dob, father, mother,
            father_occupation, mother_occupation, address, city, state;
    private ImageView backimg, profile;


    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);
        mauth = FirebaseAuth.getInstance();
        currentUser = mauth.getCurrentUser();
        if(currentUser == null){
            startActivity(new Intent(Profile.this, UserLogin.class));
            finish();
        }

        FirebaseFirestore db = FirebaseFirestore.getInstance();

        backimg = findViewById(R.id.back);
        profile = findViewById(R.id.profile_image);
        name = findViewById(R.id.name);
        class_sec = findViewById(R.id.class_sec);
        admission_no = findViewById(R.id.admission_no);
        contact = findViewById(R.id.contact);
        gender = findViewById(R.id.gender);
        dob = findViewById(R.id.date_of_birth);
        father = findViewById(R.id.father);
        mother = findViewById(R.id.mother);
        father_occupation = findViewById(R.id.fatheroccu);
        mother_occupation = findViewById(R.id.motheroccu);
        address = findViewById(R.id.address);
        city = findViewById(R.id.city);
        state = findViewById(R.id.state);


        String uid = currentUser.getUid();
        database = FirebaseDatabase.getInstance();
        myRef = database.getReference("user").child(uid).child("detail");

//        Profile_model model = new Profile_model("Ez stays, Einstein house", "234567891", "Noida",
//                "2nd B", "8874563211", "19/02/2000", "Tom efgh",
//                "Businessman", "Male", "Sim mnop", "Home-maker",
//                "Fam Singh","U.P.", "bcde@gmail.com", FirebaseAuth.getInstance().getCurrentUser().getUid());
//
//        db.collection("Parent").document(uid).set(model);

        db.collection("Parent").document(uid)
                .get()
                .addOnCompleteListener(new OnCompleteListener<DocumentSnapshot>() {
                    @Override
                    public void onComplete(@NonNull Task<DocumentSnapshot> task) {
                        if (task.isSuccessful()) {
                            DocumentSnapshot document = task.getResult();
                            Profile_model value = document.toObject(Profile_model.class);
                            name.setText(value.getStudent_name());
                            class_sec.setText(value.getStudent_class());
                            admission_no.setText(value.getStudent_admno());
                            contact.setText(value.getStudent_contact());
                            gender.setText(value.getStudent_gender());
                            dob.setText(value.getStudent_dob());
                            father.setText(value.getStudent_fname());
                            mother.setText(value.getStudent_mname());
                            father_occupation.setText(value.getStudent_focc());
                            mother_occupation.setText(value.getStudent_mocc());
                            address.setText(value.getStudent_address());
                            city.setText(value.getStudent_city());
                            state.setText(value.getStudent_state());

                            profileimg = Uri.parse(document.get("image").toString());
                            downloadProfileImage(profileimg);

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
