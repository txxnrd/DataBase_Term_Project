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

// POST 데이터 받기
$emp_no = $_POST['emp_no'];
$year = $_POST['year'];

// 평가 데이터 삭제
$sql = "DELETE FROM Evaluation WHERE emp_no = ? AND year = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $emp_no, $year);

if ($stmt->execute()) {
    echo "Evaluation record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

// 연결 종료
$stmt->close();
$conn->close();
?>
