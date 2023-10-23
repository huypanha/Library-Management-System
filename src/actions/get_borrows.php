<?php
    // import db connection
    require '../../config/db.php';

    try {
        // connect to database
        $db = DB::Connect();

        // store result as array
        $re = array();

        // get offset and limit
        $offset = $_GET['offset'];
        $limit = $_GET['limit'];

        $sql = null;

        if(isset($_GET['searchKey'])){
            // get offset and limit
            $key = strtolower($_GET['searchKey']);

            // create query to search student
            $sql = "SELECT br.*, b.title, b.cover, CONCAT(s.first_name,' ',s.last_name) borrower, u.username created_by
                    FROM borrow br LEFT JOIN books b ON br.book_id = b.id 
                        LEFT JOIN student s ON br.stu_id=s.stu_id 
                        LEFT JOIN user u ON br.created_by=u.user_id 
                    WHERE br.status=1 AND (br.id LIKE '$key%' OR title LIKE '%$key%') ";
        } else {
            // create query to get student
            $sql = "SELECT br.*, b.title, b.cover, CONCAT(s.first_name,' ',s.last_name) borrower, u.username created_by
                    FROM borrow br LEFT JOIN books b ON br.book_id = b.id 
                        LEFT JOIN student s ON br.stu_id=s.stu_id 
                        LEFT JOIN user u ON br.created_by=u.user_id 
                    WHERE br.status=1 ";
        }
            
        if(isset($_GET['startDate'])){
            $sql .= "AND br.created_date >= '".$_GET['startDate']."' AND br.created_date <= '". $_GET['endDate']." 23:59:59' ";
        }

        if(isset($_GET['startDDate'])){
            $sql .= "AND br.due_date >= '".$_GET['startDDate']."' AND br.due_date <= '". $_GET['endDDate']." 23:59:59' ";
        }

        if(isset($_GET['status'])){
            $sql .= "AND br.returned = ". $_GET['status']." ";
        }

        $sql .= "ORDER BY br.created_date DESC ";

        // if limit = 0: unlimit
        if($limit != 0){
            $sql .= " LIMIT $offset,$limit";
        }

        $stmt = $db->prepare($sql);
        $stmt->execute();

        // get all records
        $rows = $stmt->fetchAll();
        
        // add all rows to $re
        foreach($rows as $row){
            $r = array(
                "id" => $row['id'],
                "amount" => $row['amount'],
                "qty" => $row['qty'],
                "fineAmount" => $row['fine_amount'],
                "due" => $row['due_date'],
                "createdDate" => $row['created_date'],
                "updatedBy" => $row['updated_by'],
                "updatedDate" => $row['updated_date'],
                "status" => $row['returned'],
                "bookTitle" => $row['title'],
                "bookCover" => $row['cover'],
                "createdBy" => $row['created_by'],
                "borrower" => $row['borrower'],
            );
            array_push($re, $r);
        }

        // count all borrows to know have more or not
        $countSql = "SELECT COUNT(*) FROM borrow WHERE status=1";
        $countStmt = $db->prepare($countSql);
        $countStmt->execute();
        $count = $countStmt->fetchColumn();
        $hasMore = $count > ($offset+$limit);

        // get role
        session_start();
        $role = json_decode($_SESSION['role']);

        echo json_encode(array(
            "status"=>1,
            "hasMore"=>$hasMore,
            "data"=>$re,
            "roleTitle"=>$role->title,
        ));
    } catch(PDOException $ex){
        echo json_encode(array(
            "status"=>0,
            "data"=>$ex->getMessage(),
        ));
    }
?>