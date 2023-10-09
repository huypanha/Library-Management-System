<?php
    header('Content-Type: application/vnd.ms-excel');  
    header('Content-disposition: attachment; filename=LMS_'.rand().'.csv');  
    echo "Hello, World";  
    exit;
?>