<?php
session_start();
include '../../includes/config.php';

if ($_SESSION['role'] != 'bác_sĩ') {
    header('Location: ' . SITE_URL . '/index.php');
    exit();
}

include '../../includes/header.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient = $_POST['patient'] ?? '';
    $test_type = $_POST['test_type'] ?? '';
    $urgency = $_POST['urgency'] ?? '';
    
    if (empty($patient) || empty($test_type)) {
        $error = 'Vui lòng chọn bệnh nhân và loại xét nghiệm!';
    } else {
        $success = 'Ra lệnh xét nghiệm thành công! Mã lệnh: XN-' . date('YmdHis');
    }
}
?>

<div class="form-container">
    <h1>Ra Lệnh Xét Nghiệm</h1>
    
    <?php if ($success): ?>
        <div class="success-message"><?php echo $success; ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-row">
            <div class="form-group">
                <label for="patient">Bệnh Nhân <span style="color: red;">*</span></label>
                <select id="patient" name="patient" required>
                    <option value="">-- Chọn Bệnh Nhân --</option>
                    <option value="BN-001">BN-001 - Nguyễn Văn A</option>
                    <option value="BN-002">BN-002 - Trần Thị B</option>
                    <option value="BN-003">BN-003 - Lê Văn C</option>
                    <option value="BN-004">BN-004 - Phạm Thị D</option>
                </select>
            </div>
            <div class="form-group">
                <label for="test_type">Loại Xét Nghiệm <span style="color: red;">*</span></label>
                <select id="test_type" name="test_type" required>
                    <option value="">-- Chọn Loại --</option>
                    <option value="blood">Xét Nghiệm Máu</option>
                    <option value="urine">Xét Nghiệm Nước Tiểu</option>
                    <option value="stool">Xét Nghiệm Phân</option>
                    <option value="glucose">Glucose</option>
                    <option value="cholesterol">Cholesterol</option>
                </select>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="urgency">Mức Độ Ưu Tiên</label>
                <select id="urgency" name="urgency">
                    <option value="normal">Bình Thường</option>
                    <option value="urgent">Cấp Tính</option>
                </select>
            </div>
            <div class="form-group">
                <label for="indication">Chỉ Định</label>
                <input type="text" id="indication" name="indication" placeholder="Lý do yêu cầu xét nghiệm">
            </div>
        </div>
        
        <div class="form-group">
            <label for="notes">Ghi Chú</label>
            <textarea id="notes" name="notes" rows="3"></textarea>
        </div>
        
        <div style="text-align: center; margin-top: 25px;">
            <button type="submit" class="btn btn-primary">Ra Lệnh Xét Nghiệm</button>
            <a href="appointments.php" class="btn" style="background-color: #95a5a6; color: white;">Quay Lại</a>
        </div>
    </form>
    
    <div class="table-container" style="margin-top: 40px;">
        <h2>Danh Sách Lệnh Xét Nghiệm Gần Đây</h2>
        <table>
            <thead>
                <tr>
                    <th>Mã Lệnh</th>
                    <th>Bệnh Nhân</th>
                    <th>Loại Xét Nghiệm</th>
                    <th>Mức Độ Ưu Tiên</th>
                    <th>Ngày Tạo</th>
                    <th>Trạng Thái</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>XN-001</td>
                    <td>Nguyễn Văn A</td>
                    <td>Xét Nghiệm Máu</td>
                    <td>Bình Thường</td>
                    <td>2026-05-18</td>
                    <td><span style="background-color: #d4edda; padding: 4px 8px; border-radius: 4px; color: #27ae60;">Hoàn Tất</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
