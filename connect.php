<?php 
session_start();

include("./includes/db.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Retrieve data from the form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare and execute the SQL query to retrieve data from the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) 
    {
        // Correct data
        echo "Login successful.";
        
        // Start a session
        session_start();

        // Fetch the user data
        $user = $result->fetch_assoc();

        // Store the user information in the session variables
        $_SESSION["id"] = $user['id'];
        $_SESSION["email"] = $user['email'];
        $_SESSION["password"] = $user['password'];

        // Redirect to the dashboard
        header("Location: login.php");
        exit();
    } 
    else 
    {
        // Incorrect data
        echo "<script>alert('Invalid email or password.!')</script>";
    }

    
    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>TT-Facture</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets11/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets1/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets1/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets1/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets1/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets1/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets1/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets1/css/main.css" rel="stylesheet">

  <style>

/* Main Section Styles */
.call-to-action {
    background-color: transparent;
    padding: 100px 0;
}

form input {
    width: 100%;
    background-color: #fff; /* Change this line to set the background color for the form input */
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #000000;
    border-radius: 5px; /* Add this line to set the border-radius for the form input */
}

form button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
}

form button:hover {
    background-color: #0056b3;
}

  </style>
</head>

<body>

 <!-- ======= Header ======= -->
 <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets1/img/logo.png" alt=""> -->
        <h1>TT.Facture</h1>
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php" class="active"> Accueil </a></li>
        
          <li><a href="contact.php">Contact</a></li>

          <li><a href="register.php">S'inscrire</a></li>
          <li><a class="get-a-quote" href="connect.php">Se Connecter</a></li>
        </ul>
      </nav><!-- .navbar -->
    </div>
  </header>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row gy-4 d-flex justify-content-between">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h3> Espace Client </h3>
            <p>  Connectez-vous à votre espace pour bénéficier de nos offres</p>

            <form method="POST" action="connect.php">

              <input type="email" name="email" placeholder="Email" required>
              <input type="password" name="password" placeholder="Mot de passe" required>
              
              <button type="submit">Se connecter</button>
            </form>
          </div>
        </div>

        <br><br><br><br>
        <br><br><br><br>
        <br>

        
  


      <div class="copyright">
        2024 &copy; Copyright <strong><a href="index.php"><span>TT.FACTURE</span></a></strong>. All Rights Reserved
      </div>
      <div class="credits">
      Designed by Maysa LAHBIBI </>
      </div>

  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets1/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets1/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets1/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets1/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets1/vendor/aos/aos.js"></script>
  <script src="assets1/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets1/js/main.js"></script>

</body>

</html>

