<?php
    // if have data
    if(isset($_POST['id'])){
        // import db
        require '../../config/db.php';

        // start sesstion to get current user info
        session_start();

        $user = json_decode($_SESSION['user']);

        $newProfile = $_FILES['newProfile'];
        $oldProfile = $_POST['oldProfile'];
        $id = $_POST['id'];

        try {
            // connect to db
            $db = DB::Connect();

            // create new file name
            date_default_timezone_set("Asia/Phnom_Penh");
            $profile = date('YmdHis').".".end(explode(".",$newProfile['name']));

            // upload
            if(move_uploaded_file($newProfile['tmp_name'],"../../upload/user/".$profile)){
                // delete old profile image
                unlink(dirname(__DIR__, 2)."/upload/user/".end(explode('/', $oldProfile)));

                // create query
                $sql = "UPDATE user SET profile_img='$profile', updated_by=".$user->userId.", updated_date=NOW() WHERE user_id=$id";
                $stmt = $db->prepare($sql);
                $stmt->execute();

                // update user info
                $newInfo = json_decode($_SESSION['user'], true); // decode JSON to array
                $newInfo['profileImg'] = $profile; // update to new profile image
                $newInfo['updatedDate'] = date("Y-m-d H:i:s"); // update the updated date
                $_SESSION['user'] = json_encode($newInfo); // save to session

                // return result
                echo json_encode(array(
                    "status"=>1,
                    "data"=>"Updated profile successfully, Please refresh page to see the changes.",
                ));
            } else { // if upload failed
                echo json_encode(array(
                    "status"=>0,
                    "data"=> "Could not upload profile image",
                ));
            }
        } catch(PDOException $ex){
            // return error
            echo json_encode(array(
                "status"=>0,
                "data"=> $ex->getMessage(),
            ));
        }
    }
?>