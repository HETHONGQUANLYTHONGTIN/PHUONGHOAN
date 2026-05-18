<?php
session_start();
include '../../includes/config.php';

if ($_SESSION['role'] != 'y_tá') {
    header('Location: ' . SITE_URL . '/index.php');
    exit();
}

include '../../includes/header.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient = $_POST['patient'] ?? '';
    $blood_pressure = $_POST['blood_pressure'] ?? '';
    $temperature = $_POST['temperature'] ?? '';
    
    if (empty($patient) || empty($blood_pressure) || empty($temperature)) {
        $error = 'Vui lòng nhập đầy đủ thông tin sinh hiệu!';
    } else {
        $success = 'Lưu sinh hiệu ban đầu thành công!';
    }
}
?>

<div class="form-container">
    <h1>Đo Sinh Hiệu Ban Đầu</h1>
    
    <?php if ($success): ?>
        <div class="success-message"><?php echo $success; ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-group">
            <label for="patient">Bệnh Nhân <span style="color: red;">*</span></label>
            <select id="patient" name="patient" required>
                <option value="">-- Chọn Bệnh Nhân --</option>
                <option value="BN-001">BN-001 - Nguyễn Văn A</option>
                <option value="BN-002">BN-002 - Trần Thị B</option>
                <option value="BN-003">BN-003 - Lê Văn C</option>
            </select>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="blood_pressure">Huyết Áp (mmHg) <span style="color: red;">*</span></label>
                <input type="text" id="blood_pressure" name="blood_pressure" placeholder="VD: 120/80" pattern="[0-9]{2,3}/[0-9]{2,3}" required>
            </div>
            <div class="form-group">
                <label for="temperature">Nhiệt Độ (°C) <span style="color: red;">*</span></label>
                <input type="number" id="temperature" name="temperature" step="0.1" min="35" max="42" placeholder="VD: 36.5" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="heart_rate">Nhịp Tim (lần/phút) <span style="color: red;">*</span></label>
                <input type="number" id="heart_rate" name="heart_rate" min="40" max="200" placeholder="VD: 72" required>
            </div>
            <div class="form-group">
                <label for="respiratory_rate">Tần Số Hô Hấp (lần/phút) <span style="color: red;">*</span></label>
                <input type="number" id="respiratory_rate" name="respiratory_rate" min="10" max="50" placeholder="VD: 16" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="weight">Cân Nặng (kg)</label>
                <input type="number" id="weight" name="weight" step="0.1" placeholder="VD: 70.5">
            </div>
            <div class="form-group">
                <label for="height">Chiều Cao (cm)</label>
                <input type="number" id="height" name="height" placeholder="VD: 170">
            </div>
        </div>
        
        <div class="form-group">
            <label for="oxygen_saturation">Oxy Hóa (SpO2) (%)</label>
            <input type="number" id="oxygen_saturation" name="oxygen_saturation" min="0" max="100" placeholder="VD: 98">
        </div>
        
        <div class="form-group">
            <label for="notes">Ghi Chú</label>
            <textarea id="notes" name="notes" rows="3"></textarea>
        </div>
        
        <div style="text-align: center; margin-top: 25px;">
            <button type="submit" class="btn btn-primary">Lưu Sinh Hiệu</button>
            <a href="../../index.php" class="btn" style="background-color: #95a5a6; color: white;">Quay Lại</a>
        </div>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>
