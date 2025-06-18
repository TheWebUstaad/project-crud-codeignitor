<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - LMS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .register-container {
            margin-top: 5%;
            max-width: 500px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #fff;
            border-bottom: none;
            text-align: center;
            padding: 20px;
        }
        .card-body {
            padding: 30px;
        }
        .password-strength-meter {
            height: 5px;
            background-color: #eee;
            margin-top: 5px;
            border-radius: 3px;
            transition: all 0.3s ease;
        }
        
        .password-strength-text {
            font-size: 0.875rem;
            margin-top: 5px;
        }

        .password-suggestions {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container register-container">
        <div class="card">
            <div class="card-header">
                <h4>Register for LMS</h4>
            </div>
            <div class="card-body">
                <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <?php echo form_open('auth/register'); ?>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username'); ?>">
                        <?php echo form_error('username', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>">
                        <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo set_value('first_name'); ?>">
                                <?php echo form_error('first_name', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo set_value('last_name'); ?>">
                                <?php echo form_error('last_name', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class="password-strength-meter"></div>
                        <div class="password-strength-text"></div>
                        <div class="password-suggestions"></div>
                        <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        <?php echo form_error('confirm_password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                <?php echo form_close(); ?>
                
                <div class="text-center mt-3">
                    <p>Already have an account? <a href="<?php echo base_url('auth/login'); ?>">Login here</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/js/password-strength.js'); ?>"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const meterBar = document.querySelector('.password-strength-meter');
        const strengthText = document.querySelector('.password-strength-text');
        const suggestionsDiv = document.querySelector('.password-suggestions');

        passwordInput.addEventListener('input', function() {
            const result = checkPasswordStrength(this.value);
            
            // Update meter
            meterBar.style.width = (result.strength * 20) + '%';
            meterBar.style.backgroundColor = result.color;
            
            // Update strength text
            strengthText.textContent = 'Password Strength: ' + result.message;
            strengthText.style.color = result.color;
            
            // Update suggestions
            suggestionsDiv.innerHTML = result.suggestions.length ? 
                'Suggestions: ' + result.suggestions.join(', ') : '';
        });
    });
    </script>
</body>
</html>