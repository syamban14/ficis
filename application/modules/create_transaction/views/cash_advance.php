<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Advance - Finance System</title>
    <!-- Referensi ke Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Cash Advance Request</h2>
        <form id="cashAdvanceForm">
            <div class="form-group">
                <label for="employeeName">Employee Name</label>
                <input type="text" class="form-control" id="employeeName" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" class="form-control" id="amount" required>
            </div>
            <div class="form-group">
                <label for="purpose">Purpose</label>
                <textarea class="form-control" id="purpose" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Request</button>
        </form>
    </div>

    <!-- Referensi ke Bootstrap JS dan JavaScript lainnya (jika diperlukan) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        // Fungsi yang akan dijalankan ketika formulir dikirim
        function submitCashAdvanceForm(event) {
            event.preventDefault(); // Mencegah halaman refresh saat mengirimkan formulir

            // Ambil nilai-nilai dari formulir
            const employeeName = document.getElementById('employeeName').value;
            const amount = document.getElementById('amount').value;
            const purpose = document.getElementById('purpose').value;

            // Kirim data ke server atau lakukan proses lainnya sesuai kebutuhan

            // Tampilkan notifikasi bahwa permohonan cash advance berhasil dikirim
            alert(`Cash advance request for ${employeeName} with amount ${amount} is submitted successfully! Purpose: ${purpose}`);

            // Reset formulir setelah mengirimkan
            document.getElementById('cashAdvanceForm').reset();
        }

        // Tambahkan event listener ke formulir
        document.getElementById('cashAdvanceForm').addEventListener('submit', submitCashAdvanceForm);
    </script>
</body>
</html>
