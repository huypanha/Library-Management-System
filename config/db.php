<?php
    class DB {
        public static $conn;

        public static function Connect() {
            $conn = new PDO("mysql:host=localhost;dbname=LMSFINAL", 'root', 'root');
            // $conn = new PDO("mysql:host=sql311.infinityfree.com;dbname=if0_35228224_lms", 'if0_35228224', 'E6McsvDfj1V4');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
    }
?>