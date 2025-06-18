<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Teacher Dashboard</h1>
        <a href="<?php echo base_url('teacher/create_course'); ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus fa-sm"></i> Create New Course
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="row">
        <!-- Total Courses Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card primary h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Courses</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_courses; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Students Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card success h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Students</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_students; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assignments Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card info h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Assignments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_assignments; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tasks fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Submissions Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card warning h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Submissions</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $pending_submissions; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Recent Submissions -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Submissions</h6>
                </div>
                <div class="card-body">
                    <?php if (!empty($recent_submissions)): ?>
                        <div class="list-group">
                            <?php foreach ($recent_submissions as $submission): ?>
                                <a href="<?php echo base_url('teacher/grade_assignment/' . $submission->id); ?>" 
                                   class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1"><?php echo $submission->student_name; ?></h6>
                                        <small><?php echo time_elapsed_string($submission->submitted_at); ?></small>
                                    </div>
                                    <p class="mb-1"><?php echo $submission->assignment_title; ?></p>
                                    <small class="text-muted">Course: <?php echo $submission->course_title; ?></small>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-center text-muted my-3">No recent submissions</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Recent Enrollments -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Enrollments</h6>
                </div>
                <div class="card-body">
                    <?php if (!empty($recent_enrollments)): ?>
                        <div class="list-group">
                            <?php foreach ($recent_enrollments as $enrollment): ?>
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1"><?php echo $enrollment->student_name; ?></h6>
                                        <small><?php echo time_elapsed_string($enrollment->enrolled_at); ?></small>
                                    </div>
                                    <p class="mb-1">Enrolled in: <?php echo $enrollment->course_title; ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-center text-muted my-3">No recent enrollments</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div> 