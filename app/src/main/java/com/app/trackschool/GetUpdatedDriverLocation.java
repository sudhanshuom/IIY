package com.app.trackschool;

import android.app.IntentService;
import android.app.Service;
import android.content.Intent;
import android.content.Context;
import android.os.IBinder;
import android.util.Log;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.OnSuccessListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.firestore.CollectionReference;
import com.google.firebase.firestore.DocumentSnapshot;
import com.google.firebase.firestore.FirebaseFirestore;
import com.google.firebase.firestore.QuerySnapshot;

public class GetUpdatedDriverLocation extends IntentService {

    /**
     * Creates an IntentService.  Invoked by your subclass's constructor.
     *
     * @param name Used to name the worker thread, important only for debugging.
     */
    public GetUpdatedDriverLocation(String name) {
        super(name);
    }

    @Override
    protected void onHandleIntent(@Nullable Intent intent) {
        FirebaseFirestore db = FirebaseFirestore.getInstance();
        CollectionReference cities = db.collection("AssignedStudents");

        if(FirebaseAuth.getInstance().getCurrentUser() == null){
            stopSelf();
            return ;
        }else{
            String driverid = getDriverID();
            db.collection("Drivers").document(driverid)
                    .get()
                    .addOnCompleteListener(new OnCompleteListener<DocumentSnapshot>() {
                        @Override
                        public void onComplete(@NonNull Task<DocumentSnapshot> task) {
                            DocumentSnapshot snapshot = task.getResult();
                            String latti = snapshot.get("latittude").toString();
                            String longi = snapshot.get("longitude").toString();

                            Log.e("DriverLoc", latti+"  "+longi);

                        }
                    });
        }
    }


    private String getDriverID(){
        return "4c6Ut3FhHoaAlSVx9L5gvg3GXLU2";
    }
}
