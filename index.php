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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <meta property="og:title" content="Library Management System">
    <meta property="og:type" content="Library" />
    <meta property="og:image" content="media/logo.jpeg">
    <link rel="stylesheet" href="css/fontawesomepro.css">
    <link rel="stylesheet" href="js/fontawesomepro.js">
</head>
<body>
    <div class="wrapper flex">
        <div class="left-nav">
            <img src="media/logo.jpeg" alt="Logo">
            <ul class="nav-menu">
                <li class="menu-item nav-menu-active" title="Dashboard"><img src="media/dashboard_filled.png" alt="menu icon"></li>
                <li class="menu-item" title="Students"><i class="far fa-users size-25 gray"></i></li>
                <li class="menu-item" title="Books"><i class='far fa-books size-25 gray'></i></li>
                <li class="menu-item" title="Borrow"><i class="far fa-book-reader size-25 gray"></i></li>
                <li class="menu-item" title="Settings"><i class="far fa-cog size-25 gray"></i></li>
                <li class="menu-item" title="Feedback"><i class="far fa-comment-alt-edit size-25 gray"></i></li>
            </ul>
        </div>
        <div class="col">
            <div class="top-nav">
                <h2 id="page-title">Dashboard</h2>
                <div class="search-input">
                    <input type="text" name="search" id="search" placeholder="Search...">
                </div>
                <div class="row">
                    <a href="#">
                        <i class="fas fa-bell size-25"></i>
                        <div class="badge">1</div>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="col right">
                        <h4 id="current-username">Huy Panha</h4>
                        <p id="current-role-title">Admin</p>
                    </div>&nbsp;&nbsp;&nbsp;
                    <div class="profile" id="current-user-profile">
                        <img src="media/generarainbow-ceiling-bookshelves.jpg" alt="Profile">
                    </div>
                </div>
            </div>
            <div id="current-page-content">
                <iframe src="src/dashboard.php" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</body>
</html>