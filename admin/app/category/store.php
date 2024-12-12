<?php
if (isset($_POST['name'])) {
  require '../../includes/db-config.php';
  require '../../includes/helper.php';
  session_start();

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $slug = baseurl($name);
  $short_Name = mysqli_real_escape_string($conn, $_POST['Short_Name']);
  $position = mysqli_real_escape_string($conn, $_POST['position']);
  $content =mysqli_real_escape_string($conn, $_POST['content']);

  // $eligibility = mysqli_real_escape_string($conn, $_POST['eligibility']);
  // $year = mysqli_real_escape_string($conn, $_POST['year']);
  // $semester = mysqli_real_escape_string($conn, $_POST['semester']);

  $menu_ID = isset($_POST['Menu_ID']) ? mysqli_real_escape_string($conn, $_POST['Menu_ID']) : '';
  // Handle the checkbox for 'have_details'
  $have_details = isset($_POST['have_details']) ? 1 : 0;

  if (empty($name) || empty($short_Name) || empty($position)) {
    echo json_encode(['status' => 403, 'message' => 'All fields are mandatory!']);
    exit();
  }

  if ($_FILES["photo"]["name"]) {
    $filename = uploadImage($conn, "photo", "category");
  } else {
    $filename = "/admin-assets/img/default-program.jpg";
  }


   // Check if the program name already exists
   $check = $conn->query("SELECT ID FROM category WHERE Name = '$name' AND Menu_ID  = '$menu_ID'");
   if ($check && $check->num_rows > 0) {
     echo json_encode(['status' => 400, 'message' => $name . ' already exists for the selected department!']);
     exit();
   }

  // $add = $conn->query("INSERT INTO programs (Name, Slug, Department_ID, Short_Name, Position, Eligibility, Year, Semester) 
  //                       VALUES ('$name', '$slug', '$department_ID', '$short_Name', '$position', '$eligibility', '$year', '$semester')");

$add = $conn->query("INSERT INTO category (Name, Slug, Menu_ID, Short_Name, Position,Photo,Content,Have_Details) 
                        VALUES ('$name', '$slug', '$menu_ID', '$short_Name', '$position','$filename','$content','$have_details')");
  if ($add) {
    echo json_encode(['status' => 200, 'message' => $name . ' Added successfully!']);
  } else {
    echo json_encode(['status' => 400, 'message' => 'Something went wrong!']);
  }
}
