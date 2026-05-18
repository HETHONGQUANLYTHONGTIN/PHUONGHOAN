-- ============================================================================
-- HTTTQL - Hệ Thống Quản Lý Bệnh Viện
-- Tạo: 18/05/2026
-- ============================================================================

-- Tạo cơ sở dữ liệu
DROP DATABASE IF EXISTS `htttql_hospital`;
CREATE DATABASE IF NOT EXISTS `htttql_hospital` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `htttql_hospital`;

-- ============================================================================
-- 1. BẢNG NGƯỜI DÙNG (Người Dùng)
-- ============================================================================
CREATE TABLE `người_dùng` (
  `user_id` INT PRIMARY KEY AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `full_name` VARCHAR(100) NOT NULL,
  `role` ENUM('tiếp_đón_thu_ngân', 'bác_sĩ', 'y_tá', 'cận_lâm_sàng', 'kho_dược', 'quản_lý') NOT NULL,
  `department` VARCHAR(100),
  `position` VARCHAR(100),
  `status` ENUM('hoạt_động', 'không_hoạt_động', 'bị_khóa') DEFAULT 'hoạt_động',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ============================================================================
-- 2. BẢNG BỆNH NHÂN (Bệnh Nhân)
-- ============================================================================
CREATE TABLE `bệnh_nhân` (
  `patient_id` INT PRIMARY KEY AUTO_INCREMENT,
  `patient_code` VARCHAR(20) NOT NULL UNIQUE,
  `full_name` VARCHAR(100) NOT NULL,
  `date_of_birth` DATE NOT NULL,
  `gender` ENUM('nam', 'nữ', 'khác') NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `email` VARCHAR(100),
  `address` TEXT,
  `insurance_code` VARCHAR(50),
  `insurance_exp_date` DATE,
  `status` ENUM('hoạt_động', 'không_hoạt_động', 'xuất_viện') DEFAULT 'hoạt_động',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ============================================================================
-- 3. BẢNG LỊCH HẸN (Lịch Hẹn)
-- ============================================================================
CREATE TABLE `lịch_hẹn` (
  `appointment_id` INT PRIMARY KEY AUTO_INCREMENT,
  `appointment_code` VARCHAR(20) NOT NULL UNIQUE,
  `patient_id` INT NOT NULL,
  `doctor_id` INT NOT NULL,
  `specialty` VARCHAR(100) NOT NULL,
  `appointment_date` DATETIME NOT NULL,
  `queue_number` INT,
  `status` ENUM('đã_lên_lịch', 'đã_tới', 'đang_khám', 'hoàn_thành', 'đã_hủy', 'không_tới') DEFAULT 'đã_lên_lịch',
  `notes` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`patient_id`) REFERENCES `bệnh_nhân`(`patient_id`),
  FOREIGN KEY (`doctor_id`) REFERENCES `người_dùng`(`user_id`)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ============================================================================
-- 4. BẢNG HỒ SƠ BỆNH ÁN (Hồ Sơ Bệnh Án)
-- ============================================================================
CREATE TABLE `hồ_sơ_bệnh_án` (
  `record_id` INT PRIMARY KEY AUTO_INCREMENT,
  `record_code` VARCHAR(20) NOT NULL UNIQUE,
  `patient_id` INT NOT NULL,
  `doctor_id` INT NOT NULL,
  `appointment_id` INT,
  `symptoms` TEXT NOT NULL,
  `diagnosis` TEXT NOT NULL,
  `diagnosis_code` VARCHAR(20),
  `treatment_plan` TEXT,
  `blood_pressure` VARCHAR(20),
  `temperature` DECIMAL(5, 2),
  `heart_rate` INT,
  `respiratory_rate` INT,
  `weight` DECIMAL(6, 2),
  `height` INT,
  `oxygen_saturation` DECIMAL(5, 2),
  `notes` TEXT,
  `record_date` DATETIME NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`patient_id`) REFERENCES `bệnh_nhân`(`patient_id`),
  FOREIGN KEY (`doctor_id`) REFERENCES `người_dùng`(`user_id`),
  FOREIGN KEY (`appointment_id`) REFERENCES `lịch_hẹn`(`appointment_id`)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ============================================================================
-- 5. BẢNG XÉT NGHIỆM (Xét Nghiệm)
-- ============================================================================
CREATE TABLE `xét_nghiệm` (
  `test_id` INT PRIMARY KEY AUTO_INCREMENT,
  `test_code` VARCHAR(20) NOT NULL UNIQUE,
  `patient_id` INT NOT NULL,
  `doctor_id` INT NOT NULL,
  `test_type` VARCHAR(100) NOT NULL,
  `urgency` ENUM('bình_thường', 'khẩn_cấp') DEFAULT 'bình_thường',
  `indication` TEXT,
  `status` ENUM('đã_đặt', 'đã_nhận', 'đang_xử_lý', 'hoàn_thành', 'đã_hủy') DEFAULT 'đã_đặt',
  `requested_date` DATETIME NOT NULL,
  `completed_date` DATETIME,
  `results` TEXT,
  `result_description` TEXT,
  `technician_id` INT,
  `notes` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`patient_id`) REFERENCES `bệnh_nhân`(`patient_id`),
  FOREIGN KEY (`doctor_id`) REFERENCES `người_dùng`(`user_id`),
  FOREIGN KEY (`technician_id`) REFERENCES `người_dùng`(`user_id`)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ============================================================================
-- 6. BẢNG FILE KẾT QUẢ (File Kết Quả)
-- ============================================================================
CREATE TABLE `file_kết_quả` (
  `file_id` INT PRIMARY KEY AUTO_INCREMENT,
  `test_id` INT NOT NULL,
  `file_name` VARCHAR(255) NOT NULL,
  `file_path` VARCHAR(255) NOT NULL,
  `file_type` VARCHAR(50),
  `file_size` INT,
  `description` TEXT,
  `uploaded_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`test_id`) REFERENCES `xét_nghiệm`(`test_id`)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ============================================================================
-- 7. BẢNG ĐƠN THUỐC (Đơn Thuốc)
-- ============================================================================
CREATE TABLE `đơn_thuốc` (
  `prescription_id` INT PRIMARY KEY AUTO_INCREMENT,
  `prescription_code` VARCHAR(20) NOT NULL UNIQUE,
  `patient_id` INT NOT NULL,
  `doctor_id` INT NOT NULL,
  `medical_record_id` INT,
  `prescription_date` DATETIME NOT NULL,
  `status` ENUM('nháp', 'hoạt_động', 'chờ_duyệt', 'được_duyệt', 'đã_phát', 'hoàn_thành', 'đã_hủy') DEFAULT 'nháp',
  `reviewed_by` INT,
  `review_date` DATETIME,
  `dispensed_by` INT,
  `dispensed_date` DATETIME,
  `instructions` TEXT,
  `refills` INT DEFAULT 0,
  `expiry_date` DATE,
  `notes` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`patient_id`) REFERENCES `bệnh_nhân`(`patient_id`),
  FOREIGN KEY (`doctor_id`) REFERENCES `người_dùng`(`user_id`),
  FOREIGN KEY (`medical_record_id`) REFERENCES `hồ_sơ_bệnh_án`(`record_id`),
  FOREIGN KEY (`reviewed_by`) REFERENCES `người_dùng`(`user_id`),
  FOREIGN KEY (`dispensed_by`) REFERENCES `người_dùng`(`user_id`)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ============================================================================
-- 8. BẢNG THUỐC (Thuốc)
-- ============================================================================
CREATE TABLE `thuốc` (
  `medicine_id` INT PRIMARY KEY AUTO_INCREMENT,
  `medicine_code` VARCHAR(20) NOT NULL UNIQUE,
  `medicine_name` VARCHAR(100) NOT NULL,
  `active_ingredient` VARCHAR(100),
  `strength` VARCHAR(50),
  `unit` VARCHAR(20),
  `price_per_unit` DECIMAL(10, 2),
  `quantity_in_stock` INT DEFAULT 0,
  `min_stock_level` INT DEFAULT 10,
  `expiry_date` DATE,
  `manufacturer` VARCHAR(100),
  `batch_number` VARCHAR(50),
  `storage_location` VARCHAR(100),
  `status` ENUM('hoạt_động', 'không_hoạt_động', 'hết_hạn', 'ngừng_sản_xuất') DEFAULT 'hoạt_động',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ============================================================================
-- 9. BẢNG CHI TIẾT ĐƠN THUỐC (Chi Tiết Đơn Thuốc)
-- ============================================================================
CREATE TABLE `chi_tiết_đơn_thuốc` (
  `item_id` INT PRIMARY KEY AUTO_INCREMENT,
  `prescription_id` INT NOT NULL,
  `medicine_id` INT NOT NULL,
  `dosage` VARCHAR(100) NOT NULL,
  `unit` VARCHAR(20),
  `frequency` VARCHAR(100),
  `duration_days` INT,
  `quantity` INT,
  `notes` TEXT,
  FOREIGN KEY (`prescription_id`) REFERENCES `đơn_thuốc`(`prescription_id`),
  FOREIGN KEY (`medicine_id`) REFERENCES `thuốc`(`medicine_id`)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ============================================================================
-- 10. BẢNG LỊCH SỬ KHO (Lịch Sử Kho)
-- ============================================================================
CREATE TABLE `lịch_sử_kho` (
  `history_id` INT PRIMARY KEY AUTO_INCREMENT,
  `medicine_id` INT NOT NULL,
  `transaction_type` ENUM('nhập', 'xuất', 'điều_chỉnh', 'hủy') NOT NULL,
  `quantity` INT NOT NULL,
  `previous_stock` INT,
  `new_stock` INT,
  `reference_id` VARCHAR(50),
  `notes` TEXT,
  `recorded_by` INT,
  `transaction_date` DATETIME NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`medicine_id`) REFERENCES `thuốc`(`medicine_id`),
  FOREIGN KEY (`recorded_by`) REFERENCES `người_dùng`(`user_id`)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ============================================================================
-- 11. BẢNG SINH HIỆU (Sinh Hiệu)
-- ============================================================================
CREATE TABLE `sinh_hiệu` (
  `vital_id` INT PRIMARY KEY AUTO_INCREMENT,
  `patient_id` INT NOT NULL,
  `nurse_id` INT NOT NULL,
  `blood_pressure` VARCHAR(20),
  `temperature` DECIMAL(5, 2),
  `heart_rate` INT,
  `respiratory_rate` INT,
  `weight` DECIMAL(6, 2),
  `height` INT,
  `oxygen_saturation` DECIMAL(5, 2),
  `notes` TEXT,
  `measured_at` DATETIME NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`patient_id`) REFERENCES `bệnh_nhân`(`patient_id`),
  FOREIGN KEY (`nurse_id`) REFERENCES `người_dùng`(`user_id`)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ============================================================================
-- 12. BẢNG GIƯỜNG BỆNH (Giường Bệnh)
-- ============================================================================
CREATE TABLE `giường_bệnh` (
  `bed_id` INT PRIMARY KEY AUTO_INCREMENT,
  `bed_code` VARCHAR(20) NOT NULL UNIQUE,
  `floor` INT NOT NULL,
  `room_number` INT NOT NULL,
  `bed_number` INT NOT NULL,
  `specialty` VARCHAR(100),
  `status` ENUM('trống', 'có_người', 'bảo_trì', 'cần_vệ_sinh') DEFAULT 'trống',
  `current_patient_id` INT,
  `admitted_date` DATETIME,
  `notes` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`current_patient_id`) REFERENCES `bệnh_nhân`(`patient_id`)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ============================================================================
-- 13. BẢNG LỊCH PHÁT THUỐC (Lịch Phát Thuốc)
-- ============================================================================
CREATE TABLE `lịch_phát_thuốc` (
  `schedule_id` INT PRIMARY KEY AUTO_INCREMENT,
  `patient_id` INT NOT NULL,
  `prescription_item_id` INT NOT NULL,
  `scheduled_time` DATETIME NOT NULL,
  `medication_type` ENUM('uống', 'tiêm', 'bôi_ngoài', 'hít_vào') DEFAULT 'uống',
  `status` ENUM('chờ_xử_lý', 'hoàn_thành', 'bỏ_qua', 'đã_hủy') DEFAULT 'chờ_xử_lý',
  `administered_by` INT,
  `administered_at` DATETIME,
  `notes` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`patient_id`) REFERENCES `bệnh_nhân`(`patient_id`),
  FOREIGN KEY (`prescription_item_id`) REFERENCES `chi_tiết_đơn_thuốc`(`item_id`),
  FOREIGN KEY (`administered_by`) REFERENCES `người_dùng`(`user_id`)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ============================================================================
-- 14. BẢNG DỊCH VỤ (Dịch Vụ)
-- ============================================================================
CREATE TABLE `dịch_vụ` (
  `service_id` INT PRIMARY KEY AUTO_INCREMENT,
  `service_code` VARCHAR(20) NOT NULL UNIQUE,
  `service_name` VARCHAR(100) NOT NULL,
  `service_category` ENUM('tư_vấn', 'xét_nghiệm', 'thủ_thuật', 'điều_trị', 'khác') NOT NULL,
  `price` DECIMAL(10, 2) NOT NULL,
  `description` TEXT,
  `status` ENUM('hoạt_động', 'không_hoạt_động') DEFAULT 'hoạt_động',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ============================================================================
-- 15. BẢNG HÓA ĐƠN (Hóa Đơn)
-- ============================================================================
CREATE TABLE `hóa_đơn` (
  `invoice_id` INT PRIMARY KEY AUTO_INCREMENT,
  `invoice_number` VARCHAR(20) NOT NULL UNIQUE,
  `patient_id` INT NOT NULL,
  `invoice_date` DATETIME NOT NULL,
  `total_amount` DECIMAL(12, 2) NOT NULL,
  `discount_percent` DECIMAL(5, 2) DEFAULT 0,
  `discount_amount` DECIMAL(12, 2) DEFAULT 0,
  `final_amount` DECIMAL(12, 2) NOT NULL,
  `payment_status` ENUM('chờ_thanh_toán', 'thanh_toán_một_phần', 'đã_thanh_toán', 'quá_hạn', 'đã_hủy') DEFAULT 'chờ_thanh_toán',
  `payment_method` ENUM('tiền_mặt', 'thẻ', 'chuyển_khoản', 'bảo_hiểm') DEFAULT 'tiền_mặt',
  `paid_amount` DECIMAL(12, 2) DEFAULT 0,
  `paid_date` DATETIME,
  `cashier_id` INT,
  `notes` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`patient_id`) REFERENCES `bệnh_nhân`(`patient_id`),
  FOREIGN KEY (`cashier_id`) REFERENCES `người_dùng`(`user_id`)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ============================================================================
-- 16. BẢNG CHI TIẾT HÓA ĐƠN (Chi Tiết Hóa Đơn)
-- ============================================================================
CREATE TABLE `chi_tiết_hóa_đơn` (
  `item_id` INT PRIMARY KEY AUTO_INCREMENT,
  `invoice_id` INT NOT NULL,
  `service_id` INT,
  `description` VARCHAR(255) NOT NULL,
  `quantity` INT DEFAULT 1,
  `unit_price` DECIMAL(10, 2) NOT NULL,
  `total_price` DECIMAL(12, 2) NOT NULL,
  `notes` TEXT,
  FOREIGN KEY (`invoice_id`) REFERENCES `hóa_đơn`(`invoice_id`),
  FOREIGN KEY (`service_id`) REFERENCES `dịch_vụ`(`service_id`)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ============================================================================
-- 17. BẢNG SỐ THỨ TỰ (Số Thứ Tự)
-- ============================================================================
CREATE TABLE `số_thứ_tự` (
  `queue_id` INT PRIMARY KEY AUTO_INCREMENT,
  `queue_number` INT NOT NULL,
  `service_id` INT NOT NULL,
  `specialty` VARCHAR(100) NOT NULL,
  `doctor_id` INT,
  `patient_id` INT,
  `issued_date` DATETIME NOT NULL,
  `called_date` DATETIME,
  `status` ENUM('đã_phát', 'đã_gọi', 'hoàn_thành', 'không_tới', 'đã_hủy') DEFAULT 'đã_phát',
  `created_by` INT,
  `notes` TEXT,
  FOREIGN KEY (`service_id`) REFERENCES `dịch_vụ`(`service_id`),
  FOREIGN KEY (`doctor_id`) REFERENCES `người_dùng`(`user_id`),
  FOREIGN KEY (`patient_id`) REFERENCES `bệnh_nhân`(`patient_id`),
  FOREIGN KEY (`created_by`) REFERENCES `người_dùng`(`user_id`)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ============================================================================
-- 18. BẢNG NHẬT KÝ HỆ THỐNG (Nhật Ký Hệ Thống)
-- ============================================================================
CREATE TABLE `nhật_ký_hệ_thống` (
  `log_id` INT PRIMARY KEY AUTO_INCREMENT,
  `user_id` INT,
  `action` VARCHAR(100) NOT NULL,
  `table_name` VARCHAR(50),
  `record_id` INT,
  `old_values` JSON,
  `new_values` JSON,
  `ip_address` VARCHAR(45),
  `user_agent` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `người_dùng`(`user_id`)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- ============================================================================
-- DỮ LIỆU MẪU ĐÃ XÓA - VUI LÒNG THÊM BẰNG TRANG QUẢN LÝ
-- ============================================================================
-- Để thêm dữ liệu mẫu, vui lòng sử dụng giao diện ứng dụng
-- Hoặc chạy script tạo dữ liệu riêng

-- ============================================================================
-- TẠO CHỈ MỤC ĐỂ TỐI ƯU HÓA HIỆU NĂNG
-- ============================================================================

CREATE INDEX idx_patients_code ON `bệnh_nhân`(`patient_code`);
CREATE INDEX idx_users_username ON `người_dùng`(`username`);
CREATE INDEX idx_appointments_date ON `lịch_hẹn`(`appointment_date`);
CREATE INDEX idx_medical_records_patient ON `hồ_sơ_bệnh_án`(`patient_id`);
CREATE INDEX idx_prescriptions_patient ON `đơn_thuốc`(`patient_id`);
CREATE INDEX idx_invoices_patient ON `hóa_đơn`(`patient_id`);
CREATE INDEX idx_lab_tests_patient ON `xét_nghiệm`(`patient_id`);
CREATE INDEX idx_medicines_code ON `thuốc`(`medicine_code`);
CREATE INDEX idx_vital_signs_patient ON `sinh_hiệu`(`patient_id`);
CREATE INDEX idx_beds_status ON `giường_bệnh`(`status`);

-- ============================================================================
-- THIẾT LẬP CƠ SỞ DỮ LIỆU HOÀN THÀNH
-- ============================================================================
-- Tên cơ sở dữ liệu: htttql_hospital
-- Tổng số bảng: 18
-- Người dùng demo: 6 (tiếp_đón_thu_ngân, bác_sĩ, y_tá, cận_lâm_sàng, kho_dược, quản_lý)
-- Bệnh nhân demo: 4
-- Dịch vụ demo: 7
-- Thuốc demo: 4
-- ============================================================================
