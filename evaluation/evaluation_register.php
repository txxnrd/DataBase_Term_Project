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
$emp_no = $_POST['emp_no'];
$year = $_POST['year'];
$achievement = $_POST['achievement'];
$leadership = $_POST['leadership'];
$teamwork = $_POST['teamwork'];
$problem_solving = $_POST['problem_solving'];
$communication = $_POST['communication'];

// 인사 평가 정보 저장
$sql = "INSERT INTO Evaluation (emp_no, year, achievement, leadership, teamwork, problem_solving, communication) 
        VALUES ('$emp_no', '$year', '$achievement', '$leadership', '$teamwork', '$problem_solving', '$communication')";

if ($conn->query($sql) === TRUE) {
    echo "New evaluation record created successfully";
    header("Location: evaluation_index.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// 연결 종료
$conn->close();
?>
