<?php
include "../config.php";

// MySQLi 연결
$conn = new mysqli($host, $db_id, $db_password, $db_name);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


try {
    // 트랜잭션 시작
    $conn->begin_transaction();

    // 폼 데이터 받기
    $name = $_POST['name'];
    $date_of_birth = $_POST['date_of_birth'];
    $date_of_joining = $_POST['date_of_joining'];
    $phones = $_POST['phones'];

    // 구성원 정보 저장
    $sql = "INSERT INTO employee (name, date_of_birth, date_of_joining) VALUES ('$name', '$date_of_birth', '$date_of_joining')";
    if ($conn->query($sql) === TRUE) {
        $emp_no = $conn->insert_id; // 삽입된 구성원의 ID 가져오기
        
        // 휴대폰 정보 저장
        foreach ($phones as $phone) {
            $sql_phone = "INSERT INTO Phone (emp_no, phone_number) VALUES ('$emp_no', '$phone')";
            $conn->query($sql_phone);
        }
        // 트랜잭션 커밋
        $conn->commit();
        echo "New record created successfully";
        header("Location: member_info_index.php");
        exit();
    } else {
        // 트랜잭션 롤백
        $conn->rollback();
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} catch (Exception $e) {
    // 트랜잭션 롤백
    $conn->rollback();
    echo "Transaction failed: " . $e->getMessage();
}

// 연결 종료
$conn->close();
?>