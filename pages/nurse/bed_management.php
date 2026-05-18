<?php
session_start();
include '../../includes/config.php';

if ($_SESSION['role'] != 'y_tá') {
    header('Location: ' . SITE_URL . '/index.php');
    exit();
}

include '../../includes/header.php';
?>

<div class="table-container">
    <h1>Quản Lý Sơ Đồ Giường Bệnh</h1>
    
    <div style="margin-bottom: 20px; display: flex; gap: 10px;">
        <select id="floor" style="padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            <option value="">-- Chọn Tầng --</option>
            <option value="1">Tầng 1</option>
            <option value="2">Tầng 2</option>
            <option value="3">Tầng 3</option>
        </select>
        <select id="room" style="padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            <option value="">-- Chọn Phòng --</option>
            <option value="101">Phòng 101</option>
            <option value="102">Phòng 102</option>
            <option value="103">Phòng 103</option>
        </select>
        <button class="btn btn-primary" onclick="filterBeds()">Lọc</button>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin: 20px 0;">
        <div class="bed-card" style="border: 2px solid #27ae60; border-radius: 8px; padding: 15px; background-color: #d4edda; cursor: pointer;" onclick="viewBedDetails('101')">
            <h3 style="color: #27ae60; margin: 0 0 10px 0;">Giường 101</h3>
            <p><strong>Trạng Thái:</strong> <span style="color: #27ae60; font-weight: bold;">Đã Sử Dụng</span></p>
            <p><strong>Bệnh Nhân:</strong> Nguyễn Văn A</p>
            <p><strong>Chuyên Khoa:</strong> Nội Khoa</p>
            <button class="btn btn-primary" style="width: 100%; margin-top: 10px;">Chi Tiết</button>
        </div>
        
        <div class="bed-card" style="border: 2px solid #e74c3c; border-radius: 8px; padding: 15px; background-color: #f8d7da; cursor: pointer;" onclick="viewBedDetails('102')">
            <h3 style="color: #e74c3c; margin: 0 0 10px 0;">Giường 102</h3>
            <p><strong>Trạng Thái:</strong> <span style="color: #e74c3c; font-weight: bold;">Trống</span></p>
            <p><strong>Bệnh Nhân:</strong> -</p>
            <button class="btn btn-success" style="width: 100%; margin-top: 10px;">Phân Bổ Bệnh Nhân</button>
        </div>
        
        <div class="bed-card" style="border: 2px solid #27ae60; border-radius: 8px; padding: 15px; background-color: #d4edda; cursor: pointer;" onclick="viewBedDetails('103')">
            <h3 style="color: #27ae60; margin: 0 0 10px 0;">Giường 103</h3>
            <p><strong>Trạng Thái:</strong> <span style="color: #27ae60; font-weight: bold;">Đã Sử Dụng</span></p>
            <p><strong>Bệnh Nhân:</strong> Trần Thị B</p>
            <p><strong>Chuyên Khoa:</strong> Ngoại Khoa</p>
            <button class="btn btn-primary" style="width: 100%; margin-top: 10px;">Chi Tiết</button>
        </div>
        
        <div class="bed-card" style="border: 2px solid #f39c12; border-radius: 8px; padding: 15px; background-color: #fff3cd; cursor: pointer;" onclick="viewBedDetails('104')">
            <h3 style="color: #f39c12; margin: 0 0 10px 0;">Giường 104</h3>
            <p><strong>Trạng Thái:</strong> <span style="color: #f39c12; font-weight: bold;">Cần Vệ Sinh</span></p>
            <p><strong>Bệnh Nhân:</strong> -</p>
            <button class="btn btn-warning" style="width: 100%; margin-top: 10px;">Đánh Dấu Sạch</button>
        </div>
    </div>
    
    <div style="margin-top: 30px; padding: 15px; background-color: #f9f9f9; border-radius: 4px;">
        <h3>Thống Kê Giường Bệnh</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px; margin-top: 15px;">
            <div style="text-align: center; padding: 15px; background-color: white; border-radius: 4px;">
                <div style="font-size: 24px; font-weight: bold; color: #27ae60;">12</div>
                <div style="color: #666; margin-top: 5px;">Đã Sử Dụng</div>
            </div>
            <div style="text-align: center; padding: 15px; background-color: white; border-radius: 4px;">
                <div style="font-size: 24px; font-weight: bold; color: #e74c3c;">5</div>
                <div style="color: #666; margin-top: 5px;">Trống</div>
            </div>
            <div style="text-align: center; padding: 15px; background-color: white; border-radius: 4px;">
                <div style="font-size: 24px; font-weight: bold; color: #f39c12;">2</div>
                <div style="color: #666; margin-top: 5px;">Cần Vệ Sinh</div>
            </div>
        </div>
    </div>
</div>

<div style="text-align: center; margin-top: 20px;">
    <a href="../../index.php" class="btn" style="background-color: #95a5a6; color: white;">Quay Lại</a>
</div>

<script>
function filterBeds() {
    alert('Lọc giường bệnh');
}

function viewBedDetails(bedNo) {
    alert('Xem chi tiết giường: ' + bedNo);
}
</script>

<?php include '../../includes/footer.php'; ?>
