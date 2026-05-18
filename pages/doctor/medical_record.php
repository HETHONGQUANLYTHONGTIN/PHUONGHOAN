<?php
session_start();
include '../../includes/config.php';

if ($_SESSION['role'] != 'bác_sĩ') {
    header('Location: ' . SITE_URL . '/index.php');
    exit();
}

include '../../includes/header.php';

$patient = $_GET['patient'] ?? '';
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $symptoms = $_POST['symptoms'] ?? '';
    $diagnosis = $_POST['diagnosis'] ?? '';
    $treatment = $_POST['treatment'] ?? '';
    
    if (empty($symptoms) || empty($diagnosis)) {
        $error = 'Vui lòng nhập triệu chứng và chẩn đoán!';
    } else {
        $success = 'Lưu hồ sơ bệnh án thành công!';
    }
}
?>

<div class="form-container">
    <h1>Nhập Hồ Sơ Bệnh Án</h1>
    
    <div style="margin-bottom: 20px; padding: 15px; background-color: #f9f9f9; border-radius: 4px;">
        <p><strong>Mã Bệnh Nhân:</strong> <?php echo htmlspecialchars($patient); ?></p>
        <p><strong>Tên Bệnh Nhân:</strong> Nguyễn Văn A</p>
        <p><strong>Tuổi:</strong> 35 | <strong>Giới Tính:</strong> Nam</p>
        <p><strong>BHYT:</strong> AA123456789</p>
    </div>
    
    <?php if ($success): ?>
        <div class="success-message"><?php echo $success; ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-group">
            <label for="symptoms">Triệu Chứng <span style="color: red;">*</span></label>
            <textarea id="symptoms" name="symptoms" required></textarea>
            <small style="color: #666;">Mô tả chi tiết triệu chứng bệnh nhân</small>
        </div>
        
        <div class="form-group">
            <label for="diagnosis">Chẩn Đoán <span style="color: red;">*</span></label>
            <textarea id="diagnosis" name="diagnosis" required></textarea>
            <small style="color: #666;">Mã bệnh (ICD-10), tên bệnh</small>
        </div>
        
        <div class="form-group">
            <label for="treatment">Phương Pháp Điều Trị</label>
            <textarea id="treatment" name="treatment"></textarea>
            <small style="color: #666;">Hướng dẫn điều trị cho bệnh nhân</small>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="blood_pressure">Huyết Áp:</label>
                <input type="text" id="blood_pressure" name="blood_pressure" placeholder="VD: 120/80">
            </div>
            <div class="form-group">
                <label for="temperature">Nhiệt Độ (°C):</label>
                <input type="number" id="temperature" name="temperature" step="0.1" placeholder="VD: 36.5">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="heart_rate">Nhịp Tim (lần/phút):</label>
                <input type="number" id="heart_rate" name="heart_rate" placeholder="VD: 72">
            </div>
            <div class="form-group">
                <label for="respiratory_rate">Tần Số Hô Hấp (lần/phút):</label>
                <input type="number" id="respiratory_rate" name="respiratory_rate" placeholder="VD: 16">
            </div>
        </div>
        
        <div style="text-align: center; margin-top: 25px;">
            <button type="submit" class="btn btn-primary">Lưu Hồ Sơ Bệnh Án</button>
            <a href="appointments.php" class="btn" style="background-color: #95a5a6; color: white;">Quay Lại</a>
        </div>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>
