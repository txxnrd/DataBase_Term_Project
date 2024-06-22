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

// 평가 데이터 가져오기
$sql = "SELECT e.emp_no, e.year, e.achievement, e.leadership, e.teamwork, e.problem_solving, e.communication, emp.name 
        FROM Evaluation e
        JOIN employee emp ON e.emp_no = emp.emp_no";
$result = $conn->query($sql);

$evaluations = array();
while ($row = $result->fetch_assoc()) {
    $evaluations[] = $row;
}

// JSON 형식으로 데이터 반환
echo json_encode($evaluations);

// 연결 종료
$conn->close();
?>
