<?php
session_start();
include '../../includes/config.php';

if ($_SESSION['role'] != 'quản_lý') {
    header('Location: ' . SITE_URL . '/index.php');
    exit();
}

include '../../includes/header.php';
?>

<div class="table-container">
    <h1>Báo Cáo Doanh Thu & Thống Kê Bệnh Nhân</h1>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 30px;">
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 8px;">
            <div style="font-size: 28px; font-weight: bold;">1,245</div>
            <div style="margin-top: 10px;">Tổng Bệnh Nhân</div>
        </div>
        <div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; padding: 20px; border-radius: 8px;">
            <div style="font-size: 28px; font-weight: bold;">95.8M</div>
            <div style="margin-top: 10px;">Doanh Thu Tháng</div>
        </div>
        <div style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; padding: 20px; border-radius: 8px;">
            <div style="font-size: 28px; font-weight: bold;">342</div>
            <div style="margin-top: 10px;">Bệnh Nhân Tháng Này</div>
        </div>
        <div style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white; padding: 20px; border-radius: 8px;">
            <div style="font-size: 28px; font-weight: bold;">18.5%</div>
            <div style="margin-top: 10px;">Tỷ Lệ Tái Khám</div>
        </div>
    </div>
    
    <div style="margin-bottom: 30px; padding: 20px; background-color: #f9f9f9; border-radius: 8px;">
        <h3>Lọc Báo Cáo</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 10px;">
            <div>
                <label>Từ Ngày:</label>
                <input type="date" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            <div>
                <label>Đến Ngày:</label>
                <input type="date" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            <div>
                <label>Chuyên Khoa:</label>
                <select style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                    <option>-- Tất Cả --</option>
                    <option>Khám Tổng Quát</option>
                    <option>Nội Khoa</option>
                    <option>Ngoại Khoa</option>
                </select>
            </div>
            <div style="display: flex; align-items: flex-end;">
                <button class="btn btn-primary" style="width: 100%;">Xem Báo Cáo</button>
            </div>
        </div>
    </div>
    
    <h3>Doanh Thu Theo Tháng</h3>
    <div class="table-container" style="margin-bottom: 30px;">
        <table>
            <thead>
                <tr>
                    <th>Tháng</th>
                    <th>Số Bệnh Nhân</th>
                    <th>Khám</th>
                    <th>Xét Nghiệm</th>
                    <th>Dịch Vụ Khác</th>
                    <th>Tổng Doanh Thu (VNĐ)</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tháng 5/2026</td>
                    <td>342</td>
                    <td>32.5M</td>
                    <td>35.8M</td>
                    <td>27.5M</td>
                    <td><strong>95.8M</strong></td>
                    <td><a href="#" class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;">Chi Tiết</a></td>
                </tr>
                <tr>
                    <td>Tháng 4/2026</td>
                    <td>298</td>
                    <td>28.2M</td>
                    <td>31.5M</td>
                    <td>24.3M</td>
                    <td><strong>84.0M</strong></td>
                    <td><a href="#" class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;">Chi Tiết</a></td>
                </tr>
                <tr>
                    <td>Tháng 3/2026</td>
                    <td>315</td>
                    <td>30.8M</td>
                    <td>34.2M</td>
                    <td>26.9M</td>
                    <td><strong>91.9M</strong></td>
                    <td><a href="#" class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;">Chi Tiết</a></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <h3>Top 5 Dịch Vụ Được Sử Dụng Nhiều Nhất</h3>
    <div class="table-container" style="margin-bottom: 30px;">
        <table>
            <thead>
                <tr>
                    <th>Xếp Hạng</th>
                    <th>Tên Dịch Vụ</th>
                    <th>Số Lần Sử Dụng</th>
                    <th>Doanh Thu (VNĐ)</th>
                    <th>% Doanh Thu</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Xét Nghiệm Máu (Cơ Bản)</td>
                    <td>285</td>
                    <td>42,750,000</td>
                    <td>44.6%</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Khám Tổng Quát</td>
                    <td>342</td>
                    <td>68,400,000</td>
                    <td>71.4%</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>X-Quang Ngực</td>
                    <td>156</td>
                    <td>31,200,000</td>
                    <td>32.5%</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Siêu Âm</td>
                    <td>98</td>
                    <td>29,400,000</td>
                    <td>30.7%</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Xét Nghiệm Nước Tiểu</td>
                    <td>142</td>
                    <td>11,360,000</td>
                    <td>11.8%</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div style="display: flex; gap: 10px; justify-content: center;">
        <button class="btn btn-primary" onclick="exportReport()">Xuất Báo Cáo (PDF)</button>
        <button class="btn btn-success" onclick="exportReport()">Xuất Báo Cáo (Excel)</button>
        <a href="../../index.php" class="btn" style="background-color: #95a5a6; color: white;">Quay Lại</a>
    </div>
</div>

<script>
function exportReport() {
    alert('Xuất báo cáo');
}
</script>

<?php include '../../includes/footer.php'; ?>
