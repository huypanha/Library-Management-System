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
    <script>
        var username = "", phone = "", email = "", addr = "";

        $(document).ready(function() {
            // when user change thire proile img
            $("#profile").change(function() {
                // get old profile to delete and show back after failed to upload
                var oldProfile = $("#profile-img").prop("src");

                // show preview
                $("#profile-img").prop("src", window.URL.createObjectURL($(this).prop("files")[0]));

                // create formdata to upload img
                var formdata = new FormData();
                formdata.append("newProfile", $(this).prop("files")[0]);
                formdata.append("oldProfile", oldProfile);
                formdata.append("id", $("#id").val());

                // upload new profile
                $.ajax({
                    url: "update/update_user_profile_img.php",
                    type: "POST",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function(data) {
                        // if upload success
                        if(data.status == 1){
                            // show success message
                            showBottomRightMessage(data.data, 1);
                        } else {
                            // show old profile
                            $("#profile-img").prop("src", oldProfile);

                            // show error message
                            showBottomRightMessage(data.data);
                        }
                    },
                    error: function(_, status, msg) {
                        // show old profile
                        $("#profile-img").prop("src", oldProfile);

                        // show error message
                        showBottomRightMessage("Could not upload profile image", 0);
                    }
                });
            });

            // save old username
            $("#username").focus(function(){
                if(username == ""){
                    username = $("#username").val();
                }
            });

            // when user update username
            $("#username").focusout(function(){
                // update only when username input is changed
                if($("#username").val() != username){
                    // upload new profile
                    $.ajax({
                        url: "update/update_username.php",
                        type: "POST",
                        data: {
                            "id": $("#id").val(),
                            "username": $("#username").val(),
                        },
                        dataType: "JSON",
                        success: function(data) {
                            // if update success
                            if(data.status == 1){
                                // show success message
                                showBottomRightMessage(data.data, 1);

                                // clear old username (used on focus)
                                username = "";
                            } else {
                                // change username to old username
                                $("#username").val(username);

                                // show error message
                                showBottomRightMessage(data.data);
                            }
                        },
                        error: function(_, status, msg) {
                            // change username to old username
                            $("#username").val(username);

                            // show error message
                            showBottomRightMessage("Could not update username", 0);
                        }
                    });
                }
            });

            // update gener
            $("#gender").change(function() {
                $.ajax({
                    url: "update/update_gender.php",
                    type: "POST",
                    data: {
                        "id": $("#id").val(),
                        "gender": $("#gender").val(),
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // if update success
                        if(data.status == 1){
                            // show success message
                            showBottomRightMessage(data.data, 1);
                        } else {
                            // show error message
                            showBottomRightMessage(data.data);
                        }
                    },
                    error: function(_, status, msg) {
                        // show error message
                        showBottomRightMessage("Could not update gender", 0);
                    }
                });
            });

            // save old phone
            $("#phone").focus(function(){
                if(phone == ""){
                    phone = $("#phone").val();
                }
            });

            // update phone
            $("#phone").focusout(function() {
                // update only when phone input is changed
                if($("#phone").val() != phone){
                    $.ajax({
                        url: "update/update_phone.php",
                        type: "POST",
                        data: {
                            "id": $("#id").val(),
                            "phone": $("#phone").val(),
                        },
                        dataType: "JSON",
                        success: function(data) {
                            // if update success
                            if(data.status == 1){
                                // show success message
                                showBottomRightMessage(data.data, 1);
                            } else {
                                // show error message
                                showBottomRightMessage(data.data);
                            }
                        },
                        error: function(_, status, msg) {
                            // show error message
                            showBottomRightMessage("Could not update phone", 0);
                        }
                    });
                }
            });

            // save old username
            $("#email").focus(function(){
                if(email == ""){
                    email = $("#email").val();
                }
            });

            // update email
            $("#email").focusout(function() {
                // update only when email input is changed
                if($("#email").val() != email){
                    $.ajax({
                        url: "update/update_email.php",
                        type: "POST",
                        data: {
                            "id": $("#id").val(),
                            "email": $("#email").val(),
                        },
                        dataType: "JSON",
                        success: function(data) {
                            // if update success
                            if(data.status == 1){
                                // show success message
                                showBottomRightMessage(data.data, 1);
                            } else {
                                // show error message
                                showBottomRightMessage(data.data);
                            }
                        },
                        error: function(_, status, msg) {
                            // show error message
                            showBottomRightMessage("Could not update email", 0);
                        }
                    });
                }
            });

            // save old username
            $("#addr").focus(function(){
                if(addr == ""){
                    addr = $("#addr").val();
                }
            });

            // update address
            $("#addr").focusout(function() {
                // update only when address input is changed
                if($("#addr").val() != addr){
                    $.ajax({
                        url: "update/update_address.php",
                        type: "POST",
                        data: {
                            "id": $("#id").val(),
                            "addr": $("#addr").val(),
                        },
                        dataType: "JSON",
                        success: function(data) {
                            // if update success
                            if(data.status == 1){
                                // show success message
                                showBottomRightMessage(data.data, 1);
                            } else {
                                // show error message
                                showBottomRightMessage(data.data);
                            }
                        },
                        error: function(_, status, msg) {
                            // show error message
                            showBottomRightMessage("Could not update address", 0);
                        }
                    });
                }
            });

            //validate and update password
            $("#pass").focusout(function(){
                updatePass();
            });

            //validate and update password
            $("#conPass").focusout(function(){
                updatePass();
            });
        });

        function updatePass(){
            // clear error status
            $("#passStatus").text("");
            $("#conPassStatus").text("");
        
            // if user entered both password
            if($("#pass").val() != "" && $("#conPass").val() != ""){
                // if both password do not match
                if($("#pass").val() == $("#conPass").val()){
                    // if password length < 6 characters
                    if($("#pass").val().length >= 6){
                        $.ajax({
                            url: "update/update_password.php",
                            type: "POST",
                            data: {
                                "id": $("#id").val(),
                                "newPass": $("#pass").val(),
                            },
                            dataType: "JSON",
                            success: function(data) {
                                // if update success
                                if(data.status == 1){
                                    // show success message
                                    showBottomRightMessage(data.data, 1);
                                } else {
                                    // show error message
                                    showBottomRightMessage(data.data);
                                }
                            },
                            error: function(_, status, msg) {
                                // show error message
                                showBottomRightMessage("Could not update address", 0);
                            }
                        });
                    } else {
                        // show password error
                        $("#passStatus").text("Please enter password at least 6 characters!");
                    }
                } else {
                    // show password error
                    $("#passStatus").text("Both password do not match!");
                    $("#conPassStatus").text("Both password do not match!");
                }
            }
        }
    </script>
</head>
<body>
    <div class="wrapper padding-20 back-white radius-all20 shadow-gray w100per h95vh scroll-y">
        <h2>Your Profile</h2><br>
        <div class="row gap50">
            <div class="w100per center">
                <label for="profile">
                    <div class="profile-200 pos-relative">
                        <img id="profile-img" class="cursor-pointer" src="../upload/user/<?php echo $user->profileImg; ?>" alt="Profile Image">
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
                <label for="username">Username</label><br>
                <input class="w100per" type="text" name="username" id="username" value="<?php echo $user->userName; ?>">
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
                <div id="passStatus" class="input-error-status"></div>
            </div>
            <div class="col w100per">
                <label for="conPass">Confirm New Password</label><br>
                <input class="w100per" type="password" name="conPass" id="conPass" placeholder="******">
                <div id="conPassStatus" class="input-error-status"></div>
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
    <!-- message -->
    <div class="message-wrapper">
        <div class="message-bottom-right">Message</div>
    </div>
</body>
</html>