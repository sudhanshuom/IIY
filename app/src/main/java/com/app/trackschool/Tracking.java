package com.app.trackschool;

import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import android.util.Log;

import com.app.trackschool.Model.Location;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.MapView;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.CameraPosition;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.database.DatabaseReference;
import com.google.firebase.database.FirebaseDatabase;
import com.google.firebase.database.annotations.Nullable;
import com.google.firebase.firestore.DocumentReference;
import com.google.firebase.firestore.DocumentSnapshot;
import com.google.firebase.firestore.EventListener;
import com.google.firebase.firestore.FirebaseFirestore;
import com.google.firebase.firestore.FirebaseFirestoreException;

public class Tracking extends AppCompatActivity implements OnMapReadyCallback {

    private GoogleMap mMap;
    MapView mapView;
//    FirebaseDatabase database;
//    DatabaseReference myRef;
    FirebaseFirestore db;
    String driverId = "";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tracking);
        // Obtain the SupportMapFragment and get notified when the map is ready to be used.
        mapView = (MapView) findViewById(R.id.map);
        mapView.onCreate(savedInstanceState);
        mapView.onResume();
        mapView.getMapAsync(this);
        //database = FirebaseDatabase.getInstance();
        db = FirebaseFirestore.getInstance();
        db.collection("Parent");



        //myRef = database.getReference("bus").child("id").child("position");

//        Location ll = new Location(-34+"", 151+"");
//        myRef.setValue(ll);

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
            db.collection("Parent").document("user/"+uid+"/details")
                    .get()
                    .addOnCompleteListener(new OnCompleteListener<DocumentSnapshot>() {
                        @Override
                        public void onComplete(@NonNull Task<DocumentSnapshot> task) {
                            if (task.isSuccessful()) {
                                Log.e("details", task.getResult()+"");
                                DocumentSnapshot document = task.getResult();
                                driverId = document.get("driver_id").toString();
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
                                            value.setLatittude(snapshot.get("latittude").toString());
                                            value.setLongitude(snapshot.get("longitude").toString());
                                            assert value != null;
                                            LatLng currentLocation = new LatLng(Double.parseDouble(value.getLatittude()),
                                                    Double.parseDouble(value.getLongitude()));

                                            MarkerOptions marker = new MarkerOptions().position(currentLocation);

                                            // Changing marker icon
                                            marker.icon(BitmapDescriptorFactory.fromResource(R.drawable.school_bus));
                                            mMap.clear();
                                            mMap.addMarker(marker);
                                            final CameraPosition cameraPosition = new CameraPosition.Builder()
                                                    .target(currentLocation)      // Sets the center of the map to User Position
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

                            } else {
                                Log.e("error", "Error getting documents.", task.getException());
                            }
                        }
                    });
        }

        // Add a marker in Sydney and move the camera


//        myRef.addValueEventListener(new ValueEventListener() {
//            @Override
//            public void onDataChange(DataSnapshot dataSnapshot) {
//                // This method is called once with the initial value and again
//                // whenever data at this location is updated.
//                mMap.clear();
//                Location value = dataSnapshot.getValue(Location.class);
//                assert value != null;
//                LatLng currentLocation = new LatLng(Double.parseDouble(value.getLatittude()),
//                                Double.parseDouble(value.getLongitude()));
//
//                MarkerOptions marker = new MarkerOptions().position(currentLocation);
//
//                // Changing marker icon
//                marker.icon(BitmapDescriptorFactory.fromResource(R.drawable.school_bus));
//
//                mMap.addMarker(marker);
//                final CameraPosition cameraPosition = new CameraPosition.Builder()
//                        .target(currentLocation)      // Sets the center of the map to User Position
//                        .zoom(16)                         // Sets the zoom
//                        .bearing(0)                      // Sets the orientation of the camera to east
//                        .tilt(30)                         // Sets the tilt of the camera to 30 degrees
//                        .build();                         //
//                mMap.animateCamera(CameraUpdateFactory.newCameraPosition(cameraPosition));
//            }
//
//            @Override
//            public void onCancelled(DatabaseError error) {
//                // Failed to read value
//                Log.w("not recieved", "Failed to read value.", error.toException());
//            }
//        });
    }
}
