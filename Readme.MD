

This is a basic **PHP CRUD (Create, Read, Update, Delete)** application that allows users to manage posts. The app includes features like user authentication, post management, and basic session handling.

## Features

- **User Authentication**: Allows users to register, log in, and log out securely.
    
- **Post Management**: Users can create, edit, and delete their own posts.
    
- **Session Management**: Ensures only authenticated users can access certain pages.
    

## Security Considerations

While building this app, I have focused on securing it against common vulnerabilities as outlined in the **OWASP Top 10**. Here’s how the app addresses some of these vulnerabilities:

### 1. **SQL Injection**

I used **prepared statements** with **parameterized queries** to prevent SQL injection attacks. This ensures that user input is treated as data, not executable code.

```php
$stmt = $pdo->prepare("SELECT * FROM POSTS WHERE id = ?");
$stmt->execute([$id]);
```

### 2. **Broken Authentication**

The app uses **password hashing** to store passwords securely. It also regenerates session IDs upon login to prevent session fixation attacks.

### 3. **Sensitive Data Exposure**

Passwords are hashed with `password_hash()` and **never stored in plain text**. The application uses **HTTPS** to encrypt data in transit.

### 4. **Cross-Site Scripting (XSS)**

I used **`htmlspecialchars()`** to sanitize user input before displaying it on the page, preventing XSS attacks.

```php
echo htmlspecialchars($post['title']);
```

### 5. **Broken Access Control**

Users can only view, edit, and delete their own posts. The app checks that the logged-in user’s `user_id` matches the post's `user_id` before allowing actions.

## How I Am Learning and Improving

I started learning PHP and MySQL recently, and this project has been a way for me to practice securing web applications. By following best practices for security, such as using prepared statements, hashing passwords, and validating inputs, I've improved my understanding of both PHP development and web application security.

I am actively studying resources such as the **OWASP Top 10** and PHP documentation to continuously improve my skills and ensure I follow secure coding practices.

---
