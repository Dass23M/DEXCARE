<?php
include 'db_connection.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ryandi Pharmacy Navbar</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="CSS/styles.css">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
</head>
<body>
    <header>
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="center-section">
                    <span class="centered-text">Welcome to our international shop! Enjoy free shipping on orders $45.00 and up.</span>
                </div>
                <div class="right-section d-flex align-items-center">
                    <div class="location"><i class="fas fa-map-marker-alt"></i> North Americas Avenue</div>
                    <select class="custom-select">
                        <option selected>English</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="images/logo3.png" alt="Ryandi Logo">
                </a>
                <form class="form-inline mx-auto w-50">
                    <input class="form-control" type="search" placeholder="Search products..." aria-label="Search">
                </form>
                <div class="contact-and-cart d-flex align-items-center">
                    <a href="tel:+100123456789" class="phone-number"><i class="fas fa-phone"></i> +94 70 440 4404</a>
                    <div class="cart-icon ml-3">
                        <a href="#"><i class="fas fa-shopping-cart"></i></a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Navigation -->
        <nav class="main-nav navbar navbar-expand-lg navbar-light bg-lightblue">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="homeDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Home
                            </a>
                            <div class="dropdown-menu" aria-labelledby="homeDropdown">
                                <a class="dropdown-item" href="#">Sub Item 1</a>
                                <a class="dropdown-item" href="#">Sub Item 2</a>
                                <a class="dropdown-item" href="#">Sub Item 3</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="featuresDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Features
                            </a>
                            <div class="dropdown-menu" aria-labelledby="featuresDropdown">
                                <a class="dropdown-item" href="#">Sub Item 1</a>
                                <a class="dropdown-item" href="#">Sub Item 2</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="shopDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Shop
                            </a>
                            <div class="dropdown-menu" aria-labelledby="shopDropdown">
                                <a class="dropdown-item" href="#">Sub Item 1</a>
                                <a class="dropdown-item" href="#">Sub Item 2</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="blogDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Blog
                            </a>
                            <div class="dropdown-menu" aria-labelledby="blogDropdown">
                                <a class="dropdown-item" href="#">Sub Item 1</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="collectionsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Collections
                            </a>
                            <div class="dropdown-menu" aria-labelledby="collectionsDropdown">
                                <a class="dropdown-item" href="#">Sub Item 1</a>
                                <a class="dropdown-item" href="#">Sub Item 2</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="newArrivalsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                New Arrivals
                            </a>
                            <div class="dropdown-menu" aria-labelledby="newArrivalsDropdown">
                                <a class="dropdown-item" href="#">Sub Item 1</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Pages
                            </a>
                            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                                <a class="dropdown-item" href="#">Sub Item 1</a>
                                <a class="dropdown-item" href="#">Sub Item 2</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Slider Area -->
    <section class="custom-slider">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <!-- Start Single Slide -->
                <div class="swiper-slide" style="background-image:url('images/slider.jpg')">
                    <div class="content">
                        <h1>Your Trusted <span>Healthcare</span> Partner!</h1>
                        <p>Experience exceptional medical services tailored to your needs.</p>
                        <div class="buttons">
                            <a href="#" class="btn">Book Now</a>
                            <a href="#" class="btn primary">Discover More</a>
                        </div>
                    </div>
                </div>
                <!-- End Single Slide -->
                <!-- Start Single Slide -->
                <div class="swiper-slide" style="background-image:url('images/slider.jpg')">
                    <div class="content">
                        <h1>Quality <span>Medical</span> Care with <span>Compassion</span></h1>
                        <p>Your health and well-being are our top priority. Learn more about our services.</p>
                        <div class="buttons">
                            <a href="#" class="btn">Book Appointment</a>
                            <a href="#" class="btn primary">About Us</a>
                        </div>
                    </div>
                </div>
                <!-- End Single Slide -->
                <!-- Start Single Slide -->
                <div class="swiper-slide" style="background-image:url('images/slider3.jpg')">
                    <div class="content">
                        <h1>Get the <span>Care</span> You <span>Deserve</span></h1>
                        <p>Contact us today for personalized medical solutions.</p>
                        <div class="buttons">
                            <a href="#" class="btn">Schedule a Visit</a>
                            <a href="#" class="btn primary">Contact Us</a>
                        </div>
                    </div>
                </div>
                <!-- End Single Slide -->
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>

    <!-- Custom Schedule Area -->
    <section class="custom-schedule">
        <div class="container">
            <div class="schedule-grid">
                <div class="schedule-item emergency">
                    <div class="schedule-icon">
                        <i class="fas fa-ambulance"></i>
                    </div>
                    <div class="schedule-content">
                        <h5>Emergency Cases</h5>
                        <p>Prompt and efficient emergency services for critical care needs. Always ready, 24/7.</p>
                        <a href="#">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="schedule-item timetable">
                    <div class="schedule-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="schedule-content">
                        <h5>Doctors Timetable</h5>
                        <p>Check the availability of our specialists and plan your visit accordingly.</p>
                        <a href="#">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="schedule-item hours">
                    <div class="schedule-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="schedule-content">
                        <h5>Opening Hours</h5>
                        <ul class="hours-list">
                            <li>Monday - Friday: 8.00 - 20.00</li>
                            <li>Saturday: 9.00 - 18.30</li>
                            <li>Sunday: 9.00 - 15.00</li>
                        </ul>
                        <a href="#">Learn More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pharmacies Display Section -->
    <div class="container mt-5">
        <h2>Our Pharmacies</h2>
        <div class="row">
            <!-- This PHP block requires server-side execution -->
            <?php
            // Query to get the list of pharmacies
            // Make sure to include database connection code here
            // $conn = new mysqli("servername", "username", "password", "dbname");
            $pharmacies = $conn->query("SELECT * FROM Pharmacies");
            while ($row = $pharmacies->fetch_assoc()) {
                echo "<div class='col-md-4'>";
                echo "<div class='card mb-4'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . htmlspecialchars($row['PharmacyName']) . "</h5>";
                echo "<p class='card-text'>" . htmlspecialchars($row['Address']) . "</p>";
                echo "<a href='branch_page.php?id=" . intval($row['PharmacyID']) . "' class='btn btn-primary'>Visit Branch</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="JS/script.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>
</body>
</html>
