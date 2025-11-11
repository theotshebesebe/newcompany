// filepath: /newcompany/newcompany/public/js/main.js

// This file contains JavaScript for client-side functionality.
// It can be used for form validation, AJAX requests, and other interactive features.

// Example: Function to validate user registration form
function validateRegistrationForm() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;

    if (username === '' || password === '' || confirmPassword === '') {
        alert('All fields are required.');
        return false;
    }

    if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return false;
    }

    return true;
}

// Example: Function to handle AJAX request for loading posts
function loadPosts() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', '/newcompany/posts', true);
    xhr.onload = function() {
        if (this.status === 200) {
            document.getElementById('posts-container').innerHTML = this.responseText;
        } else {
            console.error('Failed to load posts.');
        }
    };
    xhr.send();
}

// Call loadPosts on page load
document.addEventListener('DOMContentLoaded', loadPosts);