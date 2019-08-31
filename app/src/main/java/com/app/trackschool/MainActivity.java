package com.app.trackschool;

import android.content.Intent;
import android.content.SharedPreferences;
import android.net.Uri;
import android.os.Bundle;
import com.bumptech.glide.Glide;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import android.preference.PreferenceManager;
import android.util.Log;
import android.view.View;
import androidx.annotation.NonNull;
import androidx.core.view.GravityCompat;
import androidx.appcompat.app.ActionBarDrawerToggle;
import android.view.MenuItem;
import com.google.android.material.navigation.NavigationView;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import android.view.Menu;
import android.widget.AdapterView;
import android.widget.GridView;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity
        implements NavigationView.OnNavigationItemSelectedListener {

    GridView gridview;
    private SharedPreferences sharedPreferences;
    private String uid, namee;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        sharedPreferences = PreferenceManager.getDefaultSharedPreferences(getBaseContext());
        uid = sharedPreferences.getString("admissionNo","NULL");
        namee = sharedPreferences.getString("name","NOT FOUND");;

        if(uid.equals("NULL")) {
            // Opens login/signup Activity
            Intent login_Session = new Intent(MainActivity.this, UserLogin.class);
            startActivity(login_Session);
            finish();
            return;
        }

        //startService(new Intent(getApplicationContext(), GetUpdatedDriverLocation.class));
//        FirebaseMessaging.getInstance().setAutoInitEnabled(true);
//        if(FirebaseAuth.getInstance().getCurrentUser() == null){
//            startActivity(new Intent(MainActivity.this, UserLogin.class));
//            finish();
//            return;
//        }

//        mFunctions = FirebaseFunctions.getInstance();
//        FirebaseInstanceId.getInstance().getInstanceId()
//                .addOnCompleteListener(new OnCompleteListener<InstanceIdResult>() {
//                    @Override
//                    public void onComplete(@NonNull Task<InstanceIdResult> task) {
//                        if (!task.isSuccessful()) {
//                            Log.e("instanceFail", "getInstanceId failed", task.getException());
//                            return;
//                        }
//
//                        String token = task.getResult().getToken();
//
//                        Log.e("token", token);
//                        FirebaseFirestore db = FirebaseFirestore.getInstance();
//
//                        sendNotification(token).addOnSuccessListener(new OnSuccessListener<String>() {
//                            @Override
//                            public void onSuccess(String s) {
//                                Log.e("return", s);
//                            }
//                        });
//                        db.collection("Parent").document("user/"+FirebaseAuth.getInstance().getCurrentUser().getUid()
//                        +"/details").update("token",token);
//                    }
//                });

        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        DrawerLayout drawer = findViewById(R.id.drawer_layout);
        NavigationView navigationView = findViewById(R.id.nav_view);
        View view = navigationView.getHeaderView(0);
        TextView name = view.findViewById(R.id.textView);

        name.setText(namee);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();
        navigationView.setNavigationItemSelectedListener(this);

        /*
        * Handling GridView
        * */
        gridview = findViewById(R.id.gridview);
        gridview.setAdapter(new HomeGridAdapter(this));
        gridview.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                //Toast.makeText(MainActivity.this, position+"", Toast.LENGTH_SHORT).show();
                if(position == 0){
                    startActivity(new Intent(MainActivity.this, Profile.class));
                    return;
                } else if(position == 1){
                    startActivity(new Intent(MainActivity.this, Tracking.class));
                    return;
                }else if(position == 2){
                    startActivity(new Intent(MainActivity.this, ApplyForLeave.class));
                    return;
                } else if(position == 3){
                    startActivity(new Intent(MainActivity.this, HolidayCalendar.class));
                    return;
                } else if(position == 4){
                    startActivity(new Intent(MainActivity.this, ViewFees.class));
                    return;
                } else if(position == 5){
//                    FirebaseAuth.getInstance().signOut();
                    SharedPreferences.Editor ed = sharedPreferences.edit();
                    ed.clear();
                    ed.commit();
                    startActivity(new Intent(MainActivity.this, UserLogin.class));
                    finish();
                    return;
                }
            }
        });

    }

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        return false;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement

        return super.onOptionsItemSelected(item);
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();

        if (id == R.id.profile) {
            startActivity(new Intent(MainActivity.this, Profile.class));
        } else if (id == R.id.track_location) {
            startActivity(new Intent(MainActivity.this, Tracking.class));
        } else if (id == R.id.apply_for_leave) {
            startActivity(new Intent(MainActivity.this, ApplyForLeave.class));
        } else if (id == R.id.academic_calendar) {
            startActivity(new Intent(MainActivity.this, HolidayCalendar.class));
        } else if (id == R.id.fee) {
            startActivity(new Intent(MainActivity.this, ViewFees.class));
        }else if (id == R.id.log_out) {
            //FirebaseAuth.getInstance().signOut();
            SharedPreferences.Editor ed = sharedPreferences.edit();
            ed.clear();
            ed.commit();
            startActivity(new Intent(MainActivity.this, UserLogin.class));
            finish();
        }

        DrawerLayout drawer = findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }

//    private void setProfileImage(final ImageView profile){
//        FirebaseFirestore db = FirebaseFirestore.getInstance();
//
//        db.collection("Parent").document("S"+uid)
//                .get()
//                .addOnCompleteListener(new OnCompleteListener<DocumentSnapshot>() {
//                    @Override
//                    public void onComplete(@NonNull Task<DocumentSnapshot> task) {
//                        if (task.isSuccessful()) {
//                            DocumentSnapshot document = task.getResult();
//
//                            if(document.get("image") != null && document.get("image").toString().equalsIgnoreCase("default")) {
//                                Glide.with(MainActivity.this)
//                                        .load(Uri.parse(document.get("image").toString()))
//                                        .asBitmap()
//                                        .into(profile);
//                            }
//
//                            Log.e("success", document.getId() + " => " + document.getData());
//
//                        } else {
//                            Log.e("error", "Error getting documents.", task.getException());
//                        }
//                    }
//                });
//
//    }



//    private Task<String> sendNotification(String token) {
//        // Create the arguments to the callable function.
//        Map<String, Object> data = new HashMap<>();
//        data.put("token", token);
//        data.put("message", "Hello one, your bus will arrive shortly, Don't be late");
//        data.put("title", "Bus");
//        data.put("push", true);
//
//        return mFunctions
//                .getHttpsCallable("sendNotification")
//                .call(data)
//                .continueWith(new Continuation<HttpsCallableResult, String>() {
//                    @Override
//                    public String then(@NonNull Task<HttpsCallableResult> task) throws Exception {
//                        // This continuation runs on either success or failure, but if the task
//                        // has failed then getResult() will throw an Exception which will be
//                        // propagated down.
//                        String result = (String) task.getResult().getData();
//                        return result;
//                    }
//                });
//    }
}
