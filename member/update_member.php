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
$name = $_POST['name'];
$date_of_birth = $_POST['date_of_birth'];
$date_of_joining = $_POST['date_of_joining'];
$phones = $_POST['phones'];

// 구성원 정보 업데이트
$sql = "UPDATE employee 
        SET name='$name',  date_of_birth='$date_of_birth', date_of_joining='$date_of_joining' 
        WHERE emp_no='$emp_no'";

if ($conn->query($sql) === TRUE) {
    // 기존 전화번호 삭제
    $sql_delete_phones = "DELETE FROM Phone WHERE emp_no='$emp_no'";
    $conn->query($sql_delete_phones);

    // 새로운 전화번호 삽입
    foreach ($phones as $phone) {
        $sql_phone = "INSERT INTO Phone (emp_no, phone_number) VALUES ('$emp_no', '$phone')";
        $conn->query($sql_phone);
    }

    echo "Member record updated successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// 연결 종료
$conn->close();
?>
