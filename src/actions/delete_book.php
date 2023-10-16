<?php
    // if have data
    if(isset($_POST['id'])){
        // import db
        require '../../config/db.php';

        // start sesstion to get current user info
        session_start();

        $user = json_decode($_SESSION['user']);

        $id = $_POST['id'];
        $cover = $_POST['cover'];

        try {
            // connect to db
            $db = DB::Connect();

            // create query
            $sql = "UPDATE books SET status=0, updated_by=".$user->userId.", updated_date=NOW() WHERE id=$id";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            // delete cover
            unlink(dirname(__DIR__, 2)."/upload/book/".end(explode('/', $cover)));

            // return result
            echo json_encode(array(
                "status"=>1,
                "data"=> "Deleted successfully!",
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