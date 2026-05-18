<?php
session_start();
include '../../includes/config.php';

// Kiểm tra quyền
require_login();
if ($_SESSION['role'] != 'tiếp_đón_thu_ngân') {
    header('Location: ' . SITE_URL . '/index.php');
    exit();
}

include '../../includes/header.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $date_of_birth = trim($_POST['date_of_birth'] ?? '');
    $gender = trim($_POST['gender'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $insurance_code = trim($_POST['insurance_code'] ?? '');
    
    // Validation
    if (empty($full_name) || empty($date_of_birth) || empty($phone)) {
        $error = 'Vui lòng điền đầy đủ thông tin bắt buộc!';
    } else {
        // Tạo mã bệnh nhân
        $patient_code = generate_code('BN-', 'patients', 'patient_code');
        
        // Lưu vào database
        $sql = "INSERT INTO patients (
                    patient_code, full_name, date_of_birth, gender, 
                    phone, email, address, insurance_code, created_at
                ) VALUES (
                    '" . escape($patient_code) . "',
                    '" . escape($full_name) . "',
                    '" . escape($date_of_birth) . "',
                    '" . escape($gender) . "',
                    '" . escape($phone) . "',
                    '" . escape($email) . "',
                    '" . escape($address) . "',
                    '" . escape($insurance_code) . "',
                    NOW()
                )";
        
        if ($conn->query($sql)) {
            $patient_id = $conn->insert_id;
            $success = "✅ Đăng ký thành công! Mã bệnh nhân: <strong>$patient_code</strong>";
            
            // Ghi log
            $conn->query("INSERT INTO audit_logs (user_id, action, description, timestamp) 
                        VALUES ({$_SESSION['user_id']}, 'PATIENT_REGISTRATION', 
                        'Đăng ký bệnh nhân: $patient_code', NOW())");
        } else {
            $error = '❌ Lỗi: ' . $conn->error;
        }
    }
}
?>

<div class="form-container">
    <h1>Đăng ký Thông Tin Bệnh Nhân</h1>
    
    <?php if ($success): ?>
        <div class="success-message"><?php echo $success; ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-row">
            <div class="form-group">
                <label for="full_name">Tên bệnh nhân <span style="color: red;">*</span></label>
                <input type="text" id="full_name" name="full_name" required>
            </div>
            <div class="form-group">
                <label for="date_of_birth">Ngày sinh <span style="color: red;">*</span></label>
                <input type="date" id="date_of_birth" name="date_of_birth" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="gender">Giới tính</label>
                <select id="gender" name="gender">
                    <option value="">-- Chọn --</option>
                    <option value="male">Nam</option>
                    <option value="female">Nữ</option>
                    <option value="other">Khác</option>
                </select>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại <span style="color: red;">*</span></label>
                <input type="tel" id="phone" name="phone" pattern="[0-9\-\+\s]+" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="insurance_code">Mã bảo hiểm y tế</label>
                <input type="text" id="insurance_code" name="insurance_code">
            </div>
        </div>
        
        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <textarea id="address" name="address" rows="3"></textarea>
        </div>
        
        <div style="text-align: center; margin-top: 25px;">
            <button type="submit" class="btn btn-primary">Đăng Ký Bệnh Nhân</button>
            <a href="../../index.php" class="btn" style="background-color: #95a5a6; color: white;">Quay Lại</a>
        </div>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>
