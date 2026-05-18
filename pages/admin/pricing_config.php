<?php
session_start();
include '../../includes/config.php';

if ($_SESSION['role'] != 'quản_lý') {
    header('Location: ' . SITE_URL . '/index.php');
    exit();
}

include '../../includes/header.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action == 'update_price') {
        $success = 'Cập nhật giá dịch vụ thành công!';
    }
}
?>

<div class="form-container">
    <h1>Cấu Hình Bảng Giá Dịch Vụ & Xét Nghiệm</h1>
    
    <?php if ($success): ?>
        <div class="success-message"><?php echo $success; ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <input type="hidden" name="action" value="update_price">
        
        <div style="margin-bottom: 30px;">
            <h3>Dịch Vụ Khám</h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Tên Dịch Vụ</th>
                            <th>Đơn Vị</th>
                            <th>Giá (VNĐ)</th>
                            <th>Ghi Chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" value="Khám Tổng Quát" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                            <td><input type="text" value="Lần" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                            <td><input type="number" value="200000" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                            <td><input type="text" value="Bao gồm kiểm tra cơ bản" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                        </tr>
                        <tr>
                            <td><input type="text" value="Khám Nội Khoa" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                            <td><input type="text" value="Lần" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                            <td><input type="number" value="250000" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                            <td><input type="text" value="" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                        </tr>
                        <tr>
                            <td><input type="text" value="Khám Ngoại Khoa" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                            <td><input type="text" value="Lần" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                            <td><input type="number" value="300000" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                            <td><input type="text" value="" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div style="margin-bottom: 30px;">
            <h3>Xét Nghiệm</h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Tên Xét Nghiệm</th>
                            <th>Đơn Vị</th>
                            <th>Giá (VNĐ)</th>
                            <th>Ghi Chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" value="Xét Nghiệm Máu (Cơ Bản)" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                            <td><input type="text" value="Lần" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                            <td><input type="number" value="150000" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                            <td><input type="text" value="Đếm công thức máu" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                        </tr>
                        <tr>
                            <td><input type="text" value="Xét Nghiệm Nước Tiểu" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                            <td><input type="text" value="Lần" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                            <td><input type="number" value="80000" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                            <td><input type="text" value="" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                        </tr>
                        <tr>
                            <td><input type="text" value="X-Quang Ngực" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                            <td><input type="text" value="Lần" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                            <td><input type="number" value="200000" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                            <td><input type="text" value="Phim ảnh gồm lưu trữ" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                        </tr>
                        <tr>
                            <td><input type="text" value="Siêu Âm" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                            <td><input type="text" value="Lần" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                            <td><input type="number" value="300000" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                            <td><input type="text" value="Siêu âm sơ cấp" style="width: 100%; padding: 8px; border: 1px solid #ddd;"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div style="text-align: center;">
            <button type="submit" class="btn btn-primary">Lưu Bảng Giá</button>
            <a href="../../index.php" class="btn" style="background-color: #95a5a6; color: white;">Quay Lại</a>
        </div>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>
