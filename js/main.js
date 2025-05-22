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

    // Form validation
    const form = document.getElementById('addStudentForm');
    if (form) {
        const inputs = form.querySelectorAll('input, select');
        
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                validateInput(this);
            });
        });

        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            inputs.forEach(input => {
                if (!validateInput(input)) {
                    isValid = false;
                }
            });

            if (!isValid) {
                e.preventDefault();
            }
        });
    }

    function validateInput(input) {
        const value = input.value.trim();
        const errorElement = input.nextElementSibling;
        
        // Clear previous error
        if (errorElement && errorElement.classList.contains('error-message')) {
            errorElement.remove();
        }
        input.classList.remove('is-invalid');

        // Validation logic
        if (!value) {
            showError(input, 'This field is required');
            return false;
        }

        // Additional validation based on input type
        switch(input.type) {
            case 'email':
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                    showError(input, 'Please enter a valid email address');
                    return false;
                }
                break;
            case 'tel':
                if (!/^\d+$/.test(value)) {
                    showError(input, 'Please enter only numbers');
                    return false;
                }
                break;
            case 'file':
                if (!input.files.length) {
                    showError(input, 'Please select a file');
                    return false;
                }
                break;
        }

        return true;
    }

    function showError(input, message) {
        input.classList.add('is-invalid');
        const error = document.createElement('div');
        error.className = 'error-message';
        error.textContent = message;
        input.parentNode.insertBefore(error, input.nextSibling);
    }
});
// Get current page URL
  const current = window.location.pathname.split("/").pop();
  // Get all nav links
  const navLinks = document.querySelectorAll('.sidebar .nav-link');
  navLinks.forEach(link => {
    const href = link.getAttribute('href');
    if (href === current) {
      link.classList.add('active');
    } else {
      link.classList.remove('active');
    }
  });
// Students
//Student Form
// Form validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('addStudentForm');
    const inputs = {
        name: document.getElementById('studentName'),
        fatherName: document.getElementById('FatherName'),
        contactNo: document.getElementById('contactNo'),
        address: document.getElementById('std_address'),
        email: document.getElementById('std_email'),
        cnic: document.getElementById('std_cnic'),
        dob: document.getElementById('dob'),
        cnicPic: document.getElementById('cnicPic'),
        studentPic: document.getElementById('studentPic')
    };

    // Validation patterns
    const patterns = {
        name: /^[A-Za-z\s]+$/,
        contact: /^\d+$/,
        email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        cnic: /^\d{13}$/
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
            if (!input.value.trim()) {
                showError(input, 'This field is required');
                return false;
            }
            if (!patterns.contact.test(input.value.trim())) {
                showError(input, 'Only numeric digits are allowed');
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
        cnic: (input) => {
            if (!input.value.trim()) {
                showError(input, 'This field is required');
                return false;
            }
            if (!patterns.cnic.test(input.value.trim())) {
                showError(input, 'CNIC must be exactly 13 digits');
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
        }
    };

    // Add input event listeners
    inputs.name.addEventListener('input', () => validateField.name(inputs.name));
    inputs.fatherName.addEventListener('input', () => validateField.name(inputs.fatherName));
    inputs.contactNo.addEventListener('input', () => validateField.contact(inputs.contactNo));
    inputs.address.addEventListener('input', () => validateField.address(inputs.address));
    inputs.email.addEventListener('input', () => validateField.email(inputs.email));
    inputs.cnic.addEventListener('input', () => validateField.cnic(inputs.cnic));
    inputs.dob.addEventListener('input', () => validateField.dob(inputs.dob));
    inputs.cnicPic.addEventListener('input', () => validateField.file(inputs.cnicPic));
    inputs.studentPic.addEventListener('input', () => validateField.file(inputs.studentPic));

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const isNameValid = validateField.name(inputs.name);
        const isFatherNameValid = validateField.name(inputs.fatherName);
        const isContactValid = validateField.contact(inputs.contactNo);
        const isAddressValid = validateField.address(inputs.address);
        const isEmailValid = validateField.email(inputs.email);
        const isCnicValid = validateField.cnic(inputs.cnic);
        const isDobValid = validateField.dob(inputs.dob);
        const isCnicPicValid = validateField.file(inputs.cnicPic);
        const isStudentPicValid = validateField.file(inputs.studentPic);

        if (isNameValid && isFatherNameValid && isContactValid && 
            isAddressValid && isEmailValid && isCnicValid && 
            isDobValid && isCnicPicValid && isStudentPicValid) {
            this.submit();
        }
    });
});
//Pagination
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




