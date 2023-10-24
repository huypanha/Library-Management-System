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
            $sql = "SELECT * FROM books WHERE status=1 AND (title LIKE '%$key%' OR id LIKE '$key%') ORDER BY id DESC";
        } else {
            // create query to get student
            $sql = "SELECT * FROM books WHERE status=1 ORDER BY id DESC";
        }

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
                "title" => $row['title'],
                "desc" => $row['description'],
                "author" => $row['author'],
                "pub" => $row['publisher'],
                "price" => $row['price'],
                "cover" => $row['cover'],
                "cate" => $row['category'],
                "createdBy" => $row['created_by'],
                "createdDate" => $row['created_date'],
                "updatedBy" => $row['updated_by'],
                "updatedDate" => $row['updated_date'],
            );
            array_push($re, $r);
        }

        // count all books to know have more or not
        $countSql = "SELECT COUNT(*) FROM books WHERE status=1";
        if(isset($_GET['searchKey'])){
            $countSql .= " AND (title LIKE '%$key%' OR id LIKE '$key%') ORDER BY id DESC";
        }
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