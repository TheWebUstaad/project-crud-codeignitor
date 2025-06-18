<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Contact Us</h1>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h3>Send us a message</h3>
            <?php echo form_open('pages/submit_contact'); ?>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            <?php echo form_close(); ?>
        </div>
        
        <div class="col-md-6">
            <h3>Contact Information</h3>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Our Office</h5>
                    <p class="card-text">
                        <strong>Address:</strong><br>
                        Your Company Name<br>
                        123 Street Name<br>
                        City, State ZIP<br><br>
                        <strong>Phone:</strong> (123) 456-7890<br>
                        <strong>Email:</strong> info@yourcompany.com<br>
                        <strong>Hours:</strong> Monday - Friday: 9:00 AM - 5:00 PM
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>