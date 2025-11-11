<!-- This file contains the registration form for new users. -->

<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Register</h2>
                </div>
                <div class="card-body">
                    <form action="<?php echo URLROOT; ?>/users/registerUser" method="post">
                        <div class="form-group mb-3">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password:</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                    <p class="text-center mt-3">Already have an account? <a href="<?php echo URLROOT; ?>/users/login">Login here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>