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

                // Collecting Form Data (Make sure form method is POST)
                $Tch_id = $_POST['tch_id'];
                $FullName = $_POST['Tfull_Name'];
                $Tch_Username = $_POST['tch_username'];
                $Tch_Password = $_POST['std_password'];
                $Tch_Gender = $_POST['tch_gender'];
                $Tch_contact = $_POST['tch_number'];
                $Tch_address = $_POST['tch_address'];
                $Tch_email = $_POST['tch_email'];
                $Tch_cnic = $_POST['tch_cnic'];
                $Tch_dob = $_POST['tch_dob'];
                $Tch_status = $_POST['tch_status'];
                $tch_qualification = $_POST['tchr_qualification'];

                // File Uploads (Check all 3 files exist)
                if (isset($_FILES['tch_cnicPic']) && isset($_FILES['tch_Pic']) && isset($_FILES['tch_cv'])) {

                    $tch_cnicPic = $_FILES['tch_cnicPic'];
                    $tchPic = $_FILES['tch_Pic'];
                    $tchcv = $_FILES['tch_cv'];

                    $uploadDir = "uploads/";

                    // File name generation
                    $tch_cnicPicName = time() . "_" . basename($tch_cnicPic['name']);
                    $tch_cnicTarget = $uploadDir . $tch_cnicPicName;

                    $teacherPicName = time() . "_" . basename($tchPic['name']);
                    $teacherTarget = $uploadDir . $teacherPicName;

                    $tch_CVName = time() . "_" . basename($tchcv['name']);
                    $cvTarget = $uploadDir . $tch_CVName;

                    // Upload all files
                    if (!move_uploaded_file($tch_cnicPic['tmp_name'], $tch_cnicTarget)) {
                        die("Error uploading CNIC Picture.");
                    }

                    if (!move_uploaded_file($tchPic['tmp_name'], $teacherTarget)) {
                        die("Error uploading Teacher Picture.");
                    }

                    if (!move_uploaded_file($tchcv['tmp_name'], $cvTarget)) {
                        die("Error uploading CV.");
                    }

                    // SQL Insert
                    $sql = "INSERT INTO teachers 
                        (tch_id, tfull_name, tch_username, tch_password, tch_gender, tch_contact, tch_address, tch_email, tch_dob, tch_cnic, tch_cnicpic, tch_pic, tch_status, tch_qualification, tch_cv)
                        VALUES 
                        ('$Tch_id', '$FullName', '$Tch_Username', '$Tch_Password', '$Tch_Gender', '$Tch_contact', '$Tch_address', '$Tch_email', '$Tch_dob', '$Tch_cnic', '$tch_cnicTarget', '$teacherTarget', '$Tch_status', '$tch_qualification', '$cvTarget')";

                    if (mysqli_query($connect, $sql)) {
                        echo "<script>alert('Teacher added successfully!');</script>";
                        echo "<a href='teachers.php' class='px-4 pt-5'>View Data</a>";
                    } else {
                        echo "Error: " . mysqli_error($connect);
                    }

                } else {
                    die("One or more file inputs are missing.");
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
