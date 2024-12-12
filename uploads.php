<?php
$target_dir = "uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true); // Tự động tạo thư mục nếu chưa tồn tại
}

$target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Kiểm tra xem file có phải là ảnh không
$check = getimagesize($_FILES["profile_image"]["tmp_name"]);
if ($check !== false) {
    $uploadOk = 1;
} else {
    echo "File không phải là ảnh.";
    $uploadOk = 0;
}

// Kiểm tra kích thước file
if ($_FILES["profile_image"]["size"] > 5000000) {
    echo "File quá lớn.";
    $uploadOk = 0;
}

// Chỉ cho phép các định dạng JPG, JPEG, PNG, GIF
if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
    echo "Chỉ chấp nhận file JPG, JPEG, PNG, GIF.";
    $uploadOk = 0;
}

// Thực hiện upload file nếu hợp lệ
if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
        echo "Ảnh " . htmlspecialchars(basename($_FILES["profile_image"]["name"])) . " đã được tải lên.";
        // Lưu thông tin sản phẩm vào cơ sở dữ liệu ở đây
    } else {
        echo "Có lỗi khi tải file.";
    }
}
?>

