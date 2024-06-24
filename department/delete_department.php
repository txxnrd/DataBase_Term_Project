<?php
include "../config.php";


// 폼 데이터 받기
$dept_number = $_POST['dept_number'];

// 트랜잭션 시작
$conn->begin_transaction();

try {
    // 부서 정보 삭제
    $sql = "DELETE FROM Department WHERE dept_number='$dept_number'";
    if ($conn->query($sql) === TRUE) {
        // 트랜잭션 커밋
        $conn->commit();
        echo "Department record deleted successfully";
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
