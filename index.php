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
            <?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'dbdata.php';


// Initialize counts
$student_count = 0;
$teacher_count = 0;
$course_count = 0;
$enrollment_count = 0;

// Fetch statistics with error handling
try {
    $total_students = mysqli_query($connect, "SELECT COUNT(*) as count FROM students");
    if ($total_students) {
        $student_count = mysqli_fetch_assoc($total_students)['count'];
    }

    $total_teachers = mysqli_query($connect, "SELECT COUNT(*) as count FROM teachers");
    if ($total_teachers) {
        $teacher_count = mysqli_fetch_assoc($total_teachers)['count'];
    }

    $total_courses = mysqli_query($connect, "SELECT COUNT(*) as count FROM courses");
    if ($total_courses) {
        $course_count = mysqli_fetch_assoc($total_courses)['count'];
    }

    // Count enrollments using your actual table structure
    $total_enrollments = mysqli_query($connect, "SELECT COUNT(*) as count FROM enrollment");
    if ($total_enrollments) {
        $enrollment_count = mysqli_fetch_assoc($total_enrollments)['count'];
    }

    // Fetch recent enrollments with correct table and column names
    $recent_enrollments = mysqli_query($connect, "
        SELECT e.enroll_id, s.std_name, c.course_name, e.roll_no, e.enroll_session, e.shift 
        FROM enrollment e
        JOIN students s ON e.EStd_id = s.std_id
        JOIN courses c ON e.ECourse_id = c.course_id
        ORDER BY e.enroll_id DESC LIMIT 5
    ");

} catch (Exception $e) {
    error_log($e->getMessage());
    echo "<!-- Error: " . $e->getMessage() . " -->";
}
?>

<div class="container-fluid">
    <!-- Page Heading -->
   <div class="d-flex justify-content-between align-items-center mb-4 px-4 flex-wrap pt-4">
                <div>
                    <h1 class="mb-0 px-4">Dashboard</h1>
                    <p class="text-muted px-4">Manage student information</p>
                </div>
                <div class="px-4">
                    <!-- Button to Open Modal -->
                    <button class="btn btn-primary" data-bs-toggle="modal"><a href="reports.php" class="text-white">
            <i class="fas fa-download fa-sm text-white"></i> Generate Report
        </a></button>
                </div>
            </div>

    <!-- Statistics Cards Row -->
    <div class="row">
        <!-- Students Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Students</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $student_count; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teachers Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body px-4">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Teachers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $teacher_count; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Courses Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Courses</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $course_count; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enrollments Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Enrollments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $enrollment_count; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Recent Enrollments -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Enrollments</h6>
                    <a href="enrollment.php" class="btn btn-primary btn-sm">View All</a>
                </div>
                <div class="card-body">
                    <?php if (isset($recent_enrollments) && mysqli_num_rows($recent_enrollments) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Course</th>
                                    <th>Roll No</th>
                                    <th>Session</th>
                                    <th>Shift</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = mysqli_fetch_assoc($recent_enrollments)) { ?>
                                <tr>
                                    <td><?php echo $row['std_name']; ?></td>
                                    <td><?php echo $row['course_name']; ?></td>
                                    <td><?php echo $row['roll_no']; ?></td>
                                    <td><?php echo $row['enroll_session']; ?></td>
                                    <td><?php echo $row['shift']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="text-center py-4">
                        <p class="text-muted">No enrollments found. Start by adding some enrollments!</p>
                        <a href="enrollment.php" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add First Enrollment
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="student.php" class="btn btn-primary btn-block mb-2">
                            <i class="fas fa-user-plus"></i> Manage Students
                        </a>
                        <a href="teachers.php" class="btn btn-success btn-block mb-2">
                            <i class="fas fa-chalkboard-teacher"></i> Manage Teachers
                        </a>
                        <a href="courses.php" class="btn btn-info btn-block mb-2">
                            <i class="fas fa-book"></i> Manage Courses
                        </a>
                        <a href="enrollment.php" class="btn btn-warning btn-block">
                            <i class="fas fa-user-graduate"></i> Manage Enrollments
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Close the database connection
mysqli_close($connect);
?> 
            <!-- Top Bar End -->
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