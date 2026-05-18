<?php
session_start();
include 'includes/config.php';

// Kiểm tra đăng nhập
require_login();

include 'includes/header.php';

// Lấy thông tin user từ database
$user = get_current_logged_in_user();
if (!$user) {
    session_destroy();
    header('Location: login.php');
    exit();
}

// Lấy thống kê cho dashboard
$stats = [];
if ($_SESSION['role'] == 'quản_lý') {
    // Tổng bệnh nhân
    $result = query("SELECT COUNT(*) as total FROM `bệnh_nhân`");
    $stats['total_patients'] = $result->fetch_assoc()['total'];
    
    // Tổng lịch hẹn hôm nay
    $result = query("SELECT COUNT(*) as total FROM `lịch_hẹn` WHERE DATE(appointment_date) = CURDATE()");
    $stats['appointments_today'] = $result->fetch_assoc()['total'];
    
    // Tổng hóa đơn hôm nay
    $result = query("SELECT SUM(total_amount) as total FROM `hóa_đơn` WHERE DATE(created_at) = CURDATE()");
    $invoice_data = $result->fetch_assoc();
    $stats['revenue_today'] = $invoice_data['total'] ?? 0;
}
?>

<div class="dashboard">
    <h1>Hệ thống Quản lý Bệnh viện - HTTTQL</h1>
    <p>Chào mừng, <strong><?php echo htmlspecialchars($user['full_name']); ?></strong></p>
    <p>Vai trò: <strong><?php echo htmlspecialchars($user['position']); ?></strong></p>
    
    <?php if ($_SESSION['role'] == 'quản_lý' && !empty($stats)): ?>
    <div class="stats-row">
        <div class="stat-card">
            <h4>Tổng bệnh nhân</h4>
            <p class="stat-value"><?php echo $stats['total_patients']; ?></p>
        </div>
        <div class="stat-card">
            <h4>Lịch hẹn hôm nay</h4>
            <p class="stat-value"><?php echo $stats['appointments_today']; ?></p>
        </div>
        <div class="stat-card">
            <h4>Doanh thu hôm nay</h4>
            <p class="stat-value"><?php echo format_currency($stats['revenue_today']); ?></p>
        </div>
    </div>
    <?php endif; ?>
    
    <div class="dashboard-grid">
        <?php
        $role = $_SESSION['role'];
        
        switch($role) {
            case 'tiếp_đón_thu_ngân':
                echo '<a href="pages/reception_cashier/patient_registration.php" class="dashboard-card">
                        <h3>Đăng ký thông tin bệnh nhân</h3>
                        <p>Nhập thông tin bệnh nhân mới</p>
                      </a>';
                echo '<a href="pages/reception_cashier/queue_number.php" class="dashboard-card">
                        <h3>Phát số thứ tự</h3>
                        <p>Cấp phát số thứ tự cho bệnh nhân</p>
                      </a>';
                echo '<a href="pages/reception_cashier/payment_invoice.php" class="dashboard-card">
                        <h3>Tính tiền / Xuất hóa đơn</h3>
                        <p>Xử lý thanh toán và in hóa đơn</p>
                      </a>';
                break;
                
            case 'bác_sĩ':
                echo '<a href="pages/doctor/appointments.php" class="dashboard-card">
                        <h3>Xem lịch hẹn</h3>
                        <p>Xem lịch khám bệnh nhân</p>
                      </a>';
                echo '<a href="pages/doctor/medical_record.php" class="dashboard-card">
                        <h3>Nhập Hồ sơ bệnh án</h3>
                        <p>Ghi nhận triệu chứng và chẩn đoán</p>
                      </a>';
                echo '<a href="pages/doctor/order_tests.php" class="dashboard-card">
                        <h3>Ra lệnh xét nghiệm</h3>
                        <p>Yêu cầu xét nghiệm cho bệnh nhân</p>
                      </a>';
                echo '<a href="pages/doctor/prescriptions.php" class="dashboard-card">
                        <h3>Kê đơn thuốc</h3>
                        <p>Kê đơn thuốc cho bệnh nhân</p>
                      </a>';
                break;
                
            case 'y_tá':
                echo '<a href="pages/nurse/vital_signs.php" class="dashboard-card">
                        <h3>Đo sinh hiệu ban đầu</h3>
                        <p>Ghi nhận sinh hiệu bệnh nhân</p>
                      </a>';
                echo '<a href="pages/nurse/bed_management.php" class="dashboard-card">
                        <h3>Quản lý sơ đồ giường bệnh</h3>
                        <p>Quản lý tình trạng giường bệnh</p>
                      </a>';
                echo '<a href="pages/nurse/medication_schedule.php" class="dashboard-card">
                        <h3>Lịch phát thuốc / tiêm thuốc</h3>
                        <p>Quản lý lịch phát thuốc và tiêm thuốc</p>
                      </a>';
                break;
                
            case 'cận_lâm_sàng':
                echo '<a href="pages/lab_xray/request_receiving.php" class="dashboard-card">
                        <h3>Tiếp nhận yêu cầu</h3>
                        <p>Tiếp nhận yêu cầu xét nghiệm / X-quang</p>
                      </a>';
                echo '<a href="pages/lab_xray/result_submission.php" class="dashboard-card">
                        <h3>Trả kết quả xét nghiệm</h3>
                        <p>Nhập kết quả và hình ảnh chụp</p>
                      </a>';
                break;
                
            case 'kho_dược':
                echo '<a href="pages/pharmacy/prescription_review.php" class="dashboard-card">
                        <h3>Duyệt đơn / Phát thuốc</h3>
                        <p>Duyệt đơn và phát thuốc cho bệnh nhân</p>
                      </a>';
                echo '<a href="pages/pharmacy/inventory_management.php" class="dashboard-card">
                        <h3>Quản lý Xuất-nhập-tồn</h3>
                        <p>Quản lý kho thuốc và theo dõi hạn sử dụng</p>
                      </a>';
                break;
                
            case 'quản_lý':
                echo '<a href="pages/admin/user_permissions.php" class="dashboard-card">
                        <h3>Phân quyền tài khoản</h3>
                        <p>Quản lý quyền hạn nhân viên</p>
                      </a>';
                echo '<a href="pages/admin/pricing_config.php" class="dashboard-card">
                        <h3>Cấu hình bảng giá</h3>
                        <p>Thiết lập giá dịch vụ và xét nghiệm</p>
                      </a>';
                echo '<a href="pages/admin/reports.php" class="dashboard-card">
                        <h3>Báo cáo / Thống kê</h3>
                        <p>Xem báo cáo doanh thu và thống kê bệnh nhân</p>
                      </a>';
                break;
        }
        ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
