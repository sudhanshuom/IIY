package com.app.trackschool;

import android.Manifest;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.os.Bundle;

import androidx.annotation.NonNull;
import androidx.core.app.ActivityCompat;
import androidx.appcompat.app.AppCompatActivity;
import android.text.InputType;
import android.text.method.HideReturnsTransformationMethod;
import android.text.method.PasswordTransformationMethod;
import android.util.Log;
import android.view.View;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.EditText;
import android.widget.Toast;

import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.AuthResult;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;

public class UserLogin extends AppCompatActivity {


    private String server_url_login = "https://limitless-beach-58047.herokuapp.com/signin";
    /**
     * UserLogin Activity
     * Used to get user credentials.
     */

    int PERMISSION_ALL = 1;
    String[] PERMISSIONS = {
            Manifest.permission.INTERNET,
            android.Manifest.permission.ACCESS_COARSE_LOCATION,
            Manifest.permission.ACCESS_FINE_LOCATION,
    };

    private CheckBox show_hide_password;
    private EditText password;
    private EditText admission;
    private Animation shakeAnimation;
    Button loginButton;
    FirebaseAuth mAuth;
    ProgressDialog progressDialog;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_user_login);

        mAuth = FirebaseAuth.getInstance();

        show_hide_password = findViewById(R.id.show_hide_password);
        password = findViewById(R.id.passwordField);
        shakeAnimation = AnimationUtils.loadAnimation(this, R.anim.shake_animation);
        loginButton = findViewById(R.id.LoginButton);
        admission = findViewById(R.id.usernameField);
        show_hide_password
                .setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {

                    @Override
                    public void onCheckedChanged(CompoundButton button,
                                                 boolean isChecked) {

                        // If it is checkec then show password else hide
                        // password
                        if (isChecked) {

                            show_hide_password.setText("Hide Password");// change
                            // checkbox
                            // text

                            password.setInputType(InputType.TYPE_CLASS_TEXT);
                            password.setTransformationMethod(HideReturnsTransformationMethod
                                    .getInstance());// show password
                        } else {
                            show_hide_password.setText("Show Password");// change
                            // checkbox
                            // text

                            password.setInputType(InputType.TYPE_CLASS_TEXT
                                    | InputType.TYPE_TEXT_VARIATION_PASSWORD);
                            password.setTransformationMethod(PasswordTransformationMethod
                                    .getInstance());// hide password

                        }

                    }
                });

        if(!hasPermissions(this,PERMISSIONS)) {
            /**
             * Checks if the user has specified permissions specified in the string PERMISSIONS.
             * If not, then request all permissions.
             */
            ActivityCompat.requestPermissions(this, PERMISSIONS, PERMISSION_ALL);
        }
        loginButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                boolean everythingCorrect = true;
                if(admission.getText().toString().trim().equals("")){
                    everythingCorrect = false;
                    admission.startAnimation(shakeAnimation);
                    view.startAnimation(shakeAnimation);
                    new CustomToast().Show_Toast(UserLogin.this, getCurrentFocus(), "Enter a valid mobile number");
                    return;                }
                if(password.getText().toString().trim().length() < 6){
                    everythingCorrect = false;
                    password.startAnimation(shakeAnimation);
                    view.startAnimation(shakeAnimation);
                    new CustomToast().Show_Toast(UserLogin.this, getCurrentFocus(), "Password should be of atleast 6 characters");
                    return;
                }
                if(everythingCorrect){
                    StartLogin();
                }
                    }
        });
    }

    private void StartLogin(){
        String email = admission.getText().toString().trim();
        String passwordd = password.getText().toString().trim();
        progressDialog = ProgressDialog.show(UserLogin.this, "",
                "Signing in Please wait...", false);
        progressDialog.setCancelable(false);
        progressDialog.show();
        mAuth.signInWithEmailAndPassword(email, passwordd)
                .addOnCompleteListener(this, new OnCompleteListener<AuthResult>() {
                    @Override
                    public void onComplete(@NonNull Task<AuthResult> task) {
                        if (task.isSuccessful()) {
                            // Sign in success, update UI with the signed-in user's information
                            Log.e("login", "signInWithEmail:success");
                            FirebaseUser user = mAuth.getCurrentUser();
                            startActivity(new Intent(UserLogin.this, MainActivity.class));
                            progressDialog.cancel();
                            finish();
                        } else {
                            // If sign in fails, display a message to the user.
                            Log.e("errorlogin", "signInWithEmail:failure", task.getException());
                            Toast.makeText(UserLogin.this, "Authentication failed.",
                                    Toast.LENGTH_SHORT).show();
                            progressDialog.cancel();
                        }

                        // ...
                    }
                });
    }

    public void StartForgotPassword(View v) {
        /**
         * Opens SendRequest with signup session.
         */
        Intent forgotPass = new Intent(UserLogin.this,ForgotPassActivity.class);
        startActivity(forgotPass);
        finish();
    }

    public static boolean hasPermissions(Context context, String... permissions) {
        /**
         * Checks if the user has specified the required permissions.
         * @return boolean variable. True if all permissions already provided. False if not.
         */
        if (context != null && permissions != null) {
            for (String permission : permissions) {
                if (ActivityCompat.checkSelfPermission(context, permission) != PackageManager.PERMISSION_GRANTED) {
                    return false;
                }
            }
        }
        return true;
    }
}
