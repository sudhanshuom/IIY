package com.app.trackschool.Model;

public class Profile_model {
    String student_admno, student_class, student_contact, student_fname, student_name, student_email, uid;

    public Profile_model() {
    }

    public Profile_model(String student_admno, String student_class, String student_contact, String student_fname, String student_name, String student_email, String uid) {
        this.student_admno = student_admno;
        this.student_class = student_class;
        this.student_contact = student_contact;
        this.student_fname = student_fname;
        this.student_name = student_name;
        this.student_email = student_email;
        this.uid = uid;
    }

    public String getStudent_admno() {
        return student_admno;
    }

    public void setStudent_admno(String student_admno) {
        this.student_admno = student_admno;
    }

    public String getStudent_class() {
        return student_class;
    }

    public void setStudent_class(String student_class) {
        this.student_class = student_class;
    }

    public String getStudent_contact() {
        return student_contact;
    }

    public void setStudent_contact(String student_contact) {
        this.student_contact = student_contact;
    }

    public String getStudent_fname() {
        return student_fname;
    }

    public void setStudent_fname(String student_fname) {
        this.student_fname = student_fname;
    }

    public String getStudent_name() {
        return student_name;
    }

    public void setStudent_name(String student_name) {
        this.student_name = student_name;
    }

    public String getStudent_email() {
        return student_email;
    }

    public void setStudent_email(String student_email) {
        this.student_email = student_email;
    }

    public String getUid() {
        return uid;
    }

    public void setUid(String uid) {
        this.uid = uid;
    }
}
