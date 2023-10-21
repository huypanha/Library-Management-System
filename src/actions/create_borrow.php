<?php
    // if have data
    if(isset($_POST['stuId'])){
        // import db
        require '../../config/db.php';

        // start sesstion to get current user info
        session_start();

        $user = json_decode($_SESSION['user']);

        $stuId = $_POST['stuId'];
        $bId = $_POST['bookId'];
        $qty = $_POST['qty'];
        $amount = $_POST['amount'];
        $famount = $_POST['famount'];
        $due = $_POST['dueDate'];

        try {
            // connect to db
            $db = DB::Connect();

            $sql = "INSERT INTO borrow (book_id, stu_id, amount, fine_amount, qty, due_date, created_by) 
                VALUES($bId, $stuId, $amount, $famount, $qty, '$due', ".$user->userId.")";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            $ubookSql = "UPDATE books SET borrow_count=borrow_count+1 WHERE id=$bId";
            $ubookStmt = $db->prepare($ubookSql);
            $ubookStmt->execute();

            // get last inserted id
            $newId = $db->lastInsertId();

            // return result
            echo json_encode(array(
                "status"=>1,
                "data"=>array(
                    "newId"=>$newId,
                    "issuer"=>$user->userName,
                ),
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