package com.app.trackschool;

import android.app.NotificationChannel;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.content.Context;
import android.content.Intent;
import android.media.RingtoneManager;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.util.Log;
import androidx.core.app.NotificationCompat;
import com.google.firebase.messaging.FirebaseMessagingService;
import com.google.firebase.messaging.RemoteMessage;

import java.util.Map;

import static androidx.constraintlayout.widget.Constraints.TAG;

public class MyFirebaseMessagingService extends FirebaseMessagingService {

    @Override
    public void onMessageReceived(RemoteMessage remoteMessage) {
        // ...

        // TODO(developer): Handle FCM messages here.
        // Not getting messages here? See why this may be: https://goo.gl/39bRNJ
        Log.e(TAG, "From: " + remoteMessage+"");

        // Check if message contains a data payload.
        if (remoteMessage.getData().size() > 0) {
            // Log.d(TAG, "Message data " + remoteMessage.getData());
            Log.e("recieve",remoteMessage.getData()+"");
            scheduleJob(remoteMessage.getData());
        }


        // Check if message contains a notification payload.
        if (remoteMessage.getNotification() != null) {
            Log.d(TAG, "Message Notification Body: " + remoteMessage.getNotification().getBody());
        }

        // Also if you intend on generating your own notifications as a result of a received FCM
        // message, here is where that should be initiated. See sendNotification method below.
    }
    public void scheduleJob(Map<String, String> data){
        String[]arr = new String[4];
        int i=0;
        Bundle bundle = new Bundle();
        for (Map.Entry<String, String> entry : data.entrySet()) {
            bundle.putString(arr[i]=entry.getKey(), arr[i+1]=entry.getValue());
            i+=2;
        }
        Intent in =new Intent(this,MainActivity.class);
        in.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
        PendingIntent pendingIntent = PendingIntent.getActivity(this,0 ,in, PendingIntent.FLAG_ONE_SHOT);
        String chid = "0";
        Uri d = RingtoneManager.getDefaultUri(RingtoneManager.TYPE_NOTIFICATION);
        NotificationCompat.Builder noti = new NotificationCompat.Builder(this,chid)
                .setSmallIcon(R.drawable.ic_menu_send)
                .setSmallIcon(R.drawable.ic_menu_gallery)
                .setContentTitle(arr[3])
                .setContentText(arr[1])
                .setAutoCancel(true)
                .setSound(d)
                .setContentIntent(pendingIntent);

        NotificationManager n = (NotificationManager)getSystemService(Context.NOTIFICATION_SERVICE);

        if(Build.VERSION.SDK_INT >= Build.VERSION_CODES.O){
            NotificationChannel channel = new NotificationChannel(chid,"Channel human Readable title", NotificationManager.IMPORTANCE_DEFAULT);
            n.createNotificationChannel(channel);
        }
        n.notify(0,noti.build());
    }
}
