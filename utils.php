<?php 
    require_once("conn.php");
    function generateToken(){
        $token = "";
        for( $i = 0; $i < 16; $i++ ){
            $token .= chr(mt_rand(65,90));
        }
        return $token;
    }

    function getUserFromToken($token){
        global $conn;
        $sql = sprintf("SELECT username FROM tokens WHERE token='%s'", $token);
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $username = $row['username'];

        $sql = sprintf("SELECT * FROM users WHERE username='%s'", $username);
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    
    }
?>