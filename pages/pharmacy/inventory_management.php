<?php
session_start();
include '../../includes/config.php';

if ($_SESSION['role'] != 'kho_dược') {
    header('Location: ' . SITE_URL . '/index.php');
    exit();
}

include '../../includes/header.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action == 'add_stock') {
        $success = 'Cập nhật hàng tồn kho thành công!';
    } elseif ($action == 'update_expiry') {
        $success = 'Cập nhật hạn sử dụng thành công!';
    }
}
?>

<div class="table-container">
    <h1>Quản Lý Xuất - Nhập - Tồn Kho Thuốc</h1>
    
    <?php if ($success): ?>
        <div class="success-message"><?php echo $success; ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <div style="margin-bottom: 20px; display: flex; gap: 10px;">
        <input type="text" id="searchDrug" placeholder="Tìm kiếm tên thuốc..." style="flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        <button class="btn btn-primary" onclick="searchDrugs()">Tìm Kiếm</button>
        <a href="#" class="btn btn-success" onclick="openAddStockModal(); return false;">+ Nhập Hàng</a>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; margin: 20px 0;">
        <div style="border: 1px solid #ddd; border-radius: 8px; padding: 15px; background-color: white;">
            <h4 style="margin-top: 0;">Paracetamol 500mg</h4>
            <p><strong>Mã Thuốc:</strong> PAR-500</p>
            <p><strong>Tồn Kho:</strong> <span style="font-size: 18px; font-weight: bold; color: #27ae60;">245 viên</span></p>
            <p><strong>Đơn Vị:</strong> Hộp (10 viên/hộp)</p>
            <p><strong>Hạn Sử Dụng:</strong> <span style="color: #27ae60;">2026-12-31</span></p>
            <p><strong>Giá Nhập:</strong> 5,000 VNĐ/hộp</p>
            <div style="margin-top: 10px; display: flex; gap: 5px;">
                <button class="btn btn-primary" style="flex: 1; padding: 8px; font-size: 12px;" onclick="openEditModal('PAR-500')">Chỉnh Sửa</button>
                <button class="btn btn-danger" style="flex: 1; padding: 8px; font-size: 12px;" onclick="checkExpiry('PAR-500')">Kiểm Hạn</button>
            </div>
        </div>
        
        <div style="border: 1px solid #ddd; border-radius: 8px; padding: 15px; background-color: white;">
            <h4 style="margin-top: 0;">Amoxicillin 500mg</h4>
            <p><strong>Mã Thuốc:</strong> AMO-500</p>
            <p><strong>Tồn Kho:</strong> <span style="font-size: 18px; font-weight: bold; color: #e74c3c;">15 viên</span></p>
            <p><strong>Đơn Vị:</strong> Vỉ (10 viên/vỉ)</p>
            <p><strong>Hạn Sử Dụng:</strong> <span style="color: #e74c3c;">2026-08-15 (SẮP HẾT)</span></p>
            <p><strong>Giá Nhập:</strong> 3,500 VNĐ/vỉ</p>
            <div style="margin-top: 10px; display: flex; gap: 5px;">
                <button class="btn btn-warning" style="flex: 1; padding: 8px; font-size: 12px;" onclick="openEditModal('AMO-500')">Chỉnh Sửa</button>
                <button class="btn btn-danger" style="flex: 1; padding: 8px; font-size: 12px;" onclick="checkExpiry('AMO-500')">Kiểm Hạn</button>
            </div>
        </div>
        
        <div style="border: 1px solid #ddd; border-radius: 8px; padding: 15px; background-color: white;">
            <h4 style="margin-top: 0;">Vitamin C 1000mg</h4>
            <p><strong>Mã Thuốc:</strong> VIT-C-1000</p>
            <p><strong>Tồn Kho:</strong> <span style="font-size: 18px; font-weight: bold; color: #27ae60;">520 viên</span></p>
            <p><strong>Đơn Vị:</strong> Lọ (30 viên/lọ)</p>
            <p><strong>Hạn Sử Dụng:</strong> <span style="color: #27ae60;">2027-06-30</span></p>
            <p><strong>Giá Nhập:</strong> 45,000 VNĐ/lọ</p>
            <div style="margin-top: 10px; display: flex; gap: 5px;">
                <button class="btn btn-primary" style="flex: 1; padding: 8px; font-size: 12px;" onclick="openEditModal('VIT-C-1000')">Chỉnh Sửa</button>
                <button class="btn btn-danger" style="flex: 1; padding: 8px; font-size: 12px;" onclick="checkExpiry('VIT-C-1000')">Kiểm Hạn</button>
            </div>
        </div>
    </div>
    
    <h3 style="margin-top: 30px;">Lịch Sử Giao Dịch</h3>
    <table>
        <thead>
            <tr>
                <th>Ngày</th>
                <th>Loại Giao Dịch</th>
                <th>Tên Thuốc</th>
                <th>Số Lượng</th>
                <th>Ghi Chú</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2026-05-18</td>
                <td><span style="background-color: #d1ecf1; padding: 4px 8px; border-radius: 4px;">Nhập</span></td>
                <td>Paracetamol 500mg</td>
                <td>50 hộp</td>
                <td>Nhập từ nhà cung cấp ABC</td>
            </tr>
            <tr>
                <td>2026-05-17</td>
                <td><span style="background-color: #d4edda; padding: 4px 8px; border-radius: 4px;">Xuất</span></td>
                <td>Amoxicillin 500mg</td>
                <td>5 vỉ</td>
                <td>Phát cho bệnh nhân BN-001</td>
            </tr>
            <tr>
                <td>2026-05-16</td>
                <td><span style="background-color: #f8d7da; padding: 4px 8px; border-radius: 4px;">Hủy</span></td>
                <td>Vitamin C 1000mg</td>
                <td>2 lọ</td>
                <td>Hết hạn sử dụng</td>
            </tr>
        </tbody>
    </table>
</div>

<div style="text-align: center; margin-top: 20px;">
    <a href="../../index.php" class="btn" style="background-color: #95a5a6; color: white;">Quay Lại</a>
</div>

<script>
function searchDrugs() {
    alert('Tìm kiếm thuốc');
}

function openAddStockModal() {
    alert('Mở modal thêm hàng nhập');
}

function openEditModal(drugId) {
    alert('Chỉnh sửa tồn kho: ' + drugId);
}

function checkExpiry(drugId) {
    alert('Kiểm tra hạn sử dụng: ' + drugId);
}
</script>

<?php include '../../includes/footer.php'; ?>
