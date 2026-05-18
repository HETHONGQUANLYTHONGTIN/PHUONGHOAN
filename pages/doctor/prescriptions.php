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
    $medications = $_POST['medications'] ?? '';
    
    if (empty($patient) || empty($medications)) {
        $error = 'Vui lòng chọn bệnh nhân và thêm thuốc!';
    } else {
        $success = 'Kê đơn thuốc thành công! Mã đơn: ĐT-' . date('YmdHis');
    }
}
?>

<div class="form-container">
    <h1>Kê Đơn Thuốc</h1>
    
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
                <option value="BN-004">BN-004 - Phạm Thị D</option>
            </select>
        </div>
        
        <div style="margin-bottom: 20px;">
            <label>Thêm Thuốc:</label>
            <div style="display: flex; gap: 10px; margin-bottom: 10px;">
                <input type="text" id="medicationName" placeholder="Tên thuốc" style="flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                <input type="number" id="medicationDosage" placeholder="Liều dùng" style="width: 120px; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                <select id="medicationUnit" style="width: 100px; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                    <option value="viên">Viên</option>
                    <option value="ml">ml</option>
                    <option value="g">g</option>
                </select>
                <button type="button" class="btn btn-primary" onclick="addMedication()">Thêm</button>
            </div>
        </div>
        
        <div class="table-container">
            <table id="medicationTable">
                <thead>
                    <tr>
                        <th>Tên Thuốc</th>
                        <th>Liều Dùng</th>
                        <th>Cách Dùng</th>
                        <th>Số Ngày</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Paracetamol</td>
                        <td>1 viên</td>
                        <td>Uống 3 lần/ngày sau ăn</td>
                        <td>3 ngày</td>
                        <td><button type="button" class="btn btn-danger" onclick="removeMedication(this)">Xóa</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="form-group" style="margin-top: 20px;">
            <label for="instructions">Hướng Dẫn Sử Dụng</label>
            <textarea id="instructions" name="instructions" rows="4" placeholder="Ghi chú và hướng dẫn cho bệnh nhân"></textarea>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="refills">Số Lần Tái Phát Hành</label>
                <input type="number" id="refills" name="refills" value="0" min="0">
            </div>
            <div class="form-group">
                <label for="expiry_date">Ngày Hết Hiệu Lực</label>
                <input type="date" id="expiry_date" name="expiry_date">
            </div>
        </div>
        
        <div style="text-align: center; margin-top: 25px;">
            <button type="submit" class="btn btn-primary">Kê Đơn Thuốc</button>
            <a href="appointments.php" class="btn" style="background-color: #95a5a6; color: white;">Quay Lại</a>
        </div>
    </form>
</div>

<script>
function addMedication() {
    alert('Thêm thuốc vào đơn');
}

function removeMedication(btn) {
    btn.closest('tr').remove();
}
</script>

<?php include '../../includes/footer.php'; ?>
