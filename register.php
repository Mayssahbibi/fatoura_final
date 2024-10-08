<?php
include("./includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST")
 {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $cin = $_POST["cin"];
    $password = $_POST["password"];
    $adresse = $_POST["adresse"];

    $checkStmt = $conn->prepare("SELECT id FROM users WHERE cin = ?");
    $checkStmt->bind_param("s", $cin);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) 
    {
          echo "<script>alert(' This user Exist !')</script>";
    } 
    else
    {
        $insertStmt = $conn->prepare("INSERT INTO users (nom, email, cin, password, adresse) VALUES (?, ?, ?, ?, ?)");
        $insertStmt->bind_param("sssss", $nom, $email, $cin, $password, $adresse);
        $insertStmt->execute();


        if ($insertStmt->affected_rows > 0)
         {
            echo "Data added to the database successfully.";
            header('Location: connect.php');
        }
        else 
        {
            echo "Error adding data to the database.";
        }

        $insertStmt->close();
    }

    $checkStmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> TT-Facture </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets1/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <link href="assets1/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets1/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets12/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets12/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets1/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets1/vendor/aos/aos.css" rel="stylesheet">

  <link href="assets1/css/main.css" rel="stylesheet">

  <style>
.call-to-action {
    background-color: transparent;
    padding: 100px 0;
}

form input {
    width: 100%;
    background-color: #fff; 
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #000000;
    border-radius: 5px; 
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

 <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
   
        <h1>TT.Facture</h1>
      </a>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php" class="active"> Accueil </a></li>
        
          

          <li><a href="register.php">S'inscrire</a></li>
          <li><a class="get-a-quote" href="home.php">Se Connecter</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section id="hero" class="hero d-flex align-items-center">
    <div class="container">
      <div class="row gy-4 d-flex justify-content-between">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h3> S'inscrire </h3>
          <p> Inscrivez-vous à votre espace 

          </p>

            <form method="POST" action="register.php">
              <input type="text" name="nom" placeholder="Nom" required><br><br>
              <input type="number" name="cin" placeholder="CIN" required><br><br>
              <input type="email" name="email" placeholder="Email" required><br><br>
              <input type="password" name="password" placeholder="Mot de passe" required><br><br>
              <input type="text" name="adresse" placeholder="Adresse" required><br><br>
              <button type="submit">S'inscrire</button>
            </form>
        </div>
  </div>

  <br><br><br>
  <br><br><br>
  <br>
  

    <div class="container mt-4">
      <div class="copyright">
        2024 &copy; Copyright <strong><a href="index.php"><span>TT.FACTURE</span></a></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by Mayssa LAHBIBI</>
      </div>
    </div>

  </footer>
  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <script src="assets1/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets1/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets1/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets1/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets1/vendor/aos/aos.js"></script>
  <script src="assets1/vendor/php-email-form/validate.js"></script>

  <script src="assets1/js/main.js"></script>

</body>

</html>