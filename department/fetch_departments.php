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

// 부서 정보 가져오기
$sql = "SELECT * FROM Department"; // 부서 정보 테이블 이름으로 변경
$result = $conn->query($sql);

$departments = array();
while ($row = $result->fetch_assoc()) {
    $departments[] = $row;
}

// JSON 형식으로 데이터 반환
echo json_encode($departments);

// 연결 종료
$conn->close();
?>
