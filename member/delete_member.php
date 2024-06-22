<?php
// 데이터베이스 연결 설정
$host = "localhost";
$db_id = "db2022320094"; // 데이터베이스 사용자 아이디
$db_password = "nrbsld@korea.ac.kr"; // 데이터베이스 사용자 비밀번호
$db_name = "db2022320094"; // 데이터베이스 이름

// MySQLi 연결
$conn = new mysqli($host, $db_id, $db_password, $db_name);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 폼 데이터 받기
$emp_no = $_POST['emp_no'];

// 구성원 정보 삭제
$sql = "DELETE FROM employee WHERE emp_no='$emp_no'";
if ($conn->query($sql) === TRUE) {
    // 휴대폰 정보 삭제 
    $sql_phone = "DELETE FROM Phone WHERE emp_no='$emp_no'";
    $conn->query($sql_phone);
    echo "Record deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// 연결 종료
$conn->close();
?>
