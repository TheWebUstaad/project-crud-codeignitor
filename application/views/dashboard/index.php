<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Welcome, <?php echo $user->first_name; ?>!</h1>
        <div class="date"><?php echo date('l, F j, Y'); ?></div>
    </div>

    <div class="row">
        <!-- Course Progress -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-1">Courses</h6>
                            <h3 class="mb-0">0</h3>
                        </div>
                        <i class="fas fa-book fa-2x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="<?php echo base_url('dashboard/courses'); ?>" class="text-white stretched-link">View Courses</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>

        <!-- Assignments -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-1">Pending Assignments</h6>
                            <h3 class="mb-0">0</h3>
                        </div>
                        <i class="fas fa-tasks fa-2x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="<?php echo base_url('dashboard/assignments'); ?>" class="text-white stretched-link">View Assignments</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>

        <!-- Grades -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-1">Average Grade</h6>
                            <h3 class="mb-0">N/A</h3>
                        </div>
                        <i class="fas fa-chart-line fa-2x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="<?php echo base_url('dashboard/grades'); ?>" class="text-white stretched-link">View Grades</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>

        <!-- Messages -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-1">Messages</h6>
                            <h3 class="mb-0">0</h3>
                        </div>
                        <i class="fas fa-envelope fa-2x opacity-50"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="<?php echo base_url('dashboard/messages'); ?>" class="text-white stretched-link">View Messages</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Activity</h5>
                </div>
                <div class="card-body">
                    <div class="text-center py-5">
                        <i class="fas fa-clock fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No recent activity to display.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 