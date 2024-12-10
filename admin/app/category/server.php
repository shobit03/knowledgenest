<?php
## Database configuration
include '../../includes/db-config.php';
session_start();
## Fetch records
$result_record = "SELECT ID, Name, Menu_ID, Photo, Status, Created_At FROM category ORDER BY ID DESC";
$results = mysqli_query($conn, $result_record);
$data = array();
$i = 1;
while ($row = mysqli_fetch_assoc($results)) {
$no = $i++;

$menu_id= $row['Menu_ID'];
$menuQuery = $conn->query("SELECT Name FROM menus WHERE ID  = $menu_id");
$menuArr = mysqli_fetch_assoc($menuQuery);
    $data[] = array( 
      "No" => $no,
      "ID"=>$row['ID'],
      "Name" => $row["Name"],
      "Menu"=>$menuArr["Name"],
      "Photo" => $row["Photo"],
      "Status" => $row["Status"],
      "Created_At" => $row["Created_At"],
    );
}
echo json_encode(['data' => $data]);

