<?php
    // inport database
    require '../config/db.php';

    // start sesstion to use sessions
    session_start();

    // check if user is logged in
    if(isset($_SESSION['user'])) {
        $user = json_decode($_SESSION['user']);
    } else {
        header('location:../login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/fontawesomepro.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/fontawesomepro.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../js/script.js" type="text/javascript"></script>
</head>
<body>
    <div class="wrapper padding-20">
        <div class="row gap25">
            <div id="setting-items" class="wrapper padding-20 back-white radius-all20 shadow-gray w350 h95vh cursor-pointer">
                <div class="setting-item row gap10 setting-item-active">
                    <i class="fad fa-user-circle size-25"></i>
                    Profile
                </div>
            </div>
            <div class="wrapper padding-20 back-white radius-all20 shadow-gray w100per h95vh">
                <h2>Your Profile</h2><br>
                <div class="row gap50">
                    <div class="profile-200">
                        <img src="../upload/user/<?php echo $user->profileImg; ?>" alt="Profile Image">
                    </div>
                    <div class="col">
                        <label for="id">ID</label><br>
                        <input type="text" name="id" id="id" value="<?php echo $user->userId; ?>" disabled><br><br>
                        <label for="id">Username</label><br>
                        <input type="text" name="id" id="id" value="<?php echo $user->userName; ?>">
                    </div>
                </div>
                <div class="col">
                    <label for="name">Username</label><br>
                    <input type="text" name="" id="">
                </div>
            </div>
        </div>
    </div>
</body>
</html>