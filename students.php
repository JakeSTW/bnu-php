<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// check logged in
if (isset($_SESSION['id'])) {

    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // Build SQL statement that selects students' information
    $sql = "SELECT id, firstname, lastname, house, town, county, country, postcode FROM student";
    $result = mysqli_query($conn, $sql);

    // prepare page content
    $data['content'] .= "<form method='POST'>";
    $data['content'] .= "<table border='1'>";
    $data['content'] .= "<tr><th colspan='9' align='center'>Students</th></tr>";
    $data['content'] .= "<tr><th>First Name</th><th>Last Name</th><th>House</th><th>Town</th><th>County</th><th>Country</th><th>Postcode</th><th>Delete</th></tr>";

    // Display the students' information within the html table
    while ($row = mysqli_fetch_array($result)) {
        $data['content'] .= "<tr>";
        $data['content'] .= "<td> {$row["firstname"]} </td>";
        $data['content'] .= "<td> {$row["lastname"]} </td>";
        $data['content'] .= "<td> {$row["house"]} </td>";
        $data['content'] .= "<td> {$row["town"]} </td>";
        $data['content'] .= "<td> {$row["county"]} </td>";
        $data['content'] .= "<td> {$row["country"]} </td>";
        $data['content'] .= "<td> {$row["postcode"]} </td>";
        $data['content'] .= "<td> <input type='checkbox' name='students[]' value='{$row["id"]}' /> </td>";
        $data['content'] .= "</tr>";
    }
    $data['content'] .= "</table>";

    $data['content'] .= "<input type='submit' name='deletebtn' value='Delete' />";
    $data['content'] .= "</form>";

    if (isset($_POST['deletebtn'])) {
        $selected_students = $_POST['students'];
        if (empty($selected_students)) {
            echo "Please select at least one student to delete.";
        } else {
            // Escape and quote each selected student ID
            $id_list = implode(',', array_map(function ($id) use ($conn) {
                return "'" . mysqli_real_escape_string($conn, $id) . "'";
            }, $selected_students));
            $sql = "DELETE FROM student WHERE id IN ($id_list)";
            if (mysqli_query($conn, $sql)) {
                header("Location: students.php");
                exit();
            } else {
                echo "Error deleting students: " . mysqli_error($conn);
            }
        }
    }

    // render the template
    echo template("templates/default.php", $data);

} else {
    header("Location: index.php");
}

echo template("templates/partials/footer.php");
?>
