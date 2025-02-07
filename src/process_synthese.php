<?php
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize input data
    $title = htmlspecialchars(strip_tags($_POST['title']));
    $subject_id = htmlspecialchars(strip_tags($_POST['subject']));
    $prof_id = htmlspecialchars(strip_tags($_POST['prof']));
    $description = htmlspecialchars(strip_tags($_POST['description']));

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is a actual file or fake file
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size
    if ($_FILES["file"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif" && $fileType != "pdf") {
        echo "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            // Insert data into database
            $query = "INSERT INTO syntheses (title, description, file_path, prof_id, matiere_id) VALUES (:title, :description, :file_path, :prof_id, :matiere_id)";
            $stmt = $db->prepare($query);

            // Bind parameters
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':file_path', $target_file);
            $stmt->bindParam(':prof_id', $prof_id);
            $stmt->bindParam(':matiere_id', $subject_id);

            if ($stmt->execute()) {
                echo "The file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded and the synthesis has been added.";
            } else {
                echo "Sorry, there was an error adding the synthesis.";
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>