<?php
    // if have data
    if(isset($_POST['username'])){
        // import db
        require '../../config/db.php';

        // start sesstion to get current user info
        session_start();

        $user = json_decode($_SESSION['user']);

        $username = $_POST['username'];
        $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $roleId = $_POST['roleId'];
        $phone = $_POST['phone'];
        $addr = $_POST['addr'];
        $profileImg = $_FILES['img'];

        try {
            // connect to db
            $db = DB::Connect();

            // upload profile image
            date_default_timezone_set("Asia/Phnom_Penh");
            $profile = date('YmdHis').".".end(explode(".",$profileImg['name']));

            if(move_uploaded_file($profileImg['tmp_name'],"../../upload/user/".$profile)){
                // create query
                $sql = "INSERT INTO user(username, pass, gender, phone, email, role_id, address, profile_img, created_by) 
                    VALUES('$username', '$pass', $gender, '$phone', '$email', $roleId, '$addr', '$profile', ".$user->userId.")";
                $stmt = $db->prepare($sql);
                $stmt->execute();

                // get last inserted id
                $newId = $db->lastInsertId();

                // return result
                echo json_encode(array(
                    "status"=>1,
                    "data"=>array(
                        "newId"=>$newId,
                        "profileImg"=>$profile,
                    ),
                ));
            } else {
                // return result
                echo json_encode(array(
                    "status"=>0,
                    "data"=> "Could not upload profile",
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