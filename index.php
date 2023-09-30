<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <meta property="og:title" content="Library Management System">
    <meta property="og:type" content="Library" />
    <meta property="og:image" content="media/logo.jpeg">
    <link rel="stylesheet" href="css/fontawesomepro.css">
    <link rel="stylesheet" href="js/fontawesomepro.js">
</head>
<body>
    <div class="wrapper">
        <div class="left-nav">
            <img src="media/logo.jpeg" alt="Logo">
            <ul class="nav-menu">
                <li class="menu-item nav-menu-active"><img src="media/dashboard_filled.png" alt="menu icon"></li>
                <li class="menu-item"><i class="far fa-users size-25"></i></li>
                <li class="menu-item"><i class='far fa-books size-25'></i></li>
                <li class="menu-item"><i class="far fa-book-reader size-25"></i></li>
                <li class="menu-item"><i class="far fa-cog size-25"></i></li>
                <li class="menu-item"><i class="far fa-comment-alt-edit size-25"></i></li>
            </ul>
        </div>
        <div class="col">
            <div class="top-nav">
                <h2>Dashboard</h2>
                <div class="search-input">
                    <input type="text" name="search" id="search" placeholder="Search...">
                </div>
                <div class="row">
                    <a href="#">
                        <i class="fas fa-bell size-25"></i>
                        <div class="badge">1</div>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="col right">
                        <h4>Huy Panha</h4>
                        <p>Admin</p>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="profile">
                        <img src="media/generarainbow-ceiling-bookshelves.jpg" alt="Profile">
                    </div>
                </div>
            </div>
            <div id="dash-body"></div>
        </div>
    </div>
</body>
</html>