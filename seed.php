<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

if (isset($_SESSION['id'])) {
    // Define array of student records
    $students = array(
        array("Steve", "Johnson", "2001-09-01", "88 Charles Road", "Bucks", "UK", "HP13 6IT"),
        array("Jane", "Smith", "1999-07-04",  "124 Marely Road", "Bucks", "UK", "HP13 5PN"),
        array("Mike", "Johnson", "1996-11-09", "48 Greenhill Road", "Bucks", "UK", "HP13 5PE"),
        array("Emily", "Davis", "2003-04-12",  "228 Hughenden Road", "Bucks", "UK", "HP13 9PE"),
        array("David", "Brown", "1988-11-22", "2 HillGrove Road", "Bucks", "UK", "HP14 8MI")
    );

    // Loop through each student record and insert into the database
    foreach ($students as $student) {
        $firstName = mysqli_real_escape_string($conn, $student[0]);
        $lastName = mysqli_real_escape_string($conn, $student[1]);
        $dob = mysqli_real_escape_string($conn, $student[2]);
        $house = mysqli_real_escape_string($conn, $student[3]);
        $town = mysqli_real_escape_string($conn, $student[4]);
        $county = mysqli_real_escape_string($conn, $student[5]);
        $country = mysqli_real_escape_string($conn, $student[6]);
        $postcode = mysqli_real_escape_string($conn, $student[7]);
        $id = uniqid(); // generate a unique id for each student

        $sql = "INSERT INTO `student` (id, firstName, lastName, dob, house, town, county, country, postcode) 
                VALUES ('$id', '$firstName', '$lastName', '$dob', '$house', '$town', '$county', '$country', '$postcode')";
        mysqli_query($conn, $sql);
    }

    // Output success message
    echo "5 student records have been inserted into the database.";
} else {
    // User is not logged in, output error message
    echo "You must be logged in to perform this action.";
}
?>
