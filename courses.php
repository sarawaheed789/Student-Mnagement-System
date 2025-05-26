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
                    <h1 class="mb-0 px-4">Courses</h1>
                    <p class="text-muted px-4">Manage course information</p>
                </div>
                <div class="px-4">
                    <!-- Button to Open Modal -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseModal">+ Add New Course</button>
                </div>
            </div>
            <div class="container-fluid mt-4 px-4">
            <!-- Filters and Search -->
            <div class="container my-4 px-4">
                <div class="custom-card mb-4 px-3 py-3 rounded shadow-sm bg-white">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <div class="flex-grow-1 position-relative">
                            <i class="bi bi-search position-absolute" style="left: 15px; top: 10px;"></i>
                            <input type="text" class="form-control ps-5" id="searchInput" placeholder="Search by course id, course name...">
                        </div>
                        <select class="form-select w-auto" id="classFilter">
                            <option value="all">All Classes</option>
                            <option value="10th">10th</option>
                            <option value="11th">11th</option>
                            <option value="12th">12th</option>
                        </select>
                        <button class="btn btn-outline-secondary w-auto">
                            <i class="bi bi-download me-1"></i> Export
                        </button>
                    </div>
                </div>
                <!--Start Courses Table -->
                <?php
                    include "dbdata.php";
                    $sql = "SELECT c.course_id, c.course_code, c.course_name, t.tfull_name, c.course_duration, c.course_description, c.course_outline 
                    FROM courses c
                    JOIN teachers t ON c.tcourse_id = t.tch_Id";
                    $result =mysqli_query($connect, $sql);
                ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover bg-white shadow-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>Course ID</th>
                                        <th>Course Code</th>
                                        <th>Course Name</th>
                                        <th>Instructor</th>
                                        <th>Duration</th>
                                        <th>Description</th>
                                        <th>Outline</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="courseTable">
                                <?php
                                while($row = mysqli_fetch_array($result)){
                                    echo "
                                        <tr>
                                            <td>$row[course_id]</td>
                                            <td>$row[course_code]</td>
                                            <td>$row[course_name]</td>
                                            <td>$row[tfull_name]</td>
                                            <td>$row[course_duration]</td>
                                            <td>$row[course_description]</td>
                                            <td>
                                            <a href='$row[course_outline]' target='_blank' class='btn btn-sm btn-outline-primary'>
                                                <i class='bi bi-eye'></i> View
                                            </a>
                                        </td>
                                            <td>
                                                <i class = 'bi bi-pencil-fill text-primary me-2' title='Edit' role='button'></i>
                                                <a href = 'course_del.php?did= " .$row['course_id']." '><i class='bi bi-trash-fill text-danger' title='Delete' role='button'></i></a>
                                            </td>  
                                           
                                        </tr>";
                                        } 
                                    ?>   
                                </tbody>
                            </table>
                        </div>    
                <!--End Courses Table-->
            </div>
        </div>
        <!-- Add Student Modal Start -->
         <?php
            include "dbdata.php";
            $teacherResult = mysqli_query($connect, "SELECT * FROM teachers");    
        ?>
        <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="row g-0">
                        <!-- Vertical Sidebar for the Form -->
                        <div class="col-md-4 col-lg-3 form-sidebar">
                            <div>
                                <h4 class="fs-4">Add New Student</h4>
                                <p class="text-white-50 mb-4">Enter student information in the form to add them to the database.</p>
                            </div>
                            <div class="form-sidebar-info">
                                <h5 class="fs-6 mb-2">Required Information</h5>
                                <p class="text-white-50 small mb-0">
                                    Please fill all the mandatory fields marked with an asterisk (*) to complete the student registration.
                                </p>
                            </div>
                        </div>
                        <!-- Form Content -->
                        <div class="col-md-8 col-lg-9">
                            <form id="addCourseForm" name="student_form" method="post" action="insert_course.php" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addCourseModalLabel">Courses Form</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="courseid" class="form-label">Course ID</label>
                                            <input type="text" class="form-control" id="courseid" name="courseId">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="coursecode" class="form-label">Course Code</label>
                                            <input type="text" class="form-control" id="coursecode" name="courseCode">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="courseName" class="form-label">Course Name</label>
                                            <input type="text" class="form-control" id="courseName" name= "courseName">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="instructor" class="form-label">Teacher</label>
                                            <select class="form-select" id="instructor" name="courseInstructor">
                                                <option value="">Select Teacher ID</option>
                                                <?php while($row = mysqli_fetch_array($teacherResult)) {
                                                    echo "<option value='{$row['tch_id']}'>{$row['tch_id']} - {$row['tch_username']}</option>";
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <input type="text" class="form-control" id="description" name = "courseDescription">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="duration" class="form-label">Duration</label>
                                            <input type="text" class="form-control" id="duration" name="courseDuration">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="course_outline" class="form-label">Course Outline</label>
                                            <input type="file" class="form-control" id="course_outline" name = "courseOutline" accept=".pdf">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Add Course</button>
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