<?php
    // if have data
    if(isset($_POST['id'])){
        // import db
        require '../../config/db.php';

        // start sesstion to get current user info
        session_start();

        $user = json_decode($_SESSION['user']);

        $id = $_POST['id'];
        $username = $_POST['username'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $roleId = $_POST['roleId'];
        $phone = $_POST['phone'];
        $addr = $_POST['addr'];

        try {
            // connect to db
            $db = DB::Connect();

            // upload profile image
            if(isset($_FILES['img'])){
                // create new file name
                date_default_timezone_set("Asia/Phnom_Penh");
                $profile = date('YmdHis').".".end(explode(".",$_FILES['img']['name']));

                // upload
                if(move_uploaded_file($_FILES['img']['tmp_name'],"../../upload/user/".$profile)){
                    // delete old profile image
                    unlink(dirname(__DIR__, 2)."/upload/user/".$_POST['oldProfileImg']);
                } else { // if upload failed
                    echo json_encode(array(
                        "status"=>0,
                        "data"=> "Could not upload profile image",
                    ));
                    return;
                }
            }

            // create query
            $sql = "UPDATE user SET username='$username', gender=$gender, phone='$phone', email='$email', 
            role_id=$roleId, address='$addr', updated_by=".$user->userId.", updated_date=NOW() ";

            // if update password
            if(isset($_POST['pass'])){
                $sql .= ", pass='".password_hash($_POST['pass'], PASSWORD_BCRYPT)."' ";
            }

            // if update user profile image
            if(isset($_FILES['img'])){
                $sql .= ", profile_img='$profile' ";
            }

            $sql .= "WHERE user_id=$id";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            // return result
            echo json_encode(array(
                "status"=>1,
                "data"=>"Updated user #".$id." successfully",
            ));
        } catch(PDOException $ex){
            // return error
            echo json_encode(array(
                "status"=>0,
                "data"=> $ex->getMessage(),
            ));
        }
    }
?>