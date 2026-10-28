
<?php
// ============================================
// HALAMAN NOTA PESANAN
// ============================================


include('include/data.php');
include('include/fungsi.php');

// Menyiapkan judul halaman dan menu navigasi aktif.
$judulHalaman = "Nota Pesanan";
$halamanAktif = "pesanan.php";

// Nilai awal total belanja dan jumlah barang.
// Keduanya akan ditambah selama proses perulangan.
$totalBelanja = 0;
$totalBarang  = 0;

// Membaca daftar pesanan berdasarkan kode produk dan jumlahnya.
// Contoh: P001 => 2 berarti pelanggan membeli dua produk P001.
foreach ($pesanan as $kode => $jumlah) {

    // Mengambil harga dan diskon produk berdasarkan kode pesanan.
    $hargaAkhir = hargaSetelahDiskon(
        $produk[$kode]["harga"],
        $produk[$kode]["diskon"]
    );

    // Menambahkan hasil harga akhir dikali jumlah barang
    // ke total belanja sementara.
    $totalBelanja += $hargaAkhir * $jumlah;

    // Menambahkan jumlah barang ke total keseluruhan item.
    $totalBarang += $jumlah;
}

// Memanggil diskonBelanja() untuk menghitung potongan tambahan
// berdasarkan total belanja pelanggan.
$potongan = diskonBelanja($totalBelanja);

// Mengurangi total belanja dengan potongan untuk mendapatkan
// jumlah akhir yang harus dibayar.
$totalBayar = $totalBelanja - $potongan;

// Memanggil header.php untuk menampilkan bagian atas halaman.
include('include/header.php');
?>

<!-- Judul halaman nota. -->
<h1 class="text-3xl font-extrabold tracking-tight mb-2">
    Nota Pesanan
</h1>

<!-- Keterangan singkat di bawah judul. -->
<p class="text-slate-500 mb-7">
    Rincian minuman yang dipilih pelanggan.
</p>

<!-- Wadah utama untuk tabel dan ringkasan pembayaran. -->
<div class="bg-white rounded-2xl border border-slate-200 p-5 sm:p-6 max-w-3xl">

    <!-- TABEL RINCIAN PESANAN -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">

            <!-- Judul kolom tabel. -->
            <thead>
                <tr class="border-b border-slate-200 text-slate-500">
                    <th class="py-3 pr-3">No.</th>
                    <th class="py-3 pr-3">Produk</th>
                    <th class="py-3 px-3 text-right">Harga</th>
                    <th class="py-3 px-3 text-center">Jumlah</th>
                    <th class="py-3 pl-3 text-right">Subtotal</th>
                </tr>
            </thead>

            <tbody>

                <?php
                // Nomor urut dimulai dari satu.
                // Variabel ini digunakan untuk menomori baris pesanan.
                $no = 1;
                ?>

                <?php foreach ($pesanan as $kode => $jumlah): ?>

                    <?php
                    // Mengambil detail produk dari array $produk
                    // berdasarkan kode yang tersimpan di $pesanan.
                    $item = $produk[$kode];

                    // Menghitung harga produk setelah diskon produk.
                    $hargaAkhir = hargaSetelahDiskon(
                        $item["harga"],
                        $item["diskon"]
                    );

                    // Menghitung subtotal untuk satu jenis produk.
                    // Rumus: harga akhir x jumlah yang dibeli.
                    $subtotal = $hargaAkhir * $jumlah;
                    ?>

                    <!-- Satu baris tabel untuk setiap jenis produk. -->
                    <tr class="border-b border-slate-100">

                        <!-- Menampilkan nomor urut lalu menambahnya satu. -->
                        <td class="py-3 pr-3"><?= $no++ ?></td>

                        <!-- Menampilkan ikon dan nama produk dari data.php. -->
                        <td class="py-3 pr-3 whitespace-nowrap">
                            <?= $item["ikon"] ?> <?= $item["nama"] ?>
                        </td>

                        <!-- Menampilkan harga satuan setelah diskon. -->
                        <td class="py-3 px-3 text-right whitespace-nowrap">
                            <?= formatRupiah($hargaAkhir) ?>
                        </td>

                        <!-- Menampilkan jumlah produk yang dibeli. -->
                        <td class="py-3 px-3 text-center">
                            <?= $jumlah ?>
                        </td>

                        <!-- Menampilkan hasil perkalian harga dan jumlah. -->
                        <td class="py-3 pl-3 text-right whitespace-nowrap">
                            <?= formatRupiah($subtotal) ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

    <!-- RINGKASAN PEMBAYARAN -->
    <div class="mt-6 space-y-3">

        <!-- Menampilkan total seluruh item yang dibeli. -->
        <p class="flex justify-between gap-4">
            <span class="text-slate-500">Total barang</span>
            <span class="font-semibold"><?= $totalBarang ?> item</span>
        </p>

        <!-- Menampilkan total belanja sebelum diskon tambahan. -->
        <p class="flex justify-between gap-4">
            <span class="text-slate-500">Total belanja</span>
            <span class="font-semibold"><?= formatRupiah($totalBelanja) ?></span>
        </p>

        <!-- Menampilkan nominal potongan dari diskonBelanja(). -->
        <p class="flex justify-between gap-4 text-rose-600">
            <span>Diskon belanja</span>
            <span class="font-semibold">- <?= formatRupiah($potongan) ?></span>
        </p>

        <!-- Menampilkan jumlah akhir yang harus dibayar. -->
        <div class="flex justify-between gap-4 border-t border-slate-200 pt-4 text-lg font-extrabold">
            <span>Total bayar</span>
            <span class="text-indigo-700"><?= formatRupiah($totalBayar) ?></span>
        </div>

    </div>

    <?php if ($potongan === 0): ?>

        <!-- Pesan ini muncul jika pelanggan belum mendapat
             diskon tambahan berdasarkan total belanja. -->
        <p class="mt-5 rounded-xl bg-amber-50 p-4 text-sm text-amber-800">
            Belanja minimal Rp 200.000 untuk mendapat diskon 10%.
            Diskon 15% berlaku untuk total belanja minimal Rp 500.000.
        </p>

    <?php endif; ?>

</div>

<?php
// Memanggil footer.php untuk menutup struktur halaman.
include('include/footer.php');
?>
