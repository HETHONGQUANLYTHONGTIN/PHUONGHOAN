<?php
session_start();
include '../../includes/config.php';

if ($_SESSION['role'] != 'cận_lâm_sàng') {
    header('Location: ' . SITE_URL . '/index.php');
    exit();
}

include '../../includes/header.php';

$request_id = $_GET['request'] ?? '';
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $result_type = $_POST['result_type'] ?? '';
    $results = $_POST['results'] ?? '';
    
    if (empty($results)) {
        $error = 'Vui lòng nhập kết quả xét nghiệm!';
    } else {
        $success = 'Nộp kết quả xét nghiệm thành công!';
    }
}
?>

<div class="form-container">
    <h1>Nộp Kết Quả Xét Nghiệm / X-Quang</h1>
    
    <div style="margin-bottom: 20px; padding: 15px; background-color: #f9f9f9; border-radius: 4px;">
        <p><strong>Mã Yêu Cầu:</strong> <?php echo htmlspecialchars($request_id); ?></p>
        <p><strong>Bệnh Nhân:</strong> Trần Thị B</p>
        <p><strong>Loại Xét Nghiệm:</strong> X-Quang Ngực</p>
    </div>
    
    <?php if ($success): ?>
        <div class="success-message"><?php echo $success; ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="result_type">Loại Kết Quả <span style="color: red;">*</span></label>
            <select id="result_type" name="result_type" required>
                <option value="">-- Chọn --</option>
                <option value="numerical">Chỉ Số Xét Nghiệm</option>
                <option value="image">Hình Ảnh Chụp (X-Quang)</option>
                <option value="both">Cả Hai</option>
            </select>
        </div>
        
        <div id="numericalResults" style="display: none;">
            <h3>Chỉ Số Xét Nghiệm</h3>
            <div class="form-group">
                <label for="results">Kết Quả <span style="color: red;">*</span></label>
                <textarea id="results" name="results" rows="5" placeholder="Nhập các chỉ số xét nghiệm&#10;VD:&#10;- Huyết Sắc Tố: 13.5 g/dL&#10;- Bạch Cầu: 7.2 x10^9/L&#10;- Tiểu Cầu: 250 x10^9/L"></textarea>
            </div>
        </div>
        
        <div id="imageResults" style="display: none;">
            <h3>Hình Ảnh Chụp</h3>
            <div class="form-group">
                <label for="image">Tải Hình Ảnh X-Quang <span style="color: red;">*</span></label>
                <input type="file" id="image" name="image" accept="image/*,.pdf">
                <small style="color: #666;">Định dạng: JPG, PNG, PDF (Tối đa 10MB)</small>
            </div>
            
            <div class="form-group">
                <label for="image_description">Mô Tả Hình Ảnh</label>
                <textarea id="image_description" name="image_description" rows="3"></textarea>
            </div>
        </div>
        
        <div class="form-group">
            <label for="interpretation">Giải Thích Kết Quả</label>
            <textarea id="interpretation" name="interpretation" rows="4" placeholder="Ghi chú và giải thích kết quả cho bác sĩ"></textarea>
        </div>
        
        <div class="form-group">
            <label for="notes">Ghi Chú Thêm</label>
            <textarea id="notes" name="notes" rows="3"></textarea>
        </div>
        
        <div style="text-align: center; margin-top: 25px;">
            <button type="submit" class="btn btn-primary">Nộp Kết Quả</button>
            <a href="request_receiving.php" class="btn" style="background-color: #95a5a6; color: white;">Quay Lại</a>
        </div>
    </form>
</div>

<script>
document.getElementById('result_type').addEventListener('change', function() {
    const numerical = document.getElementById('numericalResults');
    const image = document.getElementById('imageResults');
    
    if (this.value === 'numerical') {
        numerical.style.display = 'block';
        image.style.display = 'none';
    } else if (this.value === 'image') {
        numerical.style.display = 'none';
        image.style.display = 'block';
    } else if (this.value === 'both') {
        numerical.style.display = 'block';
        image.style.display = 'block';
    } else {
        numerical.style.display = 'none';
        image.style.display = 'none';
    }
});
</script>

<?php include '../../includes/footer.php'; ?>
