<?php
    require 'send_email.php';

    if(isset($_POST['desc'])){
        try {
            // get data to send
            $desc = $_POST['desc'];
            $type = $_POST['type'];
            $files = array();
            
            $fileLocation = "../upload/report/";

            // upload report images
            if(isset($_FILES['img1'])){
                $fileName = date('YmdHis')."1.".end(explode('.', $_FILES['img1']['name']));
                if(move_uploaded_file($_FILES['img1']['tmp_name'],$fileLocation."".$fileName)){
                    array_push($files, $fileName);
                }
            }

            if(isset($_FILES['img2'])){
                $fileName = date('YmdHis')."2.".end(explode('.', $_FILES['img2']['name']));
                if(move_uploaded_file($_FILES['img2']['tmp_name'],$fileLocation."".$fileName)){
                    array_push($files, $fileName);
                }
            }

            if(isset($_FILES['img3'])){
                $fileName = date('YmdHis')."3.".end(explode('.', $_FILES['img3']['name']));
                if(move_uploaded_file($_FILES['img3']['tmp_name'],$fileLocation."".$fileName)){
                    array_push($files, $fileName);
                }
            }

            // send email
            $email = new Email();
            $email->sendEmail(
                'loanms629@gmail.com', 
                'LMS '.($type == 0 ? "Feedback" : "Report"), 
                'Description: '.$desc.'<br><br>Attachments: <br>'.implode("<br>", $files).'<br><br>Regards,<br>Library Management System'
            );

            echo json_encode(array(
                "status" => 1,
                "data" => "success",
            ));
        } catch(Exception $e) {
            echo json_encode(array(
                "status" => 0,
                "data" => $e->getMessage(),
            ));
        }
    }
?>