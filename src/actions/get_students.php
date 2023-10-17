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

        if(isset($_GET['searchKey'])){
            // get offset and limit
            $key = strtolower($_GET['searchKey']);

            // create query to search student
            $sql = "SELECT * FROM student WHERE status=1 AND (first_name LIKE '%$key%' OR last_name LIKE '%$key%' OR stu_id LIKE '$key%') ORDER BY stu_id DESC";
        } else {
            $startDate = $_GET['startDate'];
            $endDate = $_GET['endDate'];
            $isBlackList = $_GET['isBlackList'];

            // create query to get student
            $sql = "SELECT * FROM student WHERE status=1 ";

            // if user filter date
            if($startDate != '' && $endDate != ''){
                $sql .= "AND created_date>='".$startDate."' AND created_date<='".$endDate."' ";
            }

            // if user filter black list
            if($isBlackList != ''){
                $sql .= "AND is_black_list=".$isBlackList." ";
            }

            $sql .= "ORDER BY stu_id DESC";
        }

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
                "stuId" => $row['stu_id'],
                "firstName" => $row['first_name'],
                "lastName" => $row['last_name'],
                "gender" => $row['gender'],
                "contact" => $row['contact'],
                "dob" => $row['dob'],
                "addr" => $row['address'],
                "isBlackList" => $row['is_black_list'],
                "createdBy" => $row['created_by'],
                "createdDate" => $row['created_date'],
                "updatedBy" => $row['updated_by'],
                "updatedDate" => $row['updated_date'],
                "status" => $row['status'],
            );
            array_push($re, $r);
        }

        // count all student to know have more or not
        $countSql = "SELECT COUNT(*) FROM student WHERE status=1";
        $countStmt = $db->prepare($countSql);
        $countStmt->execute();
        $count = $countStmt->fetchColumn();
        $hasMore = $count > ($offset+$limit);

        echo json_encode(array(
            "status"=>1,
            "hasMore"=>$hasMore,
            "data"=>$re,
        ));
    } catch(PDOException $ex){
        echo json_encode(array(
            "status"=>0,
            "data"=>$ex->getMessage(),
        ));
    }
?>