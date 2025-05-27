//Toggle
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    const overlay = document.querySelector('.overlay');

    // Toggle sidebar function
    function toggleSidebar() {
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
        document.body.classList.toggle('sidebar-open');
    }

    // Event listeners for sidebar
    if (sidebarToggle && sidebar && mainContent) {
        // Toggle button click
        sidebarToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleSidebar();
        });

        // Overlay click
        overlay.addEventListener('click', toggleSidebar);

        // Close sidebar on window resize if larger than mobile breakpoint
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768 && sidebar.classList.contains('show')) {
                toggleSidebar();
            }
        });

        // Handle escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && sidebar.classList.contains('show')) {
                toggleSidebar();
            }
        });
    }

    
});
//SideBar Active colors

document.addEventListener('DOMContentLoaded', () => {
  const currentPath = window.location.pathname.split('/').pop(); // e.g., "student.php"
  const navLinks = document.querySelectorAll('#sidebarNav .nav-link');

  navLinks.forEach(link => {
    const linkHref = link.getAttribute('href');
    if (linkHref === currentPath) {
      link.classList.add('active');
    } else {
      link.classList.remove('active');
    }
  });
});


// Students

//Student Active & Inactive Filter
    document.addEventListener("DOMContentLoaded", function () {
        const statusFilter = document.getElementById("statusFilter");
        const searchInput = document.getElementById("searchInput");
        const tableBody = document.getElementById("studentTable");

        function filterTable() {
            const status = statusFilter.value.toLowerCase();
            const search = searchInput.value.toLowerCase();
            const rows = tableBody.querySelectorAll("tr");

            rows.forEach(row => {
                const rollNo = row.querySelector("td:nth-child(1)")?.textContent.toLowerCase() || "";
                const name = row.querySelector("td:nth-child(2)")?.textContent.toLowerCase() || "";
                const fatherName = row.querySelector("td:nth-child(3)")?.textContent.toLowerCase() || "";
                const stdStatus = row.querySelector("td:nth-child(8) span")?.textContent.toLowerCase() || "";

                const matchesSearch =
                    rollNo.includes(search) ||
                    name.includes(search) ||
                    fatherName.includes(search);

                const matchesStatus = (status === "all" || stdStatus === status);

                row.style.display = (matchesSearch && matchesStatus) ? "" : "none";
            });
        }

        statusFilter.addEventListener("change", filterTable);
        searchInput.addEventListener("keyup", filterTable);
    });

    // badge Style
        $(document).ready(function(){
            $("span.status-badge").each(function(){
                const status = $(this).text().trim().toLowerCase();
                if(status === "active") {
                    $(this).addClass("active");
                } else if(status === "inactive") {
                    $(this).addClass("inactive");
                }
            });
        });

//Student Form Validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('addStudentForm');
    const inputs = {
        name: document.getElementById('studentName'),
        fatherName: document.getElementById('FatherName'),
        guardianName: document.getElementById('guardianName'),
        contactNo: document.getElementById('contactNo'),
        address: document.getElementById('std_address'),
        email: document.getElementById('std_email'),
        cnic: document.getElementById('std_cnic'),
        guardianCNIC: document.getElementById('guardianCNIC'),
        dob: document.getElementById('dob'),
        cnicPic: document.getElementById('cnicPic'),
        studentPic: document.getElementById('studentPic'),
        gender: document.getElementById('gender'),
        username: document.getElementById('username'),
        password: document.getElementById('password')
    };

    // Validation patterns
    const patterns = {
        name: /^[A-Za-z\s]+$/,
        contact: /^\d{11}$/,
        email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        cnic: /^\d{13}$/,
        username: /^[a-zA-Z0-9_]{3,20}$/
    };

    // Error message display function
    function showError(input, message) {
        const errorDiv = input.nextElementSibling;
        if (!errorDiv || !errorDiv.classList.contains('error-message')) {
            const div = document.createElement('div');
            div.className = 'error-message text-danger small mt-1';
            div.textContent = message;
            input.parentNode.insertBefore(div, input.nextElementSibling);
        } else {
            errorDiv.textContent = message;
        }
        input.classList.add('is-invalid');
    }

    // Clear error message
    function clearError(input) {
        const errorDiv = input.nextElementSibling;
        if (errorDiv && errorDiv.classList.contains('error-message')) {
            errorDiv.remove();
        }
        input.classList.remove('is-invalid');
    }

    // Input validation functions
    const validateField = {
        name: (input) => {
            if (!input.value.trim()) {
                showError(input, 'This field is required');
                return false;
            }
            if (!patterns.name.test(input.value.trim())) {
                showError(input, 'Only alphabetic characters are allowed');
                return false;
            }
            clearError(input);
            return true;
        },
       contact: (input) => {
    const value = input.value.trim();
    if (!value) {
        showError(input, 'This field is required');
        return false;
    }
    if (!/^\d+$/.test(value)) {
        showError(input, 'Only numbers are allowed');
        return false;
    }
    if (value.length !== 11) {
        showError(input, 'Contact must be 11 digits');
        return false;
    }
    clearError(input);
    return true;
},
cnic: (input) => {
    const value = input.value.trim();
    if (!value) {
        showError(input, 'This field is required');
        return false;
    }
    if (!/^\d+$/.test(value)) {
        showError(input, 'Only numbers are allowed');
        return false;
    }
    if (value.length !== 13) {
        showError(input, 'CNIC must be 13 digits');
        return false;
    }
    clearError(input);
    return true;
},

        email: (input) => {
            if (!input.value.trim()) {
                showError(input, 'This field is required');
                return false;
            }
            if (!patterns.email.test(input.value.trim())) {
                showError(input, 'Please enter a valid email address');
                return false;
            }
            clearError(input);
            return true;
        },
        
        address: (input) => {
            if (!input.value.trim()) {
                showError(input, 'This field is required');
                return false;
            }
            clearError(input);
            return true;
        },
        dob: (input) => {
            if (!input.value) {
                showError(input, 'Date of birth is required');
                return false;
            }
            clearError(input);
            return true;
        },
        file: (input) => {
            if (!input.value) {
                showError(input, 'Please select a file');
                return false;
            }
            clearError(input);
            return true;
        },
        gender: (input) => {
            if (!input.value) {
                showError(input, 'Please select a gender');
                return false;
            }
            clearError(input);
            return true;
        },
        username: (input) => {
            if (!input.value.trim()) {
                showError(input, 'Username is required');
                return false;
            }
            if (!patterns.username.test(input.value.trim())) {
                showError(input, 'Username must be 3-20 characters and can only contain letters, numbers, and underscores');
                return false;
            }
            clearError(input);
            return true;
        },
        password: (input) => {
            if (!input.value) {
                showError(input, 'Password is required');
                return false;
            }
            if (input.value.length < 8) {
                showError(input, 'Password must be at least 8 characters long');
                return false;
            }
            clearError(input);
            return true;
        }
    };
    // Add input event listeners
    inputs.name.addEventListener('input', () => validateField.name(inputs.name));
    inputs.fatherName.addEventListener('input', () => validateField.name(inputs.fatherName));
    inputs.guardianName.addEventListener('input', () => validateField.name(inputs.guardianName));
    inputs.contactNo.addEventListener('input', () => validateField.contact(inputs.contactNo));
    inputs.address.addEventListener('input', () => validateField.address(inputs.address));
    inputs.email.addEventListener('input', () => validateField.email(inputs.email));
    inputs.cnic.addEventListener('input', () => validateField.cnic(inputs.cnic));
    inputs.guardianCNIC.addEventListener('input', () => validateField.cnic(inputs.guardianCNIC));
    inputs.dob.addEventListener('input', () => validateField.dob(inputs.dob));
    inputs.cnicPic.addEventListener('input', () => validateField.file(inputs.cnicPic));
    inputs.studentPic.addEventListener('input', () => validateField.file(inputs.studentPic));
    inputs.gender.addEventListener('input', () => validateField.gender(inputs.gender));
    inputs.username.addEventListener('input', () => validateField.username(inputs.username));
    inputs.password.addEventListener('input', () => validateField.password(inputs.password));
    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const isNameValid = validateField.name(inputs.name);
        const isFatherNameValid = validateField.name(inputs.fatherName);
        const isGuardianNameValid = validateField.name(inputs.guardianName);
        const isContactValid = validateField.contact(inputs.contactNo);
        const isAddressValid = validateField.address(inputs.address);
        const isEmailValid = validateField.email(inputs.email);
        const isCnicValid = validateField.cnic(inputs.cnic);
        const isGuardianCNICValid = validateField.cnic(inputs.guardianCNIC);
        const isDobValid = validateField.dob(inputs.dob);
        const isCnicPicValid = validateField.file(inputs.cnicPic);
        const isStudentPicValid = validateField.file(inputs.studentPic);
        const isGenderValid = validateField.gender(inputs.gender);
        const isUsernameValid = validateField.username(inputs.username);
        const isPasswordValid = validateField.password(inputs.password);

        if (isNameValid && isFatherNameValid && isGuardianNameValid && 
            isContactValid && isAddressValid && isEmailValid && 
            isCnicValid && isGuardianCNICValid && isDobValid && 
            isCnicPicValid && isStudentPicValid && isGenderValid && 
            isUsernameValid && isPasswordValid) {
            this.submit();
        }
    });
});
//Student Pagination

$(document).ready(function () {
        var rowsPerPage = 6;
        var rows = $('#studentTable tr');
        var totalRows = rows.length;
        var totalPages = Math.ceil(totalRows / rowsPerPage);
        var currentPage = 1;
        function showPage(page) {
            var start = (page - 1) * rowsPerPage;
            var end = start + rowsPerPage;
            rows.hide();
            rows.slice(start, end).show();

            // Enable/Disable Prev/Next
            $('#prevBtn').toggleClass('disabled', page === 1);
            $('#nextBtn').toggleClass('disabled', page === totalPages);
        }
        // Only Previous/Next buttons
        var paginationHTML = `
            <nav>
                <ul class="pagination">
                    <li class="page-item" id="prevBtn"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item" id="nextBtn"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>`;

        // Add pagination just below table
        $('#paginationWrapper').html(paginationHTML);

        // Initial view
        showPage(currentPage);

        // Button clicks
        $('#paginationWrapper').on('click', '#prevBtn', function (e) {
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
            }
        });
        $('#paginationWrapper').on('click', '#nextBtn', function (e) {
            e.preventDefault();
            if (currentPage < totalPages) {
                currentPage++;
                showPage(currentPage);
            }
        });
    });

//View Student Data

$(document).on("click", ".viewBtn", function () {
    const btn = $(this);
    // Set student data
    $("#viewName").text(btn.data("name"));
    $("#viewFname").text(btn.data("fname"));
    $("#viewUname").text(btn.data("uname"));
    $("#viewUPassword").text(btn.data("upassword"));
    $("#viewGender").text(btn.data("gender"));
    $("#viewContact").text(btn.data("contact"));
    $("#viewAddress").text(btn.data("address"));
    $("#viewEmail").text(btn.data("email"));
    $("#viewCnic").text(btn.data("cnic"));
    $("#viewDob").text(btn.data("dob"));
    $("#viewGname").text(btn.data("gname"));
    $("#viewGcnic").text(btn.data("gcnic"));
    $("#viewGrelation").text(btn.data("grelation"));
    $("#viewStatus").text(btn.data("status"));
    $("#viewPicture").attr("src", btn.data("picture"));   
  });
  
//Teacher Form Validation
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('addTeacherForm');
    const inputs = {
        // teacherID removed from validation
        fullName: document.getElementById('FullName'),
        username: document.getElementById('tch_username'),
        password: document.getElementById('password'),
        gender: document.getElementById('tch_gender'),
        dob: document.getElementById('tch_dob'),
        cnic: document.getElementById('tch_cnic'),
        contact: document.getElementById('tch_contactNo'),
        email: document.getElementById('tch_email'),
        address: document.getElementById('tch_address'),
        cnicPic: document.getElementById('cnicPic'),
        pic: document.getElementById('tch_Pic'),
        qualification: document.getElementById('tch_qualification'),
        cv: document.getElementById('tch_cv')
    };

    const patterns = {
        name: /^[A-Za-z\s]+$/,
        contact: /^\d{11}$/,
        cnic: /^\d{13}$/,
        email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        username: /^[a-zA-Z0-9_]{3,20}$/
    };

    function showError(input, message) {
        const existingError = input.nextElementSibling;
        if (!existingError || !existingError.classList.contains('error-message')) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message text-danger small mt-1';
            errorDiv.textContent = message;
            input.parentNode.insertBefore(errorDiv, input.nextElementSibling);
        } else {
            existingError.textContent = message;
        }
        input.classList.add('is-invalid');
    }

    function clearError(input) {
        const errorDiv = input.nextElementSibling;
        if (errorDiv && errorDiv.classList.contains('error-message')) {
            errorDiv.remove();
        }
        input.classList.remove('is-invalid');
    }

    const validateField = {
        name: (input) => {
            const val = input.value.trim();
            if (!val) {
                showError(input, 'Name is required');
                return false;
            }
            if (!patterns.name.test(val)) {
                showError(input, 'Only letters allowed');
                return false;
            }
            clearError(input);
            return true;
        },
        username: (input) => {
            const val = input.value.trim();
            if (!val) {
                showError(input, 'Username is required');
                return false;
            }
            if (!patterns.username.test(val)) {
                showError(input, 'Only 3–20 letters, numbers, _ allowed');
                return false;
            }
            clearError(input);
            return true;
        },
        password: (input) => {
            const val = input.value.trim();
            if (!val) {
                showError(input, 'Password is required');
                return false;
            }
            if (val.length < 8) {
                showError(input, 'Min 8 characters');
                return false;
            }
            clearError(input);
            return true;
        },
        gender: (input) => {
            if (!input.value) {
                showError(input, 'Select gender');
                return false;
            }
            clearError(input);
            return true;
        },
        dob: (input) => {
            if (!input.value) {
                showError(input, 'Date of birth is required');
                return false;
            }
            clearError(input);
            return true;
        },
        cnic: (input) => {
            const value = input.value.trim();

            // 1. Check if empty
            if (value === '') {
                showError(input, 'CNIC is required');
                return false;
            }

            // 2. Check if only digits
            if (!/^\d+$/.test(value)) {
                showError(input, 'Only numbers are allowed');
                return false;
            }

            // 3. Check if exactly 13 digits
            if (value.length !== 13) {
                showError(input, 'CNIC must be exactly 13 digits');
                return false;
            }

            // All good
            clearError(input);
            return true;
        },
        contact: (input) => {
            const value = input.value.trim();

            if (!value) {
                showError(input, 'Contact number is required');
                return false;
            }

            if (!/^\d+$/.test(value)) {
                showError(input, 'Only numbers are allowed');
                return false;
            }

            if (value.length !== 11) {
                showError(input, 'Must be exactly 11 digits');
                return false;
            }

            clearError(input);
            return true;
        },
        email: (input) => {
            const val = input.value.trim();
            if (!val) {
                showError(input, 'Email is required');
                return false;
            }
            if (!patterns.email.test(val)) {
                showError(input, 'Invalid email');
                return false;
            }
            clearError(input);
            return true;
        },
        required: (input, fieldName = 'This field') => {
            if (!input.value.trim()) {
                showError(input, `${fieldName} is required`);
                return false;
            }
            clearError(input);
            return true;
        },
        file: (input, fieldName = 'File') => {
            if (!input.value) {
                showError(input, `${fieldName} is required`);
                return false;
            }
            clearError(input);
            return true;
        }
    };

    // Attach live validation
    for (const [key, input] of Object.entries(inputs)) {
        input.addEventListener('input', () => {
            switch (key) {
                case 'fullName':
                    validateField.name(input);
                    break;
                case 'username':
                    validateField.username(input);
                    break;
                case 'password':
                    validateField.password(input);
                    break;
                case 'gender':
                    validateField.gender(input);
                    break;
                case 'dob':
                    validateField.dob(input);
                    break;
                case 'cnic':
                    validateField.cnic(input);
                    break;
                case 'contact':
                    validateField.contact(input);
                    break;
                case 'email':
                    validateField.email(input);
                    break;
                case 'address':
                case 'qualification':
                    validateField.required(input);
                    break;
                case 'cnicPic':
                case 'pic':
                case 'cv':
                    validateField.file(input);
                    break;
            }
        });

        if (input.tagName === 'SELECT' || input.type === 'file') {
            input.addEventListener('change', () => {
                input.dispatchEvent(new Event('input'));
            });
        }
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const validations = [
            validateField.name(inputs.fullName),
            validateField.username(inputs.username),
            validateField.password(inputs.password),
            validateField.gender(inputs.gender),
            validateField.dob(inputs.dob),
            validateField.cnic(inputs.cnic),
            validateField.contact(inputs.contact),
            validateField.email(inputs.email),
            validateField.required(inputs.address, 'Address'),
            validateField.file(inputs.cnicPic, 'CNIC Picture'),
            validateField.file(inputs.pic, 'Teacher Picture'),
            validateField.required(inputs.qualification, 'Qualification'),
            validateField.file(inputs.cv, 'CV')
        ];

        if (validations.every(Boolean)) {
            form.submit();
        }
    });
});


//View Teacher Data

$(document).on("click", ".viewbtn", function () {
    const btn = $(this);
    // Set student data
    $("#viewTId").text(btn.data("id"));
    $("#viewFullName").text(btn.data("fullname"));
    $("#viewTUname").text(btn.data("tuname"));
    $("#viewTPassword").text(btn.data("tupassword"));
    $("#viewTGender").text(btn.data("tgender"));
    $("#viewTContact").text(btn.data("tcontact"));
    $("#viewTAddress").text(btn.data("taddress"));
    $("#viewTEmail").text(btn.data("temail"));
    $("#viewTCnic").text(btn.data("tcnic"));
    $("#viewTDob").text(btn.data("tbod"));
    $("#viewTqualificaion").text(btn.data("tqualification"));
    $("#viewStatus").text(btn.data("tstatus"));
    $("#viewTPicture").attr("src", btn.data("tpicture"));   
  });



//Courses Form Validation

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('addCourseForm');
    const inputs = {
        // courseId is optional
        courseCode: document.getElementById('coursecode'),
        courseName: document.getElementById('courseName'),
        instructor: document.getElementById('instructor'),
        description: document.getElementById('description'),
        duration: document.getElementById('duration'),
        courseOutline: document.getElementById('course_outline')
    };

    function showError(input, message) {
        const existingError = input.nextElementSibling;
        if (!existingError || !existingError.classList.contains('error-message')) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message text-danger small mt-1';
            errorDiv.textContent = message;
            input.parentNode.insertBefore(errorDiv, input.nextElementSibling);
        } else {
            existingError.textContent = message;
        }
        input.classList.add('is-invalid');
    }

    function clearError(input) {
        const errorDiv = input.nextElementSibling;
        if (errorDiv && errorDiv.classList.contains('error-message')) {
            errorDiv.remove();
        }
        input.classList.remove('is-invalid');
    }

    const validateRequired = (input, name = "This field") => {
        if (!input.value.trim()) {
            showError(input, `${name} is required`);
            return false;
        }
        clearError(input);
        return true;
    };

    const validatePDF = (input) => {
        const file = input.files[0];
        if (!file) {
            showError(input, `Course outline is required`);
            return false;
        }
        if (!file.name.toLowerCase().endsWith('.pdf')) {
            showError(input, `Only PDF files are allowed`);
            return false;
        }
        clearError(input);
        return true;
    };

    // Attach live validation
    for (const [key, input] of Object.entries(inputs)) {
        if (input.type === 'file') {
            input.addEventListener('change', () => {
                validatePDF(input);
            });
        } else if (input.tagName === 'SELECT') {
            input.addEventListener('change', () => {
                validateRequired(input, input.previousElementSibling?.textContent || key);
            });
        } else {
            input.addEventListener('input', () => {
                validateRequired(input, input.previousElementSibling?.textContent || key);
            });
        }
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const validations = [
            validateRequired(inputs.courseCode, "Course Code"),
            validateRequired(inputs.courseName, "Course Name"),
            validateRequired(inputs.instructor, "Teacher"),
            validateRequired(inputs.description, "Description"),
            validateRequired(inputs.duration, "Duration"),
            validatePDF(inputs.courseOutline)
        ];

        if (validations.every(Boolean)) {
            form.submit();
        }
    });
});

//Filter and Search of Teachers Table

  document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("searchInput");
        const statusFilter = document.getElementById("statusFilter");
        const tableRows = document.querySelectorAll("#teacherTable tr");

        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedStatus = statusFilter.value.toLowerCase();

            tableRows.forEach(row => {
                const fullName = row.cells[1]?.textContent.toLowerCase();
                const username = row.cells[2]?.textContent.toLowerCase();
                const status = row.cells[7]?.textContent.toLowerCase();

                const matchesSearch = fullName.includes(searchTerm) || username.includes(searchTerm);
                const matchesStatus = selectedStatus === "all" || status === selectedStatus;

                if (matchesSearch && matchesStatus) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

        searchInput.addEventListener("input", filterTable);
        statusFilter.addEventListener("change", filterTable);
    });