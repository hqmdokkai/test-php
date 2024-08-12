<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
  </head>
  <body>
    <h2>Trang Đăng Nhập</h2>
    <div>
      <label for="username">Tên đăng nhập:</label>
      <input type="text" id="username" required />
    </div>
    <div>
      <label for="password">Mật khẩu:</label>
      <input type="password" id="password" required />
    </div>
    <button onclick="login()">Đăng nhập</button>
    <script>
      function login() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        // Thông tin đăng nhập giả định
        var defaultUsername = "admin";
        var defaultPassword = "1234";

        if (username === defaultUsername && password === defaultPassword) {
          alert("Đăng nhập thành công!");
          // Chuyển hướng đến trang mới sau khi đăng nhập thành công
          window.location.href = "dashboard.php"; // Thay 'dashboard.html' bằng đường dẫn tương đối hoặc tuyệt đối đến trang bạn muốn chuyển hướng
        } else {
          alert("Thông tin đăng nhập không chính xác!");
        }
      }
    </script>
  </body>
</html>