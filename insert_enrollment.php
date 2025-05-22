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
                $Enroll_id = $_REQUEST['Enroll_id'];
                $EStd_id = $_REQUEST['EnrollStd_id'];
                $ECourse_id = $_REQUEST['EnrollCourse_id'];
                $rollno = $_REQUEST['rollno'];
                $enroll_session= $_REQUEST['Enroll_session'];
                $enroll_shift = $_REQUEST['enroll_shift'];
                include "dbdata.php";
                $sql = "INSERT INTO enrollment SET enroll_id ='$Enroll_id', EStd_id ='$EStd_id', ECourse_id = '$ECourse_id', roll_no = '$rollno', enroll_session = '$enroll_session', shift = '$enroll_shift'";
                $result = mysqli_query($connect, $sql);

                if($result > 0){
                echo "<p class='px-4 pt-5'>1 More Record Inserted</p>";
                echo "<a href = 'enrollment.php' class='px-4 pt-5'> View Data </a>";
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
