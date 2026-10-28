
<?php
// ============================================
// HALAMAN KATALOG PRODUK
// ============================================

// Memanggil data.php untuk mendapatkan nama toko,
// daftar produk, dan daftar pesanan.
include('include/data.php');

// Memanggil fungsi.php untuk menggunakan fungsi
// perhitungan harga, diskon, stok, dan format Rupiah.
include('include/fungsi.php');

// Variabel ini digunakan oleh header.php
// untuk menampilkan judul tab browser.
$judulHalaman = "Katalog Minuman";

// Menentukan menu navigasi yang sedang aktif.
$halamanAktif = "index.php";

// Menghitung jumlah produk di dalam array $produk.
$jumlahProduk = count($produk);

// Memanggil fungsi hitungProdukDiskon() dari fungsi.php.
// Hasilnya adalah jumlah produk yang memiliki diskon.
$jumlahDiskon = hitungProdukDiskon($produk);

// Memanggil fungsi hitungNilaiStok() dari fungsi.php.
// Hasilnya adalah total nilai stok seluruh produk
// berdasarkan harga setelah diskon dikalikan jumlah stok.
$nilaiStok = hitungNilaiStok($produk);

// Memanggil header.php untuk menampilkan bagian atas halaman,
// nama toko, navigasi, dan pembukaan elemen main.
include('include/header.php');
?>

<!-- Judul utama yang ditampilkan di halaman katalog. -->
<h1 class="text-3xl font-extrabold tracking-tight mb-2">
    Katalog Minuman
</h1>

<!-- Deskripsi singkat toko di bawah judul. -->
<p class="text-slate-500 mb-7">
    Pilihan minuman segar untuk menemani aktivitasmu.
</p>

<!-- RINGKASAN TOKO
     Bagian ini menampilkan tiga hasil perhitungan dari PHP. -->
<div class="grid sm:grid-cols-3 gap-4 mb-8">

    <!-- Menampilkan jumlah seluruh produk. -->
    <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <p class="text-sm text-slate-500">Total jenis minuman</p>
        <p class="text-2xl font-bold mt-2"><?= $jumlahProduk ?></p>
    </div>

    <!-- Menampilkan jumlah produk yang sedang diskon. -->
    <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <p class="text-sm text-slate-500">Produk dengan diskon</p>
        <p class="text-2xl font-bold mt-2"><?= $jumlahDiskon ?> produk</p>
    </div>

    <!-- Menampilkan total nilai stok dalam format Rupiah.
         formatRupiah() berasal dari fungsi.php. -->
    <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <p class="text-sm text-slate-500">Nilai seluruh stok</p>
        <p class="text-2xl font-bold mt-2">
            <?= formatRupiah($nilaiStok) ?>
        </p>
    </div>

</div>

<!-- DAFTAR PRODUK
     foreach membaca setiap produk dalam array $produk.
     $kode berisi kode produk, sedangkan $item berisi
     detail produk seperti nama, harga, stok, dan diskon. -->
<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">

    <?php foreach ($produk as $kode => $item): ?>

        <?php
        // Memanggil hargaSetelahDiskon() dari fungsi.php.
        // Harga awal dan persentase diskon diambil dari data.php.
        $hargaAkhir = hargaSetelahDiskon(
            $item["harga"],
            $item["diskon"]
        );
        ?>

        <!-- Kartu produk dibuat satu kali untuk setiap data
             yang ditemukan oleh perulangan foreach. -->
        <article class="bg-white rounded-2xl border border-slate-200 overflow-hidden flex flex-col">

            <!-- Area ilustrasi produk.
                 Ikon diambil dari $item["ikon"] pada data.php. -->
            <div class="bg-slate-50 text-6xl text-center py-8 relative">
                <?= $item["ikon"] ?>

                <?php if ($item["diskon"] > 0): ?>
                    <!-- Label diskon hanya muncul jika diskon lebih dari nol. -->
                    <span class="absolute top-3 left-3 bg-rose-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                        Hemat <?= $item["diskon"] ?>%
                    </span>
                <?php endif; ?>
            </div>

            <!-- Informasi utama produk. -->
            <div class="p-5 flex flex-col flex-1">

                <!-- Menampilkan kode dan kategori produk dari data.php. -->
                <p class="text-xs text-slate-500 mb-2">
                    <?= $kode ?> &middot; <?= $item["kategori"] ?>
                </p>

                <!-- Menampilkan nama minuman. -->
                <h2 class="font-bold text-lg mb-3">
                    <?= $item["nama"] ?>
                </h2>

                <?php if ($item["diskon"] > 0): ?>
                    <!-- Harga awal dicoret jika produk memiliki diskon.
                         formatRupiah() mengubah angka menjadi Rupiah. -->
                    <p class="text-sm text-slate-400 line-through">
                        <?= formatRupiah($item["harga"]) ?>
                    </p>
                <?php endif; ?>

                <!-- Menampilkan harga akhir setelah diskon. -->
                <p class="text-xl font-extrabold text-indigo-700 mb-4">
                    <?= formatRupiah($hargaAkhir) ?>
                </p>

                <!-- Menampilkan status stok.
                     labelStok() menentukan teks status,
                     sedangkan warnaStok() menentukan warna tampilannya. -->
                <span class="mt-auto self-start text-xs font-bold px-3 py-1 rounded-full <?= warnaStok($item["stok"]) ?>">
                    <?= labelStok($item["stok"]) ?>
                </span>

            </div>
        </article>

    <?php endforeach; ?>

</div>

<?php
// Memanggil footer.php untuk menutup elemen main,
// menampilkan informasi hak cipta, dan menutup HTML.
include('include/footer.php');
?>
