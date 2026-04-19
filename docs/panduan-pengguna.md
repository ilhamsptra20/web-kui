# Panduan Pengguna Aplikasi KUI Unida

Dokumen ini dibuat untuk pengguna non-teknis, admin konten, dan pengelola website KUI Unida. Isinya menjelaskan fungsi aplikasi dan cara memakai fitur utama tanpa membahas kode program.

## 1. Tentang Aplikasi

Aplikasi ini digunakan untuk mengelola website KUI Unida, yaitu Kantor Urusan Internasional Universitas Juanda.

Website ini membantu KUI menampilkan informasi seperti:

- profil KUI Unida
- agenda dan event internasional
- pengumuman resmi
- artikel atau berita
- galeri kegiatan
- data team KUI
- halaman informasi tambahan
- kontak dan pesan masuk dari pengunjung
- link media sosial dan relasi lembaga

Admin dapat mengelola sebagian besar isi website melalui dashboard.

## 2. Gambaran Area Aplikasi

Aplikasi memiliki dua area utama:

- Website publik, yaitu halaman yang dilihat oleh pengunjung.
- Dashboard admin, yaitu halaman yang dipakai pengelola untuk mengatur konten.

Contoh website publik:

- Beranda
- Tentang KUI
- Agenda
- Pengumuman
- Galeri
- Artikel
- Team
- Kontak

Contoh dashboard admin:

- Posts
- Pages
- Agenda
- Announcement
- Album
- Gallery
- Team
- Navigation
- Setting
- Inbox
- User
- Role
- Permission

## 3. Login Admin

Admin masuk melalui halaman login aplikasi.

Setelah login, admin akan masuk ke dashboard dan melihat menu di sidebar.

Hak akses menu tergantung role dan permission user. Jika menu tertentu tidak muncul, kemungkinan user belum memiliki permission untuk module tersebut.

## 4. Beranda Website

Beranda menampilkan ringkasan informasi penting KUI, seperti:

- slider hero
- profil singkat KUI
- artikel terbaru
- galeri atau album
- partner atau lembaga terkait
- footer berisi informasi kontak

Konten beranda diambil dari beberapa sumber:

- Slider dari menu `Slider`
- Artikel dari menu `Posts`
- Galeri dari menu `Album` dan `Gallery`
- Logo dan footer dari menu `Setting`
- Partner dari menu `Lembaga`

## 5. Mengelola Artikel

Artikel dikelola dari menu `Posts`.

Artikel yang aktif akan tampil di halaman website:

```text
/articles
```

Hal yang bisa diisi pada artikel:

- judul Indonesia
- judul English
- judul Arabic
- gambar
- isi konten
- kategori
- status publish
- meta title dan meta description

Gunakan status publish jika artikel sudah siap ditampilkan ke publik.

## 6. Mengelola Kategori Artikel

Kategori dikelola dari menu `Category`.

Kategori digunakan untuk mengelompokkan artikel. Contohnya:

- Program Internasional
- Kemitraan Global
- Mahasiswa Internasional

Kategori membantu pengunjung menemukan artikel berdasarkan tema.

## 7. Mengelola Agenda atau Event

Agenda dikelola dari menu `Agenda`.

Agenda yang aktif akan tampil di halaman:

```text
/events
```

Data yang umum diisi:

- nama agenda
- deskripsi agenda
- lokasi
- tanggal mulai
- tanggal selesai

Agenda cocok untuk menampilkan kegiatan seperti sosialisasi, seminar, forum kerja sama, short course, atau event internasional.

## 8. Mengelola Pengumuman

Pengumuman dikelola dari menu `Announcement`.

Pengumuman tampil di halaman:

```text
/announcement
```

Gunakan pengumuman untuk informasi resmi seperti:

- pembukaan pendaftaran program
- jadwal sosialisasi
- perubahan alur layanan
- informasi dokumen
- update penting dari KUI

Jika ada file lampiran, gunakan fitur upload file yang tersedia pada form pengumuman.

## 9. Mengelola Galeri

Galeri memiliki dua bagian:

- `Album`
- `Gallery`

Alurnya:

1. Buat album terlebih dahulu di menu `Album`.
2. Tambahkan foto ke menu `Gallery`.
3. Pilih album untuk setiap foto.

Di website publik:

```text
/gallery
```

Halaman tersebut menampilkan daftar album. Saat pengunjung klik salah satu album, baru muncul foto-foto berdasarkan album tersebut.

## 10. Mengelola Team KUI

Team dikelola dari menu `Team`.

Data team tampil di:

```text
/team
```

Sebelum membuat data team, admin dapat membuat jabatan atau posisi di menu `Position`.

Data yang umum diisi:

- nama anggota
- jabatan
- foto
- bio singkat
- status aktif

## 11. Mengelola Halaman Statis

Halaman statis dikelola dari menu `Page`.

Halaman ini digunakan untuk konten tambahan yang tidak cocok dimasukkan sebagai artikel. Contohnya:

- Profil KUI Unida
- Panduan Mahasiswa Internasional
- Layanan Kerja Sama Internasional
- Program Mobilitas Akademik

Jika halaman diberi status publish, halaman akan tampil sebagai submenu di menu `About` pada navbar marketing.

URL halaman statis memakai format:

```text
/page/slug-halaman
```

Contoh:

```text
/page/profil-kui-unida
```

## 12. Mengelola Menu Navigasi

Menu navigasi dikelola dari menu `Navigation`.

Menu ini mengatur:

- sidebar admin
- navbar website publik
- footer website publik

Untuk membedakan menu:

- `Admin` digunakan untuk menu dashboard.
- `Marketing` digunakan untuk website publik.

Untuk marketing:

- `Navbar` berarti menu atas website.
- `Footer` berarti menu bawah website.

Catatan penting:

- Halaman dari menu `Page` yang sudah publish otomatis masuk submenu `About`.
- Jika ingin mengatur menu utama seperti Home, About, Events, Gallery, atau Contact, gunakan menu `Navigation`.

## 13. Mengelola Setting Website

Setting dikelola dari menu `Setting`.

Setting dipakai untuk mengubah konten umum tanpa mengedit kode.

Contoh setting:

- logo website
- logo footer
- favicon
- alamat kantor
- email KUI
- nomor telepon
- teks tombol kontak
- teks footer
- konten default beranda
- konten halaman about dan contact

Jenis input setting:

- `text` untuk teks pendek
- `longtext` untuk teks panjang
- `image` untuk gambar
- `list` untuk daftar item

Admin cukup mengisi label dan value. Database key dibuat otomatis oleh sistem.

## 14. Mengelola Inbox

Inbox berisi pesan yang dikirim pengunjung dari halaman contact.

Pesan masuk dari:

```text
/contact
```

Admin dapat membuka menu `Inbox` untuk melihat:

- nama pengirim
- email
- subjek
- pesan
- status sudah dibaca atau belum

Saat admin membuka detail pesan, pesan otomatis ditandai sebagai sudah dibaca.

Form contact memiliki pembatasan pengiriman agar tidak mudah diserang spam.

## 15. Mengelola Media Sosial

Media sosial dikelola dari menu `Social Media`.

Data ini dapat muncul di footer atau halaman contact.

Contoh:

- Instagram
- Facebook
- YouTube
- LinkedIn
- TikTok

Isi field icon menggunakan class icon yang tersedia di sistem.

## 16. Mengelola Relasi atau Link Eksternal

Relasi dikelola dari menu `Relation`.

Menu ini cocok untuk menyimpan link penting seperti:

- website Universitas Juanda
- website kementerian
- portal izin belajar
- portal kerja sama
- link lembaga mitra

Relasi dapat muncul di footer sebagai link eksternal.

## 17. Mengelola User

User dikelola dari menu `Users`.

Admin dapat:

- membuat user baru
- mengubah nama dan email user
- mengganti password
- mengatur status verifikasi email
- memberikan role kepada user
- menghapus user tertentu

User yang sedang login tidak boleh menghapus dirinya sendiri.

## 18. Mengelola Role Dan Permission

Role dan permission mengatur hak akses admin.

Menu terkait:

- `Roles`
- `Permissions`

Contoh konsep:

- Role `super-admin` bisa mengakses semua fitur.
- Role `content-manager` hanya boleh mengelola konten.
- Permission `post.manage` berarti boleh mengakses module post.
- Permission `navigation.manage` berarti boleh mengatur menu.

Jika user tidak bisa membuka sebuah menu, cek role dan permission user tersebut.

## 19. Bahasa Konten

Banyak konten mendukung tiga bahasa:

- Indonesia
- English
- Arabic

Biasanya field memiliki akhiran:

- `_id` untuk Indonesia
- `_en` untuk English
- `_ar` untuk Arabic

Contoh:

- `title_id`
- `title_en`
- `title_ar`

Jika bahasa aktif tidak memiliki konten, sistem biasanya akan memakai versi Indonesia sebagai fallback.

## 20. Upload Gambar Dan File

Beberapa module mendukung upload gambar atau file, misalnya:

- Slider
- Post
- Album
- Gallery
- Team
- Setting logo
- CKEditor image upload
- Announcement file attachment

Pastikan storage public sudah aktif di server agar gambar tampil.

Command teknis yang biasanya dijalankan developer:

```bash
php artisan storage:link
```

## 21. Data Awal Dan Seeder

Aplikasi memiliki data awal untuk membantu setup.

Seeder penting:

- `RolePermissionSeeder` untuk role dan permission.
- `NavigationSeeder` untuk menu default.
- `HomeSettingSeeder` untuk setting default KUI.
- `MarketingPageSeeder` untuk halaman statis default.
- `KuiUnidaDemoSeeder` untuk dummy data local/development.

Jika admin baru setup aplikasi, developer biasanya menjalankan:

```bash
php artisan db:seed
```

## 22. Hal Yang Perlu Diperhatikan Admin

- Pastikan status konten aktif jika ingin ditampilkan di website.
- Gunakan gambar yang ringan agar halaman website tidak lambat.
- Jangan menghapus menu navigasi utama jika belum tahu dampaknya.
- Jangan mengubah database key setting secara manual.
- Jika halaman tidak muncul di website, cek status publish dan navigasi.
- Jika user tidak bisa membuka menu admin, cek role dan permission.
- Jika gambar tidak muncul, hubungi developer untuk cek storage public.

## 23. Ringkasan Menu Admin

| Menu | Fungsi |
| --- | --- |
| Dashboard | Melihat ringkasan dan analitik pengunjung. |
| Category | Mengelola kategori artikel. |
| Posts | Mengelola artikel atau berita. |
| Page | Mengelola halaman statis tambahan. |
| Album | Mengelola album galeri. |
| Gallery | Mengelola foto di dalam album. |
| Video | Mengelola video. |
| Slider | Mengelola hero slider homepage. |
| Lembaga | Mengelola partner atau lembaga terkait. |
| Agenda | Mengelola event atau agenda. |
| Announcement | Mengelola pengumuman resmi. |
| Inbox | Melihat pesan dari pengunjung. |
| Position | Mengelola jabatan team. |
| Team | Mengelola anggota team KUI. |
| Users | Mengelola user admin. |
| Roles | Mengelola role user. |
| Permissions | Mengelola permission. |
| Social Media | Mengelola link media sosial. |
| Setting | Mengelola logo, footer, kontak, dan konten setting. |
| Navigation | Mengelola menu admin dan marketing. |
| Relation | Mengelola link relasi eksternal. |

## 24. Alur Kerja Konten Yang Disarankan

Untuk membuat artikel:

1. Buat kategori jika belum ada.
2. Masuk ke menu `Posts`.
3. Isi judul, gambar, konten, kategori, dan status.
4. Simpan.
5. Cek halaman `/articles`.

Untuk membuat galeri:

1. Buat album di menu `Album`.
2. Tambahkan foto di menu `Gallery`.
3. Pilih album yang sesuai.
4. Simpan.
5. Cek halaman `/gallery`.

Untuk membuat halaman tambahan di About:

1. Masuk ke menu `Page`.
2. Buat halaman baru.
3. Isi judul dan konten.
4. Aktifkan status publish.
5. Simpan.
6. Cek dropdown `About` di navbar website.

Untuk mengubah kontak:

1. Masuk ke menu `Setting`.
2. Cari group yang berkaitan dengan footer atau contact.
3. Ubah alamat, email, telepon, atau teks lain.
4. Klik publish changes.
5. Cek halaman contact dan footer website.

## 25. Penutup

Secara sederhana, aplikasi ini berfungsi sebagai pusat pengelolaan website KUI Unida. Admin mengisi data dari dashboard, lalu website publik akan menampilkan data tersebut sesuai menu dan status konten.

Jika ada tampilan yang tidak berubah setelah data diedit, kemungkinan sistem masih memakai cache. Hubungi developer untuk melakukan clear cache atau pengecekan teknis.
