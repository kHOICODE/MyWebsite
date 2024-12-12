<?php
include 'Dtb_Connect.php';

// Lấy thông tin người dùng mặc định (id = 1)
$user_id = 1;
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Kiểm tra và hiển thị dữ liệu nếu có
echo "<h2>Hồ sơ người dùng</h2>";
if ($user) {
    echo "<p><strong>Họ và tên:</strong> " . (!empty($user['name']) ? htmlspecialchars($user['name']) : "Chưa cập nhật") . "</p>";
    echo "<p><strong>Email:</strong> " . (!empty($user['email']) ? htmlspecialchars($user['email']) : "Chưa cập nhật") . "</p>";
    echo "<p><strong>Địa chỉ:</strong> " . (!empty($user['address']) ? htmlspecialchars($user['address']) : "Chưa cập nhật") . "</p>";
    echo "<p><strong>Số điện thoại:</strong> " . (!empty($user['phone']) ? htmlspecialchars($user['phone']) : "Chưa cập nhật") . "</p>";
} else {
    echo "<p>Không tìm thấy thông tin người dùng.</p>";
}
?>
