package com.app.trackschool.Model;

public class Profile_model {
    String admission_no, name, class_sec, father, mother, father_occupation, mother_occupation, address, city, state;
    String gender, dob, contact;

    public Profile_model() {
    }

    public Profile_model(String admission_no, String name, String class_sec, String father, String mother, String father_occupation, String mother_occupation, String address, String city, String state, String gender, String dob, String contact) {
        this.admission_no = admission_no;
        this.name = name;
        this.class_sec = class_sec;
        this.father = father;
        this.mother = mother;
        this.father_occupation = father_occupation;
        this.mother_occupation = mother_occupation;
        this.address = address;
        this.city = city;
        this.state = state;
        this.gender = gender;
        this.dob = dob;
        this.contact = contact;
    }



    public String getAdmission_no() {
        return admission_no;
    }

    public void setAdmission_no(String admission_no) {
        this.admission_no = admission_no;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getClass_sec() {
        return class_sec;
    }

    public void setClass_sec(String class_sec) {
        this.class_sec = class_sec;
    }

    public String getFather() {
        return father;
    }

    public void setFather(String father) {
        this.father = father;
    }

    public String getMother() {
        return mother;
    }

    public void setMother(String mother) {
        this.mother = mother;
    }

    public String getFather_occupation() {
        return father_occupation;
    }

    public void setFather_occupation(String father_occupation) {
        this.father_occupation = father_occupation;
    }

    public String getMother_occupation() {
        return mother_occupation;
    }

    public void setMother_occupation(String mother_occupation) {
        this.mother_occupation = mother_occupation;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getCity() {
        return city;
    }

    public void setCity(String city) {
        this.city = city;
    }

    public String getState() {
        return state;
    }

    public void setState(String state) {
        this.state = state;
    }

    public String getGender() {
        return gender;
    }

    public void setGender(String gender) {
        this.gender = gender;
    }

    public String getDob() {
        return dob;
    }

    public void setDob(String dob) {
        this.dob = dob;
    }

    public String getContact() {
        return contact;
    }

    public void setContact(String contact) {
        this.contact = contact;
    }
}
