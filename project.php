<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            margin: 20px;
        }
        .dropdown-menu {
            min-width: 300px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Management
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#" onclick="showSection('studentManagement')">Student Management</a>
                        <a class="dropdown-item" href="#" onclick="showSection('teacherManagement')">Teacher Management</a>
                        <a class="dropdown-item" href="#" onclick="showSection('classManagement')">Class Management</a>
                        <a class="dropdown-item" href="#" onclick="showSection('subjectManagement')">Subject Management</a>
                        <a class="dropdown-item" href="#" onclick="showSection('attendanceManagement')">Attendance Management</a>
                        <a class="dropdown-item" href="#" onclick="showSection('examManagement')">Exam & Result Management</a>
                        <a class="dropdown-item" href="#" onclick="showSection('announcements')">Announcements</a>
                        <a class="dropdown-item" href="#" onclick="showSection('assignments')">Assignments & Documents</a>
                        <a class="dropdown-item" href="#" onclick="showSection('reports')">Reports & Analytics</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div id="dashboard" class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Students</h5>
                        <p class="card-text">150</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Total Teachers</h5>
                        <p class="card-text">30</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Total Classes</h5>
                        <p class="card-text">10</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="notifications" class="mt-4">
            <h4>Notifications</h4>
            <ul class="list-group">
                <li class="list-group-item">New student added: John Doe</li>
                <li class="list-group-item">Exam scheduled for next week</li>
            </ul>
        </div>

        <div id="recentActivity" class="mt-4">
            <h4>Recent Activity Feed</h4>
            <ul class="list-group">
                <li class="list-group-item">Teacher Jane Smith updated her profile.</li>
                <li class="list-group-item">Class 5A attendance marked.</li>
            </ul>
        </div>

        <div id="managementSections" class="mt-4"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function showSection(section) {
            const sections = {
                studentManagement: `
                    <h4>Student Management</h4>
                    <button class="btn btn-primary" onclick="alert('Add New Student Form')">Add New Student</button>
                    <button class="btn btn-secondary" onclick="alert('Edit/Delete Student')">Edit/Delete Student</button>
                `,
                teacherManagement: `
                    <h4>Teacher Management</h4>
                    <button class="btn btn-primary" onclick="alert('Add New Teacher')">Add New Teacher</button>
                    <button class="btn btn-secondary" onclick="alert('Edit/Delete Teacher')">Edit/Delete Teacher</button>
                `,
                classManagement: `
                    <h4>Class Management</h4>
                    <button class="btn btn-primary" onclick="alert('Add/Edit/Delete Classes')">Add/Edit/Delete Classes</button>
                `,
                subjectManagement: `
                    <h4>Subject Management</h4>
                    <button class="btn btn-primary" onclick="alert('Add/Edit Subjects')">Add/Edit Subjects</button>
                `,
                attendanceManagement: `
                    <h4>Attendance Management</h4>
                    <button class="btn btn-primary" onclick="alert('View Attendance Records')">View Attendance Records</button>
                `,
                examManagement: `
                    <h4>Exam & Result Management</h4>
                    <button class="btn btn-primary" onclick="alert('Schedule Exams')">Schedule Exams</button>
                `,
                announcements: `
                    <h4>Announcements</h4>
                    <button class="btn btn-primary" onclick="alert('Create New Announcement')">Create New Announcement</button>
                `,
                assignments: `
                    <h4>Assignments & Documents</h4>
                    <button class="btn btn-primary" onclick="alert('Upload Files')">Upload Files</button>
                `,
                reports: `
                    <h4>Reports & Analytics</h4>
                    <button class="btn btn-primary" onclick="alert('Student Attendance Summary')">Student Attendance Summary</button>
                `
            };
            document.getElementById('managementSections').innerHTML = sections[section] || '<h4>Select a management section</h4>';
        }
    </script>
</body>
</html>
