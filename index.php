<?php
require_once 'config/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Library - Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">College Library</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h1>Welcome to College Library</h1>
                <p class="lead">Access e-books, manage your library account, and more.</p>
                
                <div class="d-grid gap-3 col-6 mx-auto mt-4">
                    <a href="student/login.php" class="btn btn-primary btn-lg">
                        Student Login
                    </a>
                    <a href="developer/login.php" class="btn btn-secondary btn-lg">
                        Developer Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Chatbot Icon -->
    <div id="chatbot-icon" class="position-fixed bottom-0 end-0 mb-4 me-4">
        <button class="btn btn-primary rounded-circle p-3" onclick="toggleChatbot()">
            <i class="fas fa-comments"></i>
        </button>
    </div>

    <!-- Chatbot Container (Hidden by default) -->
    <div id="chatbot-container" class="position-fixed bottom-0 end-0 mb-5 me-4 d-none">
        <!-- Chatbot content will be loaded here -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>
    <script src="assets/js/chatbot.js"></script>
</body>
</html>
