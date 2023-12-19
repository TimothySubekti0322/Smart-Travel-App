# Smart Travel App

Selamat datang di repositori GitHub untuk Smart Travel App. Project ini merupakan web application sederhana untuk melakukan booking ticket travel. Project ini dibangun dengan maksud melakukan integrasi Aplikasi booking travel dengan aplikasi booking Hotel. 

### Aplikasi web ini dibuat oleh Kelompok 23 K01. Berikut adalah anggota kelompok kami :

```
1. I Dewa Made Manu Pradnyana - 18221047
2. Timothy Subekti - 18221063
3. Rahman Satya - 18221117

```


## Fitur

### Customer

- **Login** : Akses yang aman dan terenkripsi untuk setiap Pelanggan, memastikan privasi dan keamanan data.

- **Booking Tiket** : Customer dapat Melakukan Booking tiket pada paket - paket yang tersedia sesuai tanggal, waktu, dan pilihan tempat duduk yang diinginkan

- **Melihat Daftar Paket Travel** : Daftar lengkap paket travel yang tersedia dengan informasi rinci untuk membantu Customer membuat pilihan yang tepat.

- **Melihat Riwayat Booking tiket** : Akses cepat ke riwayat pembelian memberikan customer informasi lengkap tentang pesanan sebelumnya.

### Pihak Admin

- **Melihat Daftar Booking** : Admin dapat memantau dan kelola semua pesanan tiket yang masuk dengan mudah.

- **Melihat Data paket travel** : Admin dapat melihat seluruh data paket travel 

- **Menambahkan paket travel** : Tambahkan dan kelola paket travel dengan mudah, memastikan bahwa daftar selalu terkini dan relevan.

- **Rekomendasi destinasi paket travel** : Menggunakan informasi area yang ramai dikunjungi dari website booking hotel untuk menentukan destinasi paket travel baru

- **Melihat data order hotel**: Admin dapat melihat data booking Hotel melalui API sistem Hotel
## Tech Stack

**Framework :** CodeIgniter 4

**Web Server :** XAMPP

**Database :** MySQL

**Testing Tools :** Postman
## Prasyarat

Sebelum memulai, pastikan Anda telah mendownload beberapa tools berikut ini:

- **XAMPP** : Pastikan Anda telah menginstal XAMPP untuk menyediakan lingkungan pengembangan lokal yang mencakup Apache, MySQL, PHP, dan Perl.
- **Composer** : Composer digunakan untuk mengelola dependensi PHP pada proyek. Pastikan Anda telah menginstal Composer sebelum melanjutkan dengan instalasi.

Untuk prasyatar ini anda dapat menggunakan referensi video berikut ini [Instalasi CodeIgniter 4](https://youtu.be/UhpzEne6omo?si=RTYhK_HoLrGbvm8f).

## Instalasi

Berikut adalah petunjuk instalasi program untuk menjalankan service pada mesin lokal

Pertama-tama, Anda perlu mengkloning proyek ini atau **mengunduh file**

```bash
  git clone https://github.com/TimothySubekti0322/Smart-Travel-App
```

Pindah ke direktori proyek

```bash
  cd Path/to/Smart-Travel-App
```

Kemudian instal semua dependensi dengan menjalankan kode ini pada terminal

```bash
  composer install
```

Selanjutnya, nyalakan XAMPP anda, Start Apache dan MySQL. 

![xampp control panel](https://res.cloudinary.com/djkckue0o/image/upload/v1702023164/README%20LSTI/dznhrgrwtsgopfm1g20o.png)

Lalu buka php myadmin melalui url "localhost:XXXX" dengan (XXXX) sebagai Port dari Apache. Dalam contoh gambar saya diatas maka saya akan memasukan url "localhost:8040" ke website. Kemudian setelah muncul welcome page XAMPP, klik menu phpMyAdmin pada top navbarnya. Kemudian buatlah sebuah database bernama **smart_travel**.

![Create database smart_dormitoyr](https://res.cloudinary.com/djkckue0o/image/upload/v1702023678/README%20LSTI/sasw53gtedj80yrkwszp.jpg)

Selanjutnya, Donwload ENV file pada link gdrive berikut dan masukan kedalam root directory Project.

Link ENV File : https://drive.google.com/drive/folders/18yDcRzLhskIMXgjkjQRytNWWvNAVbQIB

Selanjutnya, jalankan command migrasi di bawah ini untuk membuat tabel pada database

```bash
  php spark migrate
```

![migration](https://res.cloudinary.com/djkckue0o/image/upload/v1702032125/README%20LSTI/y4xby2hv35jtwrdrxd7c.png)

Kemudian jalan kan command ini pada terminal untuk mengisi initial data pada tabel (seeding)
```bash
   php spark db:seed DbSeeder
```
![db seed](https://res.cloudinary.com/djkckue0o/image/upload/v1702032125/README%20LSTI/jib5r20etueewlerej1f.png)

Selanjutnya, ketik command di bawah ini untuk menjalankan server

```bash
  php spark serve
```

Sekarang anda bisa mengakses Aplikasi Smart Travel melalui server http://localhost:8080/

#### NOTE
Jika Mengalami Kendala tidak bisa terkonek ke database, maka git Clone project Smart-Travel-App ke dalam folder htdocs dengan path C:\xampp\htdocs

Error Yang mungkin terjadi adalah Port Conflict. berikut adalah link referensinya https://www.inforbiro.com/blog/how-to-change-xampp-apache-port

## Referensi API

Berikut adalah panduan API untuk Aplikasi Smart Travel

https://drive.google.com/file/d/10Qn4S_46_1tKbfoCjGt5t7gLuZQGJ2Ux/view?usp=sharing


## Test dengan POSTMAN

Berikut adalah panduan untuk melakukan testing API dengan POSTMAN

**LINK POSTMAN COLLECTION :**  https://drive.google.com/drive/folders/1A1phllG9e18wfYhf5OOoy_7OQERQdT0b?usp=drive_link

## Deployment

**Smart Hotel :** https://smart-hotel-sisterin.000webhostapp.com/

**Smart Travel :** https://smart-travel-app.000webhostapp.com/


## Appendix

**Dokument Kelompok 23 :** https://drive.google.com/file/d/10Qn4S_46_1tKbfoCjGt5t7gLuZQGJ2Ux/view?usp=sharing

