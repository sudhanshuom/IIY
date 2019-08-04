package com.app.trackschool;

import android.content.Intent;
import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.widget.ImageView;
import android.widget.TextView;
import com.app.trackschool.Model.Profile_model;
import com.google.android.gms.tasks.Continuation;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.OnSuccessListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.firestore.DocumentSnapshot;
import com.google.firebase.firestore.FirebaseFirestore;
import com.google.firebase.functions.FirebaseFunctions;
import com.google.firebase.functions.HttpsCallableResult;

import java.util.HashMap;
import java.util.Map;

public class Profile extends AppCompatActivity {

    FirebaseAuth mauth;
    FirebaseUser currentUser;
    FirebaseDatabase database;
    DatabaseReference myRef;

    private TextView name, class_sec, admission_no, contact, gender, dob, father, mother,
            father_occupation, mother_occupation, address, city, state;
    private ImageView backimg;


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

//        Profile_model model = new Profile_model("234567891", "Fam Singh", "2nd B",
//                "Tom efgh", "Sim mnop", "Buisnessman", "Home-maker",
//                "Ez stays, Einstein house", "Noida", "U.P.", "Male",
//                "19/02/2000","8874563211");
//
//        db.collection("Parent").document("user/"+uid+"/details").set(model);

        db.collection("Parent").document("user/"+uid+"/details")
                .get()
                .addOnCompleteListener(new OnCompleteListener<DocumentSnapshot>() {
                    @Override
                    public void onComplete(@NonNull Task<DocumentSnapshot> task) {
                        if (task.isSuccessful()) {
                            DocumentSnapshot document = task.getResult();
                            Profile_model value = document.toObject(Profile_model.class);
                            name.setText(value.getName());
                            class_sec.setText(value.getClass_sec());
                            admission_no.setText(value.getAdmission_no());
                            contact.setText(value.getContact());
                            gender.setText(value.getGender());
                            dob.setText(value.getDob());
                            father.setText(value.getFather());
                            mother.setText(value.getMother());
                            father_occupation.setText(value.getFather_occupation());
                            mother_occupation.setText(value.getMother_occupation());
                            address.setText(value.getAddress());
                            city.setText(value.getCity());
                            state.setText(value.getState());
                            Log.e("success", document.getId() + " => " + document.getData());

                        } else {
                            Log.e("error", "Error getting documents.", task.getException());
                        }
                    }
                });

//        myRef.addValueEventListener(new ValueEventListener() {
//            @Override
//            public void onDataChange(DataSnapshot dataSnapshot) {
//                // This method is called once with the initial value and again
//                // whenever data at this location is updated.
//                Profile_model value = dataSnapshot.getValue(Profile_model.class);
//                name.setText(value.getName());
//                class_sec.setText(value.getClass_sec());
//                admission_no.setText(value.getAdmission_no());
//                contact.setText(value.getContact());
//                gender.setText(value.getGender());
//                dob.setText(value.getDob());
//                father.setText(value.getFather());
//                mother.setText(value.getMother());
//                father_occupation.setText(value.getFather_occupation());
//                mother_occupation.setText(value.getMother_occupation());
//                address.setText(value.getAddress());
//                city.setText(value.getCity());
//                state.setText(value.getState());
//                Log.d("successDB", "Value is: " + value.getName());
//            }
//
//            @Override
//            public void onCancelled(DatabaseError error) {
//                // Failed to read value
//                Log.w("failReadingDB", "Failed to read value.", error.toException());
//            }
//        });

        backimg.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                onBackPressed();
            }
        });






    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        finish();
    }
}
