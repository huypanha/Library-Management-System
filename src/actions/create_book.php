<?php
    // if have data
    if(isset($_POST['title'])){
        // import db
        require '../../config/db.php';

        // start sesstion to get current user info
        session_start();

        $user = json_decode($_SESSION['user']);

        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $cate = $_POST['cate'];
        $author = $_POST['author'];
        $pub = $_POST['pub'];
        $price = $_POST['price'];
        $cover = $_FILES['cover'];

        try {
            // connect to db
            $db = DB::Connect();

            // upload file
            // create file name
            date_default_timezone_set("Asia/Phnom_Penh");
            $ext = end(explode('.', $cover['name']));
            $fileName = date("YmdHis").".".$ext;

            // upload
            if(move_uploaded_file($cover['tmp_name'], "../../upload/book/".$fileName)){
                // create query
                $sql = "INSERT INTO books(title, description, author, publisher, price, cover, category, created_by) 
                    VALUES('$title', '$desc', '$author', '$pub', '$price', '$fileName', '$cate', ".$user->userId.")";
                $stmt = $db->prepare($sql);
                $stmt->execute();

                // get last inserted id
                $newId = $db->lastInsertId();

                // get role
                $role = json_decode($_SESSION['role']);

                // return result
                echo json_encode(array(
                    "status"=>1,
                    "data"=>array(
                        "newId"=>$newId,
                        "cover"=>$fileName,
                    ),
                    "roleTitle"=>$role->title,
                ));
            } else {
                echo json_encode(array(
                    "status"=>0,
                    "data"=> "Could not uploaded book cover!",
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