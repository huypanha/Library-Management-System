<?php
    // import db connection
    require '../../config/db.php';

    try {
        // connect to database
        $db = DB::Connect();

        // get student
        $sql = "SELECT * FROM student ORDER BY stu_id DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();

        // store result as array
        $re = array();

        // get all records
        $rows = $stmt->fetchAll();
        
        // add all rows to $re
        foreach($rows as $row){
            $r = array(
                "stuId" => $row['stu_id'],
            );
            array_push($re, $r);
        }

        echo json_encode(array(
            "status"=>0,
            "data"=>$re,
        ));
    } catch(PDOException $ex){
        echo json_encode(array(
            "status"=>0,
            "data"=>$ex->getMessage(),
        ));
    }
?>