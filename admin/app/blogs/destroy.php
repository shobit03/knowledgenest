<?php
// if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id'])) {
//   require '../../includes/db-config.php';
//   session_start();

//   $id = mysqli_real_escape_string($conn, $_GET['id']);

//   $check = $conn->query("SELECT ID FROM blogs WHERE ID = $id");
//   if ($check->num_rows > 0) {
//     $delete = $conn->query("DELETE FROM blogs WHERE ID = $id");
//     if ($delete) {
//       echo json_encode(['status' => 200, 'message' => 'Blogs deleted successfully!']);
//     } else {
//       echo json_encode(['status' => 302, 'message' => 'Something went wrong!']);
//     }
//   } else {
//     echo json_encode(['status' => 302, 'message' => 'Blogs not exists!']);
//   }
// }


if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id'])) {
  require '../../includes/db-config.php';
  session_start();

  $id = mysqli_real_escape_string($conn, $_GET['id']);

  $check = $conn->query("SELECT Photo FROM blogs WHERE ID = $id");
  if ($check->num_rows > 0) {
    $row = $check->fetch_assoc();
    $photoPath = $row['Photo'];

    $delete = $conn->query("DELETE FROM blogs WHERE ID = $id");
    if ($delete) {
      if ($photoPath && file_exists("../../" . ltrim($photoPath, "/"))) {
        unlink("../../" . ltrim($photoPath, "/"));
        echo json_encode(['status' => 200, 'message' => 'Blogs deleted successfully, and associated photo removed!']);
      } else {
        echo json_encode(['status' => 200, 'message' => 'Blogs deleted successfully, but no associated photo was found!']);
      }
    } else {
      echo json_encode(['status' => 302, 'message' => 'Something went wrong while deleting the page!']);
    }
  } else {
    echo json_encode(['status' => 302, 'message' => 'Blogs does not exist!']);
  }
}
