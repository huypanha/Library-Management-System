<?php
    // inport database
    require '../config/db.php';

    // start sesstion to use sessions
    session_start();

    // check if user is logged in
    if(isset($_SESSION['user'])) {
        $user = json_decode($_SESSION['user']);
        $role = json_decode($_SESSION['role']);
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
            <div class="wrapper padding-20 back-white radius-all20 shadow-gray w100per h95vh scroll-y">
                <h2>Your Profile</h2><br>
                <div class="row gap50">
                    <div class="w100per center">
                        <label for="profile">
                            <div class="profile-200 pos-relative">
                                <img class="cursor-pointer" src="../upload/user/<?php echo $user->profileImg; ?>" alt="Profile Image">
                                <div class="choose-img-icon pos-absolute pos-bottom pos-right pos-choose-camera-90 cursor-pointer">
                                    <i class="fad fa-camera primary-color"></i>
                                </div>
                            </div>
                        </label>
                        <input type="file" name="profile" id="profile">
                    </div>
                    <div class="col w100per">
                        <label for="id">ID</label><br>
                        <input class="w100per" type="text" name="id" id="id" value="<?php echo $user->userId; ?>" disabled><br><br>
                        <label for="id">Username</label><br>
                        <input class="w100per" type="text" name="id" id="id" value="<?php echo $user->userName; ?>">
                    </div>
                </div>
                <div class="row gap50">
                    <div class="col w100per">
                        <label for="gender">Gender</label><br>
                        <div class="filter-box w100per input-back-gray">
                            <select class="w100per size-15" name="gender" id="gender">
                                <option value="0" <?php if($user->gender == 0) echo "selected"; ?>>Male</option>
                                <option value="1" <?php if($user->gender == 1) echo "selected"; ?>>Female</option>
                            </select>
                            <i class="fas fa-caret-down"></i>
                        </div>
                    </div>
                    <div class="col w100per">
                        <label for="phone">Phone</label><br>
                        <input class="w100per" type="text" name="phone" id="phone" value="<?php  echo $user->phone; ?>">
                    </div>
                </div><br>
                <div class="row gap50">
                    <div class="col w100per">
                        <label for="email">Email</label><br>
                        <input class="w100per" type="email" name="email" id="email" value="<?php  echo $user->email; ?>">
                    </div>
                    <div class="col w100per">
                        <label for="role">Role</label><br>
                        <input class="w100per" type="text" name="role" id="role" value="<?php  echo $role->title; ?>" disabled>
                    </div>
                </div><br>
                <label for="addr">Address</label><br>
                <textarea class="w100per" name="addr" id="addr" rows="5"><?php  echo $user->address; ?></textarea><br><br>
                <h3>Security</h3><br>
                <div class="row gap50">
                    <div class="col w100per">
                        <label for="pass">New Password</label><br>
                        <input class="w100per" type="password" name="pass" id="pass" placeholder="******">
                    </div>
                    <div class="col w100per">
                        <label for="conPass">Confirm New Password</label><br>
                        <input class="w100per" type="password" name="conPass" id="conPass" placeholder="******">
                    </div>
                </div><br>
                <h3>Additional Information</h3><br>
                <div class="row">
                    <div class="w150">Created By</div>
                    <p class="gray">: <?php echo $user->createdBy; ?></p>
                </div>
                <div class="h10"></div>
                <div class="row">
                    <div class="w150">Join Date</div>
                    <p class="gray">: <?php echo date_format(date_create($user->createdDate), "d/m/Y H:i:s"); ?></p>
                </div>
                <?php
                    if($user->updatedBy){
                        echo "<div class='h10'></div>
                            <div class='row'>
                                <div class='w150'>Updated By</div>
                                <p class='gray'>: $user->updatedBy</p>
                            </div>
                            <div class='h10'></div>
                            <div class='row'>
                            <div class='w150'>Updated Date</div>
                            <p class='gray'>: ".date_format(date_create($user->updatedDate), "d/m/Y H:i:s")."</p>
                        </div>";
                    }
                ?>
                <div class="h100"></div>
            </div>
        </div>
    </div>
</body>
</html>