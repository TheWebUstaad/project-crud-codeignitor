<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <!-- Brand/logo -->
                <a class="navbar-brand" href="<?php echo base_url(); ?>">Your Brand</a>
                
                <!-- Toggle button for mobile -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" 
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <!-- Navigation items -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item <?php echo ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'home') ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?php echo base_url(); ?>">Home 
                                <?php echo ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'home') ? '<span class="sr-only">(current)</span>' : ''; ?>
                            </a>
                        </li>
                        <li class="nav-item <?php echo ($this->uri->segment(1) == 'about') ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?php echo base_url('about'); ?>">About
                                <?php echo ($this->uri->segment(1) == 'about') ? '<span class="sr-only">(current)</span>' : ''; ?>
                            </a>
                        </li>
                        <li class="nav-item <?php echo ($this->uri->segment(1) == 'contact') ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?php echo base_url('contact'); ?>">Contact
                                <?php echo ($this->uri->segment(1) == 'contact') ? '<span class="sr-only">(current)</span>' : ''; ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container mt-4">
        <?php 
        // Flash messages
        if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $this->session->flashdata('error'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <?php echo $content; ?>
    </main>

    <!-- Footer -->
    <footer class="bg-light mt-5">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-6">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><a href="<?php echo base_url('about'); ?>">About</a></li>
                        <li><a href="<?php echo base_url('contact'); ?>">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-6 text-right">
                    <p>&copy; <?php echo date('Y'); ?> Your Website. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>