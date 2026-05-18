<?php
session_start();
include 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    
    if (empty($username) || empty($password)) {
        $error = 'Vui lòng nhập tên đăng nhập và mật khẩu!';
    } else {
        // Kiểm tra thông tin đăng nhập từ database
        $sql = "SELECT * FROM người_dùng WHERE username = '" . escape($username) . "' LIMIT 1";
        $result = query($sql);
        
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Kiểm tra mật khẩu (MD5 hash trong database)
            if (md5($password) == $user['password']) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_name'] = $user['full_name'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['username'] = $user['username'];
                
                // Ghi log đăng nhập
                $login_time = date('Y-m-d H:i:s');
                $conn->query("INSERT INTO audit_logs (user_id, action, description, timestamp) 
                            VALUES ({$user['user_id']}, 'LOGIN', 'Đăng nhập hệ thống', '$login_time')");
                
                header('Location: index.php');
                exit();
            } else {
                $error = 'Mật khẩu không đúng!';
            }
        } else {
            $error = 'Tên đăng nhập không tồn tại!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - HTTTQL</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-box">
            <h1>HTTTQL - Hệ thống Quản lý Bệnh viện</h1>
            <form method="POST">
                <?php if (isset($error)): ?>
                    <div class="error-message"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="username">Tên đăng nhập:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Mật khẩu:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </form>
            
            <div class="demo-accounts">
                <h3>Tài khoản Demo:</h3>
                <ul>
                    <li><strong>reception</strong> - Tiếp đón & Thu ngân</li>
                    <li><strong>doctor</strong> - Bác sĩ</li>
                    <li><strong>nurse</strong> - Y tá</li>
                    <li><strong>lab</strong> - Cận lâm sàng</li>
                    <li><strong>pharmacy</strong> - Kho dược</li>
                    <li><strong>admin</strong> - Admin</li>
                </ul>
                <p><em>Mật khẩu cho tất cả: pass123</em></p>
            </div>
        </div>
    </div>
</body>
</html>
