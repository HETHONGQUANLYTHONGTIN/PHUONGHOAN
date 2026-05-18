<?php
session_start();
include '../../includes/config.php';

if ($_SESSION['role'] != 'y_tá') {
    header('Location: ' . SITE_URL . '/index.php');
    exit();
}

include '../../includes/header.php';

$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action == 'dispense') {
        $success = 'Xác nhận phát thuốc thành công!';
    } elseif ($action == 'inject') {
        $success = 'Xác nhận tiêm thuốc thành công!';
    }
}
?>

<div class="table-container">
    <h1>Lịch Phát Thuốc / Tiêm Thuốc</h1>
    
    <?php if ($success): ?>
        <div class="success-message"><?php echo $success; ?></div>
    <?php endif; ?>
    
    <div style="margin-bottom: 20px; display: flex; gap: 10px;">
        <input type="date" id="filterDate" style="padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        <select id="filterType" style="padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            <option value="">-- Tất Cả --</option>
            <option value="dispense">Phát Thuốc</option>
            <option value="inject">Tiêm Thuốc</option>
        </select>
        <button class="btn btn-primary" onclick="filterSchedule()">Lọc</button>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Thời Gian</th>
                <th>Bệnh Nhân</th>
                <th>Loại</th>
                <th>Thuốc / Liều Dùng</th>
                <th>Ghi Chú</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>08:00</td>
                <td>Nguyễn Văn A</td>
                <td><span style="background-color: #d4edda; padding: 4px 8px; border-radius: 4px;">Phát Thuốc</span></td>
                <td>Paracetamol 500mg - 1 viên</td>
                <td>Uống sau ăn</td>
                <td><span style="background-color: #fff3cd; padding: 4px 8px; border-radius: 4px;">Chưa Thực Hiện</span></td>
                <td>
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="action" value="dispense">
                        <button type="submit" class="btn btn-success" style="padding: 6px 12px; font-size: 12px;">Xác Nhận</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>10:00</td>
                <td>Trần Thị B</td>
                <td><span style="background-color: #d1ecf1; padding: 4px 8px; border-radius: 4px;">Tiêm Thuốc</span></td>
                <td>Penicillin 2M - 1 lần</td>
                <td>Tiêm bắp tay trái</td>
                <td><span style="background-color: #fff3cd; padding: 4px 8px; border-radius: 4px;">Chưa Thực Hiện</span></td>
                <td>
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="action" value="inject">
                        <button type="submit" class="btn btn-success" style="padding: 6px 12px; font-size: 12px;">Xác Nhận</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>14:00</td>
                <td>Lê Văn C</td>
                <td><span style="background-color: #d4edda; padding: 4px 8px; border-radius: 4px;">Phát Thuốc</span></td>
                <td>Vitamin C 1000mg - 1 viên</td>
                <td>Uống trước bữa sáng</td>
                <td><span style="background-color: #d4edda; padding: 4px 8px; border-radius: 4px; color: #27ae60;">Đã Thực Hiện</span></td>
                <td>
                    <button class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;" onclick="viewRecord()">Xem Chi Tiết</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div style="text-align: center; margin-top: 20px;">
    <a href="../../index.php" class="btn" style="background-color: #95a5a6; color: white;">Quay Lại</a>
</div>

<script>
function filterSchedule() {
    alert('Lọc lịch phát thuốc / tiêm thuốc');
}

function viewRecord() {
    alert('Xem chi tiết bản ghi');
}
</script>

<?php include '../../includes/footer.php'; ?>
