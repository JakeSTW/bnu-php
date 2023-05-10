<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// check logged in
if (isset($_SESSION['id'])) {

    if(isset($_POST['deletebtn'])) {
        if(isset($_POST['students'])) {
            foreach($_POST['students'] as $student) {
                $student_info = explode("|", $student);
                $firstname = mysqli_real_escape_string($conn, $student_info[0]);
                $lastname = mysqli_real_escape_string($conn, $student_info[1]);
                $house = mysqli_real_escape_string($conn, $student_info[2]);
                $town = mysqli_real_escape_string($conn, $student_info[3]);
                $county = mysqli_real_escape_string($conn, $student_info[4]);
                $country = mysqli_real_escape_string($conn, $student_info[5]);
                $postcode = mysqli_real_escape_string($conn, $student_info[6]);
                $stmt = $conn->prepare("DELETE FROM student WHERE firstname=? AND lastname=? AND house=? AND town=? AND county=? AND country=? AND postcode=?");
                $stmt->bind_param("sssssss", $firstname, $lastname, $house, $town, $county, $country, $postcode);
                $stmt->execute();
                $stmt->close();
            }
        }
    }
}
