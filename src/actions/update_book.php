<?php
    // if have data
    if(isset($_POST['id'])){
        // import db
        require '../../config/db.php';

        // start sesstion to get current user info
        session_start();

        $user = json_decode($_SESSION['user']);

        $id = $_POST['id'];
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $cate = $_POST['cate'];
        $author = $_POST['author'];
        $pub = $_POST['pub'];
        $price = $_POST['price'];

        if(isset($_FILES['cover'])){
            $cover = $_FILES['cover'];
            $oldCover = $_POST['oldCover'];
        }

        try {
            // connect to db
            $db = DB::Connect();

            // if update book cover
            if(isset($cover)){
                // create file name
                date_default_timezone_set("Asia/Phnom_Penh");
                $ext = end(explode('.', $cover['name']));
                $fileName = date("YmdHis").".".$ext;

                // upload
                if(move_uploaded_file($cover['tmp_name'], "../../upload/book/".$fileName)){
                    // delete old cover
                    unlink(dirname(__DIR__, 2)."/upload/book/".end(explode('/', $oldCover)));

                    // create query
                    $sql = "UPDATE books SET title='$title', description='$desc', author='$author', publisher='$pub', price='$price', 
                            cover='$fileName', category='$cate', updated_by=".$user->userId.", updated_date=NOW() WHERE id=$id";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();

                    // return result
                    echo json_encode(array(
                        "status"=>1,
                        "data"=>"Updated book #$id successfully!",
                    ));
                } else {
                    echo json_encode(array(
                        "status"=>0,
                        "data"=> "Could not uploaded book cover!",
                    ));
                }
            } else {
                // create query
                $sql = "UPDATE books SET title='$title', description='$desc', author='$author', publisher='$pub', price='$price', 
                category='$cate', updated_by=".$user->userId.", updated_date=NOW() WHERE id=$id";
                $stmt = $db->prepare($sql);
                $stmt->execute();

                // return result
                echo json_encode(array(
                    "status"=>1,
                    "data"=>"Updated book #$id successfully!",
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