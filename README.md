# Entity Relationship Diagram ( ERD )
![WhatsApp Image 2024-04-30 at 19 04 21_dd758f3d](https://github.com/anazantoro/PA-WEB-Zian/assets/119950654/a4e74cfc-17cc-48b9-a9b8-e0c0767d14d6)
## Entitas dan Atribut:
### Mobil:
no_plat: varchar(15) - Nomor plat mobil
tipe_mobil: varchar(20) - Jenis mobil (misalnya, sedan, SUV, truk)
nama_pemilik: varchar(50) - Nama pemilik mobil
no_pemilik: varchar(14) - Nomor telepon pemilik mobil
status_data: varchar(1) - Status data record (misalnya, aktif, tidak aktif)
### Merk Mobil:
merk_mobil: varchar(20) - Nama merek mobil
### Ukuran Mobil:
ukuran_mobil: varchar(10) - Ukuran mobil (misalnya, kecil, sedang, besar)
### Antrian:
id_antrian: int(5) - ID antrian unik
no_plat: varchar(15) - Kunci asing yang merujuk pada atribut no_plat tabel Mobil
status_data: varchar(1) - Status data record (misalnya, aktif, tidak aktif)
### Paket Pencucian:
id_paket: int(5) - ID paket unik
nama_paket: varchar(50) - Nama paket cuci mobil
desc_paket: varchar(200) - Deskripsi paket cuci mobil
harga_paket: int(10) - Harga paket cuci mobil
status_data: varchar(1) - Status data record (misalnya, aktif, tidak aktif)
### Pesan:
id_pesan: int(11) - ID pesanan unik
nama_pesan: varchar(20) - Nama pesanan (mungkin untuk cuci custom)
email: varchar(50) - Alamat email pelanggan
no_pesan: varchar(20) - Nomor pesanan
pesan: varchar(255) - Pesan atau permintaan tambahan dari pelanggan
status_data: varchar(1) - Status data record (misalnya, aktif, tidak aktif)
### Transaksi:
id_antrian: int(5) - Kunci asing yang merujuk pada atribut id_antrian tabel Antrian
no_nota: varchar(20) - Nomor nota untuk transaksi
biaya: int(11) - Biaya layanan cuci mobil
extra_biaya: int(11) - Biaya layanan tambahan
total_bayar: int(11) - Total pembayaran yang dilakukan oleh pelanggan
status_data: varchar(1) - Status data record (misalnya, aktif, tidak aktif)
### Group Pencuci:
id_group: int(10) - ID grup unik
nama_group: varchar(50) - Nama grup pencuci
### Pencuci:
id_pencuci: int(11) - ID pencuci unik
nama_pencuci: varchar(50) - Nama pencuci
no_pencuci: varchar(14) - Nomor telepon pencuci
jenis_kelamin: enum('L', 'P') - Jenis kelamin pencuci (L untuk laki-laki, P untuk perempuan)
username: varchar(20) - Nama pengguna untuk pencuci untuk login ke sistem
password: varchar(50) - Kata sandi untuk pencuci untuk login ke sistem
status_data: varchar(1) - Status data record (misalnya, aktif, tidak aktif)

### Relasi Antar Tabel:

1. Mobil memiliki hubungan satu-ke-banyak dengan Merk Mobil, artinya satu mobil dapat memiliki satu merek, tetapi satu merek dapat memiliki banyak mobil.
2. Mobil memiliki hubungan satu-ke-banyak dengan Ukuran Mobil, artinya satu mobil dapat memiliki satu ukuran, tetapi satu ukuran dapat memiliki banyak mobil.
3. Antrian memiliki hubungan satu-ke-satu dengan Mobil, artinya satu entri antrian hanya untuk satu mobil.
4. Pesan memiliki hubungan satu-ke-banyak dengan Paket Pencucian, artinya satu pesanan dapat memiliki satu paket cuci mobil, tetapi satu paket cuci mobil dapat memiliki banyak pesanan.
5. Transaksi memiliki hubungan satu-ke-satu dengan Antrian, artinya satu transaksi hanya untuk satu entri antrian.
6. Transaksi memiliki hubungan satu-ke-banyak dengan Paket Pencucian, artinya satu transaksi dapat memiliki satu atau lebih paket cuci mobil.
7. Group Pencuci memiliki hubungan banyak-ke-banyak dengan Pencuci, artinya satu pencuci dapat menjadi anggota dari banyak grup pencuci, dan satu grup pencuci dapat memiliki banyak pencuci.

### Alur Sistem:
1. Mobil datang dan masuk ke antrian.
2. Petugas mencatat informasi mobil dan memasukkannya ke dalam sistem.
3. Pelanggan memilih paket cuci mobil dan/atau memesan cuci custom.
4. Sistem mencatat pesanan dan menambahkannya ke antrian.
5. Ketika antrian tiba, mobil dipindahkan ke area cuci.
6. Pencuci memilih grup pencuci yang sesuai dan memulai cuci mobil.
7. Sistem mencatat transaksi cuci mobil.
8. Setelah selesai dicuci, mobil dibersihkan dan dikembalikan kepada pelanggan.
9. Pelanggan melakukan pembayaran.
10. Sistem mencatat pembayaran dan memperbarui status transaksi.

# Tutorial Penggunaan WEB CleanCars
CleanCars adalah sebuah website pencucian mobil, Dimana anda dapat memesan jasa pencucian secara online melalui website.
CleanCars juga menawarkan paket paket pencucian sehingga anda dapat menentukan paket pencucian sesuai kebutuhan anda.

## HALAMAN USER :
![image](https://github.com/B1-kelompok-5/PA-WEB/assets/102432826/2f30ae56-c4cd-4b60-8027-0a3a914f5422)
Setelah membuka website langkah selanjutnya adalah menekan tombol "Antri Sekarang!" untuk mendaftar.

Kemudian user diminta untuk mengisi sebuah form antrian.
![image](https://github.com/B1-kelompok-5/PA-WEB/assets/102432826/9ae7ada6-8b74-4524-8315-06b2247deb1e)

Setelah selsai mengisi form kemudian tekan tombol "submit" untuk mengirim data antrian, jika berhasil maka akan timbul pop up
![image](https://github.com/B1-kelompok-5/PA-WEB/assets/102432826/0c4ce6e2-7167-45f3-99a4-d734d2fd0712)

Setelah itu user dapat mengecek apakah mobilnya sudah di cuci atau masih menunggu antrian pada tombol "Cek Antri"
![image](https://github.com/B1-kelompok-5/PA-WEB/assets/102432826/2f30ae56-c4cd-4b60-8027-0a3a914f5422)

Dengan memasukkan nomor kendaraan/plat kendaraan.
![image](https://github.com/B1-kelompok-5/PA-WEB/assets/102432826/e0d78399-3af0-467e-82fb-f9ae4e99be48)
Kemudian data antrian akan keluar dengan status kendaraan.

## HALAMAN MANAGER
Sebelum Masuk ke dalam halaman manager pertama - tama lakukan login sesuai akun manager
![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/e8d8c2e4-1c77-463a-a8ac-c09ba78b4942)

Setelah berhasil login maka website akan menampilkan dashboard dari halaman manager
![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/1f2ed9e0-7eab-4468-9844-09c6caf56ffd)

Role manager sendiri dapat mengakses beberapa function seperti :
**Karyawan** di dalam function ini terdapat 3 bagian yaitu 
- **pegawai** ![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/e59fb082-9599-4860-a809-9e6dd943ddcc) ![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/30c0c694-5aee-46b5-9477-43dbf338f537)

- **Pencuci** ![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/5f2462c3-430e-4bdc-b6a7-871d3423cb26)![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/93ab3c08-a6fe-4b59-90c2-6885fa07f1d6)

- **Grup Pencuci** ![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/8a60bfc3-4cbe-4276-b824-09a168fb39fd)![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/66f3e337-53ff-4a3a-8d9a-2d04950659ef) 
Manager hanya perlu mengisi form-form dari masing-masing bagian untuk menambah data, mengubah atau menghapus.

**Mobil** di dalam function ini terdapat 2 bagian yaitu 
- **Mobil** ![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/56a8f0f7-3fe0-4b64-8ba4-40bc55eac1b4) Untuk Menambah, mengubah dan menghapus dari merek mobil dan tipe mobil

- **Mobil Customer** ![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/783ab3e6-9a33-43c6-a3cb-e5d1102d95d7) Manager dapat melihat data dari mobil-mobil pelanggan yang sedang atau sudah antri pencucian, Manager juga dapat mengubah dan menghapus data jika terjadi kesalahan.

**Paket Pencucian**
![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/597d8e38-9fe2-499d-a468-7401bdc3a670)
![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/a3d9cd3f-aa8a-478f-a417-f2fae3a5be92)
Manager dapat menambah, mengubah dan menghapus paket pencucian. Dengan mengisi form di atas.

**Pesan**
![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/4cde1189-1103-4784-9386-bc735cdd3455)
Pesan adalah tempat dimana pelanggan dapat menulis kritik dan saran kepada kami

## Halaman Admin :
Sama Seperti role manager admin akan di arahkan ke dalam halaman login terlebih dahulu
![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/b8883a18-af12-4fae-8cc1-58c41a7011fe)

Setelah login kemudian akan di arahkan ke halaman dashboard admin
![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/2fb20eb2-9e8d-40f4-9427-c3018bce0a7c)
Dashboard dari admin dan manager sebenarnya tidak terlalu berbeda namun disini admin dapat mengatur segala transaksi yang di lakukan di website CleanCars. Admin juga dapat mengatur data-data dari karyyawan mobil dan paket pencucian seperti manager. Namun ada beberapa function yang manager tidak dapat akses yaitu Market.

**Market**
Market adalah function untuk mengatur transaksi yang di lakukan. Market sendiri terbagi menjadi 3 bagian yaitu :
- **Antrian** ![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/ea7fbbc3-89f2-4697-969a-1e28231df6fa) Admin dapat mengatur antrian dari pelanggan seperti menambah mengubah dan menghapus data antrian, Admin juga bertugas mengupdate status dari antrian apakah mobil belum atau sudah di cuci

- **Transaksi** ![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/eb22123b-e3a5-4dec-9a20-94c69618d3ef) Bagian ini adalah bagian dari transaksi pengguna ketika telah selesai mencuci mobil. Sebelum data transaksi masuk admin harus mengisi form untuk menginput data transaksi pada **Antrian** ![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/be0d1219-893e-4e6c-9fd1-7e4a592b9244)
Setelah itu kemudian data transaksi akan masuk ke dalam function transaksi ![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/f52bca78-0943-4bdc-99e5-ded52e7aeae6) di dalam transaksi admin bertugas untuk menambah data, menghapus dan mencetak nota dari transaksi ![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/f376bd8b-0d5e-4f9c-8142-0059fc005a4d)

- **History** 
![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/5ef97063-4949-410a-8f4c-e872bbe26d7d)
History disini adalah tempat untuk melihat data data yang sebelumnya sudah di tambah/di ubah
![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/fc4383c4-55e4-4000-889f-2ff378938ce9)
![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/cc13e252-4a2a-417f-8519-51a016d6a335)
![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/23c1d8be-2edf-40d3-8ecb-6caa44d45320)
![image](https://github.com/Bay1510/PA-WEB-Bayu/assets/102432826/a8e90377-8d37-4cac-8bdf-83ee1f4424b0)
Manager juga dapat mengakses dari History

