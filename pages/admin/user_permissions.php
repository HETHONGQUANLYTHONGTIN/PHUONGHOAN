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
    
    if ($action == 'add_user') {
        $success = 'Thêm tài khoản thành công!';
    } elseif ($action == 'update_permission') {
        $success = 'Cập nhật quyền hạn thành công!';
    } elseif ($action == 'delete_user') {
        $success = 'Xóa tài khoản thành công!';
    }
}
?>

<div class="table-container">
    <h1>Phân Quyền Tài Khoản Nhân Viên</h1>
    
    <?php if ($success): ?>
        <div class="success-message"><?php echo $success; ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <div style="margin-bottom: 20px;">
        <a href="add_user.php" class="btn btn-success">+ Thêm Tài Khoản Mới</a>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Họ Tên</th>
                <th>Email</th>
                <th>Chức Danh</th>
                <th>Phòng Ban</th>
                <th>Vai Trò Hệ Thống</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>NV-001</td>
                <td>Nguyễn Thị Phương</td>
                <td>phuong.nguyen@hospital.com</td>
                <td>Nhân Viên Tiếp Đón</td>
                <td>Tiếp Đón & Thu Ngân</td>
                <td><span style="background-color: #d4edda; padding: 4px 8px; border-radius: 4px;">Reception</span></td>
                <td><span style="background-color: #d4edda; padding: 4px 8px; border-radius: 4px; color: #27ae60;">Hoạt Động</span></td>
                <td>
                    <button class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;" onclick="editUser('NV-001')">Chỉnh Sửa</button>
                    <button class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;" onclick="deleteUser('NV-001')">Xóa</button>
                </td>
            </tr>
            <tr>
                <td>NV-002</td>
                <td>Trần Văn Anh</td>
                <td>anh.tran@hospital.com</td>
                <td>Bác Sĩ</td>
                <td>Ngoại Khoa</td>
                <td><span style="background-color: #d1ecf1; padding: 4px 8px; border-radius: 4px;">Doctor</span></td>
                <td><span style="background-color: #d4edda; padding: 4px 8px; border-radius: 4px; color: #27ae60;">Hoạt Động</span></td>
                <td>
                    <button class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;" onclick="editUser('NV-002')">Chỉnh Sửa</button>
                    <button class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;" onclick="deleteUser('NV-002')">Xóa</button>
                </td>
            </tr>
            <tr>
                <td>NV-003</td>
                <td>Lê Thị Hoa</td>
                <td>hoa.le@hospital.com</td>
                <td>Y Tá</td>
                <td>Nội Khoa</td>
                <td><span style="background-color: #fff3cd; padding: 4px 8px; border-radius: 4px;">Nurse</span></td>
                <td><span style="background-color: #d4edda; padding: 4px 8px; border-radius: 4px; color: #27ae60;">Hoạt Động</span></td>
                <td>
                    <button class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;" onclick="editUser('NV-003')">Chỉnh Sửa</button>
                    <button class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;" onclick="deleteUser('NV-003')">Xóa</button>
                </td>
            </tr>
            <tr>
                <td>NV-004</td>
                <td>Phạm Văn Hùng</td>
                <td>hung.pham@hospital.com</td>
                <td>Kỹ Thuật Viên Xét Nghiệm</td>
                <td>Cận Lâm Sàng</td>
                <td><span style="background-color: #d1ecf1; padding: 4px 8px; border-radius: 4px;">Lab</span></td>
                <td><span style="background-color: #d4edda; padding: 4px 8px; border-radius: 4px; color: #27ae60;">Hoạt Động</span></td>
                <td>
                    <button class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;" onclick="editUser('NV-004')">Chỉnh Sửa</button>
                    <button class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;" onclick="deleteUser('NV-004')">Xóa</button>
                </td>
            </tr>
            <tr>
                <td>NV-005</td>
                <td>Vũ Thị Mai</td>
                <td>mai.vu@hospital.com</td>
                <td>Dược Sĩ</td>
                <td>Kho Dược</td>
                <td><span style="background-color: #e2e3e5; padding: 4px 8px; border-radius: 4px;">Pharmacy</span></td>
                <td><span style="background-color: #d4edda; padding: 4px 8px; border-radius: 4px; color: #27ae60;">Hoạt Động</span></td>
                <td>
                    <button class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;" onclick="editUser('NV-005')">Chỉnh Sửa</button>
                    <button class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;" onclick="deleteUser('NV-005')">Xóa</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div style="text-align: center; margin-top: 20px;">
    <a href="../../index.php" class="btn" style="background-color: #95a5a6; color: white;">Quay Lại</a>
</div>

<script>
function editUser(userId) {
    alert('Chỉnh sửa tài khoản: ' + userId);
}

function deleteUser(userId) {
    if (confirm('Bạn chắc chắn muốn xóa tài khoản này?')) {
        alert('Xóa tài khoản: ' + userId);
    }
}
</script>

<?php include '../../includes/footer.php'; ?>
