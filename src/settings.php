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
        $(document).ready(function(){
            // when user click on profile menu
            $("#setting-items-profile").click(function(){
                // change menu background and icon
                $("#setting-items-feedback").removeClass("setting-item-active");
                $("#setting-items-feedback i").removeClass("fad");
                $("#setting-items-feedback i").addClass("far");
                $("#setting-items-profile").addClass("setting-item-active");
                $("#setting-items-profile i").removeClass("far");
                $("#setting-items-profile i").addClass("fad");

                // change page
                $("#menu-page").prop("src", "profile.php");
            });

            // when user click on feedback menu
            $("#setting-items-feedback").click(function(){
                // change menu background and icon
                $("#setting-items-profile").removeClass("setting-item-active");
                $("#setting-items-profile i").removeClass("fad");
                $("#setting-items-profile i").addClass("far");
                $("#setting-items-feedback").addClass("setting-item-active");
                $("#setting-items-feedback i").removeClass("far");
                $("#setting-items-feedback i").addClass("fad");

                // change page
                $("#menu-page").prop("src", "feedback.php");
            });
        });
    </script>
</head>
<body>
    <div class="wrapper padding-20">
        <div class="row gap25">
            <div id="setting-items" class="wrapper padding-20 back-white radius-all20 shadow-gray w350 h95vh cursor-pointer">
                <div id="setting-items-profile" class="setting-item row gap10 setting-item-active">
                    <i class="fad fa-user-circle size-25"></i>
                    Profile
                </div>
                <div id="setting-items-feedback" class="setting-item row gap10">
                    <i class="far fa-comment-edit size-25 gray"></i>
                    Report & Feedback
                </div>
            </div>
            <div class="w100per h95vh">
                <iframe id="menu-page" src="profile.php" frameborder="0" width="100%" height="100%"></iframe>
            </div>
        </div>
    </div>
    <!-- message -->
    <div class="message-wrapper">
        <div class="message-bottom-right">Message</div>
    </div>
</body>
</html>