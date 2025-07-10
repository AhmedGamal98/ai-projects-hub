<?php

// الاتصال بقاعدة البيانات
$conn->set_charset("utf8");

// استقبال البيانات بصيغة JSON
$input = json_decode(file_get_contents("php://input"), true);


// تنفيذ التحديث
$stmt = $conn->prepare("
    UPDATE graduation_idea_requests
    SET idea = ?, generated_at = ?, copied_status = ?, file_download_info = ?, rating = ?, suggestion = ?, view = 1
    WHERE request_id = ?
");

$stmt->bind_param("ssssisi", $idea, $generated_at, $copied_status, $file_download_info, $rating, $suggestion, $request_id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'redirect' => 'login.php']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'فشل في تحديث البيانات']);
}

$stmt->close();
?>
