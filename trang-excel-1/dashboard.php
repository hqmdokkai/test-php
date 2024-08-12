<?php
// Kiểm tra nếu form được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra nếu có yêu cầu xóa dữ liệu
    if(isset($_POST["deleteIndex"])) {
        // Lấy chỉ mục cần xóa
        $deleteIndex = $_POST["deleteIndex"];
        // Đọc dữ liệu từ file JSON
        $users = json_decode(file_get_contents("data/users.json"), true);
        // Kiểm tra xem chỉ mục cần xóa có tồn tại không
        if(isset($users[$deleteIndex])) {
            // Xóa phần tử tương ứng trong mảng $users
            unset($users[$deleteIndex]);
            // Lưu lại dữ liệu mới vào file JSON
            file_put_contents("data/users.json", json_encode($users, JSON_PRETTY_PRINT));
        }
        // Chuyển hướng người dùng sau khi xóa dữ liệu thành công
        header("Location: dashboard.php");
        exit();
    } else {
        // Lấy dữ liệu từ form
        $name = $_POST["name"];
        $attribute = $_POST["attribute"];

        // Kiểm tra tính hợp lệ của dữ liệu
        if (empty($name) || empty($attribute)) {
            $error_message = "Vui lòng nhập đầy đủ thông tin.";
        } else {
            // Đọc dữ liệu từ file JSON
            $users = json_decode(file_get_contents("data/users.json"), true);

            // Thêm dữ liệu mới vào mảng
            $users[] = array("name" => $name, "attribute" => $attribute);

            // Lưu lại dữ liệu mới vào file JSON
            file_put_contents("data/users.json", json_encode($users, JSON_PRETTY_PRINT));

            // Chuyển hướng người dùng sau khi thêm dữ liệu thành công
            header("Location: dashboard.php");
            exit();
        }
    }
}

// Kiểm tra xem file JSON có tồn tại và không rỗng
if (!file_exists("data/users.json") || filesize("data/users.json") == 0) {
    // Tạo dữ liệu mặc định
    $defaultData = json_encode(array(), JSON_PRETTY_PRINT);
    // Ghi dữ liệu mặc định vào file JSON
    file_put_contents("data/users.json", $defaultData);
}

// Đọc dữ liệu từ file JSON
$users = json_decode(file_get_contents("data/users.json"), true);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Nhập tên và đặc điểm của bạn</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" id="name" name="name" placeholder="Tên">
        <input type="text" id="attribute" name="attribute" placeholder="Đặc điểm">
        <button type="submit">Thêm Dữ Liệu</button>
    </form>

    <?php if (isset($error_message)) : ?>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>

    <h2>Danh sách người dùng</h2>
    <table id="dataTable" border="1">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Đặc điểm</th>
                <th>Thao tác</th> <!-- Thêm cột mới cho nút xóa -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $index => $user) : ?>
                <tr>
                    <td><?php echo $user["name"]; ?></td>
                    <td><?php echo $user["attribute"]; ?></td>
                    <td>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="deleteIndex" value="<?php echo $index; ?>">
                            <button type="submit">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
