-- Active: 1651820926135@@127.0.0.1@3306@gis_korlantas
CREATE TABLE polres (
  id_polres INT AUTO_INCREMENT PRIMARY KEY,
  nama_polres VARCHAR(100) NOT NULL,
  alamat VARCHAR(100),
  telepon VARCHAR(15),
  email VARCHAR(50),
  jumlah_anggota INT
);

CREATE TABLE informasi_khusus (
  id_informasi_khusus INT AUTO_INCREMENT PRIMARY KEY,
  informasi_khusus VARCHAR(100) NOT NULL
);

INSERT INTO
  informasi_khusus (informasi_khusus)
VALUES
  ('Tidak Ada Saksi'),
  ('Tabrakan Beruntun'),
  ('Tabrak Lari'),
  ('Ada Saksi');

CREATE TABLE kondisi_cahaya (
  id_kondisi_cahaya INT AUTO_INCREMENT PRIMARY KEY,
  kondisi_cahaya VARCHAR(50)
);

INSERT INTO
  kondisi_cahaya (kondisi_cahaya)
VALUES
  ('Redup / Samar (Tidak jelas terlihat)'),
  ('Terang / Jelas');

CREATE TABLE cuaca (
  id_cuaca INT AUTO_INCREMENT PRIMARY KEY,
  tanggal DATE NOT NULL,
  kota VARCHAR(100) NOT NULL,
  suhu FLOAT,
  kelembaban FLOAT,
  kondisi VARCHAR(50)
);

CREATE TABLE tingkat_kecelakaan (
  id_tingkat_kecelakaan INT AUTO_INCREMENT PRIMARY KEY,
  tingkat_kecelakaan VARCHAR(50)
);

INSERT INTO
  tingkat_kecelakaan (tingkat_kecelakaan)
VALUES
  ('Ringan'),
  ('Sedang'),
  ('Berat');

CREATE TABLE kecelakaan_menonjol (
  id_kecelakaan_menonjol INT AUTO_INCREMENT PRIMARY KEY,
  kecelakaan_menonjol VARCHAR(10)
);

INSERT INTO
  kecelakaan_menonjol (kecelakaan_menonjol)
VALUES
  ('Ya'),
  ('Tidak');

CREATE TABLE fungsi_jalan (
  id_fungsi_jalan INT AUTO_INCREMENT PRIMARY KEY,
  fungsi_jalan VARCHAR(35)
);

INSERT INTO
  fungsi_jalan (fungsi_jalan)
VALUES
  ('Arteri'),
  ('Kolektor'),
  ('Lokal/Lingkungan');

CREATE TABLE kelas_jalan (
  id_kelas_jalan INT AUTO_INCREMENT PRIMARY KEY,
  kelas_jalan VARCHAR(100)
);

INSERT INTO
  kelas_jalan (kelas_jalan)
VALUES
  (
    'I (Jalan Besar utk beban 10 ton & max 18 m Panjang Ran)'
  ),
  (
    'II (Jalan Sedang utk beban s/d 10 ton & 12m Panjang Ran)'
  ),
  (
    'III (Jalan Kecil utk max beban 8 ton & 9 m Panjang Ran)'
  );

CREATE TABLE tipe_jalan (
  id_tipe_jalan INT AUTO_INCREMENT PRIMARY KEY,
  tipe_jalan VARCHAR(75)
);

INSERT INTO
  tipe_jalan (tipe_jalan)
VALUES
  ('2/2 TB (2 Lajur/2 Arah Tanpa Batas Median)'),
  ('4/2 B (4 Lajur/2 Arah dengan Batas Median)'),
  ('6/2 B (6 Lajur/2 Arah dengan Batas Median)');

CREATE TABLE permukaan_jalan (
  id_permukaan_jalan INT AUTO_INCREMENT PRIMARY KEY,
  permukaan_jalan VARCHAR (35)
);

INSERT INTO
  permukaan_jalan (permukaan_jalan)
VALUES
  ('Baik'),
  ('Berombak'),
  ('Berlubang'),
  ('Basah'),
  ('Licin'),
  ('Banjir/ Tergenang Air');

CREATE TABLE kemiringan_jalan(
  id_kemiringan_jalan INT AUTO_INCREMENT PRIMARY KEY,
  kemiringan_jalan VARCHAR (50)
);

INSERT INTO
  kemiringan_jalan (kemiringan_jalan)
VALUES
  ('Datar'),
  ('Menanjak'),
  ('Menurun');

CREATE TABLE status_jalan(
  id_status_jalan INT AUTO_INCREMENT PRIMARY KEY,
  status_jalan VARCHAR (50)
);

INSERT INTO
  status_jalan (status_jalan)
VALUES
  ('Jalan Kota / Kabupaten'),
  ('Jalan Propinsi'),
  ('Jalan Nasional');

CREATE TABLE laka (
  id_laka INT AUTO_INCREMENT PRIMARY KEY,
  id_informasi_khusus INT,
  id_kondisi_cahaya INT,
  id_cuaca INT,
  id_tingkat_kecelakaan INT,
  id_kecelakaan_menonjol INT,
  id_fungsi_jalan INT,
  id_kelas_jalan INT,
  id_tipe_jalan INT,
  id_permukaan_jalan INT,
  id_kemiringan_jalan INT,
  id_status_jalan INT,
  id_polres INT,
  FOREIGN KEY (id_informasi_khusus) REFERENCES informasi_khusus(id_informasi_khusus) ON UPDATE CASCADE ON DELETE NO ACTION,
  FOREIGN KEY (id_kondisi_cahaya) REFERENCES kondisi_cahaya(id_kondisi_cahaya) ON UPDATE CASCADE ON DELETE NO ACTION,
  FOREIGN KEY (id_cuaca) REFERENCES cuaca(id_cuaca) ON UPDATE CASCADE ON DELETE NO ACTION,
  FOREIGN KEY (id_tingkat_kecelakaan) REFERENCES tingkat_kecelakaan(id_tingkat_kecelakaan) ON UPDATE CASCADE ON DELETE NO ACTION,
  FOREIGN KEY (id_kecelakaan_menonjol) REFERENCES kecelakaan_menonjol(id_kecelakaan_menonjol) ON UPDATE CASCADE ON DELETE NO ACTION,
  FOREIGN KEY (id_fungsi_jalan) REFERENCES fungsi_jalan(id_fungsi_jalan) ON UPDATE CASCADE ON DELETE NO ACTION,
  FOREIGN KEY (id_kelas_jalan) REFERENCES kelas_jalan(id_kelas_jalan) ON UPDATE CASCADE ON DELETE NO ACTION,
  FOREIGN KEY (id_tipe_jalan) REFERENCES tipe_jalan(id_tipe_jalan) ON UPDATE CASCADE ON DELETE NO ACTION,
  FOREIGN KEY (id_permukaan_jalan) REFERENCES permukaan_jalan(id_permukaan_jalan) ON UPDATE CASCADE ON DELETE NO ACTION,
  FOREIGN KEY (id_kemiringan_jalan) REFERENCES kemiringan_jalan(id_kemiringan_jalan) ON UPDATE CASCADE ON DELETE NO ACTION,
  FOREIGN KEY (id_status_jalan) REFERENCES status_jalan(id_status_jalan) ON UPDATE CASCADE ON DELETE NO ACTION,
  FOREIGN KEY (id_polres) REFERENCES polres(id_polres) ON UPDATE CASCADE ON DELETE CASCADE,
  no_laka VARCHAR(75),
  tanggal_kejadian DATE,
  jumlah_meninggal INT,
  jumlah_luka_berat INT,
  jumlah_luka_ringan INT,
  latitude VARCHAR(50),
  longitude VARCHAR(50),
  titik_acuan VARCHAR(100),
  tipe_kecelakaan TEXT,
  nama_jalan VARCHAR(255),
  batas_kecepatan_dilokasi INT,
  nilai_kerugian_non_kendaraan INT,
  nilai_kerugian_kendaraan INT,
  keterangan_kerugian TEXT
  jam_kejadian TIME,
);