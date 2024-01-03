-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jan 2024 pada 08.09
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gis_korlantas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `bg` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `auth`
--

INSERT INTO `auth` (`id`, `image`, `bg`) VALUES
(1, 'auth.jpg', '#476dda');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cuaca`
--

CREATE TABLE `cuaca` (
  `id_cuaca` int(11) NOT NULL,
  `kondisi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cuaca`
--

INSERT INTO `cuaca` (`id_cuaca`, `kondisi`) VALUES
(3, 'Cerah'),
(4, 'Berawan/ Mendung'),
(5, 'Hujan/ Grimis'),
(6, 'Tidak Diketahui');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fungsi_jalan`
--

CREATE TABLE `fungsi_jalan` (
  `id_fungsi_jalan` int(11) NOT NULL,
  `fungsi_jalan` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `fungsi_jalan`
--

INSERT INTO `fungsi_jalan` (`id_fungsi_jalan`, `fungsi_jalan`) VALUES
(1, 'Arteri'),
(2, 'Kolektor'),
(3, 'Lokal/Lingkungan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi_khusus`
--

CREATE TABLE `informasi_khusus` (
  `id_informasi_khusus` int(11) NOT NULL,
  `informasi_khusus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `informasi_khusus`
--

INSERT INTO `informasi_khusus` (`id_informasi_khusus`, `informasi_khusus`) VALUES
(1, 'Tidak Ada Saksi'),
(2, 'Tabrakan Beruntun'),
(3, 'Tabrak Lari'),
(4, 'Ada Saksi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecelakaan_menonjol`
--

CREATE TABLE `kecelakaan_menonjol` (
  `id_kecelakaan_menonjol` int(11) NOT NULL,
  `kecelakaan_menonjol` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kecelakaan_menonjol`
--

INSERT INTO `kecelakaan_menonjol` (`id_kecelakaan_menonjol`, `kecelakaan_menonjol`) VALUES
(1, 'Ya'),
(2, 'Tidak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_jalan`
--

CREATE TABLE `kelas_jalan` (
  `id_kelas_jalan` int(11) NOT NULL,
  `kelas_jalan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas_jalan`
--

INSERT INTO `kelas_jalan` (`id_kelas_jalan`, `kelas_jalan`) VALUES
(1, 'I (Jalan Besar utk beban 10 ton & max 18 m Panjang Ran)'),
(2, 'II (Jalan Sedang utk beban s/d 10 ton & 12m Panjang Ran)'),
(3, 'III (Jalan Kecil utk max beban 8 ton & 9 m Panjang Ran)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kemiringan_jalan`
--

CREATE TABLE `kemiringan_jalan` (
  `id_kemiringan_jalan` int(11) NOT NULL,
  `kemiringan_jalan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kemiringan_jalan`
--

INSERT INTO `kemiringan_jalan` (`id_kemiringan_jalan`, `kemiringan_jalan`) VALUES
(1, 'Datar'),
(2, 'Menanjak'),
(3, 'Menurun');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kondisi_cahaya`
--

CREATE TABLE `kondisi_cahaya` (
  `id_kondisi_cahaya` int(11) NOT NULL,
  `kondisi_cahaya` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kondisi_cahaya`
--

INSERT INTO `kondisi_cahaya` (`id_kondisi_cahaya`, `kondisi_cahaya`) VALUES
(1, 'Redup / Samar (Tidak jelas terlihat)'),
(2, 'Terang / Jelas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laka`
--

CREATE TABLE `laka` (
  `id_laka` int(11) NOT NULL,
  `id_informasi_khusus` int(11) DEFAULT NULL,
  `id_kondisi_cahaya` int(11) DEFAULT NULL,
  `id_cuaca` int(11) DEFAULT NULL,
  `id_tingkat_kecelakaan` int(11) DEFAULT NULL,
  `id_kecelakaan_menonjol` int(11) DEFAULT NULL,
  `id_fungsi_jalan` int(11) DEFAULT NULL,
  `id_kelas_jalan` int(11) DEFAULT NULL,
  `id_tipe_jalan` int(11) DEFAULT NULL,
  `id_permukaan_jalan` int(11) DEFAULT NULL,
  `id_kemiringan_jalan` int(11) DEFAULT NULL,
  `id_status_jalan` int(11) DEFAULT NULL,
  `id_polres` int(11) DEFAULT NULL,
  `no_laka` varchar(75) DEFAULT NULL,
  `tanggal_kejadian` date DEFAULT NULL,
  `jumlah_meninggal` int(11) DEFAULT NULL,
  `jumlah_luka_berat` int(11) DEFAULT NULL,
  `jumlah_luka_ringan` int(11) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `titik_acuan` varchar(100) DEFAULT NULL,
  `tipe_kecelakaan` text DEFAULT NULL,
  `batas_kecepatan_dilokasi` int(11) DEFAULT NULL,
  `nilai_kerugian_non_kendaraan` int(11) DEFAULT NULL,
  `nilai_kerugian_kendaraan` int(11) DEFAULT NULL,
  `keterangan_kerugian` text DEFAULT NULL,
  `jam_kejadian` time DEFAULT NULL,
  `img_laka` varchar(50) DEFAULT NULL,
  `id_titik_rawan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `laka`
--

INSERT INTO `laka` (`id_laka`, `id_informasi_khusus`, `id_kondisi_cahaya`, `id_cuaca`, `id_tingkat_kecelakaan`, `id_kecelakaan_menonjol`, `id_fungsi_jalan`, `id_kelas_jalan`, `id_tipe_jalan`, `id_permukaan_jalan`, `id_kemiringan_jalan`, `id_status_jalan`, `id_polres`, `no_laka`, `tanggal_kejadian`, `jumlah_meninggal`, `jumlah_luka_berat`, `jumlah_luka_ringan`, `latitude`, `longitude`, `titik_acuan`, `tipe_kecelakaan`, `batas_kecepatan_dilokasi`, `nilai_kerugian_non_kendaraan`, `nilai_kerugian_kendaraan`, `keterangan_kerugian`, `jam_kejadian`, `img_laka`, `id_titik_rawan`) VALUES
(1, 1, 1, 3, 1, 2, 1, 2, 2, 1, 1, 2, 2, 'LP/A/120/VI/2022/SPKT', '2023-06-11', 0, 0, 2, '-10.1864216', '123.6468571', 'Jembatan', 'Kendaraan Out of Control keluar ke kanan jalan', 20, 0, 0, 'Berawal saat Pengendara Sepeda Motor Honda Revo bergerak dari arah Polsek Maulafa menuju ke arah Naimata sesampainya di Tkp tepatnya di Jembatan Petuk Tiga, Pengendara Sepeda Motor Honda Revo yang melaju dengan kecepatan tinggi dan dalam keadaan mengantuk tiba-tiba hilang kendali dan menabrak Pembatas jalan sehingga terjatuh.', '20:30:00', NULL, 3),
(3, 1, 1, 3, 1, 1, 1, 1, 1, 1, 1, 1, 2, 'LP/A/121/VI/2022/SPKT', '2023-12-28', 0, 0, 1, '-10.172792117517908', '123.60451698303223', 'depan jual jagung bakar', '-', 40, 0, 0, '-', '05:54:00', '556180812.jpg', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `permukaan_jalan`
--

CREATE TABLE `permukaan_jalan` (
  `id_permukaan_jalan` int(11) NOT NULL,
  `permukaan_jalan` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `permukaan_jalan`
--

INSERT INTO `permukaan_jalan` (`id_permukaan_jalan`, `permukaan_jalan`) VALUES
(1, 'Baik'),
(2, 'Berombak'),
(3, 'Berlubang'),
(4, 'Basah'),
(5, 'Licin'),
(6, 'Banjir/ Tergenang Air');

-- --------------------------------------------------------

--
-- Struktur dari tabel `polres`
--

CREATE TABLE `polres` (
  `id_polres` int(11) NOT NULL,
  `nama_polres` varchar(100) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `jumlah_anggota` int(11) DEFAULT NULL,
  `img_polres` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `polres`
--

INSERT INTO `polres` (`id_polres`, `nama_polres`, `alamat`, `telepon`, `email`, `jumlah_anggota`, `img_polres`) VALUES
(2, 'POLRES KUPANG KOTA', 'Jl. Frans Seda, Kayu Putih, Kec. Oebobo, Kota Kupang, Nusa Tenggara Tim. 85228', '110', '', 666, '2818359612.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_jalan`
--

CREATE TABLE `status_jalan` (
  `id_status_jalan` int(11) NOT NULL,
  `status_jalan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `status_jalan`
--

INSERT INTO `status_jalan` (`id_status_jalan`, `status_jalan`) VALUES
(1, 'Jalan Kota / Kabupaten'),
(2, 'Jalan Propinsi'),
(3, 'Jalan Nasional');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tingkat_kecelakaan`
--

CREATE TABLE `tingkat_kecelakaan` (
  `id_tingkat_kecelakaan` int(11) NOT NULL,
  `tingkat_kecelakaan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tingkat_kecelakaan`
--

INSERT INTO `tingkat_kecelakaan` (`id_tingkat_kecelakaan`, `tingkat_kecelakaan`) VALUES
(1, 'Ringan'),
(2, 'Sedang'),
(3, 'Berat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe_jalan`
--

CREATE TABLE `tipe_jalan` (
  `id_tipe_jalan` int(11) NOT NULL,
  `tipe_jalan` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tipe_jalan`
--

INSERT INTO `tipe_jalan` (`id_tipe_jalan`, `tipe_jalan`) VALUES
(1, '2/2 TB (2 Lajur/2 Arah Tanpa Batas Median)'),
(2, '4/2 B (4 Lajur/2 Arah dengan Batas Median)'),
(3, '6/2 B (6 Lajur/2 Arah dengan Batas Median)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `titik_rawan`
--

CREATE TABLE `titik_rawan` (
  `id_titik_rawan` int(11) NOT NULL,
  `img_titik_rawan` varchar(50) DEFAULT NULL,
  `nama_jalan_rawan` varchar(100) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `titik_rawan`
--

INSERT INTO `titik_rawan` (`id_titik_rawan`, `img_titik_rawan`, `nama_jalan_rawan`, `latitude`, `longitude`) VALUES
(2, '654880270.jpg', 'Jln. W.J Lalamentik', '-10.168798234404536', '123.5969638824463'),
(3, '1301453848.jpg', 'Jln. Frans Seda', '-10.157963176341811', '123.62048149108888');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) DEFAULT 3,
  `id_active` int(11) DEFAULT 2,
  `en_user` varchar(75) DEFAULT NULL,
  `token` char(6) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT 'default.svg',
  `email` varchar(75) DEFAULT NULL,
  `password` varchar(75) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `id_active`, `en_user`, `token`, `name`, `image`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, 'admin', 'default.svg', 'admin@gmail.com', '$2y$10$//KMATh3ibPoI3nHFp7x/u7vnAbo2WyUgmI4x0CVVrH8ajFhMvbjG', '2023-12-06 23:09:44', '2023-12-06 23:09:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id_access_menu` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id_access_menu`, `id_role`, `id_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_sub_menu`
--

CREATE TABLE `user_access_sub_menu` (
  `id_access_sub_menu` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_sub_menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_access_sub_menu`
--

INSERT INTO `user_access_sub_menu` (`id_access_sub_menu`, `id_role`, `id_sub_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 1, 13),
(14, 1, 14),
(15, 1, 15),
(16, 1, 16),
(17, 1, 17),
(18, 1, 18),
(19, 1, 19),
(20, 1, 20),
(21, 1, 21);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id_menu` int(11) NOT NULL,
  `menu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id_menu`, `menu`) VALUES
(1, 'User Management'),
(2, 'Menu Management'),
(3, 'Korlantas'),
(4, 'GIS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id_role`, `role`) VALUES
(1, 'Administrator'),
(2, 'Owner'),
(3, 'Member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_status`
--

CREATE TABLE `user_status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_status`
--

INSERT INTO `user_status` (`id_status`, `status`) VALUES
(1, 'Active'),
(2, 'No Active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id_sub_menu` int(11) NOT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `id_active` int(11) DEFAULT 2,
  `title` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id_sub_menu`, `id_menu`, `id_active`, `title`, `url`, `icon`) VALUES
(1, 1, 1, 'Users', 'users', 'fas fa-users'),
(2, 1, 1, 'Role', 'role', 'fas fa-user-cog'),
(3, 2, 1, 'Menu', 'menu', 'fas fa-fw fa-folder'),
(4, 2, 1, 'Sub Menu', 'sub-menu', 'fas fa-fw fa-folder-open'),
(5, 2, 1, 'Menu Access', 'menu-access', 'fas fa-user-lock'),
(6, 2, 1, 'Sub Menu Access', 'sub-menu-access', 'fas fa-user-lock'),
(7, 3, 1, 'Informasi Khusus', 'informasi-khusus', 'fas fa-list-ol'),
(8, 3, 1, 'Cuaca', 'cuaca', 'fas fa-list-ol'),
(9, 3, 1, 'Tingkat Kecelakaan', 'tingkat-kecelakaan', 'fas fa-list-ol'),
(10, 3, 1, 'Kecelakaan Menonjol', 'kecelakaan-menonjol', 'fas fa-list-ol'),
(11, 3, 1, 'Fungsi Jalan', 'fungsi-jalan', 'fas fa-list-ol'),
(12, 3, 1, 'Kelas Jalan', 'kelas-jalan', 'fas fa-list-ol'),
(13, 3, 1, 'Tipe Jalan', 'tipe-jalan', 'fas fa-list-ol'),
(14, 3, 1, 'Permukaan Jalan', 'permukaan-jalan', 'fas fa-list-ol'),
(15, 3, 1, 'Kemiringan Jalan', 'kemiringan-jalan', 'fas fa-list-ol'),
(16, 3, 1, 'Status Jalan', 'status-jalan', 'fas fa-list-ol'),
(17, 3, 1, 'Polres', 'polres', 'fas fa-list-ol'),
(18, 4, 1, 'Pemetaan', 'pemetaan', 'fas fa-map'),
(19, 3, 1, 'Kondisi Cahaya', 'kondisi-cahaya', 'fas fa-list-ol'),
(20, 4, 1, 'Data Pemetaan', 'data-pemetaan', 'fas fa-map'),
(21, 4, 1, 'Titik Rawan', 'titik-rawan', 'fas fa-map');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cuaca`
--
ALTER TABLE `cuaca`
  ADD PRIMARY KEY (`id_cuaca`);

--
-- Indeks untuk tabel `fungsi_jalan`
--
ALTER TABLE `fungsi_jalan`
  ADD PRIMARY KEY (`id_fungsi_jalan`);

--
-- Indeks untuk tabel `informasi_khusus`
--
ALTER TABLE `informasi_khusus`
  ADD PRIMARY KEY (`id_informasi_khusus`);

--
-- Indeks untuk tabel `kecelakaan_menonjol`
--
ALTER TABLE `kecelakaan_menonjol`
  ADD PRIMARY KEY (`id_kecelakaan_menonjol`);

--
-- Indeks untuk tabel `kelas_jalan`
--
ALTER TABLE `kelas_jalan`
  ADD PRIMARY KEY (`id_kelas_jalan`);

--
-- Indeks untuk tabel `kemiringan_jalan`
--
ALTER TABLE `kemiringan_jalan`
  ADD PRIMARY KEY (`id_kemiringan_jalan`);

--
-- Indeks untuk tabel `kondisi_cahaya`
--
ALTER TABLE `kondisi_cahaya`
  ADD PRIMARY KEY (`id_kondisi_cahaya`);

--
-- Indeks untuk tabel `laka`
--
ALTER TABLE `laka`
  ADD PRIMARY KEY (`id_laka`),
  ADD KEY `id_informasi_khusus` (`id_informasi_khusus`),
  ADD KEY `id_kondisi_cahaya` (`id_kondisi_cahaya`),
  ADD KEY `id_cuaca` (`id_cuaca`),
  ADD KEY `id_tingkat_kecelakaan` (`id_tingkat_kecelakaan`),
  ADD KEY `id_kecelakaan_menonjol` (`id_kecelakaan_menonjol`),
  ADD KEY `id_fungsi_jalan` (`id_fungsi_jalan`),
  ADD KEY `id_kelas_jalan` (`id_kelas_jalan`),
  ADD KEY `id_tipe_jalan` (`id_tipe_jalan`),
  ADD KEY `id_permukaan_jalan` (`id_permukaan_jalan`),
  ADD KEY `id_kemiringan_jalan` (`id_kemiringan_jalan`),
  ADD KEY `id_status_jalan` (`id_status_jalan`),
  ADD KEY `id_polres` (`id_polres`),
  ADD KEY `id_titik_rawan` (`id_titik_rawan`);

--
-- Indeks untuk tabel `permukaan_jalan`
--
ALTER TABLE `permukaan_jalan`
  ADD PRIMARY KEY (`id_permukaan_jalan`);

--
-- Indeks untuk tabel `polres`
--
ALTER TABLE `polres`
  ADD PRIMARY KEY (`id_polres`);

--
-- Indeks untuk tabel `status_jalan`
--
ALTER TABLE `status_jalan`
  ADD PRIMARY KEY (`id_status_jalan`);

--
-- Indeks untuk tabel `tingkat_kecelakaan`
--
ALTER TABLE `tingkat_kecelakaan`
  ADD PRIMARY KEY (`id_tingkat_kecelakaan`);

--
-- Indeks untuk tabel `tipe_jalan`
--
ALTER TABLE `tipe_jalan`
  ADD PRIMARY KEY (`id_tipe_jalan`);

--
-- Indeks untuk tabel `titik_rawan`
--
ALTER TABLE `titik_rawan`
  ADD PRIMARY KEY (`id_titik_rawan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_active` (`id_active`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id_access_menu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indeks untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  ADD PRIMARY KEY (`id_access_sub_menu`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_sub_menu` (`id_sub_menu`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id_sub_menu`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_active` (`id_active`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `cuaca`
--
ALTER TABLE `cuaca`
  MODIFY `id_cuaca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `fungsi_jalan`
--
ALTER TABLE `fungsi_jalan`
  MODIFY `id_fungsi_jalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `informasi_khusus`
--
ALTER TABLE `informasi_khusus`
  MODIFY `id_informasi_khusus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kecelakaan_menonjol`
--
ALTER TABLE `kecelakaan_menonjol`
  MODIFY `id_kecelakaan_menonjol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kelas_jalan`
--
ALTER TABLE `kelas_jalan`
  MODIFY `id_kelas_jalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kemiringan_jalan`
--
ALTER TABLE `kemiringan_jalan`
  MODIFY `id_kemiringan_jalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kondisi_cahaya`
--
ALTER TABLE `kondisi_cahaya`
  MODIFY `id_kondisi_cahaya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `laka`
--
ALTER TABLE `laka`
  MODIFY `id_laka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `permukaan_jalan`
--
ALTER TABLE `permukaan_jalan`
  MODIFY `id_permukaan_jalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `polres`
--
ALTER TABLE `polres`
  MODIFY `id_polres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `status_jalan`
--
ALTER TABLE `status_jalan`
  MODIFY `id_status_jalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tingkat_kecelakaan`
--
ALTER TABLE `tingkat_kecelakaan`
  MODIFY `id_tingkat_kecelakaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tipe_jalan`
--
ALTER TABLE `tipe_jalan`
  MODIFY `id_tipe_jalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `titik_rawan`
--
ALTER TABLE `titik_rawan`
  MODIFY `id_titik_rawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id_access_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  MODIFY `id_access_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_status`
--
ALTER TABLE `user_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `laka`
--
ALTER TABLE `laka`
  ADD CONSTRAINT `laka_ibfk_1` FOREIGN KEY (`id_informasi_khusus`) REFERENCES `informasi_khusus` (`id_informasi_khusus`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `laka_ibfk_10` FOREIGN KEY (`id_kemiringan_jalan`) REFERENCES `kemiringan_jalan` (`id_kemiringan_jalan`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `laka_ibfk_11` FOREIGN KEY (`id_status_jalan`) REFERENCES `status_jalan` (`id_status_jalan`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `laka_ibfk_12` FOREIGN KEY (`id_polres`) REFERENCES `polres` (`id_polres`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laka_ibfk_13` FOREIGN KEY (`id_titik_rawan`) REFERENCES `titik_rawan` (`id_titik_rawan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laka_ibfk_2` FOREIGN KEY (`id_kondisi_cahaya`) REFERENCES `kondisi_cahaya` (`id_kondisi_cahaya`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `laka_ibfk_3` FOREIGN KEY (`id_cuaca`) REFERENCES `cuaca` (`id_cuaca`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `laka_ibfk_4` FOREIGN KEY (`id_tingkat_kecelakaan`) REFERENCES `tingkat_kecelakaan` (`id_tingkat_kecelakaan`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `laka_ibfk_5` FOREIGN KEY (`id_kecelakaan_menonjol`) REFERENCES `kecelakaan_menonjol` (`id_kecelakaan_menonjol`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `laka_ibfk_6` FOREIGN KEY (`id_fungsi_jalan`) REFERENCES `fungsi_jalan` (`id_fungsi_jalan`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `laka_ibfk_7` FOREIGN KEY (`id_kelas_jalan`) REFERENCES `kelas_jalan` (`id_kelas_jalan`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `laka_ibfk_8` FOREIGN KEY (`id_tipe_jalan`) REFERENCES `tipe_jalan` (`id_tipe_jalan`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `laka_ibfk_9` FOREIGN KEY (`id_permukaan_jalan`) REFERENCES `permukaan_jalan` (`id_permukaan_jalan`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_active`) REFERENCES `user_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  ADD CONSTRAINT `user_access_sub_menu_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_access_sub_menu_ibfk_2` FOREIGN KEY (`id_sub_menu`) REFERENCES `user_sub_menu` (`id_sub_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD CONSTRAINT `user_sub_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `user_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_sub_menu_ibfk_2` FOREIGN KEY (`id_active`) REFERENCES `user_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
