<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - LMS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <style>
        /* General Body and Container Background */
        body {
            background-color: #F0F2F5; /* Light grey background */
            font-family: 'Open Sans', sans-serif; /* Example font */
            overflow-x: hidden; /* Prevent horizontal scroll */
        }

        .container-fluid {
            padding: 0; /* Remove default padding */
        }

        /* Navbar Enhancements */
        .navbar {
            background-color: #FFFFFF !important; /* White navbar */
            box-shadow: 0 2px 4px rgba(0,0,0,.08); /* Subtle shadow */
            padding: 10px 20px;
            z-index: 1000; /* Ensure navbar is on top */
            position: sticky;
            top: 0;
            width: 100%;
        }

        .navbar-brand {
            color: #343A40 !important; /* Darker brand text */
            font-weight: 700; /* Bold */
            font-size: 1.5rem;
            font-family: 'Poppins', sans-serif; /* Use Poppins for brand */
        }

        .navbar-nav .nav-link {
            color: #555 !important; /* Lighter link color */
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #007bff !important; /* Hover color */
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 8px rgba(0,0,0,.1);
            border-radius: 0.5rem;
            min-width: 12rem;
            padding: 0.5rem 0;
        }

        .dropdown-item {
            padding: 0.75rem 1.5rem;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: #e9ecef; /* Light grey hover */
            color: #007bff; /* Primary blue on hover */
        }

        .dropdown-item i {
            width: 20px; /* Align icons */
        }

        /* Sidebar Enhancements */
        .sidebar {
            background-color: #2C3E50; /* Deeper, more modern dark blue */
            min-height: calc(100vh - 76px); /* Adjust height relative to navbar */
            padding-top: 30px;
            box-shadow: 2px 0 5px rgba(0,0,0,.1);
            position: sticky;
            top: 76px; /* Position below navbar */
            height: 100%;
            transition: width 0.3s ease; /* Smooth collapse transition */
        }

        .sidebar.collapsed {
            width: 80px; /* Collapsed width */
        }

        .sidebar a {
            color: #ECF0F1; /* Light grey for links */
            padding: 15px 25px;
            margin-bottom: 5px;
            border-radius: 0 25px 25px 0; /* Rounded right edges */
            transition: all 0.3s ease;
            display: flex; /* For icon and text alignment */
            align-items: center;
            white-space: nowrap; /* Prevent text wrapping */
            overflow: hidden; /* Hide overflow when collapsed */
        }

        .sidebar.collapsed a {
            padding: 15px 15px; /* Adjust padding for collapsed state */
        }

        .sidebar a:hover, .sidebar a.active {
            background-color: #34495E; /* Slightly lighter on hover/active */
            color: #4CAF50; /* Accent color for active link */
        }

        .sidebar a i {
            margin-right: 15px;
            font-size: 1.1rem;
            transition: margin-right 0.3s ease;
        }

        .sidebar.collapsed a i {
            margin-right: 0;
        }

        .sidebar a span { /* Span for text content */
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed a span {
            opacity: 0;
            width: 0; /* Hide text completely */
        }

        .user-profile {
            border-bottom: 1px solid #34495E;
            padding-bottom: 20px;
            margin-bottom: 20px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding-left: 15px; /* Add padding for alignment */
            padding-right: 15px;
        }

        .sidebar.collapsed .user-profile {
            flex-direction: column;
        }

        .user-profile img {
            border: 2px solid #4CAF50; /* Accent border around profile image */
            margin-bottom: 10px;
            object-fit: cover;
            flex-shrink: 0; /* Prevent shrinking */
        }

        .user-profile div {
            text-align: center;
            transition: opacity 0.3s ease, width 0.3s ease;
        }

        .sidebar.collapsed .user-profile div {
            opacity: 0;
            width: 0;
            height: 0;
            overflow: hidden;
            margin-top: -10px; /* Adjust to hide space */
        }

        .user-profile .font-weight-bold {
            color: #FFFFFF;
            font-size: 1.1rem;
            font-family: 'Poppins', sans-serif;
        }

        .user-profile small {
            color: #BDC3C7;
            font-size: 0.85rem;
        }

        /* Main Content Area */
        .main-content {
            background-color: #F0F2F5; /* Match body background */
            padding: 30px;
            flex-grow: 1; /* Allow main content to take remaining width */
        }

        /* Alert styles */
        .alert {
            border-radius: 0.5rem;
            padding: 1rem 1.5rem;
            font-size: 0.95rem;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #D4EDDA;
            color: #155724;
            border-color: #C3E6CB;
        }

        .alert-danger {
            background-color: #F8D7DA;
            color: #721C24;
            border-color: #F5C6CB;
        }

        /* Dashboard Cards (Example for content) */
        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 4px 12px rgba(0,0,0,.08);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #FFFFFF;
            border-bottom: 1px solid #EEEEEE;
            font-weight: bold;
            color: #343A40;
            padding: 1.25rem 1.5rem;
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
            font-family: 'Poppins', sans-serif;
            font-size: 1.15rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Custom button styles */
        .btn-primary {
            background-color: #4CAF50; /* Green primary button */
            border-color: #4CAF50;
            transition: all 0.3s ease;
            font-weight: 600;
            padding: 0.6rem 1.2rem;
            border-radius: 0.4rem;
        }

        .btn-primary:hover {
            background-color: #45A049;
            border-color: #45A049;
            box-shadow: 0 2px 6px rgba(0,0,0,.15);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -220px; /* Hide sidebar by default */
                width: 220px;
                min-height: 100vh;
                top: 0;
                z-index: 1020; /* Above main content */
                box-shadow: 3px 0 7px rgba(0,0,0,.2);
            }
            .sidebar.active {
                left: 0; /* Show sidebar */
            }
            .main-content {
                margin-left: 0; /* No margin when sidebar is hidden */
            }
            .navbar-toggler {
                display: block; /* Show toggler button */
            }
            .navbar-nav {
                flex-direction: row; /* Keep horizontal in navbar for profile */
            }
            .sidebar.collapsed {
                width: 220px; /* On small screens, collapse to full size on toggle */
            }
            .sidebar.collapsed a span, .sidebar.collapsed .user-profile div {
                opacity: 1; /* Always show text on small screens */
                width: auto;
                height: auto;
            }
            .sidebar.collapsed a i {
                margin-right: 15px; /* Maintain margin */
            }
            .navbar-toggler-icon {
                color: #343A40; /* Make toggler icon visible on white navbar */
            }
            .navbar-dark .navbar-toggler-icon {
                background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='rgba%2852, 58, 64, 0.8%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            }
        }
        @media (min-width: 769px) {
            .navbar-toggler {
                display: none; /* Hide toggler on larger screens */
            }
            .row {
                flex-wrap: nowrap; /* Prevent wrapping for sidebar and content */
            }
        }

        /* Alert Styles */
        .custom-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            max-width: 100%;
            transform: translateX(150%);
            transition: transform 0.3s ease-in-out;
        }

        .custom-alert.show {
            transform: translateX(0);
        }

        .custom-alert .progress {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
        }

        .custom-alert .progress-bar {
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.3);
            transition: width linear 3s;
        }

        .custom-alert.show .progress-bar {
            width: 0%;
        }

        .alert-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        /* Add animation for fade out */
        @keyframes slideOutRight {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(150%);
            }
        }

        .custom-alert.hide {
            animation: slideOutRight 0.3s ease-in-out forwards;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light"> <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo base_url('dashboard'); ?>">LMS</a>
            <button class="navbar-toggler" type="button" id="sidebarToggle">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $user->first_name . ' ' . $user->last_name; ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo base_url('dashboard/profile'); ?>">
                                <i class="fas fa-user-circle mr-2"></i> My Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar" id="sidebar">
                <div class="user-profile">
                    <?php
                    $profile_image = isset($user->profile_image) && $user->profile_image
                        ? base_url('uploads/profile_images/' . $user->profile_image)
                        : 'https://via.placeholder.com/50/4CAF50/FFFFFF?text=' . substr($user->first_name, 0, 1);
                    ?>
                    <img src="<?php echo $profile_image; ?>" alt="Profile" style="width: 70px; height: 70px; border-radius: 50%;">
                    <div>
                        <div class="font-weight-bold"><?php echo $user->first_name; ?></div>
                        <small><?php echo ucfirst($user->role); ?></small>
                    </div>
                </div>
                <a href="<?php echo base_url('dashboard'); ?>" class="<?php echo $active_menu == 'dashboard' ? 'active' : ''; ?>">
                    <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
                </a>
                <a href="<?php echo base_url('dashboard/courses'); ?>" class="<?php echo $active_menu == 'courses' ? 'active' : ''; ?>">
                    <i class="fas fa-book"></i> <span>My Courses</span>
                </a>
                <a href="<?php echo base_url('dashboard/assignments'); ?>" class="<?php echo $active_menu == 'assignments' ? 'active' : ''; ?>">
                    <i class="fas fa-tasks"></i> <span>Assignments</span>
                </a>
                <a href="<?php echo base_url('dashboard/grades'); ?>" class="<?php echo $active_menu == 'grades' ? 'active' : ''; ?>">
                    <i class="fas fa-chart-line"></i> <span>Grades</span>
                </a>
                <a href="<?php echo base_url('dashboard/profile'); ?>" class="<?php echo $active_menu == 'profile' ? 'active' : ''; ?>">
                    <i class="fas fa-user-circle"></i> <span>Profile</span>
                </a>
            </div>

            <div class="col-md-10 main-content">
                <?php echo $content; ?>
            </div>
        </div>
    </div>

    <div class="alert-container"></div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Sidebar toggle for smaller screens
            $('#sidebarToggle').on('click', function() {
                $('#sidebar').toggleClass('active');
            });

            // Optional: Collapse sidebar on larger screens if desired
            // You might want a separate button for this on desktop
            // Example: A button to toggle 'collapsed' class on sidebar
            // $('#collapseSidebarBtn').on('click', function() {
            //     $('#sidebar').toggleClass('collapsed');
            //     $('.main-content').toggleClass('col-md-12 col-md-10'); // Adjust main content width
            // });

            // Close sidebar when clicking outside on small screens
            $(document).on('click', function(event) {
                if ($(window).width() <= 768) {
                    if (!$(event.target).closest('#sidebar').length && !$(event.target).closest('#sidebarToggle').length && $('#sidebar').hasClass('active')) {
                        $('#sidebar').removeClass('active');
                    }
                }
            });

            // Add placeholder image logic for user profile if not set
            <?php if (!isset($user->profile_image) || !$user->profile_image): ?>
                var firstNameInitial = "<?php echo substr($user->first_name, 0, 1); ?>";
                $('.user-profile img').attr('src', 'https://via.placeholder.com/70/4CAF50/FFFFFF?text=' + firstNameInitial);
            <?php endif; ?>

            // Form validation with toast notifications
            $('#profileForm').on('submit', function(e) {
                var firstName = $('#first_name').val().trim();
                var lastName = $('#last_name').val().trim();
                
                if (!firstName || !lastName) {
                    e.preventDefault();
                    showAlert('Please fill in all required fields.', 'danger');
                    return false;
                }
            });

            // Password form validation
            $('#passwordForm').on('submit', function(e) {
                var currentPassword = $('#current_password').val();
                var newPassword = $('#new_password').val();
                var confirmPassword = $('#confirm_password').val();
                
                if (!currentPassword || !newPassword || !confirmPassword) {
                    e.preventDefault();
                    showAlert('Please fill in all password fields.', 'danger');
                    return false;
                }
                
                if (newPassword !== confirmPassword) {
                    e.preventDefault();
                    showAlert('New passwords do not match.', 'danger');
                    return false;
                }
            });
        });

        // Alert System
        class AlertSystem {
            constructor() {
                this.container = document.querySelector('.alert-container');
                this.alerts = new Map();
                this.counter = 0;
            }

            show(message, type = 'success', duration = 3000) {
                const id = this.counter++;
                const alert = this.createAlert(message, type, id);
                this.alerts.set(id, alert);
                this.container.appendChild(alert);

                // Trigger reflow to enable animation
                alert.offsetHeight;
                alert.classList.add('show');

                // Set timeout for auto-close
                setTimeout(() => this.hide(id), duration);

                return id;
            }

            hide(id) {
                const alert = this.alerts.get(id);
                if (alert) {
                    alert.classList.add('hide');
                    alert.addEventListener('animationend', () => {
                        alert.remove();
                        this.alerts.delete(id);
                    });
                }
            }

            createAlert(message, type, id) {
                const alert = document.createElement('div');
                alert.className = `custom-alert alert alert-${type}`;
                alert.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center">
                        <span>${message}</span>
                        <button type="button" class="close" onclick="alertSystem.hide(${id})">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>
                `;
                return alert;
            }
        }

        // Initialize the alert system
        const alertSystem = new AlertSystem();

        // Function to show alerts from PHP flash data with delays
        function showFlashMessages() {
            const messages = [];
            
            <?php 
            // Collect and clear flash messages
            $flash_types = ['success', 'error', 'warning', 'info'];
            foreach ($flash_types as $type): 
                if ($msg = $this->session->flashdata($type)): 
                    // Convert 'error' type to 'danger' for Bootstrap
                    $alert_type = $type === 'error' ? 'danger' : $type;
            ?>
                messages.push({
                    message: '<?php echo addslashes($msg); ?>',
                    type: '<?php echo $alert_type; ?>'
                });
                <?php 
                // Immediately unset the flash message
                $this->session->unset_userdata($type);
                endif;
            endforeach; 
            ?>

            // Show messages with delay
            messages.forEach((msg, index) => {
                setTimeout(() => {
                    alertSystem.show(msg.message, msg.type);
                }, index * 500); // 500ms delay between each message
            });
        }

        // Only show flash messages once when page loads
        let messagesShown = false;
        document.addEventListener('DOMContentLoaded', () => {
            if (!messagesShown) {
                showFlashMessages();
                messagesShown = true;
            }
        });

        // Helper function to show alerts from JavaScript
        function showAlert(message, type = 'success') {
            alertSystem.show(message, type);
        }
    </script>
</body>
</html>