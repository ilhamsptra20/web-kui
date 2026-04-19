# Dokumentasi Struktur Aplikasi KUI Unida

Dokumen ini menjelaskan struktur aplikasi Laravel KUI Unida, pola module admin, halaman marketing, generator `_dataApp`, seeder, navigation, setting, dan konvensi penempatan file.

## 1. Ringkasan Aplikasi

Aplikasi ini adalah website dan admin panel untuk KUI Unida, Kantor Urusan Internasional Universitas Juanda.

Fungsi utama aplikasi:

- Website marketing publik untuk menampilkan profil KUI, agenda, pengumuman, artikel, galeri album, team, halaman statis, dan kontak.
- Admin panel untuk mengelola konten, navigasi, setting, user, role, permission, inbox, dan data pendukung.
- Module scaffolder custom berbasis JSON di folder `_dataApp`.
- Sistem navigasi dinamis berbasis database untuk admin sidebar, marketing navbar, dan marketing footer.
- Setting builder berbasis database untuk konten konfiguratif seperti logo, footer, contact, dan section homepage.
- Visitor analytics untuk mencatat kunjungan guest berdasarkan browser, OS, device, bot, page view, dan unique visitor harian.

## 2. Struktur Folder Utama

```text
app/
  Console/Commands/
  Http/Controllers/
  Http/Controllers/Marketing/
  Http/Requests/
  Http/Middleware/
  Models/
  Providers/
  Services/
  Support/
  Traits/

routes/
  web.php
  modules/

resources/views/
  components/
  components/form/
  components/layout/
  modules/
  pages/marketing/

database/
  migrations/
  seeders/

config/
  navigator.php
  editor.php
  feather-icons.php

_dataApp/

public/assets/

docs/
```

## 3. Alur Request Aplikasi

### Public Marketing

Entry point route marketing ada di `routes/web.php` dalam group middleware `track.visitors`.

Contoh route marketing:

```text
/                     -> MarketingController@index
/about                -> Marketing/AboutController@index
/page/{page:slug}     -> Marketing/PageController@show
/team                 -> Marketing/TeamController@index
/team/{team:slug}     -> Marketing/TeamController@show
/contact              -> Marketing/ContactController@index
/contact/inbox        -> Marketing/InboxSubmissionController@store
/articles             -> Marketing/ArticleController@index
/events               -> Marketing/EventController@index
/announcement         -> Marketing/AnnouncementController@index
/gallery              -> Marketing/GalleryController@index
/gallery/{album:slug} -> Marketing/GalleryController@show
```

### Admin Panel

Admin route berada di `routes/modules/*.php`, lalu diregistrasi dari `routes/web.php` dalam group:

```php
Route::middleware('auth')->group(function () {
    $registerModuleRoutes('page.manage', __DIR__.'/modules/page.php');
});
```

Setiap module admin umumnya dilindungi permission seperti `post.manage`, `page.manage`, `navigation.manage`, dan seterusnya.

## 4. Pola File Module Admin

Mayoritas module mengikuti pola file berikut:

```text
app/Models/ModuleName.php
app/Http/Controllers/ModuleNameController.php
app/Http/Requests/StoreModuleNameRequest.php
app/Http/Requests/UpdateModuleNameRequest.php
routes/modules/module_name.php
resources/views/modules/module_name/index.blade.php
resources/views/modules/module_name/form.blade.php
resources/views/modules/module_name/fields.blade.php
resources/views/modules/module_name/show.blade.php
resources/views/modules/module_name/action.blade.php
database/migrations/*_create_module_names_table.php
_dataApp/module_name.json
```

Konvensi penting:

- `index.blade.php` menampilkan datatable admin.
- `list()` di controller menyediakan response JSON untuk datatable.
- `form.blade.php` dipakai create dan edit.
- `fields.blade.php` dipakai ulang oleh form dan show mode.
- `show.blade.php` tidak membuat form submit; show hanya memakai field readonly/disabled.
- Request validation ditempatkan di `Store*Request` dan `Update*Request`.
- Model domain berada di `app/Models`.
- Route CRUD module dipisah di `routes/modules`.
- Schema generator module disimpan di `_dataApp`.

## 5. Daftar Module Admin

| Module | Model | Controller | Route | View | Kegunaan |
| --- | --- | --- | --- | --- | --- |
| Agenda | `Agenda` | `AgendaController` | `routes/modules/agenda.php` | `resources/views/modules/agenda` | Mengelola agenda/event KUI. Data ini tampil di marketing `/events`. |
| Album | `Album` | `AlbumController` | `routes/modules/album.php` | `resources/views/modules/album` | Mengelola album galeri. Data album tampil di marketing `/gallery`. |
| Announcement | `Announcement` | `AnnouncementController` | `routes/modules/announcement.php` | `resources/views/modules/announcement` | Mengelola pengumuman resmi KUI. Data tampil di `/announcement`. |
| Category | `Category` | `CategoryController` | `routes/modules/category.php` | `resources/views/modules/category` | Mengelola kategori artikel/post. |
| Gallery | `Gallery` | `GalleryController` | `routes/modules/gallery.php` | `resources/views/modules/gallery` | Mengelola item foto galeri berdasarkan `album_id`. |
| Inbox | `Inbox` | `InboxController` | `routes/modules/inbox.php` | `resources/views/modules/inbox` | Mengelola pesan masuk dari visitor melalui halaman contact. |
| Lembaga | `Lembaga` | `LembagaController` | `routes/modules/lembaga.php` | `resources/views/modules/lembaga` | Mengelola data mitra/lembaga/partner. |
| Navigation | `Navigation` | `NavigationController` | `routes/modules/navigation.php` | `resources/views/modules/navigation` | Mengelola menu admin, navbar marketing, dan footer marketing. |
| Page | `Page` | `PageController` | `routes/modules/page.php` | `resources/views/modules/page` | Mengelola halaman statis. Page yang published tampil di marketing `/page/{slug}` dan submenu About. |
| Permission | `Permission` | `PermissionController` | `routes/modules/permission.php` | `resources/views/modules/permission` | Mengelola permission RBAC. |
| Position | `Position` | `PositionController` | `routes/modules/position.php` | `resources/views/modules/position` | Mengelola posisi/jabatan team. |
| Post | `Post` | `PostController` | `routes/modules/post.php` | `resources/views/modules/post` | Mengelola artikel/post KUI. Data tampil di marketing `/articles`. |
| Relation | `Relation` | `RelationController` | `routes/modules/relation.php` | `resources/views/modules/relation` | Mengelola link relasi eksternal di footer. |
| Role | `Role` | `RoleController` | `routes/modules/role.php` | `resources/views/modules/role` | Mengelola role admin dan relasi permission. |
| Setting | `Setting` | `SettingController` | `routes/modules/setting.php` | `resources/views/modules/setting` | Mengelola setting berbasis group, label, key, type, dan value. |
| Slider | `Slider` | `SliderController` | `routes/modules/slider.php` | `resources/views/modules/slider` | Mengelola hero slider homepage. |
| Social Media | `SocialMedia` | `SocialMediaController` | `routes/modules/social_media.php` | `resources/views/modules/social_media` | Mengelola link media sosial marketing/footer. |
| Team | `Team` | `TeamController` | `routes/modules/team.php` | `resources/views/modules/team` | Mengelola team KUI. Data tampil di marketing `/team`. |
| User | `User` | `UserController` | `routes/modules/user.php` | `resources/views/modules/user` | Mengelola user admin, role, password, dan status verifikasi email. |
| Video | `Video` | `VideoController` | `routes/modules/video.php` | `resources/views/modules/video` | Mengelola video KUI. |

## 6. Module Marketing

Marketing controller berada di:

```text
app/Http/Controllers/Marketing/
```

Marketing view berada di:

```text
resources/views/pages/marketing/
```

Daftar halaman marketing utama:

| Halaman | Controller | View | Keterangan |
| --- | --- | --- | --- |
| Home | `MarketingController@index` | `index.blade.php` | Landing page utama, mengambil slider, artikel, galeri, setting, dan fallback KUI. |
| About | `AboutController@index` | `about.blade.php` | Profil KUI, intro, visi misi, statistik, partner, preview team. |
| Page Detail | `PageController@show` | `pages/show.blade.php` | Render halaman statis dari module Page di URL `/page/{slug}`. |
| Team | `TeamController@index` | `team/index.blade.php` | Daftar team KUI. |
| Team Detail | `TeamController@show` | `team/show.blade.php` | Detail anggota team. |
| Contact | `ContactController@index` | `contact.blade.php` | Info kontak, social link, map, dan form inbox visitor. |
| Articles | `ArticleController@index` | `articles/index.blade.php` | Daftar artikel/post. |
| Article Detail | `ArticleController@show` | `articles/show.blade.php` | Detail artikel. |
| Events | `EventController@index` | `events/index.blade.php` | Daftar agenda/event. |
| Event Detail | `EventController@show` | `events/show.blade.php` | Detail agenda/event. |
| Announcements | `AnnouncementController@index` | `announcements/index.blade.php` | Daftar pengumuman. |
| Announcement Detail | `AnnouncementController@show` | `announcements/show.blade.php` | Detail pengumuman. |
| Gallery Album | `GalleryController@index` | `gallery.blade.php` | Daftar album galeri. |
| Gallery Detail | `GalleryController@show` | `gallery-show.blade.php` | Daftar foto berdasarkan album. |

## 7. Navigation System

Navigasi dikelola dari tabel `navigations` dan service:

```text
app/Support/Navigation/NavigationService.php
app/Models/Navigation.php
resources/views/components/layout/sidebar.blade.php
resources/views/components/layout/marketing/navbar.blade.php
resources/views/components/layout/marketing/footer.blade.php
```

Area navigasi:

- `admin` untuk sidebar admin.
- `marketing` untuk navbar/footer publik.

Location navigasi:

- `sidebar` untuk admin.
- `navbar` untuk marketing navbar.
- `footer` untuk marketing footer.

Rule penting:

- Admin hanya memakai `sidebar`.
- Marketing memakai `navbar` dan `footer`.
- Page yang `published` otomatis diinjeksi sebagai submenu About oleh `NavigationService`.
- Cache navigasi dibersihkan saat `Navigation` atau `Page` disimpan/dihapus.
- Default fallback navigasi ada di `config/navigator.php`.
- Seeder default navigasi ada di `database/seeders/NavigationSeeder.php`.

## 8. Setting System

Setting dikelola di module `Setting`.

Struktur tabel setting:

```text
id
group
label
key
type
value
```

Tipe setting:

- `text`
- `longtext`
- `image`
- `list`

File penting:

```text
app/Models/Setting.php
app/Services/SettingService.php
app/Http/Controllers/SettingController.php
app/Http/Requests/SaveSettingGroupRequest.php
resources/views/modules/setting/
database/seeders/HomeSettingSeeder.php
```

Aturan penting:

- User cukup isi `label`, key dibuat otomatis dalam format `snake_case`.
- Untuk setting baru, service membuat key unik.
- Untuk setting lama, key dipertahankan agar referensi tidak patah.
- Setting marketing dipakai untuk logo, favicon, CTA, footer, contact, about, home, team, gallery, dan section lain.
- Setting image mendukung path storage dan path public seperti `/assets/logo/unida.png`.

## 9. RBAC: Role Dan Permission

RBAC memakai tabel terpisah:

```text
roles
permissions
permission_role
role_user
```

File penting:

```text
app/Models/Role.php
app/Models/Permission.php
app/Models/User.php
app/Http/Controllers/RoleController.php
app/Http/Controllers/PermissionController.php
database/seeders/RolePermissionSeeder.php
```

Route module admin diregistrasi dengan permission:

```php
$registerModuleRoutes('post.manage', __DIR__.'/modules/post.php');
```

User admin harus punya role/permission agar bisa mengakses module.

## 10. Inbox Visitor

Visitor mengirim pesan dari halaman contact.

File penting:

```text
app/Http/Controllers/Marketing/InboxSubmissionController.php
app/Http/Requests/StorePublicInboxRequest.php
app/Http/Controllers/InboxController.php
app/Models/Inbox.php
resources/views/pages/marketing/contact.blade.php
```

Proteksi:

- Rate limit `3 request/menit` per IP.
- Rate limit `12 request/jam` per IP dan email.
- Honeypot field `website`.
- Admin membuka detail inbox akan menandai pesan sebagai read.

Limiter didaftarkan di:

```text
app/Providers/AppServiceProvider.php
```

## 11. Visitor Analytics

Tracking guest dilakukan oleh middleware dan service visitor.

File penting:

```text
app/Http/Middleware/TrackVisitorAnalytics.php
app/Models/VisitorVisit.php
app/Support/Visitors/VisitorTracker.php
app/Support/Visitors/UserAgentParser.php
app/Support/Visitors/VisitorAnalyticsService.php
database/migrations/2026_04_05_102455_create_visitor_visits_table.php
```

Data yang dicatat:

- `visitor_key`
- `session_id`
- `route_name`
- `first_path`
- `last_path`
- `browser_name`
- `browser_version`
- `os_name`
- `os_version`
- `device_type`
- `is_bot`
- `page_views`
- `visited_on`
- `first_visited_at`
- `last_visited_at`

Catatan:

- Satu visitor dihitung unik per hari berdasarkan `visitor_key` dan `visited_on`.
- Refresh page menaikkan `page_views`, bukan unique visitor.
- User yang sedang login admin tidak dihitung sebagai visitor publik.

## 12. Rich Text Editor

Editor rich text memakai CKEditor berbasis CDN.

File penting:

```text
resources/views/components/form/ckeditor.blade.php
resources/views/components/editor/ckeditor-scripts.blade.php
resources/views/components/editor/ckeditor-styles.blade.php
app/Http/Controllers/EditorImageController.php
app/Http/Requests/UploadEditorImageRequest.php
app/Services/EditorImageUploadService.php
app/Support/RichText/RichTextSanitizer.php
config/editor.php
```

Cara pakai di form:

```blade
<x-form.ckeditor
    name="content_id"
    label="Content ID"
    :value="$page->content_id ?? ''"
    required
/>
```

Aturan:

- Upload image editor memakai route `editor-images.store`.
- Konten rich text disanitasi sebelum disimpan.
- Untuk show page, render konten yang sudah disanitasi.
- Path upload image lokal dikembalikan sebagai `/storage/...` agar aman dari mismatch `localhost` vs `127.0.0.1`.

## 13. Module Generator `_dataApp`

Folder `_dataApp` berisi schema JSON untuk generator:

```text
_dataApp/agenda.json
_dataApp/album.json
_dataApp/announcement.json
_dataApp/category.json
_dataApp/gallery.json
_dataApp/inbox.json
_dataApp/lembaga.json
_dataApp/navigation.json
_dataApp/page.json
_dataApp/permission.json
_dataApp/position.json
_dataApp/post.json
_dataApp/relation.json
_dataApp/role.json
_dataApp/setting.json
_dataApp/slider.json
_dataApp/social_media.json
_dataApp/team.json
_dataApp/user.json
_dataApp/video.json
```

Command generator:

```bash
php artisan make:module ModuleName --json=file.json
```

Contoh:

```bash
php artisan make:module Page --json=page.json
```

Generator membuat:

- model
- controller
- form request
- migration
- route module
- index view
- form view
- fields partial
- show view
- action partial

Aturan field penting:

- `type: "richtext"` atau `style: "ckeditor"` menghasilkan `<x-form.ckeditor>`.
- Field relation memakai resolver generator untuk select relation.
- Module route otomatis diregistrasi ke group `auth` dan permission di `routes/web.php`.
- Show view memakai shared fields readonly, bukan markup detail duplikat.

## 14. Seeder

Seeder utama:

```text
database/seeders/DatabaseSeeder.php
database/seeders/RolePermissionSeeder.php
database/seeders/NavigationSeeder.php
database/seeders/HomeSettingSeeder.php
database/seeders/MarketingPageSeeder.php
database/seeders/KuiUnidaDemoSeeder.php
```

Kegunaan:

- `RolePermissionSeeder` membuat role dan permission dasar.
- `NavigationSeeder` membuat menu default dari `config/navigator.php`.
- `HomeSettingSeeder` membuat default setting KUI.
- `MarketingPageSeeder` membuat halaman statis marketing yang muncul di submenu About.
- `KuiUnidaDemoSeeder` mengisi dummy content KUI untuk local/development.

Command umum:

```bash
php artisan db:seed
php artisan db:seed --class=MarketingPageSeeder
php artisan db:seed --class=NavigationSeeder
php artisan db:seed --class=HomeSettingSeeder
```

## 15. Konvensi Menambah Module Baru

Langkah realistis:

1. Buat schema di `_dataApp/module.json`.
2. Jalankan `php artisan make:module ModuleName --json=module.json`.
3. Cek migration dan pastikan tipe field, foreign key, index, dan nullable sudah benar.
4. Jalankan `php artisan migrate`.
5. Tambahkan permission di seeder RBAC jika module baru butuh proteksi.
6. Tambahkan menu lewat module Navigation atau fallback `config/navigator.php`.
7. Cek index datatable dan sesuaikan kolom agar tidak hanya menampilkan nama.
8. Jalankan `php artisan view:cache`.
9. Jalankan `php artisan test`.

Jangan dilakukan:

- Jangan membuat route admin langsung di `web.php` kalau module punya file route sendiri.
- Jangan menaruh query marketing besar langsung di Blade.
- Jangan render HTML rich text yang belum disanitasi.
- Jangan membuat repository pattern global jika logic masih cukup di model, controller, request, service, atau support class.
- Jangan menghapus cache navigasi manual dari banyak tempat; gunakan `NavigationService::clearCache()`.

## 16. Konvensi Marketing Page

Untuk membuat halaman marketing baru:

```text
app/Http/Controllers/Marketing/NewPageController.php
resources/views/pages/marketing/new-page.blade.php
routes/web.php
```

Jika halaman memakai data admin:

- Query data di controller marketing.
- Gunakan scope model seperti `published()` atau `active()` jika ada.
- Buat fallback empty state yang rapi di Blade.
- Gunakan setting dari `SettingService` bila copywriting/asset perlu bisa diedit admin.
- Jangan hardcode konten jangka panjang jika konten seharusnya dikelola admin.

## 17. Konvensi Form Dan Component

Komponen form reusable berada di:

```text
resources/views/components/form/
```

Contoh komponen yang dipakai:

- `x-form.input`
- `x-form.textarea`
- `x-form.select`
- `x-form.switch`
- `x-form.ckeditor`
- `x-form.photo-upload`
- `x-form.feather-icon-select`

Aturan:

- Form create/edit memakai component agar konsisten.
- Show mode memakai field readonly/disabled.
- CKEditor show mode tidak menampilkan toolbar.
- Upload file harus melalui request validation dan service jika logic mulai kompleks.

## 18. File Pendukung Penting

| File | Kegunaan |
| --- | --- |
| `app/Support/Admin/AdminTable.php` | Helper HTML untuk kolom datatable admin. |
| `app/Support/Navigation/NavigationService.php` | Resolver admin sidebar, marketing navbar, dan footer. |
| `app/Services/SettingService.php` | Resolver dan normalizer setting. |
| `app/Support/RichText/RichTextSanitizer.php` | Sanitasi HTML rich text. |
| `app/Support/Visitors/VisitorTracker.php` | Tracking visitor guest. |
| `app/Support/Visitors/VisitorAnalyticsService.php` | Agregasi visitor analytics dashboard. |
| `app/Traits/HasTranslation.php` | Helper field multilingual seperti `title_id`, `title_en`, `title_ar`. |
| `config/navigator.php` | Fallback default navigasi admin dan marketing. |
| `config/feather-icons.php` | Source option icon Feather untuk Navigation module. |
| `config/editor.php` | Konfigurasi CKEditor. |

## 19. Setup Dan Perintah Rutin

Setup dasar:

```bash
composer install
npm install
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
npm run build
```

Perintah development:

```bash
php artisan serve
npm run dev
```

Perintah verifikasi:

```bash
php artisan view:cache
php artisan route:list
php artisan test
```

Catatan Node.js:

- Frontend memakai Vite 7.
- Node minimal mengikuti `package.json`, `.nvmrc`, dan `.node-version`.
- Gunakan Node `20.19+` atau `22.12+`.

## 20. Catatan Maintenance

- Module admin baru sebaiknya mengikuti pola CRUD yang sudah ada.
- Marketing route publik sebaiknya tetap di group `track.visitors`.
- Navigation yang berubah harus clear cache.
- Page published otomatis masuk submenu About.
- Setting digunakan untuk konten konfiguratif agar tidak hardcoded.
- Seeder default tidak boleh merusak data custom admin.
- Gunakan `firstOrCreate` untuk default content yang tidak boleh overwrite.
- Gunakan `updateOrCreate` hanya untuk demo/local content yang boleh disinkronkan ulang.
- Hindari menyimpan file template vendor yang tidak dipakai di `resources/views`.
