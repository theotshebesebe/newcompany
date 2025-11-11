<!-- 
MY ABOUT PAGE

I'm trying to create an about page that matches the styling of my home page.
I want to use similar Bootstrap components and layout structure for consistency.
-->

<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container mt-4">
    <!-- Hero section similar to home page -->
    <div class="jumbotron bg-light p-5 rounded">
        <div class="text-center">
            <h1 class="display-4">About New Company</h1>
            <p class="lead">Learn more about our mission and what we do!</p>
            <hr class="my-4">
            <p>We're dedicated to providing the best collaboration platform for teams.</p>
        </div>
    </div>
    
    <!-- Content sections with cards like home page -->
    <div class="row mt-5">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-building fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Our Company</h5>
                    <p class="card-text">We are dedicated to providing the best services to our clients with innovative solutions and exceptional customer service.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-bullseye fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Our Mission</h5>
                    <p class="card-text">Our mission is to deliver high-quality products and create a platform where teams can collaborate effectively and share ideas.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-heart fa-3x text-danger mb-3"></i>
                    <h5 class="card-title">Our Values</h5>
                    <p class="card-text">We believe in transparency, innovation, and putting our users first. Thank you for visiting our about page!</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>