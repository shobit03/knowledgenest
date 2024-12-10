<?php
if (isset($_POST['name']) && isset($_POST['id'])) {
  require '../../includes/db-config.php';
  require '../../includes/helper.php';
  session_start();

  $id = intval($_POST['id']);
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $slug = baseurl($name);
  $short_Name = mysqli_real_escape_string($conn, $_POST['Short_Name']);
  $position = mysqli_real_escape_string($conn, $_POST['position']);
  $content = mysqli_real_escape_string($conn, $_POST['content']);
  $updated_file = mysqli_real_escape_string($conn, $_POST['updated_file']);

  // $eligibility = mysqli_real_escape_string($conn, $_POST['eligibility']);
  // $year = mysqli_real_escape_string($conn, $_POST['year']);
  // $semester = mysqli_real_escape_string($conn, $_POST['semester']);

  $menu_ID = isset($_POST['Menu_ID']) ? mysqli_real_escape_string($conn, $_POST['Menu_ID']) : '';

  if (empty($name) || empty($short_Name) || empty($position)) {
    echo json_encode(['status' => 403, 'message' => 'All fields are mandatory!']);
    exit();
  }

  if (isset($_FILES["photo"]["name"]) && $_FILES["photo"]["name"] != '') {
    $photo = uploadImage($conn, "photo", "blogs");

    if ($photo && file_exists("../../" . ltrim($updated_file, "/"))) {
      unlink("../../" . ltrim($updated_file, "/"));
    }
  } else {
    $photo = $updated_file;
  }

  // $check = $conn->query("SELECT ID FROM programs WHERE (Name = '$name') AND ID <> $id");
  // if ($check !== false && $check->num_rows > 0) {
  //   echo json_encode(['status' => 400, 'message' => $name . ' already exists!']);
  //   exit();
  // }
  $check = $conn->query("SELECT ID FROM category WHERE Name = '$name' AND Menu_ID = '$menu_ID' AND ID <> $id");
  if ($check !== false && $check->num_rows > 0) {
    echo json_encode(['status' => 400, 'message' => $name . ' already exists for the selected department!']);
    exit();
  }

  // $update = $conn->query("UPDATE `programs` SET `Name` = '$name', `Slug` = '$slug', `Department_ID` = '$department_ID', `Short_Name` = '$short_Name', `Position` = '$position', `Eligibility` = '$eligibility', `Year` = '$year', `Semester` = '$semester' WHERE ID = $id");
  $update = $conn->query("UPDATE `category` SET `Name` = '$name', `Slug` = '$slug', `Menu_ID` = '$menu_ID', `Short_Name` = '$short_Name', `Position` = '$position',`Content` = '$content',`Photo`='$photo' WHERE ID = $id");
  if ($update) {
    echo json_encode(['status' => 200, 'message' => $name . ' updated successfully!']);
  } else {
    echo json_encode(['status' => 400, 'message' => 'Something went wrong!']);
  }
}
