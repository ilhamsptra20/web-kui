# Panduan Developer Pemula Aplikasi KUI Unida

Dokumen ini dibuat untuk developer yang masih baru belajar Laravel atau belum terlalu familiar dengan struktur aplikasi ini. Tujuannya supaya developer bisa membaca project, tahu file mana yang harus diedit, dan tidak asal mengubah bagian yang berisiko.

## 1. Gambaran Sederhana

Aplikasi ini adalah website KUI Unida dengan dua sisi:

- Sisi publik atau marketing, yaitu halaman yang dilihat pengunjung.
- Sisi admin, yaitu dashboard untuk mengelola data.

Laravel bekerja dengan alur sederhana:

```text
Route -> Controller -> Model/Service -> View
```

Artinya:

- `Route` menentukan URL.
- `Controller` menentukan logic yang dijalankan.
- `Model` mengambil atau menyimpan data dari database.
- `Service` membantu logic yang cukup kompleks atau dipakai berulang.
- `View` menampilkan HTML ke browser.

## 2. Folder Yang Paling Sering Dipakai

```text
routes/web.php
routes/modules/
app/Http/Controllers/
app/Http/Controllers/Marketing/
app/Http/Requests/
app/Models/
app/Services/
app/Support/
resources/views/modules/
resources/views/pages/marketing/
resources/views/components/
database/migrations/
database/seeders/
_dataApp/
```

Kalau bingung mulai dari mana:

- Mau ubah URL atau route: cek `routes/web.php` atau `routes/modules`.
- Mau ubah logic admin: cek `app/Http/Controllers/*Controller.php`.
- Mau ubah logic halaman publik: cek `app/Http/Controllers/Marketing`.
- Mau ubah tampilan admin: cek `resources/views/modules`.
- Mau ubah tampilan website publik: cek `resources/views/pages/marketing`.
- Mau ubah validasi form: cek `app/Http/Requests`.
- Mau ubah struktur tabel: cek `database/migrations`.
- Mau ubah data awal: cek `database/seeders`.

## 3. Route Publik Dan Route Admin

Route publik ada di `routes/web.php`.

Contoh:

```php
Route::get('/about', [AboutController::class, 'index'])->name('about-marketing');
Route::get('/page/{page:slug}', [MarketingPageController::class, 'show'])->name('pages.show-marketing');
```

Route admin dipisah ke folder `routes/modules`.

Contoh `routes/modules/page.php`:

```php
Route::get('pages/list', [PageController::class, 'list'])->name('pages.list');
Route::resource('pages', PageController::class);
```

Jangan langsung menumpuk route admin di `web.php` jika module sudah punya file di `routes/modules`.

## 4. Bedanya Controller Admin Dan Controller Marketing

Controller admin ada langsung di:

```text
app/Http/Controllers/
```

Contoh:

```text
PageController.php
PostController.php
AgendaController.php
NavigationController.php
```

Controller marketing ada di:

```text
app/Http/Controllers/Marketing/
```

Contoh:

```text
MarketingController.php
AboutController.php
PageController.php
TeamController.php
ContactController.php
```

Aturan sederhana:

- Kalau fitur untuk dashboard admin, pakai controller admin.
- Kalau fitur untuk halaman publik, pakai controller marketing.
- Jangan campur logic publik dan admin di satu controller kecuali benar-benar sederhana.

## 5. Cara Membaca Module Admin

Ambil contoh module `Page`.

File yang berkaitan:

```text
app/Models/Page.php
app/Http/Controllers/PageController.php
app/Http/Requests/StorePageRequest.php
app/Http/Requests/UpdatePageRequest.php
routes/modules/page.php
resources/views/modules/page/index.blade.php
resources/views/modules/page/form.blade.php
resources/views/modules/page/fields.blade.php
resources/views/modules/page/show.blade.php
resources/views/modules/page/action.blade.php
_dataApp/page.json
```

Fungsi masing-masing:

- `Page.php` adalah model untuk tabel `pages`.
- `PageController.php` mengatur list, create, store, show, edit, update, delete.
- `StorePageRequest.php` validasi saat membuat data baru.
- `UpdatePageRequest.php` validasi saat mengubah data.
- `routes/modules/page.php` daftar URL admin untuk module Page.
- `index.blade.php` tampilan list data.
- `form.blade.php` tampilan create dan edit.
- `fields.blade.php` kumpulan field form yang bisa dipakai ulang.
- `show.blade.php` tampilan detail readonly.
- `action.blade.php` tombol action di datatable.
- `_dataApp/page.json` schema untuk generator module.

## 6. Cara Membaca Halaman Marketing

Ambil contoh halaman Team.

File yang berkaitan:

```text
app/Http/Controllers/Marketing/TeamController.php
resources/views/pages/marketing/team/index.blade.php
resources/views/pages/marketing/team/show.blade.php
routes/web.php
app/Models/Team.php
```

Alurnya:

1. Pengunjung buka `/team`.
2. Route di `web.php` mengarah ke `Marketing\TeamController@index`.
3. Controller mengambil data dari model `Team`.
4. Controller mengirim data ke view `team/index.blade.php`.
5. Blade menampilkan HTML ke browser.

## 7. Model Dan Database

Model berada di:

```text
app/Models/
```

Migration berada di:

```text
database/migrations/
```

Contoh:

```text
app/Models/Post.php
database/migrations/2026_04_05_102453_create_posts_table.php
```

Model dipakai untuk query data.

Contoh sederhana:

```php
Post::query()->latest()->get();
```

Kalau ada scope di model, bisa dipakai seperti ini:

```php
Post::query()->published()->latest()->get();
```

Scope adalah helper query agar controller lebih bersih.

## 8. Validasi Form

Validasi form admin ada di:

```text
app/Http/Requests/
```

Contoh:

```text
StorePostRequest.php
UpdatePostRequest.php
```

Kalau ingin mengubah rule validasi, ubah file request, bukan langsung di controller.

Contoh rule:

```php
return [
    'title_id' => 'required|string|max:255',
    'content_id' => 'required|string',
    'status' => 'boolean',
];
```

Kenapa validasi dipisah:

- controller jadi lebih rapi
- rule create dan update bisa berbeda
- error validasi Laravel otomatis bekerja

## 9. Blade View

Blade adalah template HTML Laravel.

View admin berada di:

```text
resources/views/modules/
```

View marketing berada di:

```text
resources/views/pages/marketing/
```

Component reusable berada di:

```text
resources/views/components/
```

Contoh component form:

```blade
<x-form.input name="title_id" label="Title ID" :value="$page->title_id ?? ''" required />
```

Contoh CKEditor:

```blade
<x-form.ckeditor name="content_id" label="Content ID" :value="$page->content_id ?? ''" required />
```

Gunakan component jika sudah tersedia. Jangan membuat input HTML manual jika component yang sesuai sudah ada.

## 10. Setting

Setting adalah data konfigurasi yang bisa diedit dari admin tanpa mengubah kode.

File penting:

```text
app/Models/Setting.php
app/Services/SettingService.php
app/Http/Controllers/SettingController.php
resources/views/modules/setting/
```

Contoh penggunaan setting di controller:

```php
$settings = $settingService->only([
    'site_logo' => '/assets/logo/unida.png',
    'footer_email' => 'kui@unida.ac.id',
]);
```

Gunakan setting untuk konten yang sering berubah seperti:

- logo
- alamat
- email
- phone
- teks footer
- copywriting section beranda
- link CTA

Jangan hardcode konten seperti alamat dan email jika sudah ada di Setting.

## 11. Navigation

Navigation mengatur menu admin dan marketing.

File penting:

```text
app/Models/Navigation.php
app/Support/Navigation/NavigationService.php
app/Http/Controllers/NavigationController.php
resources/views/modules/navigation/
```

Navigation dipakai untuk:

- sidebar admin
- navbar marketing
- footer marketing

Jika menu tidak muncul:

1. Cek data di module `Navigation`.
2. Pastikan `area` benar.
3. Pastikan `location` benar.
4. Pastikan status aktif.
5. Clear cache jika perlu.

Page yang publish otomatis masuk submenu `About`.

## 12. Page Marketing

Module `Page` bisa membuat halaman statis tambahan.

URL publik:

```text
/page/{slug}
```

Contoh:

```text
/page/profil-kui-unida
```

File publiknya:

```text
app/Http/Controllers/Marketing/PageController.php
resources/views/pages/marketing/pages/show.blade.php
```

Kalau halaman tidak muncul:

- cek slug
- cek status publish
- cek data Page di admin
- cek cache navigasi

## 13. Inbox Dari Visitor

Visitor mengirim pesan dari halaman Contact.

File penting:

```text
app/Http/Controllers/Marketing/InboxSubmissionController.php
app/Http/Requests/StorePublicInboxRequest.php
app/Http/Controllers/InboxController.php
resources/views/pages/marketing/contact.blade.php
```

Form contact punya rate limit agar tidak mudah spam.

Kalau ingin mengubah validasi pesan pengunjung, edit:

```text
app/Http/Requests/StorePublicInboxRequest.php
```

## 14. CKEditor Dan Rich Text

CKEditor dipakai untuk field konten panjang.

File penting:

```text
resources/views/components/form/ckeditor.blade.php
resources/views/components/editor/ckeditor-scripts.blade.php
app/Http/Controllers/EditorImageController.php
app/Services/EditorImageUploadService.php
app/Support/RichText/RichTextSanitizer.php
```

Aturan penting:

- Jangan simpan HTML dari editor tanpa sanitasi.
- Upload image editor masuk ke storage public.
- Jika gambar tidak tampil, cek `php artisan storage:link`.

## 15. Visitor Analytics

Visitor analytics mencatat pengunjung website publik.

File penting:

```text
app/Http/Middleware/TrackVisitorAnalytics.php
app/Support/Visitors/VisitorTracker.php
app/Support/Visitors/VisitorAnalyticsService.php
app/Support/Visitors/UserAgentParser.php
app/Models/VisitorVisit.php
```

Yang dicatat:

- browser
- OS
- device
- bot atau bukan
- page views
- unique visitor harian

Kalau angka visitor tidak naik:

- cek apakah user sedang login admin
- cek apakah test memakai browser yang sama
- cek apakah yang naik adalah page views, bukan unique visitor

## 16. Generator `_dataApp`

Folder `_dataApp` berisi file JSON yang dipakai generator module.

Contoh:

```text
_dataApp/post.json
_dataApp/page.json
_dataApp/team.json
```

Command:

```bash
php artisan make:module NamaModule --json=nama_file.json
```

Generator bisa membuat:

- model
- controller
- request validation
- migration
- route
- view index
- view form
- view show

Developer pemula harus tetap cek hasil generator. Jangan langsung percaya 100 persen.

Yang harus dicek setelah generate:

- nama tabel benar
- field migration benar
- nullable atau required sesuai kebutuhan
- relation benar
- route masuk ke permission yang tepat
- view form sudah enak dipakai
- index datatable menampilkan kolom yang berguna

## 17. Seeder

Seeder mengisi data awal.

File penting:

```text
database/seeders/DatabaseSeeder.php
database/seeders/RolePermissionSeeder.php
database/seeders/NavigationSeeder.php
database/seeders/HomeSettingSeeder.php
database/seeders/MarketingPageSeeder.php
database/seeders/KuiUnidaDemoSeeder.php
```

Command:

```bash
php artisan db:seed
```

Seeder khusus:

```bash
php artisan db:seed --class=MarketingPageSeeder
php artisan db:seed --class=NavigationSeeder
php artisan db:seed --class=HomeSettingSeeder
```

Bedanya `firstOrCreate` dan `updateOrCreate`:

- `firstOrCreate` hanya membuat data jika belum ada.
- `updateOrCreate` membuat atau mengubah data jika sudah ada.

Untuk data penting yang tidak boleh menimpa edit admin, lebih aman pakai `firstOrCreate`.

## 18. Cara Aman Mengubah Fitur

Gunakan urutan ini:

1. Cari route.
2. Cari controller.
3. Cari model yang dipakai.
4. Cari view yang dirender.
5. Cari request validation jika ada form.
6. Ubah bagian yang memang diperlukan.
7. Jalankan test atau minimal compile view.

Command pengecekan:

```bash
php artisan route:list
php artisan view:cache
php artisan test
```

Jika hanya edit satu file PHP:

```bash
php -l path/file.php
```

## 19. Contoh: Menambah Halaman Marketing Baru

Misalnya ingin membuat halaman `Scholarship`.

Langkah umum:

1. Buat controller:

```text
app/Http/Controllers/Marketing/ScholarshipController.php
```

2. Buat view:

```text
resources/views/pages/marketing/scholarship.blade.php
```

3. Tambahkan route di `routes/web.php` dalam group `track.visitors`:

```php
Route::get('/scholarship', [ScholarshipController::class, 'index'])->name('scholarship-marketing');
```

4. Jika perlu menu, tambahkan lewat module `Navigation`.

## 20. Contoh: Menambah Field Baru Di Module

Misalnya ingin menambah field `subtitle_id` ke module `Post`.

Langkah aman:

1. Buat migration baru untuk menambah kolom.
2. Tambahkan field ke `$fillable` di model `Post`.
3. Tambahkan rule validasi di `StorePostRequest` dan `UpdatePostRequest`.
4. Tambahkan input di `resources/views/modules/post/fields.blade.php`.
5. Tambahkan kolom di index jika perlu.
6. Jalankan `php artisan migrate`.
7. Test create dan edit dari admin.

Jangan langsung edit migration lama jika migration itu sudah pernah dijalankan di laptop/server lain.

## 21. Kesalahan Umum Developer Pemula

Hindari ini:

- Mengubah route admin langsung di `web.php` padahal module punya file sendiri.
- Menulis query database langsung di Blade.
- Menghapus file yang tidak dipahami.
- Mengubah migration lama yang sudah terlanjur jalan di database lain.
- Membuat validasi langsung di controller padahal sudah ada Form Request.
- Render `{!! $content !!}` tanpa sanitasi.
- Menaruh logic berat di view.
- Menyimpan konten konfigurasi di kode padahal harusnya di Setting.
- Mengubah permission tanpa cek role admin.
- Commit file cache atau file temporary.

## 22. Cara Debug Sederhana

Jika route tidak ketemu:

```bash
php artisan route:list
```

Jika view error:

```bash
php artisan view:clear
php artisan view:cache
```

Jika perubahan setting/navigasi tidak muncul:

```bash
php artisan cache:clear
```

Jika gambar upload tidak tampil:

```bash
php artisan storage:link
```

Jika npm build gagal:

- cek versi Node
- gunakan Node `20.19+` atau `22.12+`
- hapus `node_modules`
- install ulang dependency

```bash
npm install
npm run build
```

## 23. Git Workflow Sederhana

Sebelum mulai kerja:

```bash
git status
git pull
```

Setelah mengubah file:

```bash
git status
git diff
```

Sebelum commit:

```bash
php artisan view:cache
php artisan test
```

Commit:

```bash
git add file-yang-diubah
git commit -m "pesan commit"
git push
```

Jangan commit file yang tidak sengaja berubah.

## 24. Checklist Sebelum Bilang Selesai

Gunakan checklist ini:

- Route sudah benar.
- Controller tidak error.
- View tampil rapi.
- Form validation bekerja.
- Data tersimpan ke database.
- Data tampil di halaman publik jika memang perlu.
- Permission admin sesuai.
- Tidak ada error di console browser.
- `php artisan view:cache` sukses.
- `php artisan test` sudah dicoba.
- Git status sudah dicek.

## 25. Penutup

Kalau masih bingung, mulai dari route. Setelah tahu route mengarah ke controller mana, biasanya alur project akan lebih mudah dibaca.

Pegang prinsip sederhana:

- Route untuk alamat.
- Controller untuk alur.
- Model untuk data.
- Request untuk validasi.
- Service untuk logic tambahan.
- View untuk tampilan.
- Seeder untuk data awal.
- Setting untuk konten yang harus bisa diedit admin.
- Navigation untuk menu.
