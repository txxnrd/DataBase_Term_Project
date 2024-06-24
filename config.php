<?php
// 데이터베이스 연결 설정
$host = "localhost";
$db_id = "db2022320094"; // 데이터베이스 사용자 아이디
$db_password = "secret_key"; // 데이터베이스 사용자 비밀번호
$db_name = "db2022320094"; // 데이터베이스 이름

// MySQLi 연결
$conn = new mysqli($host, $db_id, $db_password, $db_name);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
