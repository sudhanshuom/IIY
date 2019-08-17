package com.app.trackschool.Model;

public class Profile_model {
    String student_address, student_admno, student_city, student_class, student_contact, student_dob,
            student_fname, student_focc, student_gender, student_mname, student_mocc, student_name,
            student_state;

    public Profile_model() {
    }

    public Profile_model(String student_address, String student_admno, String student_city, String student_class, String student_contact, String student_dob, String student_fname, String student_focc, String student_gender, String student_mname, String student_mocc, String student_name, String student_state) {
        this.student_address = student_address;
        this.student_admno = student_admno;
        this.student_city = student_city;
        this.student_class = student_class;
        this.student_contact = student_contact;
        this.student_dob = student_dob;
        this.student_fname = student_fname;
        this.student_focc = student_focc;
        this.student_gender = student_gender;
        this.student_mname = student_mname;
        this.student_mocc = student_mocc;
        this.student_name = student_name;
        this.student_state = student_state;
    }

    public String getStudent_address() {
        return student_address;
    }

    public void setStudent_address(String student_address) {
        this.student_address = student_address;
    }

    public String getStudent_admno() {
        return student_admno;
    }

    public void setStudent_admno(String student_admno) {
        this.student_admno = student_admno;
    }

    public String getStudent_city() {
        return student_city;
    }

    public void setStudent_city(String student_city) {
        this.student_city = student_city;
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

    public String getStudent_dob() {
        return student_dob;
    }

    public void setStudent_dob(String student_dob) {
        this.student_dob = student_dob;
    }

    public String getStudent_fname() {
        return student_fname;
    }

    public void setStudent_fname(String student_fname) {
        this.student_fname = student_fname;
    }

    public String getStudent_focc() {
        return student_focc;
    }

    public void setStudent_focc(String student_focc) {
        this.student_focc = student_focc;
    }

    public String getStudent_gender() {
        return student_gender;
    }

    public void setStudent_gender(String student_gender) {
        this.student_gender = student_gender;
    }

    public String getStudent_mname() {
        return student_mname;
    }

    public void setStudent_mname(String student_mname) {
        this.student_mname = student_mname;
    }

    public String getStudent_mocc() {
        return student_mocc;
    }

    public void setStudent_mocc(String student_mocc) {
        this.student_mocc = student_mocc;
    }

    public String getStudent_name() {
        return student_name;
    }

    public void setStudent_name(String student_name) {
        this.student_name = student_name;
    }

    public String getStudent_state() {
        return student_state;
    }

    public void setStudent_state(String student_state) {
        this.student_state = student_state;
    }
}
