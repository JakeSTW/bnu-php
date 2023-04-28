<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

 if (isset($_SESSION['id'])) {
    // Define array of student records
    $students = array(
        array("Steve", "Johnson", "2001-09-01", "88 charles road", "Bucks", "UK", "HP13 6IT"),
        array("Jane", "Smith", "1999-07-04",  "124 marely road", "Bucks", "UK", "HP13 5PN"),
        array("Mike", "Johnson", "1996-11-09", "48 Greenhill road", "Bucks", "UK", "HP13 5PE"),
        array("Emily", "Davis", "2003-04-12",  "228 Hughenden road", "Bucks", "UK", "HP13 9PE"),
        array("David", "Brown", "1988-11-22", "2 HillGrove road", "Bucks", "UK", "HP14 8MI")
    );


    // Loop through each student record and insert into the database
    foreach ($students as $student) {
        $firstName = $student[0];
        $lastName = $student[1];
        $dob = $student[2];
        $house = $student[3];
        $town = $student[4];
        $county = $student[5];
        $country = $student[6];
        $postcode = $student[7];
        $id = uniqid(); // generate a unique id for each student

        $sql = "INSERT INTO `oss-cw2`.`student` (id, firstName, lastName, dob, house, town, county, country, postcode) VALUES ('$id', '$firstName', '$lastName', '$dob', '$house', '$town', '$county', '$country', '$postcode')";
        mysqli_query($conn, $sql);
    }

    // Output success message
    echo "5 student records have been inserted into the database.";
} else {
    // User is not logged in, output error message
    echo "You must be logged in to perform this action.";
}
?>
