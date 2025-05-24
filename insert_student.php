<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Management System</title>
        <link href="img/favicon.ico" rel="icon">
        <!-- Customized Bootstrap Stylesheet -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <!-- Icon Font Stylesheet -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

         <!-- Libraries Stylesheet -->
        <link href="css/animate.min.css" rel="stylesheet">
        
    </head>
    <body>
         <!--Sidebar Start-->
        <?php
            include "sidebar.php";
        ?>
        <!--Sidebar End-->   
        <!--Content Start-->
        <div class="main-content pt-0 px-0">
            <!-- Top Bar Start -->
            <?php
                include "topbar.php";
            ?>
            <!-- Top Bar End -->
            <?php
include 'dbdata.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and collect form data
    $std_id = mysqli_real_escape_string($connect, $_POST['std_id']);
    $fullName = mysqli_real_escape_string($connect, $_POST['fullName']);
    $fatherName = mysqli_real_escape_string($connect, $_POST['father_Name']);
    $contact = mysqli_real_escape_string($connect, $_POST['stud_number']);
    $address = mysqli_real_escape_string($connect, $_POST['stud_address']);
    $email = mysqli_real_escape_string($connect, $_POST['stud_email']);
    $dob = mysqli_real_escape_string($connect, $_POST['dob']);
    $cnic = mysqli_real_escape_string($connect, $_POST['stud_cnic']);
    $status = mysqli_real_escape_string($connect, $_POST['std_status']);

    // File Uploads
    $cnicPic = $_FILES['cnicPic'];
    $studentPic = $_FILES['studentPic'];

    // File upload directories
    $uploadDir = "uploads/";

    // Handle CNIC Picture
    $cnicPicName = time() . "_" . basename($cnicPic['name']);
    $cnicTarget = $uploadDir . $cnicPicName;

    // Handle Student Picture
    $studentPicName = time() . "_" . basename($studentPic['name']);
    $studentTarget = $uploadDir . $studentPicName;

    // Upload CNIC Picture
    if (!move_uploaded_file($cnicPic['tmp_name'], $cnicTarget)) {
        die("Error uploading CNIC Picture.");
    }

    // Upload Student Picture
    if (!move_uploaded_file($studentPic['tmp_name'], $studentTarget)) {
        die("Error uploading Student Picture.");
    }

    // Insert query
    $sql = "INSERT INTO students 
        (std_id, std_name, f_name, contact_no, std_address, std_email, std_dob, std_cnic, cnic_picture, std_picture, std_status)
        VALUES 
        ('$std_id', '$fullName', '$fatherName', '$contact', '$address', '$email', '$dob', '$cnic', '$cnicTarget', '$studentTarget', '$status')";

    if (mysqli_query($connect, $sql)) {
        echo "<script>
            alert('Student added successfully!');
            
        </script>";
        echo "<a href = 'student.php' class='px-4 pt-5'> View Data </a>";
    } else {
        echo "Error: " . mysqli_error($connect);
    }
} else {
    echo "Invalid request method!";
}
?>

        </div>
        <!--End Content-->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/color-modes.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>    
