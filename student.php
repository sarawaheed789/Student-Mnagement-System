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
                    <h1 class="mb-0 px-4">Students</h1>
                    <p class="text-muted px-4">Manage student information</p>
                </div>
                <div class="px-4">
                    <!-- Button to Open Modal -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">+ Add New Student</button>
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
                    $sql = "select * from students";
                    $result =mysqli_query($connect, $sql);
                    
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover bg-white shadow-sm">
                        <thead class="table-light">
                            <tr>
                                <th>Std_id</th>
                                <th>Name</th>
                                <th>Father Name</th>
                                <th>Contact No</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>CNIC</th>
                                <th>DOB</th>
                                <th>CNIC Picture</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="studentTable">
                            <?php
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>
                                        <td>$row[std_id]</td>
                                        <td class='d-flex align-items-center gap-2'>
                                            <img src='$row[std_picture]' alt='Student' width='40' height='40' class='rounded-circle object-fit-cover'>
                                            $row[std_name]
                                        </td>
                                        <td>$row[f_name]</td>
                                        <td>$row[contact_no]</td>
                                        <td>$row[std_address]</td>
                                        <td>$row[std_email]</td>
                                        <td>$row[std_cnic]</td>
                                        <td>$row[std_dob]</td>
                                        <td>$row[cnic_picture]</td>
                                        <td><span class='status-badge status-active status-inactive'>$row[std_status]</span></td>
                                        <td>
                                            <i class='bi bi-pencil-fill text-primary me-2' title='Edit' role='button'></i>
                                            <a href='student_del.php?did=" . $row['std_id'] . "'><i class='bi bi-trash-fill text-danger' title='Delete' role='button'></i></a>
                                        </td>  
                                    </tr>";
                                } 
                            ?>   
                        </tbody>
                    </table>
                    <div id="paginationWrapper" class="d-flex justify-content-end mt-3"></div>
                    <!--End Student Table-->
                </div>    
            </div>
        </div>
        <!-- Add Student Modal Start -->
        <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
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
                            <form id="addStudentForm" name="student_form" method="post" action="insert_student.php">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addStudentModalLabel">Student Registration</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="std_id" class="form-label">Student ID *</label>
                                            <input type="text" class="form-control" id="std_id" name="std_id">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="studentName" class="form-label">Full Name *</label>
                                            <input type="text" class="form-control" id="studentName" name="fullName">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="FatherName" class="form-label">Father's Name *</label>
                                            <input type="text" class="form-control" id="FatherName" name="father_Name">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="contactNo" class="form-label">Contact Number *</label>
                                            <input type="text" class="form-control" id="contactNo" name="stud_number">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="std_address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="std_address" name="stud_address">
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="std_email" class="form-label">Email Address *</label>
                                            <input type="email" class="form-control" id="std_email" name="stud_email">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="dob" class="form-label">Date of Birth *</label>
                                            <input type="date" class="form-control" id="dob" name="dob">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="std_cnic" class="form-label">CNIC Number *</label>
                                        <input type="text" class="form-control" id="std_cnic" name="stud_cnic">
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="cnicPic" class="form-label">CNIC Picture</label>
                                            <input type="file" class="form-control" id="cnicPic" name="cnicPic" accept=".pdf">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="studentPic" class="form-label">Student Picture</label>
                                            <input type="file" class="form-control" id="studentPic" name="studentPic" accept=".pdf, image/*">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" id="status" name="std_status">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Add Student</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Student Modal End -->
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