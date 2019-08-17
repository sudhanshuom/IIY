package com.app.trackschool;

import android.graphics.Color;
import android.location.Address;
import android.location.Geocoder;
import android.os.AsyncTask;
import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Toast;

import com.app.trackschool.Model.Location;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.MapView;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.CameraPosition;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.gms.maps.model.PolylineOptions;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.database.annotations.Nullable;
import com.google.firebase.firestore.DocumentReference;
import com.google.firebase.firestore.DocumentSnapshot;
import com.google.firebase.firestore.EventListener;
import com.google.firebase.firestore.FirebaseFirestore;
import com.google.firebase.firestore.FirebaseFirestoreException;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Locale;

public class Tracking extends AppCompatActivity implements OnMapReadyCallback {

    private GoogleMap mMap;
    MapView mapView;
//    FirebaseDatabase database;
//    DatabaseReference myRef;
    FirebaseFirestore db;
    String driverId = "";
    EditText addresset;
    Geocoder geocoder;
    ImageView back;
    ArrayList<LatLng> markerPoints = new ArrayList<>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tracking);

        back = findViewById(R.id.back);
        mapView = (MapView) findViewById(R.id.map);
        addresset = findViewById(R.id.address);
        addresset.setKeyListener(null);
        mapView.onCreate(savedInstanceState);
        mapView.onResume();
        mapView.getMapAsync(this);
        //database = FirebaseDatabase.getInstance();
        db = FirebaseFirestore.getInstance();
        db.collection("Parent");

        geocoder = new Geocoder(this, Locale.getDefault());

        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish();
            }
        });

    }


    /**
     * Manipulates the map once available.
     * This callback is triggered when the map is ready to be used.
     * This is where we can add markers or lines, add listeners or move the camera. In this case,
     * we just add a marker near Sydney, Australia.
     * If Google Play services is not installed on the device, the user will be prompted to install
     * it inside the SupportMapFragment. This method will only be triggered once the user has
     * installed Google Play services and returned to the app.
     */
    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;

        if(driverId.equals("")) {
            String uid = FirebaseAuth.getInstance().getCurrentUser().getUid();

            /********************************************
             * TODO: Get assigned driver id from database.
             */
            db.collection("Parent").document(uid)
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
                                if(driverId.equals("") || driverId == null){
                                    Toast.makeText(Tracking.this, "Driver Not Available", Toast.LENGTH_SHORT).show();
                                    return;
                                }else {
                                    DocumentReference docRef = db.collection("Drivers").document(driverId);

                                    docRef.addSnapshotListener(new EventListener<DocumentSnapshot>() {
                                        @Override
                                        public void onEvent(@Nullable DocumentSnapshot snapshot,
                                                            @Nullable FirebaseFirestoreException e) {
                                            if (e != null) {
                                                Log.w("lisfail", "Listen failed.", e);
                                                return;
                                            }

                                            String source = snapshot != null && snapshot.getMetadata().hasPendingWrites()
                                                    ? "Local" : "Server";

                                            if (snapshot != null && snapshot.exists()) {
                                                Location value = new Location();
                                                value.setLatittude(snapshot.get("latitude").toString());
                                                value.setLongitude(snapshot.get("longitude").toString());
                                                assert value != null;
                                                LatLng location = new LatLng(Double.parseDouble(value.getLatittude()),
                                                        Double.parseDouble(value.getLongitude()));


                                                MarkerOptions marker = new MarkerOptions().position(location);

                                                List<Address> addresses;
                                                try {
                                                    addresses = (List<Address>) geocoder.getFromLocation(
                                                            Double.parseDouble(value.getLatittude()),
                                                            Double.parseDouble(value.getLongitude()), 1); // Here 1 represent max location result to returned, by documents it recommended 1 to 5

                                                    String address = addresses.get(0).getAddressLine(0); // If any additional address line present than only, check with max available address lines by getMaxAddressLineIndex()
                                                    String city = addresses.get(0).getLocality();
//                                                String state = addresses.get(0).getAdminArea();
//                                                String country = addresses.get(0).getCountryName();
//                                                String postalCode = addresses.get(0).getPostalCode();
//                                                String knownName = addresses.get(0).getFeatureName(); // Only if available else return NULL
                                                    addresset.setText(address + "," + city);
                                                } catch (Exception ee) {
                                                    ee.printStackTrace();
                                                }
                                                // Changing marker icon
                                                marker.icon(BitmapDescriptorFactory.fromResource(R.drawable.school_bus));
                                                mMap.clear();
                                                mMap.addMarker(marker);
                                                final CameraPosition cameraPosition = new CameraPosition.Builder()
                                                        .target(location)      // Sets the center of the map to User Position
                                                        .zoom(16)                         // Sets the zoom
                                                        .bearing(0)                      // Sets the orientation of the camera to east
                                                        .tilt(30)                         // Sets the tilt of the camera to 30 degrees
                                                        .build();                         //
                                                mMap.animateCamera(CameraUpdateFactory.newCameraPosition(cameraPosition));
                                                Log.e("fetchdata", source + " data: " + snapshot.getData());

                                            } else {
                                                Log.e("fetchnull", source + " data: null");
                                            }
                                        }
                                    });
                                    Log.e("success", document.getId() + " => " + document.getData());
                                }

                            } else {
                                Log.e("error", "Error getting documents.", task.getException());
                            }
                        }
                    });
        }
    }

}
