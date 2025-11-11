<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">User Profile</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <i class="fas fa-user-circle fa-5x text-primary mb-3"></i>
                        </div>
                        <div class="col-md-8">
                            <h5>Profile Information</h5>
                            <hr>
                            <div class="mb-3">
                                <strong>Name:</strong> 
                                <?php echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'Not available'; ?>
                            </div>
                            <div class="mb-3">
                                <strong>Email:</strong> 
                                <?php echo isset($_SESSION['user_email']) ? htmlspecialchars($_SESSION['user_email']) : 'Not available'; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <a href="<?php echo URLROOT; ?>/posts" class="btn btn-primary me-2">
                            <i class="fas fa-globe me-1"></i>All Posts
                        </a>
                        <a href="<?php echo URLROOT; ?>/users/logout" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>