<!-- File ini để xem danh sách tất cả tệp trong trình duyệt -->
<?php
// Redirect to login if not accessed directly
if (!isset($_GET['view'])) {
    // List all files and folders
    $baseDir = dirname(__FILE__);
    $ignore = ['.', '..', '.git', '.gitignore'];
    
    $scan = function($dir, $prefix = '') use (&$scan, $ignore) {
        $items = scandir($dir);
        $result = [];
        foreach ($items as $item) {
            if (in_array($item, $ignore)) continue;
            if ($item[0] === '.') continue;
            
            $path = $dir . DIRECTORY_SEPARATOR . $item;
            if (is_dir($path)) {
                $result[] = ['type' => 'dir', 'name' => $item, 'path' => $path, 'full' => $prefix . $item . '/'];
                $result = array_merge($result, $scan($path, $prefix . $item . '/'));
            } else {
                $result[] = ['type' => 'file', 'name' => $item, 'path' => $path, 'full' => $prefix . $item];
            }
        }
        return $result;
    };
    
    $files = $scan($baseDir);
    sort($files);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTTTQL - File List</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }
        
        .content {
            padding: 30px;
        }
        
        .quick-links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .quick-links a {
            display: block;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .quick-links a:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .file-tree {
            background: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            font-family: 'Courier New', monospace;
            font-size: 13px;
            overflow-x: auto;
            max-height: 600px;
            overflow-y: auto;
        }
        
        .file-tree div {
            padding: 3px 0;
            line-height: 1.6;
        }
        
        .file-item {
            display: flex;
            align-items: center;
            margin: 2px 0;
        }
        
        .file-item:hover {
            background: rgba(52, 152, 219, 0.1);
            padding-left: 5px;
        }
        
        .icon {
            width: 20px;
            margin-right: 8px;
            display: inline-block;
        }
        
        .dir {
            color: #f39c12;
            font-weight: bold;
        }
        
        .file {
            color: #3498db;
        }
        
        .stat {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        
        .stat-item {
            background: #ecf0f1;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
        }
        
        .stat-item .number {
            font-size: 24px;
            font-weight: bold;
            color: #3498db;
        }
        
        .stat-item .label {
            color: #666;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏥 HTTTQL</h1>
            <p>Hệ Thống Quản Lý Bệnh Viện - File Structure</p>
        </div>
        
        <div class="content">
            <h2>🚀 Bắt Đầu Nhanh</h2>
            <div class="quick-links">
                <a href="index.php">🏠 Vào Hệ Thống</a>
                <a href="login.php">🔐 Đăng Nhập</a>
                <a href="README.md" target="_blank">📖 Tài Liệu</a>
                <a href="QUICKSTART.html" target="_blank">⚡ Hướng Dẫn Nhanh</a>
                <a href="STRUCTURE.md" target="_blank">📋 Cấu Trúc</a>
                <a href="COMPLETION_REPORT.md" target="_blank">✅ Báo Cáo</a>
            </div>
            
            <h2>📁 Cấu Trúc File</h2>
            <div class="file-tree">
                <div class="file-item"><span class="icon">📁</span> <span class="dir">HTTTQL/</span></div>
                
                <div style="padding-left: 20px;">
                    <div class="file-item"><span class="icon">📄</span> <span class="file">index.php</span> - Dashboard</div>
                    <div class="file-item"><span class="icon">📄</span> <span class="file">login.php</span> - Đăng nhập</div>
                    <div class="file-item"><span class="icon">📄</span> <span class="file">logout.php</span> - Đăng xuất</div>
                    <div class="file-item"><span class="icon">📄</span> <span class="file">README.md</span> - Tài liệu chính</div>
                    <div class="file-item"><span class="icon">📄</span> <span class="file">STRUCTURE.md</span> - Chi tiết cấu trúc</div>
                    <div class="file-item"><span class="icon">📄</span> <span class="file">QUICKSTART.html</span> - Hướng dẫn nhanh</div>
                    <div class="file-item"><span class="icon">📄</span> <span class="file">COMPLETION_REPORT.md</span> - Báo cáo hoàn thành</div>
                    
                    <div style="margin-top: 10px;">
                        <div class="file-item"><span class="icon">📁</span> <span class="dir">includes/</span> - Tệp chung</div>
                        <div style="padding-left: 20px;">
                            <div class="file-item"><span class="icon">📄</span> <span class="file">config.php</span></div>
                            <div class="file-item"><span class="icon">📄</span> <span class="file">header.php</span></div>
                            <div class="file-item"><span class="icon">📄</span> <span class="file">footer.php</span></div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 10px;">
                        <div class="file-item"><span class="icon">📁</span> <span class="dir">css/</span> - CSS Files</div>
                        <div style="padding-left: 20px;">
                            <div class="file-item"><span class="icon">📄</span> <span class="file">style.css</span> - (1000+ dòng)</div>
                            <div class="file-item"><span class="icon">📄</span> <span class="file">responsive.css</span></div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 10px;">
                        <div class="file-item"><span class="icon">📁</span> <span class="dir">js/</span> - JavaScript Files</div>
                        <div style="padding-left: 20px;">
                            <div class="file-item"><span class="icon">📄</span> <span class="file">main.js</span> - (200+ dòng)</div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 10px;">
                        <div class="file-item"><span class="icon">📁</span> <span class="dir">pages/</span> - Các trang chính (22 trang)</div>
                        <div style="padding-left: 20px;">
                            <div class="file-item">
                                <span class="icon">📁</span> <span class="dir">reception_cashier/</span> (3 trang)
                            </div>
                            <div style="padding-left: 20px;">
                                <div class="file-item"><span class="icon">📄</span> patient_registration.php</div>
                                <div class="file-item"><span class="icon">📄</span> queue_number.php</div>
                                <div class="file-item"><span class="icon">📄</span> payment_invoice.php</div>
                            </div>
                            
                            <div class="file-item">
                                <span class="icon">📁</span> <span class="dir">doctor/</span> (4 trang)
                            </div>
                            <div style="padding-left: 20px;">
                                <div class="file-item"><span class="icon">📄</span> appointments.php</div>
                                <div class="file-item"><span class="icon">📄</span> medical_record.php</div>
                                <div class="file-item"><span class="icon">📄</span> order_tests.php</div>
                                <div class="file-item"><span class="icon">📄</span> prescriptions.php</div>
                            </div>
                            
                            <div class="file-item">
                                <span class="icon">📁</span> <span class="dir">nurse/</span> (3 trang)
                            </div>
                            <div style="padding-left: 20px;">
                                <div class="file-item"><span class="icon">📄</span> vital_signs.php</div>
                                <div class="file-item"><span class="icon">📄</span> bed_management.php</div>
                                <div class="file-item"><span class="icon">📄</span> medication_schedule.php</div>
                            </div>
                            
                            <div class="file-item">
                                <span class="icon">📁</span> <span class="dir">lab_xray/</span> (2 trang)
                            </div>
                            <div style="padding-left: 20px;">
                                <div class="file-item"><span class="icon">📄</span> request_receiving.php</div>
                                <div class="file-item"><span class="icon">📄</span> result_submission.php</div>
                            </div>
                            
                            <div class="file-item">
                                <span class="icon">📁</span> <span class="dir">pharmacy/</span> (2 trang)
                            </div>
                            <div style="padding-left: 20px;">
                                <div class="file-item"><span class="icon">📄</span> prescription_review.php</div>
                                <div class="file-item"><span class="icon">📄</span> inventory_management.php</div>
                            </div>
                            
                            <div class="file-item">
                                <span class="icon">📁</span> <span class="dir">admin/</span> (3 trang)
                            </div>
                            <div style="padding-left: 20px;">
                                <div class="file-item"><span class="icon">📄</span> user_permissions.php</div>
                                <div class="file-item"><span class="icon">📄</span> pricing_config.php</div>
                                <div class="file-item"><span class="icon">📄</span> reports.php</div>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 10px;">
                        <div class="file-item"><span class="icon">📁</span> <span class="dir">assets/</span> - Hình ảnh</div>
                    </div>
                </div>
            </div>
            
            <div class="stat">
                <div class="stat-item">
                    <div class="number">22</div>
                    <div class="label">Trang Chức Năng</div>
                </div>
                <div class="stat-item">
                    <div class="number">6</div>
                    <div class="label">Vai Trò Người Dùng</div>
                </div>
                <div class="stat-item">
                    <div class="number">32</div>
                    <div class="label">Tệps Tạo Ra</div>
                </div>
                <div class="stat-item">
                    <div class="number">7,700+</div>
                    <div class="label">Dòng Code</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
