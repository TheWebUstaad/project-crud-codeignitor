<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <?php 
                    $profile_image = isset($user->profile_image) && $user->profile_image 
                        ? base_url('uploads/profile_images/' . $user->profile_image) 
                        : 'https://via.placeholder.com/150';
                    ?>
                    <img src="<?php echo $profile_image; ?>" alt="Profile" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <h4><?php echo $user->first_name . ' ' . $user->last_name; ?></h4>
                    <p class="text-muted"><?php echo ucfirst($user->role); ?></p>
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateProfileImage">
                        <i class="fas fa-camera mr-1"></i> Change Photo
                    </button>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Profile Information</h5>
                </div>
                <div class="card-body">
                    <?php echo form_open('dashboard/update_profile', ['id' => 'profileForm']); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" 
                                           value="<?php echo set_value('first_name', $user->first_name); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" 
                                           value="<?php echo set_value('last_name', $user->last_name); ?>" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" value="<?php echo $user->email; ?>" readonly>
                            <small class="text-muted">Email cannot be changed</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" value="<?php echo $user->username; ?>" readonly>
                            <small class="text-muted">Username cannot be changed</small>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Update Profile
                        </button>
                    <?php echo form_close(); ?>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Change Password</h5>
                </div>
                <div class="card-body">
                    <?php echo form_open('dashboard/change_password', ['id' => 'passwordForm']); ?>
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                            <div class="password-strength-meter"></div>
                            <div class="password-strength-text"></div>
                            <div class="password-suggestions"></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="confirm_password">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-key mr-1"></i> Change Password
                        </button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Image Update Modal -->
<div class="modal fade" id="updateProfileImage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Profile Picture</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open_multipart('dashboard/update_profile_image'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>Select Image</label>
                    <input type="file" class="form-control-file" name="profile_image" accept="image/*" required>
                    <small class="text-muted">
                        Maximum file size: 2MB<br>
                        Allowed formats: JPG, JPEG, PNG, GIF
                    </small>
                </div>
                <div id="imagePreview" class="mt-3 text-center" style="display: none;">
                    <img src="" alt="Preview" style="max-width: 200px; max-height: 200px;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!-- Add this JavaScript at the bottom of your file -->
<script>
$(document).ready(function() {
    // Auto-hide alerts after 5 seconds
    $('.alert').delay(5000).fadeOut('slow');
    
    // Form validation
    $('#profileForm').on('submit', function(e) {
        var firstName = $('#first_name').val().trim();
        var lastName = $('#last_name').val().trim();
        
        if (!firstName || !lastName) {
            e.preventDefault();
            alert('Please fill in all required fields.');
            return false;
        }
    });
});
</script>

<!-- Add this to your JavaScript section -->
<script src="<?php echo base_url('assets/js/password-strength.js'); ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('new_password');
    const meterBar = document.querySelector('.password-strength-meter');
    const strengthText = document.querySelector('.password-strength-text');
    const suggestionsDiv = document.querySelector('.password-suggestions');
    const confirmInput = document.getElementById('confirm_password');

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

    // Add password match validation
    confirmInput.addEventListener('input', function() {
        if (this.value !== passwordInput.value) {
            this.setCustomValidity('Passwords do not match');
        } else {
            this.setCustomValidity('');
        }
    });

    passwordInput.addEventListener('change', function() {
        if (confirmInput.value) {
            confirmInput.dispatchEvent(new Event('input'));
        }
    });
});
</script> 