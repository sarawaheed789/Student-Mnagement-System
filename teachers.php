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
                    <h1 class="mb-0 px-4">Teachers</h1>
                    <p class="text-muted px-4">Manage teachers information</p>
                </div>
                <div class="px-4">
                    <!-- Button to Open Modal -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTeacherModal">+ Add New Teacher</button>
                </div>
            </div>
            <div class="container-fluid mt-4 px-4">
            <!-- Filters and Search -->
            <div class="container my-4 px-4">
                <div class="custom-card mb-4 px-3 py-3 rounded shadow-sm bg-white">
                    <div class="d-flex flex-wrap align-items-center gap-3">
                        <div class="flex-grow-1 position-relative">
                            <i class="bi bi-search position-absolute" style="left: 15px; top: 10px;"></i>
                            <input type="text" class="form-control ps-5" id="searchInput" placeholder="Search by name & username..">
                        </div>
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
                    $sql = "select * from teachers";
                    $result =mysqli_query($connect, $sql);
                    
                ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover bg-white shadow-sm">
                        <thead class="table-light">
                            <tr>
                                <th>Tch_id</th>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Qualification</th>
                                <th>CNIC Picture</th>
                                <th>CV</th>
                                <th>Status</th>
                                <th>View Teacher Detail</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="teacherTable">
                            <?php
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>
                                        <td>$row[tch_id]</td>
                                        <td class='d-flex align-items-center gap-2'>
                                            <img src='$row[tch_pic]' alt='Teacher' width='50' height='50' class='rounded-circle object-fit-cover'>
                                            $row[tfull_name]
                                        </td>
                                        <td>$row[tch_username]</td>
                                        <td>$row[tch_password]</td>
                                        <td>$row[tch_qualification]</td>
                                        <td>
                                            <a href='$row[tch_cnicpic]' target='_blank' class='btn btn-sm btn-outline-primary'>
                                                <i class='bi bi-eye'></i> View
                                            </a>
                                        </td>
                                        <td>
                                            <a href='$row[tch_cv]' target='_blank' class='btn btn-sm btn-outline-primary'>
                                                <i class='bi bi-eye'></i> View
                                            </a>
                                        </td>
                                        <td><span class='status-badge'>$row[tch_status]</span></td>
                                        <td>
                                            <button class='btn btn-sm btn-info viewbtn' 
                                                data-id='$row[tch_id]'
                                                data-fullname='$row[tfull_name]'
                                                data-tuname='$row[tch_username]'
                                                data-tupassword='$row[tch_password]'
                                                data-tgender='$row[tch_gender]'
                                                data-tbod='$row[tch_dob]'
                                                data-taddress='$row[tch_address]'
                                                data-tcnic='$row[tch_cnic]'
                                                data-tcontact='$row[tch_contact]'
                                                data-temail='$row[tch_email]'
                                                data-tqualification='$row[tch_qualification]'
                                                data-tstatus='$row[tch_status]'
                                                data-tpicture='$row[tch_pic]'
                                                data-bs-toggle='modal' 
                                                data-bs-target='#viewTeacherModal'>
                                                <i class='bi bi-eye-fill'></i> View
                                            </button>
                                        </td>
                                        <td>
                                            <i class='bi bi-pencil-fill text-primary me-2' title='Edit' role='button'></i>
                                            <a href='teacher_del.php?did=" . $row['tch_id'] . "'><i class='bi bi-trash-fill text-danger' title='Delete' role='button'></i></a>
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
        <div class="modal fade" id="addTeacherModal" tabindex="-1" aria-labelledby="addTeacherModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="row g-0">
                        <!-- Vertical Sidebar for the Form -->
                        <div class="col-md-4 col-lg-3 form-sidebar">
                            <div>
                                <h4 class="fs-4">Add New Teacher</h4>
                                <p class="text-black-50 mb-4">Enter student information in the form to add them to the database.</p>
                            </div>
                            <div class="form-sidebar-info">
                                <h5 class="fs-6 mb-2">Required Information</h5>
                                <p class="text-black-50 small mb-0 ">
                                    Please fill all the mandatory fields marked with an asterisk (*) to complete the student registration.
                                </p>
                            </div>
                        </div>
                        <!-- Form Content -->
                        <div class="col-md-8 col-lg-9">
                            <form id="addTeacherForm" name="teacher_form" method="post" action="insert_teacher.php" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addTeacherModalLabel" style="font-weight:600">Teacher Registration Form</h5>
                                </div>
                                <div class="modal-body">
                                    <h5 class="py-2">Teacher Detail</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="tch_id" class="form-label">Teacher ID *</label>
                                            <input type="text" class="form-control" id="tch_id" name="tch_id">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="FullName" class="form-label">Full Name *</label>
                                            <input type="text" class="form-control" id="FullName" name="Tfull_Name">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="tch_username" class="form-label">Username *</label>
                                            <input type="text" class="form-control" id="tch_username" name="tch_username">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="password" class="form-label">Password *</label>
                                            <input type="password" class="form-control" id="password" name="std_password">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="tch_gender" class="form-label">Gender *</label>
                                            <select class="form-select" id="tch_gender" name="tch_gender">
                                                <option value="">Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="tch_dob" class="form-label">Date of Birth *</label>
                                            <input type="date" class="form-control" id="tch_dob" name="tch_dob">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="tch_cnic" class="form-label">CNIC Number *</label>
                                            <input type="text" class="form-control" id="tch_cnic" name="tch_cnic" />
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="tch_contactNo" class="form-label">Contact Number *</label>
                                            <input type="text" class="form-control" id="tch_contactNo" name="tch_number">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="tch_email" class="form-label">Email Address *</label>
                                            <input type="email" class="form-control" id="tch_email" name="tch_email">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="tch_address" class="form-label">Address *</label>
                                            <input type="text" class="form-control" id="tch_address" name="tch_address">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="tch_cnicPic" class="form-label">Teacher CNIC Picture*</label>
                                            <input type="file" class="form-control" id="cnicPic" name="tch_cnicPic" accept=".pdf">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="tch_Pic" class="form-label">Teacher Picture *</label>
                                            <input type="file" class="form-control" id="tch_Pic" name="tch_Pic" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="tch_qualification" class="form-label">Qualification *</label>
                                            <input type="text" class="form-control" id="tch_qualification" name="tchr_qualification">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="tch_cv" class="form-label">CV *</label>
                                            <input type="file" class="form-control" id="tch_cv" name="tch_cv" accept=".pdf">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="Tch_status" class="form-label">Status</label>
                                        <select class="form-select" id="Tch_status" name="tch_status">
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
        <!-- Add Teacher Modal End -->

        <!-- View Teacher Modal -->
        <div class="modal fade" id="viewTeacherModal" tabindex="-1" aria-labelledby="viewTeacherModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content border-primary">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="viewTeacherModalLabel">Teacher Full Details</h5>
                        <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Centered Larger Image -->
                        <div class="text-center mb-4">
                            <img id="viewTPicture" class="img-fluid rounded-circle shadow" style="width: 220px; height: 220px; object-fit: cover;" alt="Teacher Picture">
                        </div>
                        <!-- Info Table with View PDF Button Inside -->
                        <table class="table table-bordered view-Table table-hover bg-white shadow-sm">
                            <tbody>
                                <tr>
                                    <th class="table-light">ID</th>
                                    <td id="viewTId"></td>
                                </tr>
                                <tr>
                                    <th class="table-light">Full Name</th>
                                    <td id="viewFullName"></td>
                                </tr>
                                <tr>
                                    <th class="table-light">Username</th>
                                    <td id="viewTUname"></td>
                                </tr>
                                <tr>
                                    <th class="table-light">Password</th>
                                    <td id="viewTPassword"></td>
                                </tr>
                                <tr>
                                    <th class="table-light">Gender</th>
                                    <td id="viewTGender"></td>                                                                                                                            
                                </tr>
                                <tr>
                                    <th class="table-light">Contact</th>
                                    <td id="viewTContact"></td>
                                </tr>
                                <tr>
                                    <th class="table-light">Address</th>
                                    <td id="viewTAddress"></td>
                                </tr>
                                <tr>
                                    <th class="table-light">Email</th>
                                    <td id="viewTEmail"></td>
                                </tr>
                                <tr>
                                    <th class="table-light">CNIC</th>
                                    <td id="viewTCnic"></td>
                                </tr>
                                <tr>
                                    <th class="table-light">Date of Birth</th>
                                    <td id="viewTDob"></td>
                                </tr>
                                <tr>
                                    <th class="table-light">Qualification</th>
                                    <td id="viewTqualificaion"></td>
                                </tr>
                                <tr>
                                    <th class="table-light">Status</th>
                                    <td id="viewStatus"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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