<?php
include "../config.php";

// 트랜잭션 시작
$conn->begin_transaction();

try{

$emp_id = $_GET['emp_id'];

// 구성원 정보 가져오기
$sql = "SELECT * FROM employee WHERE emp_no = '$emp_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $member = $result->fetch_assoc();
    
    // 휴대폰 번호 가져오기
    $sql_phones = "SELECT phone_number FROM Phone WHERE emp_no='$emp_id'";
    $result_phones = $conn->query($sql_phones);
    $phones = array();
    while ($row_phone = $result_phones->fetch_assoc()) {
        $phones[] = $row_phone['phone_number'];
    }
    $member['phones'] = $phones;

    // JSON 형식으로 데이터 반환
    echo json_encode($member);
} else {
    echo json_encode(null); // 데이터가 없을 경우 null 반환
}

}
catch (Exception $e) {
    // 트랜잭션 롤백
    $conn->rollback();
    echo "Transaction failed: " . $e->getMessage();
}


// 연결 종료
$conn->close();
?>
