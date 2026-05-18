<?php
/*
 * HTTTQL - Hospital Management System
 * Tệp này mô tả cấu trúc toàn bộ hệ thống
 */
?>

# HTTTQL - DANH SÁCH TỆPS HOÀN CHỈNH

## 📁 CẤU TRÚC THƯ MỤC

```
c:\xampp\htdocs\HTTTQL\
│
├── 📄 index.php                        # Trang chủ Dashboard
├── 📄 login.php                        # Trang Đăng Nhập
├── 📄 logout.php                       # Đăng Xuất
├── 📄 README.md                        # Tài Liệu Hệ Thống
│
├── 📁 includes/                        # Các tệp Include chung
│   ├── 📄 config.php                   # Cấu hình Database
│   ├── 📄 header.php                   # Header chung
│   └── 📄 footer.php                   # Footer chung
│
├── 📁 css/                             # CSS Files
│   ├── 📄 style.css                    # CSS Chính
│   └── 📄 responsive.css               # CSS Responsive Design
│
├── 📁 js/                              # JavaScript Files
│   └── 📄 main.js                      # JavaScript Chính
│
├── 📁 assets/                          # Hình ảnh & Tài nguyên
│
└── 📁 pages/                           # Các Trang Chính
    │
    ├── 📁 reception_cashier/           # NHÓM TIẾP ĐÓN & THU NGÂN
    │   ├── 📄 patient_registration.php # ✓ Đăng ký thông tin bệnh nhân
    │   ├── 📄 queue_number.php         # ✓ Phát số thứ tự
    │   └── 📄 payment_invoice.php      # ✓ Tính tiền / Xuất hóa đơn
    │
    ├── 📁 doctor/                      # NHÓM BÁC SĨ
    │   ├── 📄 appointments.php         # ✓ Xem lịch hẹn
    │   ├── 📄 medical_record.php       # ✓ Nhập Hồ sơ bệnh án
    │   ├── 📄 order_tests.php          # ✓ Ra lệnh xét nghiệm
    │   └── 📄 prescriptions.php        # ✓ Kê đơn thuốc
    │
    ├── 📁 nurse/                       # NHÓM Y TÁ / ĐIỀU DƯỠNG
    │   ├── 📄 vital_signs.php          # ✓ Đo sinh hiệu ban đầu
    │   ├── 📄 bed_management.php       # ✓ Quản lý sơ đồ giường bệnh
    │   └── 📄 medication_schedule.php  # ✓ Lịch phát thuốc / tiêm thuốc
    │
    ├── 📁 lab_xray/                    # NHÓM CẬN LÂM SÀNG
    │   ├── 📄 request_receiving.php    # ✓ Tiếp nhận yêu cầu
    │   └── 📄 result_submission.php    # ✓ Trả kết quả xét nghiệm
    │
    ├── 📁 pharmacy/                    # NHÓM KHO DƯỢC
    │   ├── 📄 prescription_review.php  # ✓ Duyệt đơn / Phát thuốc
    │   └── 📄 inventory_management.php # ✓ Quản lý xuất-nhập-tồn
    │
    └── 📁 admin/                       # NHÓM QUẢN LÝ / ADMIN
        ├── 📄 user_permissions.php     # ✓ Phân quyền tài khoản
        ├── 📄 pricing_config.php       # ✓ Cấu hình bảng giá
        └── 📄 reports.php              # ✓ Báo cáo doanh thu
```

## ✅ DANH SÁCH TÌM TẤT CẢ CÁC TÍNH NĂNG

### 1️⃣ NHÓM TIẾP ĐÓN & THU NGÂN (Reception & Cashier)

#### Trang 1.1: Đăng Ký Thông Tin Bệnh Nhân
- **File**: `pages/reception_cashier/patient_registration.php`
- **Tính năng**:
  - Form nhập thông tin bệnh nhân (tên, ngày sinh, giới tính, điện thoại, email, địa chỉ)
  - Lưu mã bảo hiểm y tế
  - Validation dữ liệu
  - Phát mã bệnh nhân tự động
  - Thông báo thành công

#### Trang 1.2: Phát Số Thứ Tự
- **File**: `pages/reception_cashier/queue_number.php`
- **Tính năng**:
  - Danh sách chuyên khoa và bác sĩ
  - Số thứ tự hiện tại cho mỗi chuyên khoa
  - Phát số thứ tự tự động tăng
  - Hiển thị thời gian phát hành
  - Chức năng in phiếu

#### Trang 1.3: Tính Tiền / Xuất Hóa Đơn
- **File**: `pages/reception_cashier/payment_invoice.php`
- **Tính năng**:
  - Tìm bệnh nhân
  - Danh sách dịch vụ sử dụng
  - Tính toán tổng tiền
  - Áp dụng chiết khấu
  - Chọn hình thức thanh toán
  - In hóa đơn

---

### 2️⃣ NHÓM BÁC SĨ (Doctor)

#### Trang 2.1: Xem Lịch Hẹn
- **File**: `pages/doctor/appointments.php`
- **Tính năng**:
  - Danh sách bệnh nhân theo ngày
  - Khung giờ khám
  - Mã bệnh nhân, tên, chuyên khoa
  - Trạng thái (đã tới, chờ, không tới)
  - Lọc theo ngày
  - Link vào hồ sơ bệnh án

#### Trang 2.2: Nhập Hồ Sơ Bệnh Án
- **File**: `pages/doctor/medical_record.php`
- **Tính năng**:
  - Thông tin bệnh nhân (tên, tuổi, BHYT)
  - Nhập triệu chứng
  - Nhập chẩn đoán (mã ICD-10)
  - Phương pháp điều trị
  - Ghi sinh hiệu (huyết áp, nhiệt độ, nhịp tim, hô hấp)
  - Lưu hồ sơ

#### Trang 2.3: Ra Lệnh Xét Nghiệm
- **File**: `pages/doctor/order_tests.php`
- **Tính năng**:
  - Chọn bệnh nhân
  - Chọn loại xét nghiệm
  - Mức độ ưu tiên
  - Lý do yêu cầu
  - Ghi chú
  - Danh sách lệnh gần đây
  - Trạng thái từng lệnh

#### Trang 2.4: Kê Đơn Thuốc
- **File**: `pages/doctor/prescriptions.php`
- **Tính năng**:
  - Chọn bệnh nhân
  - Thêm thuốc vào đơn
  - Nhập liều dùng và cách dùng
  - Bảng danh sách thuốc
  - Xóa thuốc khỏi đơn
  - Hướng dẫn sử dụng
  - Ngày hết hiệu lực của đơn

---

### 3️⃣ NHÓM Y TÁ / ĐIỀU DƯỠNG (Nurse)

#### Trang 3.1: Đo Sinh Hiệu Ban Đầu
- **File**: `pages/nurse/vital_signs.php`
- **Tính năng**:
  - Chọn bệnh nhân
  - Nhập huyết áp (mmHg)
  - Nhập nhiệt độ (°C)
  - Nhập nhịp tim (lần/phút)
  - Nhập tần số hô hấp
  - Cân nặng (kg)
  - Chiều cao (cm)
  - Oxy hóa (SpO2)
  - Ghi chú
  - Validation dữ liệu

#### Trang 3.2: Quản Lý Sơ Đồ Giường Bệnh
- **File**: `pages/nurse/bed_management.php`
- **Tính năng**:
  - Hiển thị sơ đồ giường bệnh
  - Tình trạng giường (trống, đã sử dụng, cần vệ sinh)
  - Thông tin bệnh nhân trên giường
  - Chuyên khoa nằm viện
  - Phân bổ bệnh nhân vào giường
  - Thống kê giường (tổng, trống, sử dụng)
  - Lọc theo tầng/phòng

#### Trang 3.3: Lịch Phát Thuốc / Tiêm Thuốc
- **File**: `pages/nurse/medication_schedule.php`
- **Tính năng**:
  - Danh sách phát thuốc/tiêm theo thời gian
  - Tên bệnh nhân
  - Loại thuốc, liều dùng
  - Ghi chú cách dùng
  - Xác nhận thực hiện
  - Lọc theo ngày
  - Lọc theo loại (phát/tiêm)
  - Trạng thái thực hiện

---

### 4️⃣ NHÓM CẬN LÂM SÀNG (Lab/X-ray)

#### Trang 4.1: Tiếp Nhận Yêu Cầu
- **File**: `pages/lab_xray/request_receiving.php`
- **Tính năng**:
  - Danh sách yêu cầu xét nghiệm/X-quang
  - Mã yêu cầu
  - Tên bệnh nhân
  - Loại xét nghiệm
  - Mức ưu tiên
  - Ngày tạo
  - Trạng thái (chờ tiếp nhận, đã tiếp nhận, đang xử lý)
  - Nút tiếp nhận
  - Lọc theo trạng thái

#### Trang 4.2: Trả Kết Quả Xét Nghiệm
- **File**: `pages/lab_xray/result_submission.php`
- **Tính năng**:
  - Thông tin yêu cầu (mã, bệnh nhân, loại xét nghiệm)
  - Chọn loại kết quả (chỉ số/hình ảnh)
  - Nhập chỉ số xét nghiệm
  - Tải hình ảnh X-quang
  - Mô tả hình ảnh
  - Giải thích kết quả
  - Ghi chú
  - Nộp kết quả

---

### 5️⃣ NHÓM KHO DƯỢC (Pharmacy)

#### Trang 5.1: Duyệt Đơn / Phát Thuốc
- **File**: `pages/pharmacy/prescription_review.php`
- **Tính năng**:
  - Danh sách đơn thuốc
  - Mã đơn, bệnh nhân, bác sĩ kê đơn
  - Số loại thuốc trong đơn
  - Trạng thái (chờ duyệt, đã duyệt, đã phát)
  - Lọc theo trạng thái/ngày
  - Xem chi tiết đơn
  - Nút duyệt đơn
  - Nút phát thuốc

#### Trang 5.2: Quản Lý Xuất-Nhập-Tồn
- **File**: `pages/pharmacy/inventory_management.php`
- **Tính năng**:
  - Danh sách thuốc trong kho
  - Mã thuốc, tên, tồn kho
  - Đơn vị (viên, vỉ, lọ, hộp)
  - Hạn sử dụng (với cảnh báo hết hạn)
  - Giá nhập
  - Nút chỉnh sửa/xóa
  - Tìm kiếm thuốc
  - Nhập hàng mới
  - Lịch sử giao dịch (nhập/xuất/hủy)
  - Thống kê tồn kho

---

### 6️⃣ NHÓM QUẢN LÝ / ADMIN (Admin)

#### Trang 6.1: Phân Quyền Tài Khoản Nhân Viên
- **File**: `pages/admin/user_permissions.php`
- **Tính năng**:
  - Danh sách nhân viên
  - ID, họ tên, email, chức danh
  - Phòng ban, vai trò hệ thống
  - Trạng thái (hoạt động/khóa)
  - Nút chỉnh sửa quyền
  - Nút xóa tài khoản
  - Nút thêm tài khoản mới
  - Phân quyền chi tiết (xem, thêm, sửa, xóa)

#### Trang 6.2: Cấu Hình Bảng Giá
- **File**: `pages/admin/pricing_config.php`
- **Tính năng**:
  - Bảng giá dịch vụ khám
  - Bảng giá xét nghiệm
  - Chỉnh sửa giá trực tiếp trong bảng
  - Cột: Tên dịch vụ, đơn vị, giá, ghi chú
  - Lưu bảng giá
  - Tính toán doanh thu dựa trên giá

#### Trang 6.3: Báo Cáo Doanh Thu & Thống Kê
- **File**: `pages/admin/reports.php`
- **Tính năng**:
  - Dashboard thống kê
  - Tổng bệnh nhân, doanh thu tháng, bệnh nhân tháng này, tỷ lệ tái khám
  - Bộ lọc: ngày từ-đến, chuyên khoa
  - Bảng doanh thu theo tháng
  - Top 5 dịch vụ sử dụng nhiều
  - Xuất báo cáo (PDF, Excel)
  - Biểu đồ thống kê

---

## 🌐 TỆPS CƠ BẢN HỮU DỤNG

### Trang Chính & Xác Thực
- `index.php` - Dashboard trang chủ
- `login.php` - Đăng nhập
- `logout.php` - Đăng xuất

### Tệps Include
- `includes/config.php` - Cấu hình database
- `includes/header.php` - Header chung
- `includes/footer.php` - Footer chung

### CSS & JavaScript
- `css/style.css` - Kiểu dáng chính
- `css/responsive.css` - Responsive Design
- `js/main.js` - JavaScript tiện ích

---

## 🔑 TÍNH NĂNG CHÍNH CỦA HỆ THỐNG

✅ **Quản lý bệnh nhân** - Đăng ký, tìm kiếm, cập nhật
✅ **Lịch hẹn** - Xem, lên lịch khám
✅ **Hồ sơ bệnh án** - Ghi chép triệu chứng, chẩn đoán
✅ **Xét nghiệm** - Ra lệnh, nhập kết quả
✅ **Đơn thuốc** - Kê đơn, duyệt, phát
✅ **Sinh hiệu** - Đo và ghi nhận
✅ **Giường bệnh** - Quản lý tình trạng
✅ **Kho dược** - Quản lý tồn kho, hạn sử dụng
✅ **Thanh toán** - Tính tiền, in hóa đơn
✅ **Báo cáo** - Doanh thu, thống kê
✅ **Phân quyền** - Quản lý tài khoản nhân viên
✅ **Bảng giá** - Cấu hình giá dịch vụ

---

## 👥 TƯƠNG THÍCH VAI TRÒ

| Vai Trò | Tên Đăng Nhập | Các Trang Có Thể Truy Cập |
|---------|---|---|
| **Tiếp Đón** | reception | patient_registration, queue_number, payment_invoice |
| **Bác Sĩ** | doctor | appointments, medical_record, order_tests, prescriptions |
| **Y Tá** | nurse | vital_signs, bed_management, medication_schedule |
| **Cận Lâm Sàng** | lab | request_receiving, result_submission |
| **Kho Dược** | pharmacy | prescription_review, inventory_management |
| **Admin** | admin | user_permissions, pricing_config, reports |

---

## 📋 DANH SÁCH TỆPS HOÀN TOÀN

**Tổng cộng**: 26 tệps chính + 3 tệps config

**Tệps PHP**: 22
**Tệps CSS**: 2
**Tệps JS**: 1
**Tệps Markdown/Doc**: 2

---

## 🚀 HƯỚNG DẪN NHANH

1. **Khởi động**: Truy cập `http://localhost/HTTTQL/`
2. **Đăng nhập**: Sử dụng một tài khoản demo
3. **Chọn chức năng**: Từ dashboard chính
4. **Thực hiện công việc**: Theo từng chức năng
5. **Đăng xuất**: Nút Đăng xuất ở navbar

---

**Phiên bản**: 1.0.0  
**Ngày tạo**: May 2026  
**Tình trạng**: Hoàn thành ✅
