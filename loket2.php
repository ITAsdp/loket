<?php
session_start();

// Set default nomor antrean jika belum ada
if (!isset($_SESSION['nomor'])) {
    $_SESSION['nomor'] = 1;
}

// Memeriksa apakah tombol diklik untuk menambah nomor
if (isset($_POST['tambah'])) {
    $_SESSION['nomor']++; // Tambah nomor urut setiap kali tombol ditekan
}

// Logika untuk reset nomor
if (isset($_POST['reset'])) {
    $_SESSION['nomor'] = 1; // Reset nomor ke 0
}

$hariInggris = date('l'); // Contoh output: "Monday"

// Buat array untuk menerjemahkan nama hari
$hariIndonesia = [
    'Sunday' => 'Minggu, ',
    'Monday' => 'Senin, ',
    'Tuesday' => 'Selasa, ',
    'Wednesday' => 'Rabu, ',
    'Thursday' => 'Kamis, ',
    'Friday' => 'Jumat, ',
    'Saturday' => 'Sabtu, '
];



?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loket Antrian Obat</title>
        <script>
        // Fungsi untuk mencetak bagian tertentu
        function printSection(sectionId) {
            // Ambil elemen yang ingin dicetak
            var printContent = document.getElementById(sectionId).innerHTML;
            // Simpan konten halaman asli
            var originalContent = document.body.innerHTML;

            // Ganti konten halaman dengan bagian yang ingin dicetak
            document.body.innerHTML = printContent;

            // Panggil fungsi cetak browser
            window.print();

            // Kembalikan konten halaman ke aslinya
            document.body.innerHTML = originalContent;

            // Reload halaman untuk mengembalikan event listener
            window.location.reload();
        }
    </script>
    <style>
        @media print {
          @page {
              size: 150px 283px; /* Custom ukuran */
              margin: 20px;
            }
            .no-print {
                display: none; /* Elemen ini tidak akan dicetak */
            }
        }
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            background-color: #f4f4f9;
        }
        .container {
            margin-top: 30px;
        }
        h1 {
            background-color: #1b3d5f;
            color: white;
            padding: 10px;
            margin: 0;
        }
        h2 {
            color: black;
            padding: 2px;
            margin: 0;
            margin-top: 100;
            margin-bottom: 100;
            font-size: 15px;
        }
        .box {
            display: inline-block;
            background-color: white;
            border: 1px solid #ccc;
            padding: 20px;
            width: 200px;
            height: 100px;
            margin: 0px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .number {
            font-size: 40px;
            font-weight: bold;
            margin: 5px 0;
        }

        button {
            padding: 10px 20px;
            background-color: #1b3d5f;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #14508e;
        }

        /* CSS untuk mengatur posisi logo */
        .logo {
            position: absolute; /* Posisi absolut terhadap halaman */
            top: 5px;          /* Jarak 10px dari atas */
            right: 10px;        /* Jarak 10px dari kanan */
            width: 70px;       /* Lebar logo */
            height: auto;       /* Tinggi menyesuaikan proporsi */
        }
        .date {
            font-size: 10px;
            font-weight: bold;
            margin: 1px 0;
            top: 100px;          /* Jarak 10px dari atas */            
        }
    </style>

</head>
<body>
    <h1>PT ASDP Indonesia Ferry (Persero) Cabang Bajoe</h1>
    <img src="LOGO.png" alt="Logo Perusahaan" class="logo">
    <div class="container">
    <div class="box">
      <!-- Bagian untuk dicetak -->
      <div id="printableSection">
          <h2>Nomor Antrian</h2>
              <div class="number">
                  <?php echo $_SESSION['nomor']; ?>
              </div>
              <div class="date">
                <?php
                  // Set zona waktu sesuai lokasi (WIB - Jakarta)
                  date_default_timezone_set("Asia/Jakarta");

                  // Menampilkan tanggal dan waktu
                  echo "<p>" . $hariIndonesia[$hariInggris] . date("d F Y") . "</p>"; // Format: Hari, Tanggal Bulan Tahun
                  echo "<p>Waktu: " . date("H:i:s") . "</p>";     // Format: Jam:Menit:Detik (24 jam)
                ?>
              </div>
      </div>
      </div>

      <!-- Button -->
        <div>
          <form method="post">
            <button class="no-print" onclick="printSection('printableSection')">Print</button>
            <button type="submit" name="tambah">Next</button>
            <button type="submit" name="reset">Reset</button>
          </form>
        </div>
    </div>
</body>
</html>

