<?php
session_start();
include '../../includes/config.php';

if ($_SESSION['role'] != 'bác_sĩ') {
    header('Location: ' . SITE_URL . '/index.php');
    exit();
}

include '../../includes/header.php';
?>

<div class="table-container">
    <h1>Lịch Hẹn Khám Bệnh</h1>
    
    <div style="margin-bottom: 20px; display: flex; gap: 10px;">
        <input type="date" id="filterDate" style="padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        <button class="btn btn-primary" onclick="filterAppointments()">Lọc</button>
        <button class="btn btn-success" style="margin-left: auto;" onclick="refreshAppointments()">Làm Mới</button>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Thời Gian</th>
                <th>Mã Bệnh Nhân</th>
                <th>Tên Bệnh Nhân</th>
                <th>Chuyên Khoa</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>08:30 - 09:00</td>
                <td>BN-001</td>
                <td>Nguyễn Văn A</td>
                <td>Khám Tổng Quát</td>
                <td><span style="background-color: #d4edda; padding: 4px 8px; border-radius: 4px; color: #27ae60;">Đã Tới</span></td>
                <td>
                    <a href="medical_record.php?patient=BN-001" class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;">Xem Chi Tiết</a>
                </td>
            </tr>
            <tr>
                <td>09:00 - 09:30</td>
                <td>BN-002</td>
                <td>Trần Thị B</td>
                <td>Nội Khoa</td>
                <td><span style="background-color: #fff3cd; padding: 4px 8px; border-radius: 4px; color: #856404;">Chờ Khám</span></td>
                <td>
                    <a href="medical_record.php?patient=BN-002" class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;">Xem Chi Tiết</a>
                </td>
            </tr>
            <tr>
                <td>09:30 - 10:00</td>
                <td>BN-003</td>
                <td>Lê Văn C</td>
                <td>Ngoại Khoa</td>
                <td><span style="background-color: #d1ecf1; padding: 4px 8px; border-radius: 4px; color: #0c5460;">Chưa Tới</span></td>
                <td>
                    <a href="medical_record.php?patient=BN-003" class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;">Xem Chi Tiết</a>
                </td>
            </tr>
            <tr>
                <td>10:00 - 10:30</td>
                <td>BN-004</td>
                <td>Phạm Thị D</td>
                <td>Nhi Khoa</td>
                <td><span style="background-color: #d4edda; padding: 4px 8px; border-radius: 4px; color: #27ae60;">Đã Tới</span></td>
                <td>
                    <a href="medical_record.php?patient=BN-004" class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;">Xem Chi Tiết</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div style="text-align: center; margin-top: 20px;">
    <a href="../../index.php" class="btn" style="background-color: #95a5a6; color: white;">Quay Lại</a>
</div>

<script>
function filterAppointments() {
    const date = document.getElementById('filterDate').value;
    if (date) {
        alert('Lọc lịch hẹn ngày: ' + date);
        // Implement filter logic here
    }
}

function refreshAppointments() {
    location.reload();
}
</script>

<?php include '../../includes/footer.php'; ?>
