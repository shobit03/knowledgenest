<?php
require '../../includes/db-config.php';

if (isset($_POST['category_id'])) {
    $programID = mysqli_real_escape_string($conn, $_POST['category_id']);
    $query = "SELECT ID, Name FROM sub_category WHERE Category_ID  = '$programID' AND Status = 1 ORDER BY Name";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo '<option value="">Select Sub_Category</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['ID'] . '">' . $row['Name'] . '</option>';
        }
    } else {
        echo '<option value="">No Sub_category Available</option>';
    }
} else {
    echo '<option value="">Select category First</option>';
}
