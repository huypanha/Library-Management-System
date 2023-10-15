<?php
    // if have data
    if(isset($_POST['id'])){
        // import db
        require '../../config/db.php';

        // start sesstion to get current user info
        session_start();

        $user = json_decode($_SESSION['user']);

        $id = $_POST['od']; // book id

        try {
            // connect to db
            $db = DB::Connect();

            // create query
            $sql = "UPDATE student SET status=0, updated_by=".$user->userId.", updated_date=NOW() WHERE stu_id=$id";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            // set content type to json to send data back as JSON
            header('Content-Type: application/json');

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