<!-- This file contains the form for editing an existing post. -->

<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h3 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Edit Post
                    </h3>
                </div>
                <div class="card-body">
                    <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" method="POST">
                        <div class="mb-3">
                            <label for="title" class="form-label">
                                <i class="fas fa-heading me-1"></i>Post Title
                            </label>
                            <input type="text" 
                                   name="title" 
                                   id="title"
                                   class="form-control" 
                                   value="<?php echo htmlspecialchars($data['post']->title); ?>" 
                                   placeholder="Enter an engaging title for your post..."
                                   required>
                            <div class="form-text">Update your post title to better reflect the content.</div>
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
                                      required><?php echo htmlspecialchars($data['post']->message ?? ''); ?></textarea>
                            <div class="form-text">Make your updates clear and engaging for your team.</div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="<?php echo URLROOT; ?>/posts" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-1"></i>Update Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Post Info -->
            <div class="card mt-4">
                <div class="card-body">
                    <h6 class="card-title">
                        <i class="fas fa-info-circle text-info me-2"></i>Post Information
                    </h6>
                    <div class="row text-sm">
                        <div class="col-md-6">
                            <strong>Created:</strong> 
                            <span class="text-muted">
                                <?php echo isset($data['post']->created_at) ? date('M d, Y \a\t g:i A', strtotime($data['post']->created_at)) : 'Unknown'; ?>
                            </span>
                        </div>
                        <div class="col-md-6">
                            <strong>Last Updated:</strong> 
                            <span class="text-muted">
                                <?php echo isset($data['post']->updated_at) ? date('M d, Y \a\t g:i A', strtotime($data['post']->updated_at)) : 'Never'; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>