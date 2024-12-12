<?php
if (isset($_POST['name'])) {
  require '../../includes/db-config.php';
  require '../../includes/helper.php';
  session_start();

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $slug = baseurl($name);
  $short_Name = mysqli_real_escape_string($conn, $_POST['Short_Name']);
  $content = mysqli_real_escape_string($conn, $_POST['content']);
  $position = mysqli_real_escape_string($conn, $_POST['position']);
  $short_description = mysqli_real_escape_string($conn, $_POST['short_description']);


  $department_ID = isset($_POST['Menu_ID']) ? mysqli_real_escape_string($conn, $_POST['Menu_ID']) : '';
  $program_ID = isset($_POST['Category_ID']) ? mysqli_real_escape_string($conn, $_POST['Category_ID']) : '';


  if (empty($name) || empty($short_Name) || empty($position)) {
    echo json_encode(['status' => 403, 'message' => 'All fields are mandatory!']);
    exit();
  }

  if ($_FILES["photo"]["name"]) {
    $filename = uploadImage($conn, "photo", "Sub_category");
  } else {
    $filename = "/admin-assets/img/default-program.jpg";
  }

   // Check if the program name already exists
   $check = $conn->query("SELECT ID FROM sub_category WHERE Name = '$name' AND Menu_ID = '$department_ID' AND Category_ID = '$program_ID'");
   if ($check && $check->num_rows > 0) {
     echo json_encode(['status' => 400, 'message' => $name . ' already exists for the selected department&program!']);
     exit();
   }
  
  //  // Check if the program name already exists
  //  $check = $conn->query("SELECT ID FROM courses WHERE Name = '$name' AND Department_ID = '$department_ID'");
  //  if ($check && $check->num_rows > 0) {
  //    echo json_encode(['status' => 400, 'message' => $name . ' already exists for the selected department!']);
  //    exit();
  //  }

  $add = $conn->query("INSERT INTO sub_category (Name, Slug, Menu_ID, Category_ID, Short_Name, Position, Photo, Content, Description) 
                        VALUES ('$name', '$slug', '$department_ID','$program_ID', '$short_Name', '$position', '$filename', '$content', '$short_description')");
  if ($add) {
    echo json_encode(['status' => 200, 'message' => $name . ' Added successfully!']);
  } else {
    echo json_encode(['status' => 400, 'message' => 'Something went wrong!']);
  }
}
