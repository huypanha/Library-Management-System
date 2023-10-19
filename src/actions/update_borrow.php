<?php
    // if have data
    if(isset($_POST['id'])){
        // import db
        require '../../config/db.php';

        // start sesstion to get current user info
        session_start();

        $user = json_decode($_SESSION['user']);

        $id = $_POST['id'];
        $stuId = $_POST['stuId'];
        $bId = $_POST['bookId'];
        $qty = $_POST['qty'];
        $amount = $_POST['amount'];
        $famount = $_POST['famount'];
        $due = $_POST['dueDate'];
        $isReturned = $_POST['isReturned'];

        try {
            // connect to db
            $db = DB::Connect();

            // create query
            $sql = "UPDATE borrow SET book_id=$bId, stu_id=$stuId, amount=$amount, fine_amount=$famount, 
            qty=$qty, due_date='$due', returned=$isReturned, updated_by=".$user->userId.", updated_date=NOW() WHERE id=$id";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            // return result
            echo json_encode(array(
                "status"=>1,
                "data"=>"Updated book #$id successfully!",
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