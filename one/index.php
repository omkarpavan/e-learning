<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="logo1.png" alt="Logo" class="d-inline-block align-text-top" width="120" height="80">
                E-Learn
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Welcome to E-Learn</h1>
            <p class="lead">Your gateway to online learning and skill development.</p>
            <a href="login.php" class="btn btn-light btn-lg">Get Started</a>
        </div>
    </header>

    <!-- Course Section -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Our Courses</h2>
        <div class="row">
            <!-- Course 1 -->
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="logo1.png" class="card-img-top" alt="Course 1">
                    <div class="card-body">
                        <h5 class="card-title">Course Title 1</h5>
                        <p class="card-text">Learn the basics of this subject and start your journey.</p>
                        <a href="login.php" class="btn btn-primary">Enroll Now</a>
                    </div>
                </div>
            </div>
            <!-- Course 2 -->
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="logo1.png" class="card-img-top" alt="Course 2">
                    <div class="card-body">
                        <h5 class="card-title">Course Title 2</h5>
                        <p class="card-text">Deep dive into advanced topics and enhance your skills.</p>
                        <a href="login.php" class="btn btn-primary">Enroll Now</a>
                    </div>
                </div>
            </div>
            <!-- Course 3 -->
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="logo1.png" class="card-img-top" alt="Course 3">
                    <div class="card-body">
                        <h5 class="card-title">Course Title 3</h5>
                        <p class="card-text">Master this subject with our comprehensive course.</p>
                        <a href="login.php" class="btn btn-primary">Enroll Now</a>
                    </div>
                </div>
            </div>
            <!-- Course 4 -->
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="logo1.png" class="card-img-top" alt="Course 4">
                    <div class="card-body">
                        <h5 class="card-title">Course Title 4</h5>
                        <p class="card-text">Explore new concepts and broaden your knowledge.</p>
                        <a href="login.php" class="btn btn-primary">Enroll Now</a>
                    </div>
                </div>
            </div>
            <!-- Add more course cards here if needed -->
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="logo1.png" class="card-img-top" alt="Course 4">
                    <div class="card-body">
                        <h5 class="card-title">Course Title 5</h5>
                        <p class="card-text">Explore new concepts and broaden your knowledge.</p>
                        <a href="login.php" class="btn btn-primary">Enroll Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="logo1.png" class="card-img-top" alt="Course 4">
                    <div class="card-body">
                        <h5 class="card-title">Course Title 6</h5>
                        <p class="card-text">Explore new concepts and broaden your knowledge.</p>
                        <a href="login.php" class="btn btn-primary">Enroll Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="container p-4">
            <div class="row">
                <!-- About -->
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">E-Learn</h5>
                    <p>
                        E-Learn is an online platform providing quality education through accessible courses. Learn anytime, anywhere.
                    </p>
                </div>

                <!-- Links -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Quick Links</h5>
                    <ul class="list-unstyled mb-0">
                        <li><a href="#" class="text-dark">Home</a></li>
                        <li><a href="#" class="text-dark">Courses</a></li>
                        <li><a href="#" class="text-dark">About Us</a></li>
                        <li><a href="#" class="text-dark">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Contact Us</h5>
                    <ul class="list-unstyled">
                        <li><span class="text-dark">Email: support@elearn.com</span></li>
                        <li><span class="text-dark">Phone: +123 456 7890</span></li>
                        <li><span class="text-dark">Address: 123 Learning Street</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center p-3 bg-dark text-white">
            © 2025 E-Learn. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
