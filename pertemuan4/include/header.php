
<?php
$judulHalaman = $judulHalaman ?? "Beranda";

$halamanAktif = $halamanAktif ?? "";

$menu = [
    "index.php"   => "Katalog",
    "pesanan.php" => "Pesanan",
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Judul tab browser menggabungkan nama halaman dan nama toko. -->
    <title><?= $judulHalaman ?> | <?= $namaToko ?></title>

    <!-- Tailwind CSS digunakan untuk mengatur desain halaman. -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-stone-50 text-slate-800 min-h-screen flex flex-col">

    <!-- BAGIAN HEADER TOKO -->
    <header class="bg-emerald-950 text-white shadow-md">

        <div class="max-w-6xl mx-auto px-5 py-5">

            <!-- Baris identitas toko dan navigasi. -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <!-- Nama toko dan deskripsi singkat. -->
                <a href="index.php" class="flex items-center gap-3">

                    <!-- Ikon sederhana sebagai identitas toko. -->
                    <span class="flex items-center justify-center w-12 h-12 rounded-2xl bg-lime-300 text-emerald-950 text-2xl">
                        🛒
                    </span>

                    <span>
                        <span class="block text-xl font-extrabold tracking-wide">
                            <?= $namaToko ?>
                        </span>

                        <span class="block text-xs text-emerald-100 mt-1">
                            Belanja praktis, minuman selalu segar
                        </span>
                    </span>

                </a>

                <!-- Menu navigasi dibentuk dari array $menu. -->
                <nav class="flex flex-wrap gap-2">

                    <?php foreach ($menu as $file => $teks): ?>

                        <?php
                        $kelas = ($file === $halamanAktif)
                            ? "bg-lime-300 text-emerald-950"
                            : "text-white hover:bg-emerald-800";
                        ?>

                        <a
                            href="<?= $file ?>"
                            class="px-4 py-2 rounded-xl text-sm font-bold transition-colors <?= $kelas ?>"
                        >
                            <?= $teks ?>
                        </a>

                    <?php endforeach; ?>

                </nav>

            </div>
        </div>
    </header>

    <!-- Konten dari index.php atau pesanan.php
         akan dimasukkan di dalam elemen main ini. -->
    <main class="max-w-6xl mx-auto px-5 py-8 w-full flex-1">
