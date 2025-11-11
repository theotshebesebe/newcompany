<!-- This file contains the form for creating a new post. -->

<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Add New Post
                    </h3>
                </div>
                <div class="card-body">
                    <form action="<?php echo URLROOT; ?>/posts/store" method="POST">
                        <div class="mb-3">
                            <label for="title" class="form-label">
                                <i class="fas fa-heading me-1"></i>Post Title
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   class="form-control" 
                                   placeholder="Enter an engaging title for your post..."
                                   required>
                            <div class="form-text">Choose a clear and descriptive title for your post.</div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="body" class="form-label">
                                <i class="fas fa-edit me-1"></i>Word of the day
                            </label>
                            <textarea name="body" 
                                      id="body" 
                                      class="form-control" 
                                      rows="8"
                                      placeholder="Share your thoughts, ideas, or the word of the day..."
                                      required></textarea>
                            <div class="form-text">Express your ideas clearly and engage with your team.</div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="<?php echo URLROOT; ?>/posts" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Back to Posts
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-paper-plane me-1"></i>Publish Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Help Section -->
            <div class="card mt-4">
                <div class="card-body">
                    <h6 class="card-title">
                        <i class="fas fa-lightbulb text-warning me-2"></i>Tips for Great Posts
                    </h6>
                    <ul class="mb-0 small text-muted">
                        <li>Write a clear, descriptive title</li>
                        <li>Share valuable insights or updates</li>
                        <li>Keep your content engaging and relevant</li>
                        <li>Use proper grammar and formatting</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>