# HTTTQL - Hệ Thống Quản Lý Bệnh Viện

Hospital Management System (HTTTQL) là một ứng dụng web toàn diện dành cho quản lý các hoạt động bệnh viện, bao gồm quản lý bệnh nhân, lịch hẹn, điều trị y tế, kho dược, và báo cáo tài chính.

## 📋 Tính Năng Chính

### 1. **Nhóm Tiếp Đón & Thu Ngân** (Reception & Cashier)
- **Đăng Ký Thông Tin Bệnh Nhân**: Nhập thông tin chi tiết bệnh nhân mới
- **Phát Số Thứ Tự**: Cấp phát số thứ tự cho bệnh nhân
- **Tính Tiền / Xuất Hóa Đơn**: Xử lý thanh toán và in hóa đơn

### 2. **Nhóm Bác Sĩ** (Doctor)
- **Xem Lịch Hẹn**: Danh sách các bệnh nhân cần khám
- **Nhập Hồ Sơ Bệnh Án**: Ghi nhận triệu chứng, chẩn đoán và sinh hiệu
- **Ra Lệnh Xét Nghiệm**: Yêu cầu các xét nghiệm cần thiết
- **Kê Đơn Thuốc**: Kê đơn thuốc cho bệnh nhân

### 3. **Nhóm Y Tá / Điều Dưỡng** (Nurse)
- **Đo Sinh Hiệu Ban Đầu**: Ghi nhận các chỉ số sinh hiệu
- **Quản Lý Sơ Đồ Giường Bệnh**: Theo dõi tình trạng các giường bệnh
- **Lịch Phát Thuốc / Tiêm Thuốc**: Quản lý lịch phát thuốc và tiêm cho bệnh nhân

### 4. **Nhóm Cận Lâm Sàng** (Lab/X-ray)
- **Tiếp Nhận Yêu Cầu**: Nhận các yêu cầu xét nghiệm và X-quang
- **Trả Kết Quả**: Nhập chỉ số xét nghiệm và tải hình ảnh chụp

### 5. **Nhóm Kho Dược** (Pharmacy)
- **Duyệt Đơn / Phát Thuốc**: Xem xét và phát thuốc theo đơn
- **Quản Lý Xuất-Nhập-Tồn**: Quản lý kho thuốc, theo dõi hạn sử dụng

### 6. **Nhóm Quản Lý / Admin** (Admin)
- **Phân Quyền Tài Khoản**: Quản lý quyền hạn nhân viên
- **Cấu Hình Bảng Giá**: Thiết lập giá dịch vụ và xét nghiệm
- **Báo Cáo / Thống Kê**: Xem báo cáo doanh thu và thống kê bệnh nhân

## 🚀 Cách Sử Dụng

### Yêu Cầu Hệ Thống
- PHP 7.4+
- Apache Web Server
- MySQL 5.7+
- Modern Web Browser

### Cài Đặt

1. **Tải Dự Án**
   ```bash
   git clone <repository-url>
   cd HTTTQL
   ```

2. **Cấu Hình Database** (Tùy chọn)
   - Mặc định hệ thống sử dụng demo data
   - Để sử dụng database thực, chỉnh sửa `includes/config.php`

3. **Khởi Động**
   - Copy thư mục `HTTTQL` vào `c:\xampp\htdocs\`
   - Truy cập: `http://localhost/HTTTQL/`

### Tài Khoản Demo

| Tên Đăng Nhập | Mật Khẩu | Vai Trò |
|---|---|---|
| reception | pass123 | Tiếp Đón & Thu Ngân |
| doctor | pass123 | Bác Sĩ |
| nurse | pass123 | Y Tá / Điều Dưỡng |
| lab | pass123 | Cận Lâm Sàng |
| pharmacy | pass123 | Kho Dược |
| admin | pass123 | Admin |

## 📁 Cấu Trúc Thư Mục

```
HTTTQL/
├── index.php                 # Trang chủ (Dashboard)
├── login.php                 # Trang đăng nhập
├── logout.php                # Đăng xuất
├── includes/
│   ├── config.php            # Cấu hình database
│   ├── header.php            # Header chung
│   └── footer.php            # Footer chung
├── css/
│   ├── style.css             # CSS chính
│   └── responsive.css        # CSS responsive
├── js/
│   └── main.js               # JavaScript chính
├── pages/
│   ├── reception_cashier/    # Trang tiếp đón & thu ngân
│   │   ├── patient_registration.php
│   │   ├── queue_number.php
│   │   └── payment_invoice.php
│   ├── doctor/               # Trang bác sĩ
│   │   ├── appointments.php
│   │   ├── medical_record.php
│   │   ├── order_tests.php
│   │   └── prescriptions.php
│   ├── nurse/                # Trang y tá
│   │   ├── vital_signs.php
│   │   ├── bed_management.php
│   │   └── medication_schedule.php
│   ├── lab_xray/             # Trang cận lâm sàng
│   │   ├── request_receiving.php
│   │   └── result_submission.php
│   ├── pharmacy/             # Trang kho dược
│   │   ├── prescription_review.php
│   │   └── inventory_management.php
│   └── admin/                # Trang admin
│       ├── user_permissions.php
│       ├── pricing_config.php
│       └── reports.php
└── assets/                   # Hình ảnh và tài nguyên khác
```

## 🎨 Giao Diện & Thiết Kế

- **Thiết Kế Responsive**: Tương thích với mọi kích thước màn hình
- **Giao Diện Thân Thiện**: Dễ sử dụng cho người dùng không am hiểu công nghệ
- **Tông Màu**: Xanh dương chuyên nghiệp kết hợp với các màu cảnh báo thích hợp

### Màu Sắc Chính
- Primary: `#2c3e50` (Xanh dương đậm)
- Secondary: `#3498db` (Xanh dương sáng)
- Success: `#27ae60` (Xanh lá)
- Danger: `#e74c3c` (Đỏ)
- Warning: `#f39c12` (Vàng cam)

## 🔐 Bảo Mật

- Hỗ trợ phân quyền theo vai trò (Role-based Access Control)
- Session management để quản lý phiên đăng nhập
- Validation dữ liệu đầu vào
- Chức năng đăng xuất an toàn

## 📝 Hướng Dẫn Cho Từng Nhóm

### Tiếp Đón & Thu Ngân
1. Đăng nhập với tài khoản `reception`
2. Đăng ký bệnh nhân mới hoặc tìm bệnh nhân hiện có
3. Phát số thứ tự cho bệnh nhân
4. Xử lý thanh toán và in hóa đơn

### Bác Sĩ
1. Đăng nhập với tài khoản `doctor`
2. Xem lịch hẹn các bệnh nhân
3. Nhập hồ sơ bệnh án (triệu chứng, chẩn đoán)
4. Ra lệnh xét nghiệm nếu cần
5. Kê đơn thuốc

### Y Tá
1. Đăng nhập với tài khoản `nurse`
2. Đo sinh hiệu ban đầu cho bệnh nhân
3. Quản lý giường bệnh (cập nhật tình trạng)
4. Xác nhận phát thuốc/tiêm thuốc theo lịch

### Cận Lâm Sàng
1. Đăng nhập với tài khoản `lab`
2. Tiếp nhận yêu cầu xét nghiệm
3. Nhập kết quả xét nghiệm (chỉ số hoặc hình ảnh)

### Kho Dược
1. Đăng nhập với tài khoản `pharmacy`
2. Duyệt các đơn thuốc từ bác sĩ
3. Phát thuốc cho bệnh nhân
4. Quản lý tồn kho thuốc và hạn sử dụng

### Admin
1. Đăng nhập với tài khoản `admin`
2. Quản lý tài khoản nhân viên (phân quyền)
3. Cấu hình bảng giá dịch vụ
4. Xem báo cáo doanh thu và thống kê

## 🔄 Quy Trình Khám Bệnh Điển Hình

1. **Tiếp Đón**: Bệnh nhân đến - Đăng ký thông tin - Phát số thứ tự
2. **Y Tá**: Đo sinh hiệu ban đầu (huyết áp, nhiệt độ, v.v.)
3. **Bác Sĩ**: Khám bệnh - Nhập hồ sơ bệnh án - Ra lệnh xét nghiệm - Kê đơn
4. **Cận Lâm Sàng**: Thực hiện xét nghiệm/X-quang - Nhập kết quả
5. **Kho Dược**: Duyệt và phát thuốc
6. **Thu Ngân**: Tính tiền - Xuất hóa đơn

## 🐛 Báo Cáo Lỗi

Nếu phát hiện lỗi, vui lòng liên hệ:
- Email: support@hospital.com
- Điện thoại: (024) xxxx-xxxx

## 📚 Tài Liệu Tham Khảo

- [PHP Documentation](https://www.php.net/docs.php)
- [MySQL Reference](https://dev.mysql.com/doc/)
- [HTML/CSS Guide](https://developer.mozilla.org/en-US/)

## 📄 Giấy Phép

Copyright © 2026 Bệnh Viện. Tất cả các quyền được bảo lưu.

## 👥 Nhóm Phát Triển

- Phát triển: IT Department
- Kiểm thử: QA Team
- Quản lý dự án: Project Manager

## 🎯 Các Tính Năng Sắp Tới

- [ ] Tích hợp thanh toán online
- [ ] Hệ thống SMS/Email thông báo
- [ ] Cải thiện báo cáo dữ liệu
- [ ] Mobile app
- [ ] Hệ thống backup tự động

---

**Phiên Bản**: 1.0.0  
**Ngày Phát Hành**: May 2026  
**Trạng Thái**: Stable
