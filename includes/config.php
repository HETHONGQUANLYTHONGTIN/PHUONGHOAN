<?php
// ============================================================================
// DATABASE CONFIGURATION
// ============================================================================

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'htttql_hospital');
define('DB_PORT', 3306);

// Kết nối database - chỉ kết nối một lần
global $conn;
if (!isset($conn)) {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
    
    // Kiểm tra lỗi kết nối
    if ($conn->connect_error) {
        die("❌ Kết nối database thất bại: " . $conn->connect_error . 
            "<br>Vui lòng:<br>
            1. Chắc chắn MySQL đang chạy<br>
            2. Import file database.sql vào phpMyAdmin<br>
            3. Kiểm tra lại tên database, user, password");
    }
    
    // Thiết lập charset UTF-8
    $conn->set_charset("utf8mb4");
}

// ============================================================================
// SITE CONFIGURATION
// ============================================================================
define('SITE_NAME', 'HTTTQL - Hệ thống Quản lý Bệnh viện');
define('SITE_URL', 'http://localhost/HTTTQL');

// ============================================================================
// HELPER FUNCTIONS
// ============================================================================

if (!function_exists('query')) {
    /**
     * Lấy dữ liệu từ database
     */
    function query($sql) {
        global $conn;
        $result = $conn->query($sql);
        if (!$result) {
            die("❌ Lỗi SQL: " . $conn->error);
        }
        return $result;
    }

    /**
     * Lấy một hàng từ kết quả
     */
    function fetch_one($sql) {
        $result = query($sql);
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    /**
     * Lấy tất cả các hàng từ kết quả
     */
    function fetch_all($sql) {
        $result = query($sql);
        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    /**
     * Escape dữ liệu để tránh SQL injection
     */
    function escape($data) {
        global $conn;
        if (is_array($data)) {
            return array_map('escape', $data);
        }
        return $conn->real_escape_string($data);
    }

    /**
     * Định dạng tiền tệ
     */
    function format_currency($amount) {
        return number_format($amount, 0, ',', '.') . ' VNĐ';
    }

    /**
     * Định dạng ngày tháng
     */
    function format_date($date) {
        if (empty($date)) return '-';
        return date('d/m/Y', strtotime($date));
    }

    /**
     * Định dạng thời gian
     */
    function format_datetime($datetime) {
        if (empty($datetime)) return '-';
        return date('d/m/Y H:i', strtotime($datetime));
    }

    /**
     * Kiểm tra đăng nhập
     */
    function require_login() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . SITE_URL . '/login.php');
            exit();
        }
    }

    /**
     * Kiểm tra quyền hạn
     */
    function require_role($required_role) {
        require_login();
        if ($_SESSION['role'] != $required_role) {
            header('Location: ' . SITE_URL . '/index.php');
            exit();
        }
    }

    /**
     * Lấy thông tin user đã đăng nhập hiện tại
     */
    function get_current_logged_in_user() {
        global $conn;
        if (isset($_SESSION['user_id'])) {
            $user_id = intval($_SESSION['user_id']);
            $result = $conn->query("SELECT * FROM người_dùng WHERE user_id = $user_id");
            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc();
            }
        }
        return null;
    }

    /**
     * Tạo mã tự động (BN-001, XN-001, etc.)
     */
    function generate_code($prefix, $table, $column) {
        global $conn;
        $result = $conn->query("SELECT MAX($column) as max_code FROM $table WHERE $column LIKE '$prefix%'");
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $max_code = $row['max_code'];
            if ($max_code) {
                $number = intval(substr($max_code, strlen($prefix))) + 1;
            } else {
                $number = 1;
            }
            return $prefix . str_pad($number, 3, '0', STR_PAD_LEFT);
        }
        return $prefix . '001';
    }
}
?>
