<?php
    // start session to use session
    session_start();

    // check logged in or not
    if(!$_SESSION['loggedIn']){
        header("location: auth/login.php");
    }

    $user = json_decode($_SESSION['user']);
    $role = json_decode($_SESSION['role']);
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
    <script src="js/fontawesomepro.js" type="text/javascript"></script>
    <meta property="og:title" content="Library Management System">
    <meta property="og:type" content="Library" />
    <meta property="og:image" content="media/logo.jpeg">
    <link rel="stylesheet" href="css/fontawesomepro.css">
    <script>
        $(document).ready(function(){
            $("#search").keypress(function(e){
                if(e.which == 13){
                    if($("#current-page").attr("src").match("^src/students.php")){
                        if($("#search").val() == ""){
                            $("#current-page-content").html("<iframe id='current-page' src='src/students.php' frameborder='0'></iframe>");
                        } else {
                            $("#current-page-content").html("<iframe id='current-page' src='src/students.php?searchKey="+$("#search").val()+"' frameborder='0'></iframe>");
                        }
                    } else if($("#current-page").attr("src").match("^src/books.php")){
                        if($("#search").val() == ""){
                            $("#current-page-content").html("<iframe id='current-page' src='src/books.php' frameborder='0'></iframe>");
                        } else {
                            $("#current-page-content").html("<iframe id='current-page' src='src/books.php?searchKey="+$("#search").val()+"' frameborder='0'></iframe>");
                        }
                    } else if($("#current-page").attr("src").match("^src/borrows.php")){
                        if($("#search").val() == ""){
                            $("#current-page-content").html("<iframe id='current-page' src='src/borrows.php' frameborder='0'></iframe>");
                        } else {
                            $("#current-page-content").html("<iframe id='current-page' src='src/borrows.php?searchKey="+$("#search").val()+"' frameborder='0'></iframe>");
                        }
                    } else if($("#current-page").attr("src").match("^src/users.php")){
                        if($("#search").val() == ""){
                            $("#current-page-content").html("<iframe id='current-page' src='src/users.php' frameborder='0'></iframe>");
                        } else {
                            $("#current-page-content").html("<iframe id='current-page' src='src/users.php?searchKey="+$("#search").val()+"' frameborder='0'></iframe>");
                        }
                    }
                }
            });
        });
    </script>
</head>
<body>
    <div class="wrapper flex">
        <div class="left-nav">
            <img src="media/logo.jpeg" alt="Logo">
            <?php 
                    if($role->title == "Admin"){
                        echo '<ul class="nav-menu">
                            <li id="menu-item1" class="menu-item nav-menu-active" title="Dashboard"><img src="media/dashboard_filled.png" alt="menu icon"></li>
                            <li id="menu-item2" class="menu-item" title="Students"><i class="far fa-user-graduate size-25 gray"></i></li>
                            <li id="menu-item3" class="menu-item" title="Books"><i class="far fa-books size-25 gray"></i></li>
                            <li id="menu-item4" class="menu-item" title="Borrows"><i class="far fa-book-reader size-25 gray"></i></li>
                            <li id="menu-item5" class="menu-item" title="Users"><i class="far fa-users size-25 gray"></i></li>
                            <li id="menu-item6" class="menu-item" title="Settings"><i class="far fa-cog size-25 gray"></i></li>
                            <a class="logout" title="Logout" href="auth/logout.php" onclick="return confirm(\'Are you sure want to logout?\');"><i class="far fa-sign-out-alt size-25 red"></i></a>
                        </ul>';
                    } else {
                        echo '<ul class="nav-menu">
                            <li id="menu-item1" class="lib-menu-item nav-menu-active" title="Dashboard"><img src="media/dashboard_filled.png" alt="menu icon"></li>
                            <li id="menu-item2" class="lib-menu-item" title="Students"><i class="far fa-user-graduate size-25 gray"></i></li>
                            <li id="menu-item3" class="lib-menu-item" title="Books"><i class="far fa-books size-25 gray"></i></li>
                            <li id="menu-item4" class="lib-menu-item" title="Borrows"><i class="far fa-book-reader size-25 gray"></i></li>
                            <li id="menu-item6" class="lib-menu-item" title="Settings"><i class="far fa-cog size-25 gray"></i></li>
                            <a class="logout" title="Logout" href="auth/logout.php" onclick="return confirm(\'Are you sure want to logout?\');"><i class="far fa-sign-out-alt size-25 red"></i></a>
                        </ul>';
                    }
                ?>
        </div>
        <div class="col">
            <div class="top-nav">
                <h2 id="page-title">Dashboard</h2>
                <div class="search-input">
                    <input type="search" name="search" id="search" placeholder="Search...">
                </div>
                <div class="row gap10">
                    <!-- <a href="#">
                        <i class="fas fa-bell size-25"></i>
                        <div class="badge">1</div>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                    <div class="col right">
                        <h4 id="current-username"><?php echo $user->userName; ?></h4>
                        <p id="current-role-title"><?php echo $role->title; ?></p>
                    </div>
                    <div class="profile cursor-pointer" id="current-user-profile" onclick="document.getElementById('menu-item6').click();">
                        <img src="upload/user/<?php echo $user->profileImg; ?>" alt="Profile">
                    </div>
                </div>
            </div>
            <div id="current-page-content">
                <iframe id="current-page" src="src/dashboard.php" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</body>
</html>