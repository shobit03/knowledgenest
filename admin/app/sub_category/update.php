<?php
if (isset($_POST['id']) && isset($_POST['name'])) {
    require '../../includes/db-config.php';
    require '../../includes/helper.php';
    session_start();

    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $slug = baseurl($name);
    $short_Name = mysqli_real_escape_string($conn, $_POST['Short_Name']);
    // $content = mysqli_real_escape_string($conn, $_POST['content']);
    $position = intval($_POST['position']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $short_description = mysqli_real_escape_string($conn, $_POST['short_description']);
    $updated_file = mysqli_real_escape_string($conn, $_POST['updated_file']);

    $department_ID = isset($_POST['Menu_ID']) ? intval($_POST['Menu_ID']) : null;
    $program_ID = isset($_POST['Category_ID']) ? intval($_POST['Category_ID']) : null;

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
    $check = $conn->query("SELECT ID FROM sub_category WHERE Name = '$name' AND Menu_ID = '$department_ID' AND Category_ID = '$program_ID' AND ID != '$id'");
    if ($check && $check->num_rows > 0) {
        echo json_encode(['status' => 400, 'message' => $name . ' already exists for the selected department&program!']);
        exit();
    }

    $update = $conn->query("UPDATE sub_category SET 
                            Name = '$name', 
                            Slug = '$slug', 
                            Menu_ID = '$department_ID', 
                            Category_ID = '$program_ID', 
                            Short_Name = '$short_Name', 
                            Position = '$position',
                            Content = '$content',
                            Photo ='$photo',
                            Description = '$short_description' 
                            WHERE ID = $id");

    if ($update) {
        echo json_encode(['status' => 200, 'message' => $name . ' updated successfully!']);
    } else {
        echo json_encode(['status' => 400, 'message' => 'Something went wrong!']);
    }
}
