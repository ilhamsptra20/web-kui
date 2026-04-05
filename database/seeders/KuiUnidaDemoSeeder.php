<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\Album;
use App\Models\Announcement;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Lembaga;
use App\Models\Page;
use App\Models\Position;
use App\Models\Post;
use App\Models\Slider;
use App\Models\SocialMedia;
use App\Models\Team;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class KuiUnidaDemoSeeder extends Seeder
{
    public function run(): void
    {
        if (! $this->requiredTablesExist()) {
            return;
        }

        $adminUser = User::query()->where('email', 'admin@email.com')->first() ?? User::query()->oldest('id')->first();

        $this->seedSocialMedia();
        $categories = $this->seedCategories();
        $this->seedSliders();
        $this->seedAnnouncements();
        $this->seedAgendas();
        $albums = $this->seedAlbums();
        $this->seedGalleries($albums);
        $this->seedPartners();
        $positions = $this->seedPositions();
        $this->seedTeams($positions);
        $this->seedPosts($categories, $adminUser);
        $this->seedPages($adminUser);
        $this->seedVideos();
    }

    private function requiredTablesExist(): bool
    {
        foreach ([
            'users',
            'social_media',
            'categories',
            'sliders',
            'announcements',
            'agendas',
            'albums',
            'galleries',
            'lembagas',
            'positions',
            'teams',
            'posts',
            'pages',
            'videos',
        ] as $table) {
            if (! Schema::hasTable($table)) {
                return false;
            }
        }

        return true;
    }

    private function seedSocialMedia(): void
    {
        $items = [
            ['name' => 'Instagram', 'icon' => 'ri-instagram-line', 'link' => 'https://instagram.com/kui.unida'],
            ['name' => 'Facebook', 'icon' => 'ri-facebook-fill', 'link' => 'https://facebook.com/kui.unida'],
            ['name' => 'YouTube', 'icon' => 'ri-youtube-fill', 'link' => 'https://youtube.com/@kuiunida'],
            ['name' => 'LinkedIn', 'icon' => 'ri-linkedin-fill', 'link' => 'https://linkedin.com/company/kui-unida'],
            ['name' => 'TikTok', 'icon' => 'ri-tiktok-fill', 'link' => 'https://tiktok.com/@kui.unida'],
        ];

        foreach ($items as $item) {
            SocialMedia::query()->updateOrCreate(
                ['name' => $item['name']],
                $item
            );
        }
    }

    private function seedCategories(): array
    {
        $items = [
            [
                'title_id' => 'Program Internasional',
                'title_en' => 'International Programs',
                'title_ar' => 'البرامج الدولية',
            ],
            [
                'title_id' => 'Kemitraan Global',
                'title_en' => 'Global Partnerships',
                'title_ar' => 'الشراكات العالمية',
            ],
            [
                'title_id' => 'Mahasiswa Internasional',
                'title_en' => 'International Students',
                'title_ar' => 'الطلاب الدوليون',
            ],
        ];

        $categories = [];

        foreach ($items as $item) {
            $category = Category::query()->updateOrCreate(
                ['title_id' => $item['title_id']],
                $item
            );

            $categories[$item['title_id']] = $category;
        }

        return $categories;
    }

    private function seedSliders(): void
    {
        $slides = [
            [
                'order' => 1,
                'subtitle_id' => 'KUI UNIVERSITAS JUANDA',
                'subtitle_en' => 'INTERNATIONAL OFFICE OF UNIVERSITAS JUANDA',
                'subtitle_ar' => 'مكتب الشؤون الدولية بجامعة جواندا',
                'title_id' => 'Membangun <span class="text_primary">Kolaborasi Global</span> Untuk Kampus Yang Lebih Terhubung',
                'title_en' => 'Building <span class="text_primary">Global Collaboration</span> For A More Connected Campus',
                'title_ar' => 'نبني <span class="text_primary">شراكات عالمية</span> لحرم جامعي أكثر ترابطًا',
                'description_id' => 'KUI Unida menghubungkan mahasiswa, dosen, dan mitra strategis melalui kerja sama internasional, mobilitas akademik, dan program global yang berdampak.',
                'description_en' => 'KUI Unida connects students, lecturers, and strategic partners through international collaboration, academic mobility, and impactful global programs.',
                'description_ar' => 'يربط مكتب الشؤون الدولية بجامعة جواندا بين الطلاب والمحاضرين والشركاء الاستراتيجيين عبر التعاون الدولي وبرامج التنقل الأكاديمي.',
                'btn_text_id' => 'Jelajahi Profil KUI',
                'btn_text_en' => 'Explore The International Office',
                'btn_text_ar' => 'استكشف المكتب الدولي',
                'btn_url' => '/about',
                'image' => $this->copyDemoAsset('assets/images/banner/banner-1.jpg', 'demo/kui-unida/sliders/slider-global-collaboration.jpg'),
            ],
            [
                'order' => 2,
                'subtitle_id' => 'PROGRAM MOBILITAS',
                'subtitle_en' => 'MOBILITY PROGRAMS',
                'subtitle_ar' => 'برامج التنقل',
                'title_id' => 'Membuka Jalan Untuk <span class="text_primary">Pertukaran Akademik</span> Dan Pengalaman Internasional',
                'title_en' => 'Opening The Way For <span class="text_primary">Academic Exchange</span> And International Experience',
                'title_ar' => 'فتح الطريق نحو <span class="text_primary">التبادل الأكاديمي</span> والخبرة الدولية',
                'description_id' => 'KUI Unida mendukung mahasiswa dan dosen dalam program inbound, outbound, short course, dan kunjungan akademik lintas negara.',
                'description_en' => 'KUI Unida supports students and lecturers through inbound, outbound, short course, and cross-border academic visit programs.',
                'description_ar' => 'يدعم مكتب الشؤون الدولية الطلاب والمحاضرين من خلال برامج التبادل والزيارات الأكاديمية والدورات القصيرة.',
                'btn_text_id' => 'Lihat Program',
                'btn_text_en' => 'View Programs',
                'btn_text_ar' => 'عرض البرامج',
                'btn_url' => '/articles',
                'image' => $this->copyDemoAsset('assets/images/banner/banner-5.jpg', 'demo/kui-unida/sliders/slider-mobility-programs.jpg'),
            ],
            [
                'order' => 3,
                'subtitle_id' => 'JEJARING INTERNASIONAL',
                'subtitle_en' => 'INTERNATIONAL NETWORK',
                'subtitle_ar' => 'الشبكة الدولية',
                'title_id' => 'Memperkuat <span class="text_primary">Reputasi Global</span> Universitas Juanda Secara Bertahap',
                'title_en' => 'Strengthening <span class="text_primary">Global Reputation</span> Of Universitas Juanda Step By Step',
                'title_ar' => 'تعزيز <span class="text_primary">السمعة العالمية</span> لجامعة جواندا تدريجيًا',
                'description_id' => 'Melalui kemitraan, promosi internasional, dan layanan terpadu, KUI Unida membantu universitas tampil lebih siap di level global.',
                'description_en' => 'Through partnerships, international promotion, and integrated services, KUI Unida helps the university become more visible globally.',
                'description_ar' => 'من خلال الشراكات والترويج الدولي والخدمات المتكاملة، يساعد المكتب الدولي الجامعة على الظهور عالميًا.',
                'btn_text_id' => 'Hubungi KUI',
                'btn_text_en' => 'Contact KUI',
                'btn_text_ar' => 'تواصل مع المكتب الدولي',
                'btn_url' => '/contact',
                'image' => $this->copyDemoAsset('assets/images/banner/banner-9.jpg', 'demo/kui-unida/sliders/slider-global-reputation.jpg'),
            ],
        ];

        foreach ($slides as $slide) {
            Slider::query()->updateOrCreate(
                ['order' => $slide['order']],
                $slide
            );
        }
    }

    private function seedAnnouncements(): void
    {
        $announcements = [
            [
                'title_id' => 'Pendaftaran Program Student Mobility Asia 2026 Dibuka',
                'title_en' => 'Registration For Student Mobility Asia 2026 Is Open',
                'title_ar' => 'تم فتح التسجيل لبرنامج التنقل الطلابي في آسيا 2026',
                'content_id' => 'KUI Universitas Juanda membuka pendaftaran bagi mahasiswa yang ingin mengikuti program student mobility ke universitas mitra di Asia. Program ini ditujukan untuk memperluas wawasan akademik dan pengalaman lintas budaya.',
                'content_en' => 'The International Office opens registration for students interested in joining a student mobility program at partner universities across Asia.',
                'content_ar' => 'يفتح المكتب الدولي باب التسجيل للطلاب الراغبين في الانضمام إلى برنامج التنقل الطلابي في الجامعات الشريكة في آسيا.',
                'file_path' => null,
                'is_active' => true,
            ],
            [
                'title_id' => 'Sosialisasi Beasiswa Mitra Internasional Pekan Depan',
                'title_en' => 'International Partner Scholarship Briefing Next Week',
                'title_ar' => 'لقاء تعريفي بمنح الشركاء الدوليين الأسبوع القادم',
                'content_id' => 'Mahasiswa dan dosen diundang mengikuti sosialisasi peluang beasiswa dari mitra internasional Universitas Juanda. Informasi mencakup persyaratan, alur seleksi, dan jadwal pendaftaran.',
                'content_en' => 'Students and lecturers are invited to attend a scholarship briefing session featuring opportunities from Universitas Juanda international partners.',
                'content_ar' => 'يُدعى الطلاب والمحاضرون لحضور لقاء تعريفي بفرص المنح من الشركاء الدوليين لجامعة جواندا.',
                'file_path' => null,
                'is_active' => true,
            ],
            [
                'title_id' => 'Layanan Dokumen Akademik Internasional Diperbarui',
                'title_en' => 'International Academic Document Service Updated',
                'title_ar' => 'تم تحديث خدمة الوثائق الأكاديمية الدولية',
                'content_id' => 'KUI Unida memperbarui alur layanan dokumen akademik internasional untuk mempercepat proses legalisasi, endorsement, dan pendampingan administrasi mobilitas.',
                'content_en' => 'KUI Unida has updated its international academic document service flow to speed up legalization, endorsement, and mobility administration support.',
                'content_ar' => 'قام مكتب الشؤون الدولية بتحديث آلية خدمة الوثائق الأكاديمية الدولية لتسريع عمليات التصديق والدعم الإداري.',
                'file_path' => null,
                'is_active' => true,
            ],
        ];

        foreach ($announcements as $announcement) {
            Announcement::query()->updateOrCreate(
                ['title_id' => $announcement['title_id']],
                $announcement
            );
        }
    }

    private function seedAgendas(): void
    {
        $now = now();

        $agendas = [
            [
                'slug' => 'international-partnership-forum-2026',
                'name_id' => 'International Partnership Forum 2026',
                'name_en' => 'International Partnership Forum 2026',
                'name_ar' => 'منتدى الشراكات الدولية 2026',
                'description_id' => 'Forum strategis untuk mempertemukan Universitas Juanda dengan calon mitra akademik internasional serta membahas peluang kerja sama riset, pertukaran mahasiswa, dan visiting lecturer.',
                'description_en' => 'A strategic forum that connects Universitas Juanda with prospective international academic partners.',
                'description_ar' => 'منتدى استراتيجي يربط جامعة جواندا بالشركاء الأكاديميين الدوليين المحتملين.',
                'location_id' => 'Aula Utama Universitas Juanda',
                'location_en' => 'Main Hall of Universitas Juanda',
                'location_ar' => 'القاعة الرئيسية بجامعة جواندا',
                'start_date' => $now->copy()->addDays(10)->setTime(9, 0),
                'end_date' => $now->copy()->addDays(10)->setTime(15, 30),
            ],
            [
                'slug' => 'orientation-for-incoming-students-2026',
                'name_id' => 'Orientation For Incoming International Students',
                'name_en' => 'Orientation For Incoming International Students',
                'name_ar' => 'برنامج التعريف للطلاب الدوليين الجدد',
                'description_id' => 'Kegiatan orientasi untuk mahasiswa internasional baru yang mencakup pengenalan kampus, layanan akademik, budaya lokal, dan pendampingan administratif.',
                'description_en' => 'An orientation program for newly admitted international students covering campus life, academic services, and local culture.',
                'description_ar' => 'برنامج تعريفي للطلاب الدوليين الجدد يشمل الحياة الجامعية والخدمات الأكاديمية والثقافة المحلية.',
                'location_id' => 'International Office Lounge',
                'location_en' => 'International Office Lounge',
                'location_ar' => 'صالة المكتب الدولي',
                'start_date' => $now->copy()->addMonth()->setTime(8, 30),
                'end_date' => $now->copy()->addMonth()->setTime(12, 30),
            ],
            [
                'slug' => 'webinar-study-opportunities-abroad',
                'name_id' => 'Webinar Peluang Studi Dan Magang Luar Negeri',
                'name_en' => 'Webinar On Overseas Study And Internship Opportunities',
                'name_ar' => 'ندوة إلكترونية حول فرص الدراسة والتدريب في الخارج',
                'description_id' => 'Webinar terbuka untuk mahasiswa Universitas Juanda mengenai peluang studi lanjut, pertukaran, dan magang internasional bersama kampus mitra.',
                'description_en' => 'An open webinar for Universitas Juanda students about study, exchange, and internship opportunities abroad.',
                'description_ar' => 'ندوة مفتوحة لطلاب جامعة جواندا حول فرص الدراسة والتبادل والتدريب في الخارج.',
                'location_id' => 'Zoom Meeting',
                'location_en' => 'Zoom Meeting',
                'location_ar' => 'اجتماع زووم',
                'start_date' => $now->copy()->addDays(20)->setTime(13, 30),
                'end_date' => $now->copy()->addDays(20)->setTime(15, 0),
            ],
        ];

        foreach ($agendas as $agenda) {
            Agenda::query()->updateOrCreate(
                ['slug' => $agenda['slug']],
                $agenda
            );
        }
    }

    private function seedAlbums(): array
    {
        $albums = [
            [
                'slug' => 'student-mobility-kui-unida',
                'name_id' => 'Student Mobility KUI Unida',
                'name_en' => 'KUI Unida Student Mobility',
                'name_ar' => 'تنقل الطلاب بمكتب الشؤون الدولية',
                'image' => $this->copyDemoAsset('assets/images/pages/content-img-1.jpg', 'demo/kui-unida/albums/student-mobility-cover.jpg'),
            ],
            [
                'slug' => 'international-partnership-meetings',
                'name_id' => 'Pertemuan Kemitraan Internasional',
                'name_en' => 'International Partnership Meetings',
                'name_ar' => 'اجتماعات الشراكات الدولية',
                'image' => $this->copyDemoAsset('assets/images/pages/content-img-2.jpg', 'demo/kui-unida/albums/partnership-meeting-cover.jpg'),
            ],
        ];

        $savedAlbums = [];

        foreach ($albums as $album) {
            $savedAlbum = Album::query()->updateOrCreate(
                ['slug' => $album['slug']],
                $album
            );

            $savedAlbums[$album['slug']] = $savedAlbum;
        }

        return $savedAlbums;
    }

    private function seedGalleries(array $albums): void
    {
        $items = [
            [
                'album_slug' => 'student-mobility-kui-unida',
                'title_id' => 'Sesi Pembekalan Mahasiswa Outbound',
                'title_en' => 'Outbound Student Briefing Session',
                'title_ar' => 'جلسة الإعداد للطلاب المغادرين',
                'image' => $this->copyDemoAsset('assets/images/pages/content-img-3.jpg', 'demo/kui-unida/galleries/outbound-briefing.jpg'),
            ],
            [
                'album_slug' => 'student-mobility-kui-unida',
                'title_id' => 'Penerimaan Delegasi Mahasiswa Mitra',
                'title_en' => 'Welcoming Partner University Delegation',
                'title_ar' => 'استقبال وفد الجامعة الشريكة',
                'image' => $this->copyDemoAsset('assets/images/pages/content-img-4.jpg', 'demo/kui-unida/galleries/partner-delegation.jpg'),
            ],
            [
                'album_slug' => 'student-mobility-kui-unida',
                'title_id' => 'International Student Experience Day',
                'title_en' => 'International Student Experience Day',
                'title_ar' => 'يوم تجربة الطلاب الدوليين',
                'image' => $this->copyDemoAsset('assets/images/pages/modern.jpg', 'demo/kui-unida/galleries/international-student-day.jpg'),
            ],
            [
                'album_slug' => 'international-partnership-meetings',
                'title_id' => 'Forum Penandatanganan Kerja Sama',
                'title_en' => 'Partnership Signing Forum',
                'title_ar' => 'منتدى توقيع الشراكات',
                'image' => $this->copyDemoAsset('assets/images/banner/banner-16.jpg', 'demo/kui-unida/galleries/partnership-signing.jpg'),
            ],
            [
                'album_slug' => 'international-partnership-meetings',
                'title_id' => 'Diskusi Pengembangan Program Internasional',
                'title_en' => 'International Program Development Discussion',
                'title_ar' => 'نقاش تطوير البرامج الدولية',
                'image' => $this->copyDemoAsset('assets/images/banner/banner-21.jpg', 'demo/kui-unida/galleries/program-development-discussion.jpg'),
            ],
            [
                'album_slug' => 'international-partnership-meetings',
                'title_id' => 'Kunjungan Mitra Akademik Ke Kampus',
                'title_en' => 'Academic Partner Campus Visit',
                'title_ar' => 'زيارة الشركاء الأكاديميين إلى الحرم الجامعي',
                'image' => $this->copyDemoAsset('assets/images/banner/banner-24.jpg', 'demo/kui-unida/galleries/academic-partner-visit.jpg'),
            ],
        ];

        foreach ($items as $item) {
            Gallery::query()->updateOrCreate(
                ['title_id' => $item['title_id']],
                [
                    'album_id' => $albums[$item['album_slug']]->id ?? null,
                    'title_id' => $item['title_id'],
                    'title_en' => $item['title_en'],
                    'title_ar' => $item['title_ar'],
                    'image' => $item['image'],
                ]
            );
        }
    }

    private function seedPartners(): void
    {
        $items = [
            [
                'slug' => 'international-office-network',
                'name_id' => 'Jejaring Kantor Urusan Internasional',
                'name_en' => 'International Office Network',
                'name_ar' => 'شبكة المكاتب الدولية',
                'description_id' => 'Kemitraan antar kantor urusan internasional untuk mendukung pertukaran informasi, promosi kampus, dan mobilitas akademik.',
                'description_en' => 'A partnership network between international offices to support information exchange, campus promotion, and academic mobility.',
                'description_ar' => 'شبكة شراكات بين المكاتب الدولية لدعم تبادل المعلومات والترويج الجامعي والتنقل الأكاديمي.',
                'image' => $this->copyDemoAsset('assets/images/logo/logo-primary.png', 'demo/kui-unida/partners/io-network.png'),
            ],
            [
                'slug' => 'global-campus-consortium',
                'name_id' => 'Global Campus Consortium',
                'name_en' => 'Global Campus Consortium',
                'name_ar' => 'اتحاد الحرم الجامعي العالمي',
                'description_id' => 'Kolaborasi kampus untuk pengembangan short course, visiting professor, dan kegiatan ilmiah internasional.',
                'description_en' => 'A campus collaboration for short courses, visiting professors, and international academic programs.',
                'description_ar' => 'تعاون جامعي لتطوير الدورات القصيرة والأساتذة الزائرين والبرامج الأكاديمية الدولية.',
                'image' => $this->copyDemoAsset('assets/images/logo/logo-success.png', 'demo/kui-unida/partners/global-campus-consortium.png'),
            ],
            [
                'slug' => 'asia-mobility-alliance',
                'name_id' => 'Asia Mobility Alliance',
                'name_en' => 'Asia Mobility Alliance',
                'name_ar' => 'تحالف التنقل في آسيا',
                'description_id' => 'Mitra untuk penguatan program student exchange dan mobilitas mahasiswa lintas negara di kawasan Asia.',
                'description_en' => 'A partner alliance for strengthening student exchange and mobility programs across Asia.',
                'description_ar' => 'تحالف شريك لتعزيز برامج التبادل والتنقل الطلابي في آسيا.',
                'image' => $this->copyDemoAsset('assets/images/logo/logo-info.png', 'demo/kui-unida/partners/asia-mobility-alliance.png'),
            ],
            [
                'slug' => 'academic-collaboration-forum',
                'name_id' => 'Academic Collaboration Forum',
                'name_en' => 'Academic Collaboration Forum',
                'name_ar' => 'منتدى التعاون الأكاديمي',
                'description_id' => 'Forum lintas institusi untuk mendorong riset kolaboratif, publikasi bersama, dan kunjungan akademik.',
                'description_en' => 'An inter-institution forum that drives collaborative research, joint publications, and academic visits.',
                'description_ar' => 'منتدى بين المؤسسات لدفع البحث التعاوني والنشر المشترك والزيارات الأكاديمية.',
                'image' => $this->copyDemoAsset('assets/images/logo/logo-warning.png', 'demo/kui-unida/partners/academic-collaboration-forum.png'),
            ],
        ];

        foreach ($items as $item) {
            Lembaga::query()->updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );
        }
    }

    private function seedPositions(): array
    {
        $items = [
            [
                'name_id' => 'Kepala Kantor Urusan Internasional',
                'name_en' => 'Head Of International Office',
                'name_ar' => 'رئيس مكتب الشؤون الدولية',
            ],
            [
                'name_id' => 'Koordinator Mobilitas Dan Kemitraan',
                'name_en' => 'Mobility And Partnership Coordinator',
                'name_ar' => 'منسق التنقل والشراكات',
            ],
            [
                'name_id' => 'Staf Layanan Internasional',
                'name_en' => 'International Services Officer',
                'name_ar' => 'موظف الخدمات الدولية',
            ],
        ];

        $positions = [];

        foreach ($items as $item) {
            $position = Position::query()->updateOrCreate(
                ['name_id' => $item['name_id']],
                $item
            );

            $positions[$item['name_id']] = $position;
        }

        return $positions;
    }

    private function seedTeams(array $positions): void
    {
        $items = [
            [
                'npp' => 'KUI-001',
                'name' => 'Dr. Aulia Rahmawati',
                'position' => 'Kepala Kantor Urusan Internasional',
                'bio_id' => 'Memimpin pengembangan strategi internasional Universitas Juanda dan memperkuat kolaborasi dengan mitra luar negeri.',
                'bio_en' => 'Leads the international strategy of Universitas Juanda and strengthens collaboration with overseas partners.',
                'bio_ar' => 'تقود الاستراتيجية الدولية لجامعة جواندا وتعزز التعاون مع الشركاء الدوليين.',
                'image' => $this->copyDemoAsset('assets/images/pages/card-image-4.jpg', 'demo/kui-unida/team/head-international-office.jpg'),
                'slug' => 'dr-aulia-rahmawati',
            ],
            [
                'npp' => 'KUI-002',
                'name' => 'Muhammad Daffa Prasetya',
                'position' => 'Koordinator Mobilitas Dan Kemitraan',
                'bio_id' => 'Berfokus pada pengembangan program mobilitas mahasiswa dan kerja sama akademik lintas institusi.',
                'bio_en' => 'Focuses on student mobility programs and inter-institution academic partnerships.',
                'bio_ar' => 'يركز على برامج تنقل الطلاب والشراكات الأكاديمية بين المؤسسات.',
                'image' => $this->copyDemoAsset('assets/images/pages/card-image-5.jpg', 'demo/kui-unida/team/mobility-coordinator.jpg'),
                'slug' => 'muhammad-daffa-prasetya',
            ],
            [
                'npp' => 'KUI-003',
                'name' => 'Siti Nabila Fauziah',
                'position' => 'Staf Layanan Internasional',
                'bio_id' => 'Mendampingi layanan administrasi internasional, komunikasi dengan mahasiswa asing, dan koordinasi kegiatan internasional.',
                'bio_en' => 'Supports international administration, communication with international students, and coordination of global activities.',
                'bio_ar' => 'تدعم الإدارة الدولية والتواصل مع الطلاب الدوليين وتنسيق الأنشطة العالمية.',
                'image' => $this->copyDemoAsset('assets/images/pages/card-image-6.jpg', 'demo/kui-unida/team/international-services-officer.jpg'),
                'slug' => 'siti-nabila-fauziah',
            ],
        ];

        foreach ($items as $item) {
            Team::query()->updateOrCreate(
                ['npp' => $item['npp']],
                [
                    'position_id' => $positions[$item['position']]->id ?? null,
                    'npp' => $item['npp'],
                    'name' => $item['name'],
                    'image' => $item['image'],
                    'bio_id' => $item['bio_id'],
                    'bio_en' => $item['bio_en'],
                    'bio_ar' => $item['bio_ar'],
                    'slug' => $item['slug'],
                ]
            );
        }
    }

    private function seedPosts(array $categories, ?User $adminUser): void
    {
        $items = [
            [
                'slug' => 'kui-unida-buka-program-student-mobility-asia',
                'category' => 'Program Internasional',
                'title_id' => 'KUI Unida Buka Program Student Mobility Asia 2026',
                'title_en' => 'KUI Unida Opens Student Mobility Asia 2026 Program',
                'title_ar' => 'يفتح مكتب الشؤون الدولية برنامج التنقل الطلابي في آسيا 2026',
                'content_id' => '<p>Kantor Urusan Internasional Universitas Juanda membuka peluang bagi mahasiswa untuk mengikuti program <strong>student mobility</strong> ke beberapa kampus mitra di kawasan Asia.</p><p>Program ini dirancang untuk memperluas pengalaman akademik, memperkuat kompetensi lintas budaya, dan membuka akses jejaring internasional bagi mahasiswa Universitas Juanda.</p><h3>Fokus Program</h3><ul><li>Pertukaran akademik jangka pendek.</li><li>Kegiatan kolaboratif bersama universitas mitra.</li><li>Pendampingan administrasi dan orientasi keberangkatan.</li></ul>',
                'content_en' => '<p>The International Office of Universitas Juanda opens opportunities for students to join a <strong>student mobility</strong> program at partner universities across Asia.</p><p>The program aims to expand academic experience, strengthen intercultural competence, and widen global exposure.</p>',
                'content_ar' => '<p>يفتح مكتب الشؤون الدولية بجامعة جواندا فرصًا للطلاب للمشاركة في برنامج <strong>التنقل الطلابي</strong> مع الجامعات الشريكة في آسيا.</p>',
                'image' => $this->copyDemoAsset('assets/images/banner/banner-14.jpg', 'demo/kui-unida/posts/student-mobility-asia.jpg'),
                'meta_title' => 'Program Student Mobility Asia 2026 KUI Unida',
                'meta_description' => 'Informasi program student mobility Asia 2026 oleh KUI Universitas Juanda.',
            ],
            [
                'slug' => 'penguatan-kemitraan-global-universitas-juanda',
                'category' => 'Kemitraan Global',
                'title_id' => 'Penguatan Kemitraan Global Untuk Reputasi Internasional Universitas Juanda',
                'title_en' => 'Strengthening Global Partnerships For Universitas Juanda International Reputation',
                'title_ar' => 'تعزيز الشراكات العالمية لرفع السمعة الدولية لجامعة جواندا',
                'content_id' => '<p>KUI Unida terus memperluas kemitraan dengan institusi luar negeri untuk mendukung pengembangan program bersama, riset kolaboratif, dan pertukaran akademik.</p><blockquote>Kolaborasi internasional bukan hanya soal jaringan, tetapi juga soal dampak nyata bagi mutu akademik kampus.</blockquote><p>Melalui kemitraan yang terarah, Universitas Juanda dapat memperkuat posisi dan visibilitasnya di level internasional.</p>',
                'content_en' => '<p>KUI Unida continues to strengthen global partnerships to support joint programs, collaborative research, and academic exchanges.</p>',
                'content_ar' => '<p>يواصل مكتب الشؤون الدولية تعزيز الشراكات العالمية لدعم البرامج المشتركة والبحث التعاوني والتبادل الأكاديمي.</p>',
                'image' => $this->copyDemoAsset('assets/images/banner/banner-23.jpg', 'demo/kui-unida/posts/global-partnerships.jpg'),
                'meta_title' => 'Penguatan Kemitraan Global Universitas Juanda',
                'meta_description' => 'Strategi KUI Unida dalam memperluas jejaring dan kerja sama internasional.',
            ],
            [
                'slug' => 'layanan-untuk-mahasiswa-internasional-di-kui-unida',
                'category' => 'Mahasiswa Internasional',
                'title_id' => 'Layanan Untuk Mahasiswa Internasional Di KUI Unida',
                'title_en' => 'Services For International Students At KUI Unida',
                'title_ar' => 'خدمات الطلاب الدوليين في مكتب الشؤون الدولية',
                'content_id' => '<p>KUI Unida menyediakan dukungan awal bagi mahasiswa internasional mulai dari orientasi kampus, pengenalan layanan akademik, hingga informasi dasar terkait adaptasi budaya.</p><p>Layanan ini dirancang untuk membantu mahasiswa internasional beradaptasi lebih cepat dan merasakan lingkungan kampus yang ramah dan suportif.</p>',
                'content_en' => '<p>KUI Unida provides orientation, academic service guidance, and essential information to support international students at the beginning of their study journey.</p>',
                'content_ar' => '<p>يوفر مكتب الشؤون الدولية خدمات التوجيه الأكاديمي والمعلومات الأساسية لدعم الطلاب الدوليين في بداية رحلتهم الدراسية.</p>',
                'image' => $this->copyDemoAsset('assets/images/banner/banner-31.jpg', 'demo/kui-unida/posts/international-student-services.jpg'),
                'meta_title' => 'Layanan Mahasiswa Internasional KUI Unida',
                'meta_description' => 'Dukungan layanan awal bagi mahasiswa internasional di Universitas Juanda.',
            ],
            [
                'slug' => 'webinar-peluang-studi-lanjut-dan-magang-luar-negeri',
                'category' => 'Program Internasional',
                'title_id' => 'Webinar Peluang Studi Lanjut Dan Magang Luar Negeri',
                'title_en' => 'Webinar On Overseas Study And Internship Opportunities',
                'title_ar' => 'ندوة حول فرص الدراسة العليا والتدريب في الخارج',
                'content_id' => '<p>KUI Unida menyelenggarakan webinar yang membahas peluang studi lanjut, pertukaran, serta magang internasional bersama narasumber dari mitra luar negeri.</p><p>Materi webinar mencakup persiapan dokumen, strategi memilih program, dan pemetaan peluang yang sesuai dengan minat peserta.</p>',
                'content_en' => '<p>KUI Unida organizes a webinar about overseas study, exchange, and internship opportunities with speakers from international partner institutions.</p>',
                'content_ar' => '<p>ينظم مكتب الشؤون الدولية ندوة حول فرص الدراسة والتبادل والتدريب في الخارج مع متحدثين من مؤسسات شريكة دولية.</p>',
                'image' => $this->copyDemoAsset('assets/images/banner/banner-35.jpg', 'demo/kui-unida/posts/webinar-study-opportunities.jpg'),
                'meta_title' => 'Webinar Peluang Studi Lanjut Dan Magang Luar Negeri',
                'meta_description' => 'Webinar KUI Unida tentang peluang studi lanjut dan magang internasional.',
            ],
        ];

        foreach ($items as $item) {
            Post::query()->updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'category_id' => $categories[$item['category']]->id ?? null,
                    'user_id' => $adminUser?->id,
                    'title_id' => $item['title_id'],
                    'title_en' => $item['title_en'],
                    'title_ar' => $item['title_ar'],
                    'slug' => $item['slug'],
                    'image' => $item['image'],
                    'content_id' => $item['content_id'],
                    'content_en' => $item['content_en'],
                    'content_ar' => $item['content_ar'],
                    'status' => 'published',
                    'meta_title' => $item['meta_title'],
                    'meta_description' => $item['meta_description'],
                ]
            );
        }
    }

    private function seedPages(?User $adminUser): void
    {
        $items = [
            [
                'slug' => 'profil-kui-unida',
                'title_id' => 'Profil KUI Universitas Juanda',
                'title_en' => 'Profile Of KUI Universitas Juanda',
                'title_ar' => 'ملف مكتب الشؤون الدولية بجامعة جواندا',
                'content_id' => '<p>KUI Universitas Juanda adalah unit yang mengelola dan mendorong internasionalisasi kampus melalui kemitraan, mobilitas, dan layanan akademik lintas negara.</p>',
                'content_en' => '<p>The International Office of Universitas Juanda manages and promotes campus internationalization through partnerships, mobility, and cross-border academic services.</p>',
                'content_ar' => '<p>يدير مكتب الشؤون الدولية بجامعة جواندا جهود تدويل الحرم الجامعي من خلال الشراكات والتنقل والخدمات الأكاديمية العابرة للحدود.</p>',
            ],
            [
                'slug' => 'panduan-mahasiswa-internasional',
                'title_id' => 'Panduan Mahasiswa Internasional',
                'title_en' => 'International Student Guide',
                'title_ar' => 'دليل الطلاب الدوليين',
                'content_id' => '<p>Halaman ini memuat informasi ringkas mengenai layanan awal, orientasi kampus, dan dukungan administrasi yang dapat diakses oleh mahasiswa internasional di Universitas Juanda.</p>',
                'content_en' => '<p>This page contains brief information on orientation, administrative support, and initial services for international students at Universitas Juanda.</p>',
                'content_ar' => '<p>تحتوي هذه الصفحة على معلومات موجزة حول التوجيه والدعم الإداري والخدمات الأولية للطلاب الدوليين في جامعة جواندا.</p>',
            ],
        ];

        foreach ($items as $item) {
            Page::query()->updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'user_id' => $adminUser?->id,
                    'title_id' => $item['title_id'],
                    'title_en' => $item['title_en'],
                    'title_ar' => $item['title_ar'],
                    'slug' => $item['slug'],
                    'content_id' => $item['content_id'],
                    'content_en' => $item['content_en'],
                    'content_ar' => $item['content_ar'],
                    'status' => true,
                ]
            );
        }
    }

    private function seedVideos(): void
    {
        $items = [
            [
                'title_id' => 'Profil KUI Universitas Juanda',
                'title_en' => 'International Office Profile',
                'title_ar' => 'ملف المكتب الدولي',
                'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'thumbnail' => $this->copyDemoAsset('assets/images/pages/video-poster.jpg', 'demo/kui-unida/videos/profile-video-thumbnail.jpg'),
            ],
            [
                'title_id' => 'Testimoni Program Mobilitas Internasional',
                'title_en' => 'International Mobility Program Testimonial',
                'title_ar' => 'شهادة برنامج التنقل الدولي',
                'video_url' => 'https://www.youtube.com/watch?v=aqz-KE-bpKQ',
                'thumbnail' => $this->copyDemoAsset('assets/images/pages/search-result.jpg', 'demo/kui-unida/videos/mobility-testimonial-thumbnail.jpg'),
            ],
        ];

        foreach ($items as $item) {
            Video::query()->updateOrCreate(
                ['title_id' => $item['title_id']],
                $item
            );
        }
    }

    private function copyDemoAsset(string $sourceRelativePath, string $targetRelativePath): ?string
    {
        $sourcePath = public_path($sourceRelativePath);

        if (! File::exists($sourcePath)) {
            return null;
        }

        $disk = Storage::disk('public');

        if (! $disk->exists($targetRelativePath)) {
            $disk->put($targetRelativePath, File::get($sourcePath));
        }

        return $targetRelativePath;
    }
}
