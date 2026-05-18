<?php
session_start();
include '../../includes/config.php';

require_login();
if ($_SESSION['role'] != 'tiếp_đón_thu_ngân') {
    header('Location: ' . SITE_URL . '/index.php');
    exit();
}

include '../../includes/header.php';

// Láº¥y danh sÃ¡ch dá»‹ch vá»¥ vÃ  bÃ¡c sÄ© tá»« database
$services = fetch_all("SELECT * FROM dịch_vụ ORDER BY service_id");
$doctors = fetch_all("SELECT * FROM người_dùng WHERE role = 'doctor' ORDER BY full_name");

$queue_number = '';
$issued_queue = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_id = intval($_POST['service_id'] ?? 0);
    $doctor_id = intval($_POST['doctor_id'] ?? 0);
    
    if ($service_id > 0) {
        // Láº¥y sá»' thá»© tá»± cuá»'i cÃ¹ng
        $result = query("SELECT MAX(queue_number) as last_queue FROM số_thứ_tự 
                        WHERE DATE(created_at) = CURDATE() AND service_id = $service_id");
        $row = $result->fetch_assoc();
        $last_queue = $row['last_queue'] ?? 0;
        $queue_number = $last_queue + 1;
        
        // LÆ°u vÃ o database
        $sql = "INSERT INTO queue_numbers (service_id, doctor_id, queue_number, status, created_by, created_at)
                VALUES ($service_id, " . ($doctor_id > 0 ? $doctor_id : 'NULL') . ", $queue_number, 'pending', 
                        {$_SESSION['user_id']}, NOW())";
        
        if ($conn->query($sql)) {
            $queue_id = $conn->insert_id;
            $issued_queue = "âœ… PhÃ¡t sá»‘ thá»© tá»± thÃ nh cÃ´ng! Sá»‘: <strong style='font-size: 36px; color: #27ae60;'>$queue_number</strong>";
        } else {
            $issued_queue = 'âŒ Lá»—i: ' . $conn->error;
        }
    }
}
?>

<div class="form-container">
    <h1>PhÃ¡t Sá»‘ Thá»© Tá»±</h1>
    
    <?php if ($issued_queue): ?>
        <div class="alert" style="background: #e8f5e9; padding: 20px; text-align: center; margin-bottom: 20px; border-radius: 5px;">
            <?php echo $issued_queue; ?>
        </div>
    <?php endif; ?>
    
    <div style="text-align: center; margin: 40px 0;">
        <p style="font-size: 18px; margin-bottom: 20px;">Chá»n chuyÃªn khoa Ä‘á»ƒ phÃ¡t sá»‘ thá»© tá»±:</p>
        
        <form method="POST" style="max-width: 500px; margin: 0 auto;">
            <div class="form-group">
                <label for="service_id">ChuyÃªn khoa <span style="color: red;">*</span></label>
                <select id="service_id" name="service_id" required>
                    <option value="">-- Chá»n chuyÃªn khoa --</option>
                    <?php foreach ($services as $service): ?>
                        <option value="<?php echo $service['service_id']; ?>">
                            <?php echo htmlspecialchars($service['service_name']); ?> (<?php echo format_currency($service['price']); ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="doctor_id">BÃ¡c sÄ© (tuá»³ chá»n)</label>
                <select id="doctor_id" name="doctor_id">
                    <option value="">-- KhÃ´ng chá»n bÃ¡c sÄ© --</option>
                    <?php foreach ($doctors as $doctor): ?>
                        <option value="<?php echo $doctor['user_id']; ?>">
                            <?php echo htmlspecialchars($doctor['full_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">PhÃ¡t Sá»‘ Thá»© Tá»±</button>
        </form>
    </div>
    
    <div class="table-container">
        <h3>Sá»‘ Thá»© Tá»± HÃ´m Nay</h3>
        <table>
            <thead>
                <tr>
                    <th>ChuyÃªn Khoa</th>
                    <th>BÃ¡c SÄ©</th>
                    <th>Sá»‘ Thá»© Tá»±</th>
                    <th>Tráº¡ng ThÃ¡i</th>
                    <th>Thá»i Gian</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $today_queues = fetch_all("SELECT q.*, s.service_name, u.full_name 
                                          FROM số_thứ_tự q 
                                          JOIN dịch_vụ s ON q.service_id = s.service_id
                                          LEFT JOIN người_dùng u ON q.doctor_id = u.user_id
                                          WHERE DATE(q.created_at) = CURDATE()
                                          ORDER BY q.queue_number DESC");
                
                if (!empty($today_queues)):
                    foreach ($today_queues as $queue):
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($queue['service_name']); ?></td>
                    <td><?php echo htmlspecialchars($queue['full_name'] ?? 'N/A'); ?></td>
                    <td style="font-size: 18px; font-weight: bold; color: #3498db;"><?php echo $queue['queue_number']; ?></td>
                    <td><?php echo $queue['status']; ?></td>
                    <td><?php echo format_datetime($queue['created_at']); ?></td>
                </tr>
                <?php
                    endforeach;
                else:
                ?>
                <tr>
                    <td colspan="5" style="text-align: center; color: #7f8c8d;">ChÆ°a cÃ³ sá»‘ thá»© tá»± nÃ o hÃ´m nay</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

