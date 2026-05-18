<?php
session_start();
include '../../includes/config.php';

if ($_SESSION['role'] != 'cận_lâm_sàng') {
    header('Location: ' . SITE_URL . '/index.php');
    exit();
}

include '../../includes/header.php';

$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action == 'receive') {
        $success = 'Tiếp nhận yêu cầu thành công!';
    }
}
?>

<div class="table-container">
    <h1>Tiếp Nhận Yêu Cầu Xét Nghiệm / X-Quang</h1>
    
    <?php if ($success): ?>
        <div class="success-message"><?php echo $success; ?></div>
    <?php endif; ?>
    
    <div style="margin-bottom: 20px; display: flex; gap: 10px;">
        <select id="filterStatus" style="padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            <option value="">-- Tất Cả --</option>
            <option value="pending">Chờ Tiếp Nhận</option>
            <option value="received">Đã Tiếp Nhận</option>
            <option value="processing">Đang Xử Lý</option>
        </select>
        <button class="btn btn-primary" onclick="filterRequests()">Lọc</button>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Mã Yêu Cầu</th>
                <th>Bệnh Nhân</th>
                <th>Loại Xét Nghiệm</th>
                <th>Mức Ưu Tiên</th>
                <th>Ngày Tạo</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>XN-001</td>
                <td>Nguyễn Văn A</td>
                <td>Xét Nghiệm Máu</td>
                <td>Bình Thường</td>
                <td>2026-05-18 08:00</td>
                <td><span style="background-color: #fff3cd; padding: 4px 8px; border-radius: 4px; color: #856404;">Chờ Tiếp Nhận</span></td>
                <td>
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="action" value="receive">
                        <button type="submit" class="btn btn-success" style="padding: 6px 12px; font-size: 12px;">Tiếp Nhận</button>
                    </form>
                </td>
            </tr>
            <tr>
                <td>XN-002</td>
                <td>Trần Thị B</td>
                <td>X-Quang Ngực</td>
                <td>Cấp Tính</td>
                <td>2026-05-18 09:30</td>
                <td><span style="background-color: #d1ecf1; padding: 4px 8px; border-radius: 4px; color: #0c5460;">Đã Tiếp Nhận</span></td>
                <td>
                    <a href="result_submission.php?request=XN-002" class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;">Nhập Kết Quả</a>
                </td>
            </tr>
            <tr>
                <td>XN-003</td>
                <td>Lê Văn C</td>
                <td>Xét Nghiệm Nước Tiểu</td>
                <td>Bình Thường</td>
                <td>2026-05-18 07:15</td>
                <td><span style="background-color: #e2e3e5; padding: 4px 8px; border-radius: 4px; color: #383d41;">Đang Xử Lý</span></td>
                <td>
                    <button class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;" onclick="viewDetails()">Chi Tiết</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div style="text-align: center; margin-top: 20px;">
    <a href="../../index.php" class="btn" style="background-color: #95a5a6; color: white;">Quay Lại</a>
</div>

<script>
function filterRequests() {
    alert('Lọc yêu cầu xét nghiệm');
}

function viewDetails() {
    alert('Xem chi tiết yêu cầu');
}
</script>

<?php include '../../includes/footer.php'; ?>
