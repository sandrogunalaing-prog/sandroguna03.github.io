
<?php

// Nama toko yang akan ditampilkan pada header dan footer.
$namaToko = "Mampir Aja Kalau Haus";

// Data produk disimpan dalam array
$produk = [
    "P001" => [
        "nama"     => "Coca-Cola 390 ml",
        "kategori" => "Soft Drink",
        "harga"    => 7000,
        "diskon"   => 5,       // Diskon dalam persen.
        "stok"     => 24,
        "ikon"     => "🥤",
    ],

    "P002" => [
        "nama"     => "Sprite 390 ml",
        "kategori" => "Soft Drink",
        "harga"    => 7000,
        "diskon"   => 0,
        "stok"     => 3,
        "ikon"     => "🍋",
    ],

    "P003" => [
        "nama"     => "Fanta Strawberry 390 ml",
        "kategori" => "Soft Drink",
        "harga"    => 7000,
        "diskon"   => 5,
        "stok"     => 40,
        "ikon"     => "🍓",
    ],

    "P004" => [
        "nama"     => "Pepsi 390 ml",
        "kategori" => "Soft Drink",
        "harga"    => 7000,
        "diskon"   => 0,
        "stok"     => 20,
        "ikon"     => "🥤",
    ],

    "P005" => [
        "nama"     => "Fanta Orange 390 ml",
        "kategori" => "Soft Drink",
        "harga"    => 7000,
        "diskon"   => 0,
        "stok"     => 12,
        "ikon"     => "🍊",
    ],

    "P006" => [
        "nama"     => "Mountain Dew 390 ml",
        "kategori" => "Soft Drink",
        "harga"    => 8000,
        "diskon"   => 0,
        "stok"     => 4,
        "ikon"     => "🥤",
    ],
];

// Daftar barang yang dibeli pelanggan.
// Angka di sebelah kanan menunjukkan jumlah yang dibeli.
$pesanan = [
    "P001" => 2,
    "P003" => 3,
    "P006" => 1,
];
