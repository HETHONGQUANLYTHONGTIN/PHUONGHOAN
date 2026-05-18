<?php
session_start();
include '../../includes/config.php';

if ($_SESSION['role'] != 'tiếp_đón_thu_ngân') {
    header('Location: ' . SITE_URL . '/index.php');
    exit();
}

include '../../includes/header.php';
?>

<div class="form-container">
    <h1>Tính Tiền / Xuất Hóa Đơn</h1>
    
    <div class="form-group">
        <label for="patient">Chọn Bệnh Nhân:</label>
        <input type="text" id="patient" name="patient" placeholder="Nhập tên hoặc mã bệnh nhân">
        <div id="patientList" style="margin-top: 10px;"></div>
    </div>
    
    <div class="table-container" style="margin-top: 30px;">
        <h2>Chi Tiết Hóa Đơn</h2>
        <table id="invoiceTable">
            <thead>
                <tr>
                    <th>Dịch Vụ</th>
                    <th>Số Lượng</th>
                    <th>Đơn Giá (VNĐ)</th>
                    <th>Thành Tiền (VNĐ)</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Khám Tổng Quát</td>
                    <td>1</td>
                    <td>200,000</td>
                    <td>200,000</td>
                    <td><button class="btn btn-danger" onclick="removeRow(this)">Xóa</button></td>
                </tr>
                <tr>
                    <td>Xét Nghiệm Máu</td>
                    <td>1</td>
                    <td>150,000</td>
                    <td>150,000</td>
                    <td><button class="btn btn-danger" onclick="removeRow(this)">Xóa</button></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 20px; padding: 20px; background-color: #f9f9f9; border-radius: 8px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label>Tổng Tiền (VNĐ):</label>
                <div style="font-size: 24px; font-weight: bold; color: #e74c3c;">350,000</div>
            </div>
            <div>
                <label>Chiết Khấu (%):</label>
                <input type="number" name="discount" value="0" min="0" max="100" style="width: 100%; padding: 8px;">
            </div>
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div>
                <label>Tiền Giảm (VNĐ):</label>
                <div style="font-size: 18px; font-weight: bold;">0</div>
            </div>
            <div>
                <label>Tổng Thanh Toán (VNĐ):</label>
                <div style="font-size: 24px; font-weight: bold; color: #27ae60;">350,000</div>
            </div>
        </div>
    </div>
    
    <div style="margin-top: 20px;">
        <label>Hình Thức Thanh Toán:</label>
        <div style="margin: 10px 0;">
            <label><input type="radio" name="payment" value="cash" checked> Tiền Mặt</label>
            <label style="margin-left: 20px;"><input type="radio" name="payment" value="card"> Thẻ Tín Dụng</label>
            <label style="margin-left: 20px;"><input type="radio" name="payment" value="transfer"> Chuyển Khoản</label>
            <label style="margin-left: 20px;"><input type="radio" name="payment" value="insurance"> Bảo Hiểm</label>
        </div>
    </div>
    
    <div style="text-align: center; margin-top: 30px;">
        <button class="btn btn-success" onclick="printInvoice()" style="margin-right: 10px;">In Hóa Đơn</button>
        <button class="btn btn-primary" onclick="completePayment()">Hoàn Tất Thanh Toán</button>
        <a href="../../index.php" class="btn" style="background-color: #95a5a6; color: white;">Quay Lại</a>
    </div>
</div>

<script>
function removeRow(btn) {
    btn.closest('tr').remove();
}

function printInvoice() {
    alert('In hóa đơn thành công!');
}

function completePayment() {
    alert('Thanh toán thành công!');
}
</script>

<?php include '../../includes/footer.php'; ?>
