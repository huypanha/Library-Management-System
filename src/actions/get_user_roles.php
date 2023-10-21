<?php
    // import db connection
    require '../../config/db.php';

    try {
        // connect to database
        $db = DB::Connect();

        // store result as array
        $re = array();

        $sql = "SELECT role_id, title FROM role WHERE status = 1 ORDER BY title";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        // get all records
        $rows = $stmt->fetchAll();
        
        // add all rows to $re
        foreach($rows as $row){
            $r = array(
                "id" => $row['role_id'],
                "title" => $row['title'],
            );
            array_push($re, $r);
        }

        echo json_encode(array(
            "status"=>1,
            "data"=>$re,
        ));
    } catch(PDOException $ex){
        echo json_encode(array(
            "status"=>0,
            "data"=>$ex->getMessage(),
        ));
    }
?>