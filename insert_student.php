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
                $student_id = $_REQUEST['std_id'];
                $student_Name= $_REQUEST['fullName'];
                $std_f_name = $_REQUEST['father_Name'];
                $student_contact = $_REQUEST['stud_number'];
                $student_address= $_REQUEST['stud_address'];
                $std_email = $_REQUEST['stud_email'];
                $student_dob = $_REQUEST['dob'];
                $student_cnic= $_REQUEST['stud_cnic'];
                $std_cnicPic = $_REQUEST['cnicPic'];
                $student_Pic = $_REQUEST['studentPic'];
                $student_status= $_REQUEST['std_status'];
                include "dbdata.php";
                $sql = "INSERT INTO students SET std_id ='$student_id', std_name ='$student_Name', f_name = '$std_f_name', contact_no = '$student_contact', std_address = '$student_address', std_email = '$std_email', std_cnic = '$student_cnic',  std_dob = '$student_dob',  cnic_picture = '$std_cnicPic',  std_picture = '$student_Pic', std_status = '$student_status'";
                $result = mysqli_query($connect, $sql);

                if($result > 0){
                echo "<p class='px-4 pt-5'>1 More Record Inserted</p>";
                echo "<a href = 'student.php' class='px-4 pt-5'> View Data </a>";
                }
                else{
                    echo "error";
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
