-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jan 2024 pada 07.00
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
(1, 'auth.jpg', '#5c5d60');

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
-- Struktur dari tabel `kontak`
--

CREATE TABLE `kontak` (
  `id_kontak` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kontak`
--

INSERT INTO `kontak` (`id_kontak`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Arlan Butar Butar', 'arlanbutarbutar@net-code.tech', 'Belum dapat invoice/faktur', 'tes', '2024-01-16 13:35:45'),
(2, 'tes', 'arlanbutarbutar@net-code.tech', 'Website Tidak Bisa Diakses', 'tes', '2024-01-16 13:36:38'),
(3, 'Arlan', 'arlan270899@gmail.com', 'Email bermasalah', 'rtesdvs', '2024-01-16 13:37:30');

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
  `titik_acuan` varchar(100) DEFAULT NULL,
  `tipe_kecelakaan` text DEFAULT NULL,
  `batas_kecepatan_dilokasi` int(11) DEFAULT NULL,
  `nilai_kerugian_non_kendaraan` int(11) DEFAULT NULL,
  `nilai_kerugian_kendaraan` int(11) DEFAULT NULL,
  `keterangan_kerugian` text DEFAULT NULL,
  `jam_kejadian` time DEFAULT NULL,
  `id_titik_rawan` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `laka`
--

INSERT INTO `laka` (`id_laka`, `id_informasi_khusus`, `id_kondisi_cahaya`, `id_cuaca`, `id_tingkat_kecelakaan`, `id_kecelakaan_menonjol`, `id_fungsi_jalan`, `id_kelas_jalan`, `id_tipe_jalan`, `id_permukaan_jalan`, `id_kemiringan_jalan`, `id_status_jalan`, `id_polres`, `no_laka`, `tanggal_kejadian`, `jumlah_meninggal`, `jumlah_luka_berat`, `jumlah_luka_ringan`, `titik_acuan`, `tipe_kecelakaan`, `batas_kecepatan_dilokasi`, `nilai_kerugian_non_kendaraan`, `nilai_kerugian_kendaraan`, `keterangan_kerugian`, `jam_kejadian`, `id_titik_rawan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, 1, 2, 1, 2, 2, 1, 1, 2, 2, 'LP/A/120/VI/2022/SPKT', '2023-06-11', 0, 0, 2, 'Jembatan', 'Kendaraan Out of Control keluar ke kanan jalan', 20, 0, 0, 'Berawal saat Pengendara Sepeda Motor Honda Revo bergerak dari arah Polsek Maulafa menuju ke arah Naimata sesampainya di Tkp tepatnya di Jembatan Petuk Tiga, Pengendara Sepeda Motor Honda Revo yang melaju dengan kecepatan tinggi dan dalam keadaan mengantuk tiba-tiba hilang kendali dan menabrak Pembatas jalan sehingga terjatuh.', '20:30:00', 3, '2024-01-16 07:10:05', '2024-01-16 07:10:05'),
(3, 1, 1, 3, 1, 1, 1, 1, 1, 1, 1, 1, 2, 'LP/A/121/VI/2022/SPKT', '2023-12-28', 0, 0, 1, 'depan jual jagung bakar', '-', 40, 0, 0, '-', '05:54:00', 3, '2024-01-16 07:10:05', '2024-01-16 07:10:05'),
(5, 1, 1, 3, 1, 1, 1, 1, 1, 1, 1, 1, 2, 'LP/A/123/VI/2022/SPKT', '2024-01-15', 0, 0, 2, 'depan jual jagung bakar', 'Kendaraan Out of Control keluar ke kanan jalan', 40, 0, 0, '-', '15:48:00', 2, '2024-01-16 13:50:53', '2024-01-16 13:50:53');

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
-- Struktur dari tabel `pesan_kapolri`
--

CREATE TABLE `pesan_kapolri` (
  `id_pesan` int(11) NOT NULL,
  `img_kapolri` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesan_kapolri`
--

INSERT INTO `pesan_kapolri` (`id_pesan`, `img_kapolri`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, '2689803091.jpeg', '<p>Kepada masyarakat mari kita dukung upaya-upaya untuk mewujudkan Polri yang lebih profesional dan amanah. Berbagai pengalaman berbangsa dan bernegara selama ini, tentunya akan menjadi pelajaran berharga bagi kita semua dalam upaya melanjutkan reformasi Polri. Kami membuka diri, menampung aspirasi dan pandangan dari semua elemen masyarakat, untuk mendudukkan Polri menjadi pelindung dan pengayom bagi segenap warga bangsa.<br />\r\n<br />\r\nKami tidak hanya akan selalu bekerja profesional, yakni mendasarkan kinerjanya kepada ilmu pengetahuan dan sistem hukum yang berlaku, tetapi juga amanah, akuntabel kepada pemangku kepentingan antara lain dengan menggunakan kewenangannya secara bijak dan santun pada masyarakat yang kami layani.<br />\r\n<br />\r\nPolri milik kita. Mari kita jadikan Polri seperti yang kita dambakan.<br />\r\n<br />\r\nJalan Trunojoyo no. 3, Kebayoran Baru Jakarta 12110<br />\r\nTerima Kasih,<br />\r\n<br />\r\n<br />\r\nKapolri<br />\r\n<strong>Drs. Listyo Sigit Prabowo, M.Si</strong><br />\r\nJendral Polisi</p>\r\n', '2024-01-16 12:11:25', '2024-01-16 12:44:34');

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
-- Struktur dari tabel `sejarah`
--

CREATE TABLE `sejarah` (
  `id_sejarah` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sejarah`
--

INSERT INTO `sejarah` (`id_sejarah`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, '<p><strong>Sebelum Kemerdekaan Indonesia</strong></p>\r\n\r\n<hr />\r\n<p><strong>Jaman Kerajaan</strong><br />\r\nPada zaman Kerajaan Majapahit patih Gajah Mada membentuk pasukan pengamanan yang disebut dengan Bhayangkara yang bertugas melindungi raja dan kerajaan.</p>\r\n\r\n<p><strong>Masa kolonial Belanda</strong><br />\r\nPada masa kolonial Belanda, pembentukan pasukan keamanan diawali oleh pembentukan pasukan-pasukan jaga yang diambil dari orang-orang pribumi untuk menjaga aset dan kekayaan orang-orang Eropa di Hindia Belanda pada waktu itu. Pada tahun 1867 sejumlah warga Eropa di Semarang, merekrut 78 orang pribumi untuk menjaga keamanan mereka.</p>\r\n\r\n<p>Wewenang operasional kepolisian ada pada residen yang dibantu asisten residen. Rechts politie dipertanggungjawabkan pada procureur generaal (jaksa agung). Pada masa Hindia Belanda terdapat bermacam-macam bentuk kepolisian, seperti veld politie (polisi lapangan) , stands politie (polisi kota), cultur politie (polisi pertanian), bestuurs politie (polisi pamong praja), dan lain-lain.</p>\r\n\r\n<p>Sejalan dengan administrasi negara waktu itu, pada kepolisian juga diterapkan pembedaan jabatan bagi bangsa Belanda dan pribumi. Pada dasarnya pribumi tidak diperkenankan menjabat hood agent (bintara), inspekteur van politie, dan commisaris van politie. Untuk pribumi selama menjadi agen polisi diciptakan jabatan seperti mantri polisi, asisten wedana, dan wedana polisi.</p>\r\n\r\n<p>Kepolisian modern Hindia Belanda yang dibentuk antara tahun 1897-1920 adalah merupakan cikal bakal dari terbentuknya Kepolisian Negara Republik Indonesia saat ini.</p>\r\n\r\n<p><strong>Masa pendudukan Jepang</strong><br />\r\nPada masa ini Jepang membagi wiliyah kepolisian Indonesia menjadi Kepolisian Jawa dan Madura yang berpusat di Jakarta, Kepolisian Sumatera yang berpusat di Bukittinggi, Kepolisian wilayah Indonesia Timur berpusat di Makassar dan Kepolisian Kalimantan yang berpusat di Banjarmasin.</p>\r\n\r\n<p>Tiap-tiap kantor polisi di daerah meskipun dikepalai oleh seorang pejabat kepolisian bangsa Indonesia, tapi selalu didampingi oleh pejabat Jepang yang disebut sidookaan yang dalam praktik lebih berkuasa dari kepala polisi.</p>\r\n\r\n<p><strong>Awal Kemerdekaan Indonesia</strong></p>\r\n\r\n<hr />\r\n<p><strong>Periode 1945-1950</strong><br />\r\nTidak lama setelah Jepang menyerah tanpa syarat kepada Sekutu, pemerintah militer Jepang membubarkan Peta dan Gyu-Gun, sedangkan polisi tetap bertugas, termasuk waktu Soekarno-Hatta memproklamasikan kemerdekaan Indonesia pada tanggal 17 Agustus 1945. Secara resmi kepolisian menjadi kepolisian Indonesia yang merdeka.</p>\r\n\r\n<p>Inspektur Kelas I (Letnan Satu) Polisi Mochammad Jassin, Komandan Polisi di Surabaya, pada tanggal 21 Agustus 1945 memproklamasikan Pasukan Polisi Republik Indonesia sebagai langkah awal yang dilakukan selain mengadakan pembersihan dan pelucutan senjata terhadap tentara Jepang yang kalah perang, juga membangkitkan semangat moral dan patriotik seluruh rakyat maupun satuan-satuan bersenjata yang sedang dilanda depresi dan kekalahan perang yang panjang. Sebelumnya pada tanggal 19 Agustus 1945 dibentuk Badan Kepolisian Negara (BKN) oleh Panitia Persiapan Kemerdekaan Indonesia (PPKI). Pada tanggal 29 September 1945 Presiden Soekarno melantik R.S. Soekanto Tjokrodiatmodjo menjadi Kepala Kepolisian Negara (KKN).</p>\r\n\r\n<p>Pada awalnya kepolisian berada dalam lingkungan Kementerian Dalam Negeri dengan nama Djawatan Kepolisian Negara yang hanya bertanggung jawab masalah administrasi, sedangkan masalah operasional bertanggung jawab kepada Jaksa Agung.</p>\r\n\r\n<p>Kemudian mulai tanggal 1 Juli 1946 dengan Penetapan Pemerintah tahun 1946 No. 11/S.D. Djawatan Kepolisian Negara yang bertanggung jawab langsung kepada Perdana Menteri. Tanggal 1 Juli inilah yang setiap tahun diperingati sebagai Hari Bhayangkara hingga saat ini.</p>\r\n\r\n<p>Sebagai bangsa dan negara yang berjuang mempertahankan kemerdekaan maka Polri di samping bertugas sebagai penegak hukum juga ikut bertempur di seluruh wilayah RI. Polri menyatakan dirinya &ldquo;combatant&rdquo; yang tidak tunduk pada Konvensi Jenewa. Polisi Istimewa diganti menjadi Mobile Brigade, sebagai kesatuan khusus untuk perjuangan bersenjata, seperti dikenal dalam pertempuran 10 November di Surabaya, di front Sumatera Utara, Sumatera Barat, penumpasan pemberontakan PKI di Madiun, dan lain-lain.</p>\r\n\r\n<p>Pada masa kabinet presidential, pada tanggal 4 Februari 1948 dikeluarkan Tap Pemerintah No. 1/1948 yang menetapkan bahwa Polri dipimpin langsung oleh presiden/wakil presiden dalam kedudukan sebagai perdana menteri/wakil perdana menteri.</p>\r\n\r\n<p>Pada masa revolusi fisik, Kapolri Jenderal Polisi R.S. Soekanto telah mulai menata organisasi kepolisian di seluruh wilayah RI. Pada Pemerintahan Darurat RI (PDRI) yang diketuai Mr. Sjafrudin Prawiranegara berkedudukan di Sumatera Tengah, Jawatan Kepolisian dipimpin KBP Umar Said (tanggal 22 Desember 1948).</p>\r\n\r\n<p>Hasil Konferensi Meja Bundar antara Indonesia dan Belanda dibentuk Republik Indonesia Serikat (RIS), maka R.S. Sukanto diangkat sebagai Kepala Jawatan Kepolisian Negara RIS dan R. Sumanto diangkat sebagai Kepala Kepolisian Negara RI berkedudukan di Yogyakarta.</p>\r\n\r\n<p>Dengan Keppres RIS No. 22 tahun 1950 dinyatakan bahwa Jawatan Kepolisian RIS dalam kebijaksanaan politik polisional berada di bawah perdana menteri dengan perantaraan jaksa agung, sedangkan dalam hal administrasi pembinaan, dipertanggungjawabkan pada menteri dalam negeri.</p>\r\n\r\n<p>Umur RIS hanya beberapa bulan. Sebelum dibentuk Negara Kesatuan RI pada tanggal 17 Agustus 1950, pada tanggal 7 Juni 1950 dengan Tap Presiden RIS No. 150, organisasi-organisasi kepolisian negara-negara bagian disatukan dalam Jawatan Kepolisian Indonesia. Dalam peleburan tersebut disadari adanya kepolisian negara yang dipimpin secara sentral, baik di bidang kebijaksanaan siasat kepolisian maupun administratif, organisatoris.</p>\r\n\r\n<p><strong>Periode 1950-1959</strong><br />\r\nDengan dibentuknya negara kesatuan pada 17 Agustus 1950 dan diberlakukannya UUDS 1950 yang menganut sistem parlementer, Kepala Kepolisian Negara tetap dijabat R.S. Soekanto yang bertanggung jawab kepada perdana menteri/presiden.</p>\r\n\r\n<p>Waktu kedudukan Polri kembali ke Jakarta, karena belum ada kantor digunakan bekas kantor Hoofd van de Dienst der Algemene Politie di Gedung Departemen Dalam Negeri. Kemudian R.S. Soekanto merencanakan kantor sendiri di Jalan Trunojoyo 3, Kebayoran Baru, Jakarta Selatan, dengan sebutan Markas Besar Djawatan Kepolisian Negara RI (DKN) yang menjadi Markas Besar Kepolisian sampai sekarang. Ketika itu menjadi gedung perkantoran termegah setelah Istana Negara.</p>\r\n\r\n<p>Sampai periode ini kepolisian berstatus tersendiri antara sipil dan militer yang memiliki organisasi dan peraturan gaji tersendiri. Anggota Polri terorganisir dalam Persatuan Pegawai Polisi Republik Indonesia (P3RI) tidak ikut dalam Korpri, sedangkan bagi istri polisi semenjak zaman revolusi sudah membentuk organisasi yang sampai sekarang dikenal dengan nama Bhayangkari tidak ikut dalam Dharma Wanita ataupun Dharma Pertiwi. Organisasi P3RI dan Bhayangkari ini memiliki ketua dan pengurus secara demokratis dan pernah ikut Pemilu 1955 yang memenangkan kursi di Konstituante dan Parlemen. Waktu itu semua gaji pegawai negeri berada di bawah gaji angkatan perang, namun P3RI memperjuangkan perbaikan gaji dan berhasil melahirkan Peraturan Gaji Polisi (PGPOL) di mana gaji Polri relatif lebih baik dibanding dengan gaji pegawai negeri lainnya (mengacu standar PBB).</p>\r\n\r\n<p><strong>Masa Orde Lama</strong><br />\r\nDengan Dekrit Presiden 5 Juli 1959, setelah kegagalan Konstituante, Indonesia kembali ke UUD 1945, namun dalam pelaksanaannya kemudian banyak menyimpang dari UUD 1945. Jabatan Perdana Menteri (Alm. Ir. Juanda) diganti dengan sebutan Menteri Pertama, Polri masih tetap di bawah pada Menteri Pertama sampai keluarnya Keppres No. 153/1959, tertanggal 10 Juli di mana Kepala Kepolisian Negara diberi kedudukan Menteri Negara ex-officio.</p>\r\n\r\n<p>Pada tanggal 13 Juli 1959 dengan Keppres No. 154/1959 Kapolri juga menjabat sebagai Menteri Muda Kepolisian dan Menteri Muda Veteran. Pada tanggal 26 Agustus 1959 dengan Surat Edaran Menteri Pertama No. 1/MP/RI1959, ditetapkan sebutan Kepala Kepolisian Negara diubah menjadi Menteri Muda Kepolisian yang memimpin Departemen Kepolisian (sebagai ganti dari Djawatan Kepolisian Negara).</p>\r\n\r\n<p>Waktu Presiden Soekarno menyatakan akan membentuk ABRI yang terdiri dari Angkatan Perang dan Angkatan Kepolisian, R.S. Soekanto menyampaikan keberatannya dengan alasan untuk menjaga profesionalisme kepolisian. Pada tanggal 15 Desember 1959 R.S. Soekanto mengundurkan diri setelah menjabat Kapolri/Menteri Muda Kepolisian, sehingga berakhirlah karier Bapak Kepolisian RI tersebut sejak 29 September 1945 hingga 15 Desember 1959.</p>\r\n\r\n<p>Dengan Tap MPRS No. II dan III tahun 1960 dinyatakan bahwa ABRI terdiri atas Angkatan Perang dan Polisi Negara. Berdasarkan Keppres No. 21/1960 sebutan Menteri Muda Kepolisian ditiadakan dan selanjutnya disebut Menteri Kepolisian Negara bersama Angkatan Perang lainnya dan dimasukkan dalam bidang keamanan nasional.</p>\r\n\r\n<p>Tanggal 19 Juni 1961, DPR-GR mengesahkan UU Pokok kepolisian No. 13/1961. Dalam UU ini dinyatakan bahwa kedudukan Polri sebagai salah satu unsur ABRI yang sama sederajat dengan TNI AD, AL, dan AU.</p>\r\n\r\n<p>Dengan Keppres No. 94/1962, Menteri Kapolri, Menteri/KASAD, Menteri/KASAL, Menteri/KSAU, Menteri/Jaksa Agung, Menteri Urusan Veteran dikoordinasikan oleh Wakil Menteri Pertama bidang pertahanan keamanan. Dengan Keppres No. 134/1962 menteri diganti menjadi Menteri/Kepala Staf Angkatan Kepolisian (Menkasak).</p>\r\n\r\n<p>Kemudian Sebutan Menkasak diganti lagi menjadi Menteri/Panglima Angkatan Kepolisian (Menpangak) dan langsung bertanggung jawab kepada presiden sebagai kepala pemerintahan negara. Dengan Keppres No. 290/1964 kedudukan, tugas, dan tanggung jawab Polri ditentukan sebagai berikut :</p>\r\n\r\n<ul>\r\n	<li>Alat Negara Penegak Hukum.</li>\r\n	<li>Koordinator Polsus.</li>\r\n	<li>Ikut serta dalam pertahanan.</li>\r\n	<li>Pembinaan Kamtibmas.</li>\r\n	<li>Kerkaryaan</li>\r\n	<li>Sebagai alat revolusi.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Berdasarkan Keppres No. 155/1965 tanggal 6 Juli 1965, pendidikan AKABRI disamakan bagi Angkatan Perang dan Polri selama satu tahun di Magelang. Sementara pada tahun 1964 dan 1965, pengaruh PKI bertambah besar karena politik NASAKOM Presiden Soekarno, dan PKI mulai menyusupi memengaruhi sebagian anggota ABRI dari keempat angkatan.</p>\r\n\r\n<p><strong>Masa Orde Baru</strong><br />\r\nKarena pengalaman yang pahit dari peristiwa G30S/PKI yang mencerminkan tidak adanya integrasi antar unsur-unsur ABRI, maka untuk meningkatkan integrasi ABRI, tahun 1967 dengan SK Presiden No. 132/1967 tanggal 24 Agustus 1967 ditetapkan Pokok-Pokok Organisasi dan Prosedur Bidang Pertahanan dan Keamanan yang menyatakan ABRI merupakan bagian dari organisasi Departemen Hankam meliputi AD, AL, AU , dan AK yang masing-masing dipimpin oleh Panglima Angkatan dan bertanggung jawab atas pelaksanaan tugas dan kewajibannya kepada Menhankam/Pangab. Jenderal Soeharto sebagai Menhankam/Pangab yang pertama.</p>\r\n\r\n<p>Setelah Soeharto dipilih sebagai presiden pada tahun 1968, jabatan Menhankam/Pangab berpindah kepada Jenderal M. Panggabean. Kemudian ternyata betapa ketatnya integrasi ini yang dampaknya sangat menyulitkan perkembangan Polri yang secara universal memang bukan angkatan perang.</p>\r\n\r\n<p>Pada tahun 1969 dengan Keppres No. 52/1969 sebutan Panglima Angkatan Kepolisian diganti kembali sesuai UU No. 13/1961 menjadi Kepala Kepolisian Negara RI, namun singkatannya tidak lagi KKN tetapi Kapolri. Pergantian sebutan ini diresmikan pada tanggal 1 Juli 1969.</p>\r\n', '2024-01-16 12:57:20', '2024-01-16 12:57:26');

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
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `titik_rawan`
--

INSERT INTO `titik_rawan` (`id_titik_rawan`, `img_titik_rawan`, `nama_jalan_rawan`, `created_at`, `updated_at`) VALUES
(2, '654880270.jpg', 'Jln. W.J Lalamentik', '2024-01-16 07:09:32', '2024-01-16 07:09:32'),
(3, '1301453848.jpg', 'Jln. Frans Seda', '2024-01-16 07:09:32', '2024-01-16 07:09:32'),
(4, '1922264560.jpg', 'Jln. amabi', '2024-01-16 07:09:32', '2024-01-16 07:09:32');

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
(4, 1, 4),
(5, 1, 5);

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
(19, 1, 19),
(20, 1, 20),
(21, 1, 21),
(22, 1, 22),
(24, 1, 24),
(25, 1, 25),
(27, 1, 27);

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
(3, 'Utilitas'),
(4, 'Satlantas'),
(5, 'Lainnya');

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
(19, 3, 1, 'Kondisi Cahaya', 'kondisi-cahaya', 'fas fa-list-ol'),
(20, 4, 1, 'Data Kecelakaan', 'data-kecelakaan', 'fas fa-map'),
(21, 4, 1, 'Titik Rawan', 'titik-rawan', 'fas fa-map'),
(22, 5, 1, 'Pesan Kapolri', 'pesan-kapolri', 'fas fa-list-ol'),
(24, 5, 1, 'Sejarah', 'sejarah', 'fas fa-list-ol'),
(25, 5, 1, 'Visi Misi', 'visi-misi', 'fas fa-list-ol'),
(27, 5, 1, 'Kontak', 'kontak', 'fas fa-list-ol');

-- --------------------------------------------------------

--
-- Struktur dari tabel `visi_misi`
--

CREATE TABLE `visi_misi` (
  `id_vm` int(11) NOT NULL,
  `img_vm` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `visi_misi`
--

INSERT INTO `visi_misi` (`id_vm`, `img_vm`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, '2689803091.jpeg', '<h2>Visi</h2>\r\n\r\n<p>Terwujudnya Indonesia yang Aman dan Tertib guna mendukung Visi dan Misi Presiden dan Wakil Presiden : &quot;Indonesia Maju yang Berdaulat, Mandiri, dan Berkepribadian Berlandaskan Gotong-Royong&quot;.</p>\r\n\r\n<hr />\r\n<h2>Misi</h2>\r\n\r\n<p>Melindungi, mengayomi dan melayani masyarakat dalam memberikan perlindungan bagi segenap bangsa dan memberikan rasa aman kepada seluruh warga serta mendorong kemajuan budaya yang mencerminkan kepribadian bangsa; serta menegakkan sistem hukum yang bebas korupsi, bermartabat dan terpercaya dan menjamin tercapainya lingkungan hidup berkelanjutan</p>\r\n\r\n<p>Adapun Janji Presiden (JP) di Polri ialah :</p>\r\n\r\n<ol>\r\n	<li>penegakkan hukum terhadap kejahatan Premanisme, Lingkungan Hidup, Narkoba, TPPU, Radikalisme, Terorisma dan Intoleransi serta PPA;</li>\r\n	<li>meningkatkan Sinergi dan Kerjasama antar Lembaga penegak hukum dan TNI;</li>\r\n	<li>mengembangkan profesionalisme dan kesejahteraan anggota Polri, reformasi birokrasi guna menekan budaya koruptif dan tindakan yang berlebihan atau kekerasan eksesif;</li>\r\n</ol>\r\n\r\n<h2>Tujuan</h2>\r\n\r\n<ol>\r\n	<li>menjamin terpeliharanya keamanan dan ketertiban masyarakat di seluruh wilayah NKRI;</li>\r\n	<li>menegakkan hukum secara berkeadilan;</li>\r\n	<li>mewujudkan Polri yang profesional;</li>\r\n	<li>modernisasi pelayanan Polri;</li>\r\n	<li>menerapkan manajemen Polri yang terintegrasi dan terpercaya.</li>\r\n</ol>\r\n', '2024-01-16 13:03:11', '2024-01-16 13:03:26');

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
-- Indeks untuk tabel `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id_kontak`);

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
-- Indeks untuk tabel `pesan_kapolri`
--
ALTER TABLE `pesan_kapolri`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indeks untuk tabel `polres`
--
ALTER TABLE `polres`
  ADD PRIMARY KEY (`id_polres`);

--
-- Indeks untuk tabel `sejarah`
--
ALTER TABLE `sejarah`
  ADD PRIMARY KEY (`id_sejarah`);

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
-- Indeks untuk tabel `visi_misi`
--
ALTER TABLE `visi_misi`
  ADD PRIMARY KEY (`id_vm`);

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
-- AUTO_INCREMENT untuk tabel `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id_kontak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `laka`
--
ALTER TABLE `laka`
  MODIFY `id_laka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `permukaan_jalan`
--
ALTER TABLE `permukaan_jalan`
  MODIFY `id_permukaan_jalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pesan_kapolri`
--
ALTER TABLE `pesan_kapolri`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `polres`
--
ALTER TABLE `polres`
  MODIFY `id_polres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `sejarah`
--
ALTER TABLE `sejarah`
  MODIFY `id_sejarah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id_titik_rawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id_access_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_access_sub_menu`
--
ALTER TABLE `user_access_sub_menu`
  MODIFY `id_access_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `visi_misi`
--
ALTER TABLE `visi_misi`
  MODIFY `id_vm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
