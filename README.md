# College Library Website

A comprehensive library management system with separate interfaces for students and developers (teachers).

## Features

### Student Interface
- Google Authentication
- Profile Management
- E-Book Access (PDF/EPUB)
- Book Upload System
- View Summary Videos
- Issued Book History
- Search Functionality
- AI Chatbot Integration

### Developer Interface
- Secure Login System
- Book Management
- Issue/Return System
- Student Upload Verification
- User History Tracking

## Technology Stack
- Frontend: HTML, CSS, JavaScript
- Backend: PHP
- Database: MySQL
- Storage: Local File System
- AI Chatbot Integration

## Installation
1. Clone this repository to your XAMPP's htdocs folder
2. Import the database schema from `database/library.sql`
3. Configure database credentials in `config/config.php`
4. Access the website through localhost/LIBRARY

## Deployment

### Firebase Hosting Setup
1. Install Firebase CLI:
   ```bash
   npm install -g firebase-tools
   ```
2. Login to Firebase:
   ```bash
   firebase login
   ```
3. Initialize your project:
   ```bash
   firebase init hosting
   ```
4. Deploy to Firebase:
   ```bash
   firebase deploy
   ```

Note: Before deploying, make sure to:
1. Update the Firebase configuration in your project
2. Move all static assets to the `public` directory
3. Configure environment variables in Firebase Console

## Directory Structure
```
LIBRARY/
├── assets/          # Static files (CSS, JS, images)
├── config/          # Configuration files
├── database/        # Database schema
├── includes/        # PHP helper functions
├── uploads/         # Uploaded books storage
│   ├── ebooks/      # E-books uploaded by developers
│   └── student/     # Books uploaded by students
├── student/         # Student interface files
└── developer/       # Developer interface files
```
