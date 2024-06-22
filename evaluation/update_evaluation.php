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
$year = $_POST['year'];
$achievement = $_POST['achievement'];
$leadership = $_POST['leadership'];
$teamwork = $_POST['teamwork'];
$problem_solving = $_POST['problem_solving'];
$communication = $_POST['communication'];

// 인사 평가 정보 업데이트
$sql = "UPDATE Evaluation 
        SET  year='$year', achievement='$achievement', leadership='$leadership', teamwork='$teamwork', problem_solving='$problem_solving', communication='$communication' 
        WHERE emp_no='$emp_no' AND year='$year'";

if ($conn->query($sql) === TRUE) {
    echo "Evaluation record updated successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// 연결 종료a
$conn->close();
?>
