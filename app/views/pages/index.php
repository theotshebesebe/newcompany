<!-- 
This is the home page view for the newcompany application. 
It includes a welcome message and links to other parts of the application.
-->

<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container mt-4">
    <div class="jumbotron bg-light p-5 rounded">
        <div class="text-center">
            <h1 class="display-4">Welcome to New Company</h1>
            <p class="lead">Your one-stop solution for managing your posts!</p>
            <hr class="my-4">
            <p>Register or log in to start creating and managing your posts.</p>
            <?php if(!isset($_SESSION['user_id'])): ?>
                <a class="btn btn-primary btn-lg me-2" href="<?php echo URLROOT; ?>/users/register" role="button">
                    <i class="fas fa-user-plus me-2"></i>Get Started
                </a>
                <a class="btn btn-outline-secondary btn-lg" href="<?php echo URLROOT; ?>/users/login" role="button">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </a>
            <?php else: ?>
                <a class="btn btn-primary btn-lg" href="<?php echo URLROOT; ?>/posts" role="button">
                    <i class="fas fa-newspaper me-2"></i>View All Posts
                </a>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Team Collaboration</h5>
                    <p class="card-text">Share your thoughts and ideas with your team members through our posting system.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-shield-alt fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Secure Platform</h5>
                    <p class="card-text">Your data is protected with secure authentication and user-specific content management.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-edit fa-3x text-info mb-3"></i>
                    <h5 class="card-title">Easy Management</h5>
                    <p class="card-text">Create, edit, and delete your posts with our intuitive and user-friendly interface.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>