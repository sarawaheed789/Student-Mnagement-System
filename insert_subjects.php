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
                $Scourse_Name = $_REQUEST['scourse_name'];
                $programe_semster = $_REQUEST['semester'];
                $Subject_name= $_REQUEST['subject_name'];
                $programe_session = $_REQUEST['session_year'];
                include "dbdata.php";
                $sql = "INSERT INTO subjects SET 
                        scourse_id = '$Scourse_Name', 
                        semester = '$programe_semster', 
                        subject_name = '$Subject_name', 
                        programe_session = '$programe_session'";
                        $result = mysqli_query($connect, $sql);

                if($result > 0){
                echo "<p class='px-4 pt-5'>1 More Record Inserted</p>";
                echo "<a href = 'subjects.php' class='px-4 pt-5'> View Data </a>";
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
