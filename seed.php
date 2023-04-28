<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

 if (isset($_SESSION['ID'])) {
    // Define array of student records
    $students = array(
        array("Steve", "Johnson", "Programming Development", "2001-09-01", "88 charles road", "Bucks", "UK", "HP13 6IT")
        array("Jane", "Smith", "Internet Systems Development", "1999-07-04",  "124 marely road", "Bucks", "UK", "HP13 5PN"),
        array("Mike", "Johnson", "Programming Principles", "1996-11-09", "48 Greenhill road", "Bucks", "UK", "HP13 5PE"),
        array("Emily", "Davis", "Internet Systems Development", "2003-04-12",  "228 Hughenden road", "Bucks", "UK", "HP13 9PE"),
        array("David", "Brown", "Internet Systems Development", "1988-11-22", "2 HillGrove road", "Bucks", "UK", "HP14 8MI")
    );


    // Loop through each student record and insert into the database
    foreach ($students as $student) {
        $firstName = $student[0];
        $lastName = $student[1];
        $major = $student[2];
        $dob = $student[3];
        $house = $student[4];
        $town = $student[5];
        $county = $student[6];
        $country = $student[7];
        $postcode = $student[8];

        $sql = "INSERT INTO students (firstName, lastName, major, dob, house, town, county, country, postcode) VALUES ('$firstName', '$lastName', '$major', '$dob', '$house', '$town', '$county', '$country', '$postcode')";
        mysqli_query($conn, $sql);
    }

    // Output success message
    echo "5 student records have been inserted into the database.";
} else {
    // User is not logged in, output error message
    echo "You must be logged in to perform this action.";
}
?>



