<?php
require '../../includes/db-config.php';

if(isset($_POST['menu_id'])) {
    $menuID = mysqli_real_escape_string($conn, $_POST['menu_id']);
    $query = "SELECT ID, Name FROM category WHERE Menu_ID = '$menuID' AND Status = 1 ORDER BY Name";
    $result = $conn->query($query);

    if($result->num_rows > 0) {
        echo '<option value="">Select Category</option>';
        while($row = $result->fetch_assoc()) {
            echo '<option value="'.$row['ID'].'">'.$row['Name'].'</option>';
        }
    } else {
        echo '<option value="">No Category Available</option>';
    }
} else {
    echo '<option value="">Select Menu First</option>';
}
?>
