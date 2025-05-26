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
                $std_id = $_REQUEST['std_id'];
                $fullName = $_REQUEST['fullName'];
                $fatherName = $_REQUEST ['father_Name'];
                $Std_Username = $_REQUEST['std_username'];
                $Std_Password = $_REQUEST['std_password'];
                $Std_Gender = $_REQUEST['std_gender'];
                $contact = $_REQUEST['stud_number'];
                $address = $_REQUEST['stud_address'];
                $email = $_REQUEST['stud_email'];
                $cnic = $_REQUEST['stud_cnic'];
                $dob = $_REQUEST['dob'];
                $status = $_REQUEST['std_status'];
                $Std_guardian_name = $_REQUEST['guardian_name'];
                $Std_guardian_cnic = $_REQUEST['guardian_cnic'];
                $Relation_guardian = $_REQUEST['relate_guardian'];
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
                    (std_id, std_name, f_name, std_username, std_password, s_gender, contact_no, std_address, std_email, std_dob, std_cnic, cnic_picture, std_picture, std_status, guardian_name, guardian_cnic, relation_guardian)
                    VALUES 
                    ('$std_id', '$fullName', '$fatherName', '$Std_Username', '$Std_Password', '$Std_Gender', '$contact', '$address', '$email',  '$dob', '$cnic', '$cnicTarget', '$studentTarget', '$status', '$Std_guardian_name', '$Std_guardian_cnic', '$Relation_guardian')";

                if (mysqli_query($connect, $sql)) {
                    echo "<script>
                        alert('Student added successfully!');
                        
                    </script>";
                    echo "<a href = 'student.php' class='px-4 pt-5'> View Data </a>";
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
