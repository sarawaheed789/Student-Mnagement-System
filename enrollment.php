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
            <div class="d-flex justify-content-between align-items-center mb-4 px-4 flex-wrap pt-4">
                <div>
                    <h1 class="mb-0 px-4">Enrollment</h1>
                    <p class="text-muted px-4">Manage Enrollment Information</p>
                </div>
                <div class="px-4">
                    <!-- Button to Open Modal -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addenrollmentModal">+ Add New Enrollment</button>
                </div>
            </div>
            <div class="container-fluid mt-4 px-4">
            <!-- Filters and Search -->
            <div class="container my-4 px-4">
                <div class="custom-card mb-4 px-3 py-3 rounded shadow-sm bg-white">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <div class="flex-grow-1 position-relative">
                            <i class="bi bi-search position-absolute" style="left: 15px; top: 10px;"></i>
                            <input type="text" class="form-control ps-5" id="searchInput" placeholder="Search by name, roll number or class...">
                        </div>
                        <select class="form-select w-auto" id="classFilter">
                            <option value="all">All Classes</option>
                            <option value="10th">10th</option>
                            <option value="11th">11th</option>
                            <option value="12th">12th</option>
                        </select>
                        <select class="form-select w-auto" id="statusFilter">
                            <option value="all">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <button class="btn btn-outline-secondary w-auto">
                            <i class="bi bi-download me-1"></i> Export
                        </button>
                    </div>
                </div>
                <!--Start Student Table -->
                <?php
                    include "dbdata.php";
                    $sql = "SELECT e.enroll_id, s.std_name, c.course_name, e.roll_no, e.enroll_session, e.shift 
                    FROM enrollment e
                    JOIN students s ON e.EStd_id = s.std_id
                    JOIN courses c ON e.ECourse_id = c.course_id";
                    $result =mysqli_query($connect, $sql);
                    
                ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover bg-white shadow-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>Enroll_id</th>
                                        <th>EStd_Name</th>
                                        <th>ECourse_Name</th>
                                        <th>Roll NO</th>
                                        <th>Session</th>
                                        <th>Shift</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="studentTable">
                                <?php
                                while($row = mysqli_fetch_array($result)){
                                    echo "
                                        <tr>
                                            <td>$row[enroll_id]</td>
                                            <td>$row[std_name]</td>
                                            <td>$row[course_name]</td>
                                            <td>$row[roll_no]</td>
                                            <td>$row[enroll_session]</td>
                                            <td><span class='status-badge status-active status-inactive'>$row[shift]</span></td>
                                            <td>
                                                <i class = 'bi bi-pencil-fill text-primary me-2' title='Edit' role='button'></i>
                                                <a href = 'enrollment_del.php?did= " .$row['enroll_id']." '><i class='bi bi-trash-fill text-danger' title='Delete' role='button'></i></a>
                                            </td>  
                                           
                                        </tr>";
                                        } 
                                        ?>   
                                </tbody>
                            </table>
                        </div>    
                <!--End Student Table-->
            </div>
        </div>
        <!-- Add Student Table Start -->
         <?php
            include "dbdata.php";
            $studentResult = mysqli_query($connect, "SELECT * FROM students");
            $courseResult = mysqli_query($connect, "SELECT * FROM courses");        
        ?>
        
        <div class="modal fade" id="addenrollmentModal" tabindex="-1" aria-labelledby="addenrollmentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="addenrollmentForm" name="enrollment_form" method="post" action = "insert_enrollment.php">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addStudentModalLabel">Add New Enrollment</h5>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for=enroll_id" class="form-label">Enroll_id</label>
                                <input type="text" class="form-control" id="enroll_id" name="Enroll_id" required>
                            </div>
                            <div class="mb-3">
                                <label for="enrollStd_id" class="form-label">EStd_id</label>
                                <select class="form-select" id="enrollStd_id" name = "EnrollStd_id" required>
                                    <option value="">Select Student ID</option>
                                    <?php while($row = mysqli_fetch_array($studentResult)) {
                                        echo "<option value='{$row['std_id']}'>{$row['std_id']} - {$row['std_name']}</option>";
                                    } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="enrollCourse_id" class="form-label">ECourse_id</label>
                                <select class="form-select" id="enrollCourse_id" name = "EnrollCourse_id" required>
                                    <option value="">Select Course ID</option>
                                    <?php while($row = mysqli_fetch_array($courseResult)) {
                                        echo "<option value='{$row['course_id']}'>{$row['course_id']} - {$row['course_name']}</option>";
                                    } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="rollno" class="form-label">Roll NO</label>
                                <input type="text" class="form-control" id="rollno" name = "rollno" required>
                            </div>
                             <div class="mb-3">
                                <label for="enroll_session" class="form-label">Session</label>
                                <input type="text" class="form-control" id="enroll_session" name = "Enroll_session" required>
                            </div>
                            <div class="mb-3">
                                <label for="shift" class="form-label">Shift</label>
                                <select class="form-select" id="shift" name = "enroll_shift" required>
                                    <option value="morning">Morning</option>
                                    <option value="evening">Evening</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="submit" class="btn btn-primary">Enroll</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Add Student Table End -->
        <!--Content End-->

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/color-modes.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>