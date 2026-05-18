# 📋 HƯỚNG DẪN THIẾT LẬP DATABASE

## ✅ Bước 1: Đảm bảo XAMPP đang chạy
- Mở **XAMPP Control Panel**
- Khởi động **Apache** và **MySQL**

## ✅ Bước 2: Truy cập phpMyAdmin
- Mở trình duyệt
- Truy cập: **http://localhost/phpmyadmin**

## ✅ Bước 3: Tạo Database

### Cách 1: Sử dụng phpMyAdmin (Dễ nhất)
1. Vào mục **"Nhập dữ liệu"** (Import)
2. Chọn file: **database.sql** (nằm trong thư mục HTTTQL)
3. Click **"Thực thi"** (Go)
4. Chờ hoàn tất, database `htttql_hospital` sẽ được tạo tự động

### Cách 2: Sử dụng Command Line
1. Mở **PowerShell** hoặc **CMD**
2. Di chuyển tới thư mục HTTTQL:
   ```powershell
   cd C:\xampp\htdocs\HTTTQL
   ```
3. Chạy lệnh:
   ```powershell
   mysql -u root -p < database.sql
   ```
4. Khi được hỏi mật khẩu, chỉ cần nhấn **Enter** (mặc định không có mật khẩu)

## ✅ Bước 4: Kiểm tra Kết nối

### Đăng nhập bằng Demo Account:
- **Tài khoản**: reception (hoặc doctor, nurse, lab, pharmacy, admin)
- **Mật khẩu**: pass123

### Tài khoản Demo:
| Tài khoản | Mật khẩu | Vai trò |
|-----------|----------|--------|
| reception | pass123 | Tiếp đón & Thu ngân |
| doctor | pass123 | Bác sĩ |
| nurse | pass123 | Y tá |
| lab | pass123 | Cận lâm sàng |
| pharmacy | pass123 | Kho dược |
| admin | pass123 | Quản lý |

## ⚠️ Xử lý Lỗi

### Lỗi: "Kết nối database thất bại"
**Giải pháp:**
1. Kiểm tra MySQL đang chạy
2. Kiểm tra tên database, username, password trong `config.php`
3. Đảm bảo file `database.sql` đã được import

### Lỗi: "Bảng không tồn tại"
**Giải pháp:**
1. Vào phpMyAdmin
2. Chọn database `htttql_hospital`
3. Kiểm tra xem các bảng có được tạo (nên có 18 bảng)
4. Nếu chưa có, import lại file `database.sql`

### Lỗi: "Đăng nhập thất bại"
**Giải pháp:**
1. Kiểm tra tài khoản demo có tồn tại trong bảng `users`
2. Trong phpMyAdmin, vào `htttql_hospital` → `users`
3. Kiểm tra dữ liệu demo

## 📊 Cấu trúc Database

### 18 Bảng Chính:
1. **users** - Tài khoản người dùng
2. **patients** - Thông tin bệnh nhân
3. **appointments** - Lịch hẹn
4. **medical_records** - Hồ sơ bệnh án
5. **lab_tests** - Xét nghiệm
6. **test_result_files** - File kết quả xét nghiệm
7. **prescriptions** - Đơn thuốc
8. **prescription_items** - Chi tiết đơn thuốc
9. **medicines** - Thông tin thuốc
10. **invoices** - Hóa đơn
11. **invoice_items** - Chi tiết hóa đơn
12. **vital_signs** - Sinh hiệu
13. **hospital_beds** - Giường bệnh
14. **medication_schedules** - Lịch phát thuốc
15. **queue_numbers** - Quản lý số thứ tự
16. **services** - Danh sách dịch vụ
17. **inventory_history** - Lịch sử kho dược
18. **audit_logs** - Nhật ký hoạt động

## 🔧 Cấu hình Nâng cao

### Thay đổi Thông tin Kết nối:
Chỉnh sửa file `includes/config.php`:
```php
define('DB_HOST', 'localhost');      // Máy chủ MySQL
define('DB_USER', 'root');           // Tên người dùng
define('DB_PASSWORD', '');           // Mật khẩu
define('DB_NAME', 'htttql_hospital');// Tên database
```

## ✨ Sau Khi Thiết Lập
1. Truy cập: **http://localhost/HTTTQL**
2. Đăng nhập bằng tài khoản demo
3. Bắt đầu sử dụng hệ thống!
