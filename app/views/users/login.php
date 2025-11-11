<!-- This file contains the login form for users. -->

<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Login</h2>
                </div>
                <div class="card-body">
                    <form action="<?php echo URLROOT; ?>/users/loginUser" method="post">
                        <div class="form-group mb-3">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                    <p class="text-center mt-3">Don't have an account? <a href="<?php echo URLROOT; ?>/users/register">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>