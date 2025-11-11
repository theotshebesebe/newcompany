# My PHP CRUD Project - Learning Portfolio

## 📋 **Project Overview**

This is my attempt at building a full-featured CRUD (Create, Read, Update, Delete) application from scratch using PHP and MySQL. I wanted to understand the fundamentals before jumping into frameworks like Laravel or CodeIgniter.

## 🎯 **What I Built**

A simple company bulletin board system where employees can:
- Register accounts and log in securely
- Create and share posts with colleagues
- Edit and delete their own posts
- View posts from all team members

## 🛠️ **Technologies I Used**

- **PHP 8+** - Server-side logic (still getting comfortable with OOP concepts)
- **MySQL** - Database storage (learning about relationships and joins)
- **Bootstrap 5** - Frontend styling (because my CSS skills need work)
- **PDO** - Database connections (chose this over mysqli for security)
- **XAMPP** - Local development environment

## 📚 **What I'm Learning**

### **MVC Architecture**
I'm trying to implement a basic Model-View-Controller pattern:
- **Models** - Database interactions (still working on this part)
- **Views** - HTML templates with PHP
- **Controllers** - Business logic and request handling

### **Security Practices**
I'm learning about:
- Prepared statements to prevent SQL injection
- Password hashing with `password_hash()`
- Input sanitization and validation
- XSS prevention with `htmlspecialchars()`
- Session management for authentication

### **Database Design**
My current schema includes:
- `users` table for authentication
- `posts` table for content
- Foreign key relationships between tables

## 🔍 **Areas I'm Still Working On**

### **Things I Know Need Improvement**
- **Error handling** - Currently using basic `die()` statements
- **Validation** - Should implement more robust form validation
- **Code organization** - Some methods are doing too much
- **Model implementation** - Had to comment out model loading due to issues
- **REST conventions** - Not following proper URL structures yet

### **Questions I'm Still Exploring**
- When to use models vs direct database queries?
- Best practices for session security?
- How to structure larger applications?
- Environment configuration for production deployment?

## 📁 **Project Structure**

```
newcompany/
├── config/
│   └── config.php          # My app configuration
├── app/
│   ├── controllers/        # Request handlers
│   ├── libraries/          # Core framework files
│   ├── models/             # Database models (working on this)
│   └── views/              # HTML templates
└── public/
    └── index.php           # Entry point
```

## 🚀 **How to Run This Project**

1. **Set up XAMPP** with PHP and MySQL
2. **Create database** called `newcompany_db`
3. **Import tables** for `users` and `posts`
4. **Place files** in `htdocs/newcompany`
5. **Visit** `http://localhost/newcompany/public`

## 💭 **My Learning Process**

### **What Worked Well**
- Breaking down the MVC pattern into understandable pieces
- Using PDO for secure database connections
- Implementing basic authentication and authorization
- Creating responsive layouts with Bootstrap

### **Challenges I Faced**
- Understanding URL routing and how frameworks handle it
- Getting comfortable with mixing PHP and HTML
- Implementing proper error handling
- Debugging database connection issues

### **Next Steps for Improvement**
- Refactor controllers to be more focused
- Implement proper model layer
- Add email verification for user registration
- Improve error handling and logging
- Learn about dependency injection
- Study modern PHP frameworks

## 🎓 **Skills Demonstrated**

- **PHP fundamentals** - Variables, functions, classes, arrays
- **Database operations** - CRUD operations with PDO
- **Web security** - Basic authentication and input validation
- **Frontend integration** - Bootstrap, responsive design
- **Problem solving** - Debugging and iterative development
- **Code documentation** - Commenting for learning and maintenance

## 📝 **Personal Notes**

This project represents my current understanding of web development with PHP. I know there are many areas where I can improve, and I'm excited to continue learning. I've tried to comment my code honestly, showing both what I understand and where I'm still learning.

I believe the best way to learn is by building, breaking and fixing things which is exactly what this project has been for me.

---

*This is a learning project submitted as part of my developer portfolio. I'm open to feedback and excited to discuss the code and my learning process.*