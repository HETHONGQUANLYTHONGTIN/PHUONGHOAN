// HTTTQL - Main JavaScript

// Xác nhận xóa
function confirmDelete(message) {
    return confirm(message || 'Bạn chắc chắn muốn xóa?');
}

// Format tiền tệ
function formatCurrency(value) {
    return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND'
    }).format(value);
}

// Format ngày tháng
function formatDate(dateString) {
    const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
    return new Date(dateString).toLocaleDateString('vi-VN', options);
}

// Validate email
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Validate phone number
function validatePhone(phone) {
    const re = /^(0[0-9]{9,10})$/;
    return re.test(phone);
}

// Alert message
function showAlert(message, type = 'info') {
    const alertClass = `${type}-message`;
    const alertDiv = document.createElement('div');
    alertDiv.className = alertClass;
    alertDiv.textContent = message;
    
    const container = document.querySelector('.container');
    if (container) {
        container.insertBefore(alertDiv, container.firstChild);
    }
}

// Print function
function printContent(elementId) {
    const content = document.getElementById(elementId).innerHTML;
    const printWindow = window.open('', '', 'height=500,width=800');
    printWindow.document.write('<html><head><title>In tài liệu</title>');
    printWindow.document.write('<link rel="stylesheet" href="/HTTTQL/css/style.css">');
    printWindow.document.write('</head><body>');
    printWindow.document.write(content);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.print();
}

// Export to CSV
function exportToCSV(filename, data) {
    let csv = '';
    data.forEach(row => {
        csv += row.join(',') + '\n';
    });

    const element = document.createElement('a');
    element.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv));
    element.setAttribute('download', filename);
    element.style.display = 'none';
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
}

// Document ready
document.addEventListener('DOMContentLoaded', function() {
    // Remove alert messages after 5 seconds
    const alerts = document.querySelectorAll('.error-message, .success-message, .info-message, .warning-message');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });
});
