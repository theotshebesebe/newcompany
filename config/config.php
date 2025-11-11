<?php
/**
 * MY APPLICATION CONFIGURATION
 * 
 * I learned that it's good practice to keep all my app settings in one place.
 * This makes it easier to change things when I deploy to different environments.
 * I'm still figuring out what should go in config vs environment variables.
 */

// ==========================================
// FILE PATHS
// ==========================================

/**
 * This tells my app where to find the important folders
 * I had to use dirname() twice to go up two levels from config/config.php
 */
define('APPROOT', dirname(dirname(__FILE__)) . '/app');

/**
 * This is the base URL for my application
 * I'm using localhost for development, but I'll need to change this for production
 */
define('URLROOT', 'http://localhost/newcompany/public');

// ==========================================
// DATABASE SETTINGS
// ==========================================

/**
 * My database connection info
 * I know these aren't secure for production, but they work for learning locally
 */
define('DB_HOST', 'localhost');     // My XAMPP MySQL server
define('DB_USER', 'root');          // Default MySQL user in XAMPP
define('DB_PASS', '');              // No password set on my local machine
define('DB_NAME', 'newcompany_db'); // The database I created for this project

// ==========================================
// APPLICATION INFO
// ==========================================

/**
 * Basic app information I use throughout the site
 */
define('APP_NAME', 'New Company');                    // Shows up in page titles
define('APP_URL', 'http://localhost/newcompany');     // Base URL without /public

// ==========================================
// SESSION SETUP
// ==========================================

/**
 * I start sessions here so they work everywhere in my app
 * Sessions let me remember that users are logged in as they navigate pages
 * Still learning about session security and best practices
 */
session_start();

// ==========================================
// NOTES FOR FUTURE ME
// ==========================================

/**
 * Things I want to add as I learn more:
 * 
 * - Environment-specific configs (dev vs production)
 * - Email settings for user registration
 * - File upload limits and paths
 * - Security keys for encryption
 * - Error logging configuration
 * - Database connection pooling
 */

?>