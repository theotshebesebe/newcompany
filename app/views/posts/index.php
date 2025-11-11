<!-- 
MY POSTS DISPLAY PAGE

I'm trying to create a nice-looking page that shows all posts from everyone.
I'm still learning how to mix PHP with HTML properly, but I think this approach works.
I'm using Bootstrap for styling because I'm not great at CSS yet.
-->

<?php 
// I include the header on every page - still figuring out if this is the best way to do templates
require APPROOT . '/views/inc/header.php'; 
?>

<!-- I'm using Bootstrap's container system - copied this structure from examples online -->
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            
            <!-- Page header with title and add button -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-lightbulb me-2 text-primary"></i>Word of the day</h2>
                
                <!-- I only show this button to logged-in users -->
                <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-success">
                    <i class="fas fa-plus me-1"></i>Add New Post
                </a>
            </div>

            <?php 
            // I check if there are any posts to display
            // Learning: empty() works on arrays - if $posts is empty or doesn't exist
            if (empty($posts)): 
            ?>
                
                <!-- What I show when there are no posts -->
                <div class="card text-center">
                    <div class="card-body py-5">
                        <!-- Font Awesome icon - I'm still learning which icons to use when -->
                        <i class="fas fa-file-alt fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">No Posts Yet</h4>
                        <p class="text-muted mb-4">No one has created any posts yet. Be the first to share your thoughts!</p>
                        
                        <!-- Call-to-action button -->
                        <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Create The First Post
                        </a>
                    </div>
                </div>
                
            <?php else: ?>
                
                <!-- The main posts display area -->
                <div class="row">
                    <?php 
                    // I loop through each post and create a card for it
                    // Still getting comfortable with foreach loops in HTML
                    foreach ($posts as $post): 
                    ?>
                        
                        <!-- Each post gets its own card -->
                        <!-- I'm using responsive columns: 3 cards on large screens, 2 on medium, 1 on small -->
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                
                                <!-- Card header with the post title -->
                                <div class="card-header bg-primary text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-quote-left me-2"></i>
                                        <!-- I use htmlspecialchars() because I learned about XSS attacks -->
                                        <?php echo htmlspecialchars($post['title']); ?>
                                    </h5>
                                </div>
                                
                                <!-- The main content of the post -->
                                <div class="card-body">
                                    <!-- I truncate long messages so cards stay the same height -->
                                    <p class="card-text">
                                        <?php 
                                        // My attempt at smart text truncation
                                        $message = htmlspecialchars($post['message'] ?? 'No content available');
                                        // If longer than 150 chars, cut it short and add dots
                                        echo strlen($message) > 150 ? substr($message, 0, 150) . '...' : $message; 
                                        ?>
                                    </p>
                                    
                                    <!-- Show who wrote it and when -->
                                    <div class="d-flex align-items-center text-muted small">
                                        <i class="fas fa-user me-1"></i>
                                        <span class="me-3"><?php echo htmlspecialchars($post['name']); ?></span>
                                        <i class="fas fa-calendar me-1"></i>
                                        <!-- I format the date to be more readable -->
                                        <span><?php echo date('M d, Y', strtotime($post['created_at'])); ?></span>
                                    </div>
                                </div>
                                
                                <!-- Card footer with action buttons -->
                                <div class="card-footer bg-transparent">
                                    <?php 
                                    // I show edit/delete buttons if the current user owns this post OR if user is admin
                                    // This is my attempt at permission checking with admin support
                                    $canEdit = ($post['user_id'] == $current_user_id) || ($is_admin == 1);
                                    if ($canEdit): 
                                    ?>
                                        
                                        <!-- Buttons for the post owner or admin -->
                                        <div class="btn-group w-100" role="group">
                                            <!-- Edit button -->
                                            <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $post['id']; ?>" 
                                               class="btn btn-outline-warning btn-sm">
                                                <i class="fas fa-edit me-1"></i>Edit
                                                <?php if ($is_admin == 1 && $post['user_id'] != $current_user_id): ?>
                                                    <span class="badge bg-danger ms-1">Admin</span>
                                                <?php endif; ?>
                                            </a>
                                            
                                            <!-- Delete button with confirmation -->
                                            <!-- I added a JavaScript confirm dialog for safety -->
                                            <a href="<?php echo URLROOT; ?>/posts/delete/<?php echo $post['id']; ?>" 
                                               class="btn btn-outline-danger btn-sm"
                                               onclick="return confirm('Are you sure you want to delete this post?')">
                                                <i class="fas fa-trash me-1"></i>Delete
                                                <?php if ($is_admin == 1 && $post['user_id'] != $current_user_id): ?>
                                                    <span class="badge bg-danger ms-1">Admin</span>
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                        
                                    <?php else: ?>
                                        
                                        <!-- For posts by other users (when user is not admin), just show the author -->
                                        <div class="text-center">
                                            <span class="btn btn-outline-secondary btn-sm disabled">
                                                <i class="fas fa-user me-1"></i>By <?php echo htmlspecialchars($post['name']); ?>
                                            </span>
                                        </div>
                                        
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                    <?php endforeach; // End of the posts loop ?>
                </div>
                
            <?php endif; // End of the empty check ?>
        </div>
    </div>
</div>

<?php 
// Include the footer - this closes HTML tags and adds JavaScript
require APPROOT . '/views/inc/footer.php'; 
?>