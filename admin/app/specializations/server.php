<?php
## Database configuration
include '../../includes/db-config.php';
session_start();
## Fetch records
$result_record = "SELECT ID, Name, Menu_ID, Category_ID, Sub_Category_ID, Status, Created_At FROM specializations ORDER BY ID DESC";
$results = mysqli_query($conn, $result_record);
$data = array();
$i = 1;
while ($row = mysqli_fetch_assoc($results)) {
$no = $i++;

$department_id= $row['Menu_ID'];
$departmentQuery = $conn->query("SELECT Name FROM menus WHERE ID  = $department_id");
$departmentArr = mysqli_fetch_assoc($departmentQuery);

$program_id= $row['Category_ID'];
$programQuery = $conn->query("SELECT Name FROM category WHERE ID  = $program_id");
$programArr = mysqli_fetch_assoc($programQuery);

$course_id= $row['Sub_Category_ID'];
$courseQuery = $conn->query("SELECT Name FROM sub_category WHERE ID  = $course_id");
$courseArr = mysqli_fetch_assoc($courseQuery);

    $data[] = array( 
      "No" => $no,
      "ID"=>$row['ID'],
      "Name" => $row["Name"],
      "Department"=>$departmentArr["Name"],
      "Program"=>$programArr["Name"],
      "Course"=>$courseArr["Name"],
      "Status" => $row["Status"],
      "Created_At" => $row["Created_At"],
    );
}
echo json_encode(['data' => $data]);

