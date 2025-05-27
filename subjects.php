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
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addsubjectModal">+ Add New Subject</button>
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
                    $sql = "SELECT c.course_name, s.semester, s.subject_name, s.programe_session
                    FROM subjects s
                    JOIN courses c ON s.scourse_id = c.course_id";
                    $result =mysqli_query($connect, $sql);
                    
                ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover bg-white shadow-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>Serial#</th>
                                        <th>Course Name</th>
                                        <th>Semester</th>
                                        <th>Subject Name</th>
                                        <th>Session</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="studentTable">
                                <?php
                                    $sno = 1;
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>
                                                <td>$sno</td>
                                                <td>$row[course_name]</td>
                                                <td>$row[semester]</td>
                                                <td>$row[subject_name]</td>
                                                <td>$row[programe_session]</td>
                                                <td>
                                                    <i class='bi bi-pencil-fill text-primary me-2' title='Edit' role='button'></i>
                                                    <a href='subject_del.php?did=" . $row['course_name'] . "'><i class='bi bi-trash-fill text-danger' title='Delete' role='button'></i></a>
                                                </td>   
                                            </tr>";
                                            $sno++;
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
            $courseResult = mysqli_query($connect, "SELECT * FROM courses");        
        ?>
        <div class="modal fade" id="addsubjectModal" tabindex="-1" aria-labelledby="addsubjectModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="row g-0">
                        <!-- Sidebar Section -->
                        <div class="col-md-4 col-lg-3 form-sidebar">
                            <div>
                                <h4 class="fs-4">Add Enrollment</h4>
                                <p class="text-black-50 mb-4">Fill in the enrollment details to register the student for a course.</p>
                            </div>
                            <div class="form-sidebar-info">
                                <h5 class="fs-6 mb-2">Important</h5>
                                <p class="text-black-50 small mb-0">
                                    Ensure all fields are correctly filled before submitting the form.
                                </p>
                            </div>
                        </div>
                        <!-- Form Section -->
                        <div class="col-md-8 col-lg-9">
                            <form id="addsubjectForm" name="enrollment_form" method="post" action="insert_subjects.php">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addenrollmentModalLabel" style="font-weight:600">Subject Form</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="scourse_name" class="form-label">Course Name *</label>
                                            <select class="form-select" id="scourse_name" name="scourse_name">
                                                <option value="">Select Course ID</option>
                                                <?php while($row = mysqli_fetch_array($courseResult)) {
                                                    echo "<option value='{$row['course_id']}'>{$row['course_id']} - {$row['course_name']}</option>";
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="semester" class="form-label">Semester *</label>
                                            <select class="form-control" id="semester" name="semester">
                                                <option value="">Select Semester</option>
                                                <?php
                                                for ($sem = 1; $sem <= 10; $sem++) {
                                                    echo "<option value=\"$sem\">Semester $sem</option>";
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="subject_name" class="form-label">Subject Name *</label>
                                            <input type="text" class="form-control" id="subject_name" name="subject_name">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="session_year" class="form-label">Session *</label>
                                            <select  class="form-control" id="session_year" name="session_year">
                                                <option value="">Select Session</option>
                                                <?php
                                                for ($year = 2025; $year <= 2050; $year++) {
                                                    echo "<option value=\"$year\">$year</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
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