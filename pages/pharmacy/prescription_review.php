<?php
session_start();
include '../../includes/config.php';

if ($_SESSION['role'] != 'kho_dược') {
    header('Location: ' . SITE_URL . '/index.php');
    exit();
}

include '../../includes/header.php';

$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action == 'approve') {
        $success = 'Duyệt đơn thành công!';
    } elseif ($action == 'dispense') {
        $success = 'Phát thuốc thành công!';
    }
}
?>

<div class="table-container">
    <h1>Duyệt Đơn / Phát Thuốc Bệnh Nhân</h1>
    
    <?php if ($success): ?>
        <div class="success-message"><?php echo $success; ?></div>
    <?php endif; ?>
    
    <div style="margin-bottom: 20px; display: flex; gap: 10px;">
        <select id="filterStatus" style="padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            <option value="">-- Tất Cả --</option>
            <option value="pending">Chờ Duyệt</option>
            <option value="approved">Đã Duyệt</option>
            <option value="dispensed">Đã Phát</option>
        </select>
        <input type="date" id="filterDate" style="padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        <button class="btn btn-primary" onclick="filterPrescriptions()">Lọc</button>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Mã Đơn</th>
                <th>Bệnh Nhân</th>
                <th>Bác Sĩ Kê Đơn</th>
                <th>Số Loại Thuốc</th>
                <th>Ngày Kê</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>ĐT-001</td>
                <td>Nguyễn Văn A</td>
                <td>Dr. Nguyễn Văn A</td>
                <td>3</td>
                <td>2026-05-18</td>
                <td><span style="background-color: #fff3cd; padding: 4px 8px; border-radius: 4px; color: #856404;">Chờ Duyệt</span></td>
                <td>
                    <button class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;" onclick="viewPrescription('ĐT-001')">Xem Chi Tiết</button>
                </td>
            </tr>
            <tr>
                <td>ĐT-002</td>
                <td>Trần Thị B</td>
                <td>Dr. Trần Thị B</td>
                <td>2</td>
                <td>2026-05-18</td>
                <td><span style="background-color: #d4edda; padding: 4px 8px; border-radius: 4px; color: #27ae60;">Đã Duyệt</span></td>
                <td>
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="action" value="dispense">
                        <button type="submit" class="btn btn-success" style="padding: 6px 12px; font-size: 12px;">Phát Thuốc</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>ĐT-003</td>
                <td>Lê Văn C</td>
                <td>Dr. Lê Văn C</td>
                <td>4</td>
                <td>2026-05-17</td>
                <td><span style="background-color: #d1ecf1; padding: 4px 8px; border-radius: 4px; color: #0c5460;">Đã Phát</span></td>
                <td>
                    <button class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;" onclick="viewPrescription('ĐT-003')">Chi Tiết</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div style="text-align: center; margin-top: 20px;">
    <a href="../../index.php" class="btn" style="background-color: #95a5a6; color: white;">Quay Lại</a>
</div>

<script>
function filterPrescriptions() {
    alert('Lọc đơn thuốc');
}

function viewPrescription(prescriptionId) {
    alert('Xem chi tiết đơn: ' + prescriptionId);
}
</script>

<?php include '../../includes/footer.php'; ?>
