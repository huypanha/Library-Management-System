<?php
    class DB {
        public static $conn;

        public static function Connect() {
            $conn = new PDO("mysql:host=localhost;dbname=LMSFINAL", 'root', 'root');
            return $conn;
        }
    }
?>