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
            $sql = "SELECT u.*, r.title, u2.username, u3.username
                FROM user u LEFT JOIN role r 
                ON u.role_id = r.role_id 
                LEFT JOIN user u2 ON u.created_by = u2.user_id
                LEFT JOIN user u3 ON u.updated_by = u3.user_id
                WHERE u.status = 1 AND (u.user_id LIKE '$key%' OR u.username LIKE '%$key%') ";
        } else {
            // create query to get student
            $sql = `SELECT u.*, r.title, u2.username, u3.username
                FROM user u LEFT JOIN role r 
                ON u.role_id = r.role_id 
                LEFT JOIN user u2 ON u.created_by = u2.user_id
                LEFT JOIN user u3 ON u.updated_by = u3.user_id
                WHERE u.status = 1 `;
        }
            
        if(isset($_GET['startDate'])){
            $sql .= "AND br.created_date >= '".$_GET['startDate']."' AND br.created_date <= '". $_GET['endDate']." 23:59:59' ";
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
                "id" => $row['user_id'],
                "username" => $row['username'],
                "gender" => $row['gender'],
                "phone" => $row['phone'],
                "email" => $row['qty'],
                "roleId" => $row['role_id'],
                "roleTitle" => $row['title'],
                "addr" => $row['address'],
                "profile" => $row['profile_img'],
                "createdById" => $row['created_by'],
                "createdBy" => $row['u2.username'],
                "createdDate" => $row['created_date'],
                "updatedById" => $row['updated_by'],
                "updatedBy" => $row['u3.username'],
                "updatedDate" => $row['updated_date'],
            );
            array_push($re, $r);
        }

        // count all users to know have more or not
        $countSql = "SELECT COUNT(*) FROM user WHERE status=1";
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