# 🎯 HƯỚNG DẪN THIẾT LẬP VÀ SỬ DỤNG HỆ THỐNG HTTTQL

## 📋 SETUP BAN ĐẦU

### 1. Thiết Lập Database

**Cách nhanh nhất (phpMyAdmin):**
1. Mở http://localhost/phpmyadmin
2. Chọn "Nhập dữ liệu" (Import)
3. Chọn file: `c:\xampp\htdocs\HTTTQL\database.sql`
4. Bấm "Thực thi"

**Hoặc dùng Command Line:**
```powershell
cd C:\xampp\htdocs\HTTTQL
mysql -u root -p < database.sql
# Nhấn Enter khi hỏi password (mặc định không có)
```

### 2. Kiểm Tra Kết Nối

Truy cập: **http://localhost/HTTTQL**

## 👥 TÀI KHOẢN DEMO

| Vai trò | Username | Password | 
|---------|----------|----------|
| Tiếp đón & Thu ngân | reception | pass123 |
| Bác sĩ | doctor | pass123 |
| Y tá | nurse | pass123 |
| Cận lâm sàng | lab | pass123 |
| Kho dược | pharmacy | pass123 |
| Quản lý | admin | pass123 |

## 🚀 TÍNH NĂNG CHÍNH

### 👨‍💼 TIẾP ĐÓN & THU NGÂN
- **Đăng ký bệnh nhân**: Nhập thông tin bệnh nhân, tạo mã BN tự động
- **Phát số thứ tự**: Chọn chuyên khoa, phát số để bệnh nhân xếp hàng
- **Tính tiền/Xuất hóa đơn**: Lập hóa đơn, xử lý thanh toán

### 🏥 BÁC SĨ
- **Xem lịch hẹn**: Danh sách bệnh nhân trong ngày
- **Nhập hồ sơ bệnh án**: Ghi chẩn đoán, triệu chứng, sinh hiệu (huyết áp, nhịp tim, độ oxy, nhiệt độ...)
- **Ra lệnh xét nghiệm**: Yêu cầu xét nghiệm cho bệnh nhân
- **Kê đơn thuốc**: Kê đơn với liều lượng, cách dùng, thời gian

### 👩‍⚕️ Y TÁ
- **Đo sinh hiệu**: Ghi nhận huyết áp, nhiệt độ, nhịp tim...
- **Quản lý giường bệnh**: Xem tình trạng giường (trống/có bệnh nhân/đang vệ sinh)
- **Lịch phát thuốc**: Xem lịch tiêm/phát thuốc theo giờ

### 🔬 CẬN LÂM SÀNG (LAB/X-QUANG)
- **Tiếp nhận yêu cầu**: Xem danh sách xét nghiệm chờ
- **Trả kết quả**: Nhập kết quả số hoặc tải hình ảnh

### 💊 KHO DƯỢC
- **Duyệt đơn thuốc**: Xem danh sách đơn chờ chuẩn bị
- **Quản lý kho**: Xem tồn kho, hạn dùng, lịch sử nhập xuất

### ⚙️ QUẢN LÝ
- **Quản lý người dùng**: Thêm/sửa/xóa tài khoản nhân viên
- **Cấu hình giá dịch vụ**: Sửa giá khám, xét nghiệm...
- **Báo cáo thống kê**: Xem tổng bệnh nhân, doanh thu, dịch vụ phổ biến

## 🔧 CẤU HÌNH NÂNG CAO

**Thay đổi database config** - Sửa file `includes/config.php`:
```php
define('DB_HOST', 'localhost');      // Máy chủ MySQL
define('DB_USER', 'root');           // Tên đăng nhập
define('DB_PASSWORD', '');           // Mật khẩu
define('DB_NAME', 'htttql_hospital');// Tên database
```

## 📊 CẤU TRÚC DATABASE

**18 Bảng chính:**
- users, patients, appointments, medical_records
- lab_tests, prescriptions, medicines, invoices
- vital_signs, hospital_beds, medication_schedules
- queue_numbers, services, audit_logs, v.v.

## ⚠️ GIẢI QUYẾT LỖI

### ❌ "Kết nối database thất bại"
- Kiểm tra MySQL đang chạy (XAMPP)
- Import lại database.sql vào phpMyAdmin
- Kiểm tra config.php có đúng username/password

### ❌ "Đăng nhập thất bại"  
- Kiểm tra dữ liệu demo trong bảng `users`
- Mật khẩu được lưu MD5 hash

### ❌ Lỗi 404 trang không tìm thấy
- Kiểm tra tên file PHP có đúng không
- Xác nhận URL đúng: http://localhost/HTTTQL

## 📁 CẤU TRÚC THƯ MỤC

```
HTTTQL/
├── index.php              ← Dashboard chính
├── login.php              ← Đăng nhập
├── database.sql           ← Schema database
├── config.php             ← Cấu hình
├── includes/
│   ├── config.php         ← Kết nối DB + hàm hỗ trợ
│   ├── header.php         ← Menu trên
│   └── footer.php         ← Footer
├── css/
│   ├── style.css          ← Stylish chính
│   └── responsive.css     ← Mobile responsive
├── js/
│   └── main.js            ← JavaScript utilities
└── pages/
    ├── reception_cashier/  ← 3 trang tiếp đón
    ├── doctor/             ← 4 trang bác sĩ
    ├── nurse/              ← 3 trang y tá
    ├── lab_xray/           ← 2 trang cận lâm sàng
    ├── pharmacy/           ← 2 trang kho dược
    └── admin/              ← 3 trang quản lý
```

## 💡 MÁCH NHỎ

1. **Đăng nhập** với bất kỳ tài khoản demo
2. **Dashboard** sẽ hiển thị menu riêng cho từng vai trò
3. **Dữ liệu** được lưu trực tiếp vào MySQL
4. **Audit logs** ghi lại mọi hoạt động (xem trong admin)
5. **Số thứ tự** tự động reset mỗi ngày mới

## 📞 HỖ TRỢ

Kiểm tra file `DATABASE_SETUP.md` để xem chi tiết thiết lập database.

---

**Hệ thống HTTTQL - Quản lý Bệnh viện** ✨
