package com.app.trackschool.Model;

public class Location {

    String longitude, lattitude;

    public Location() {
    }

    public Location(String longitude, String lattitude) {
        this.longitude = longitude;
        this.lattitude = lattitude;
    }

    public String getLongitude() {
        return longitude;
    }

    public void setLongitude(String longitude) {
        this.longitude = longitude;
    }

    public String getLattitude() {
        return lattitude;
    }

    public void setLattitude(String lattitude) {
        this.lattitude = lattitude;
    }
}
