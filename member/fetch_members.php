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

// 구성원 정보 가져오기
$sql = "SELECT * FROM employee";
$result = $conn->query($sql);

$members = array();
while ($row = $result->fetch_assoc()) {
    $emp_no = $row['emp_no'];
    $sql_phones = "SELECT phone_number FROM Phone WHERE emp_no='$emp_no'";
    $result_phones = $conn->query($sql_phones);
    $phones = array();
    while ($row_phone = $result_phones->fetch_assoc()) {
        $phones[] = $row_phone['phone_number'];
    }
    $row['phones'] = $phones;
    $members[] = $row;
}

// JSON 형식으로 데이터 반환
echo json_encode($members);

// 연결 종료
$conn->close();
?>
