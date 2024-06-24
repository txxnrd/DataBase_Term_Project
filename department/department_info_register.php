<?php
// 데이터베이스 연결 설정
$host = "localhost";
$db_id = "db2022320094"; // 데이터베이스 사용자 아이디
$db_password = "secret"; // 데이터베이스 사용자 비밀번호
$db_name = "db2022320094"; // 데이터베이스 이름

// MySQLi 연결
$conn = new mysqli($host, $db_id, $db_password, $db_name);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 폼 데이터 받기
$dept_number = $_POST['dept_number'];
$dept_name = $_POST['dept_name'];
$dept_head = $_POST['dept_head'];
$dept_established_date = $_POST['dept_established_date'];
$dept_location = $_POST['dept_location'];

// 부서 정보 저장
$sql = "INSERT INTO Department (dept_number, dept_name, dept_head, dept_established_date, dept_location) 
        VALUES ('$dept_number', '$dept_name', '$dept_head', '$dept_established_date', '$dept_location')";

if ($conn->query($sql) === TRUE) {
    echo "New department record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// 연결 종료
$conn->close();
?>
