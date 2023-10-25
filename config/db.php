<?php
    class DB {
        public static $conn;

        public static function Connect() {
            $conn = new PDO("mysql:host=localhost;dbname=LMSFINAL", 'root', 'root');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
    }
?>