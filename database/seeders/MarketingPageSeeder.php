<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\User;
use App\Support\Navigation\NavigationService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class MarketingPageSeeder extends Seeder
{
    public function run(): void
    {
        if (! Schema::hasTable('pages')) {
            return;
        }

        $adminUser = Schema::hasTable('users')
            ? User::query()->where('email', 'admin@email.com')->first() ?? User::query()->oldest('id')->first()
            : null;

        foreach ($this->pages() as $page) {
            Page::query()->firstOrCreate(
                ['slug' => $page['slug']],
                [
                    'user_id' => $adminUser?->id,
                    'title_id' => $page['title_id'],
                    'title_en' => $page['title_en'],
                    'title_ar' => $page['title_ar'],
                    'content_id' => $page['content_id'],
                    'content_en' => $page['content_en'],
                    'content_ar' => $page['content_ar'],
                    'status' => true,
                ]
            );
        }

        app(NavigationService::class)->clearCache();
    }

    private function pages(): array
    {
        return [
            [
                'slug' => 'profil-kui-unida',
                'title_id' => 'Profil KUI Universitas Juanda',
                'title_en' => 'Profile Of KUI Universitas Juanda',
                'title_ar' => 'ملف مكتب الشؤون الدولية بجامعة جواندا',
                'content_id' => '<h2>Peran KUI Universitas Juanda</h2><p>Kantor Urusan Internasional Universitas Juanda adalah unit yang mengelola agenda internasionalisasi kampus melalui kemitraan global, mobilitas akademik, promosi internasional, dan layanan pendukung bagi mahasiswa, dosen, serta mitra luar negeri.</p><p>KUI menjadi pintu koordinasi untuk kerja sama internasional, kunjungan akademik, visiting lecturer, student mobility, short course, dan komunikasi kelembagaan dengan mitra global.</p><h3>Fokus Layanan</h3><ul><li>Koordinasi kerja sama internasional dan dokumen pendukung kemitraan.</li><li>Pendampingan program inbound dan outbound untuk mahasiswa serta dosen.</li><li>Promosi peluang akademik global bagi sivitas Universitas Juanda.</li><li>Fasilitasi komunikasi dengan universitas, lembaga, dan jejaring internasional.</li></ul>',
                'content_en' => '<h2>Role Of The International Office</h2><p>The International Office of Universitas Juanda manages the university internationalization agenda through global partnerships, academic mobility, international promotion, and support services for students, lecturers, and overseas partners.</p><p>The office acts as a coordination gateway for international collaboration, academic visits, visiting lecturer programs, student mobility, short courses, and institutional communication with global partners.</p><h3>Service Focus</h3><ul><li>Coordination of international partnerships and supporting documents.</li><li>Support for inbound and outbound programs for students and lecturers.</li><li>Promotion of global academic opportunities for Universitas Juanda communities.</li><li>Facilitation of communication with universities, institutions, and international networks.</li></ul>',
                'content_ar' => '<h2>دور مكتب الشؤون الدولية</h2><p>يدير مكتب الشؤون الدولية بجامعة جواندا أجندة تدويل الجامعة من خلال الشراكات العالمية والتنقل الأكاديمي والترويج الدولي والخدمات الداعمة للطلاب والمحاضرين والشركاء الدوليين.</p><p>يعمل المكتب كبوابة تنسيق للتعاون الدولي والزيارات الأكاديمية وبرامج المحاضرين الزائرين وتنقل الطلاب والدورات القصيرة والتواصل المؤسسي مع الشركاء العالميين.</p>',
            ],
            [
                'slug' => 'panduan-mahasiswa-internasional',
                'title_id' => 'Panduan Mahasiswa Internasional',
                'title_en' => 'International Student Guide',
                'title_ar' => 'دليل الطلاب الدوليين',
                'content_id' => '<h2>Layanan Untuk Mahasiswa Internasional</h2><p>Halaman ini memuat panduan ringkas bagi mahasiswa internasional yang akan mengikuti kegiatan akademik di Universitas Juanda. KUI membantu koordinasi awal terkait informasi kampus, orientasi, komunikasi administratif, dan kebutuhan pendampingan selama proses akademik.</p><h3>Informasi Yang Perlu Disiapkan</h3><ul><li>Data identitas dan kontak aktif yang dapat dihubungi.</li><li>Surat penerimaan atau dokumen akademik dari unit terkait.</li><li>Informasi program, periode studi, dan kebutuhan administrasi akademik.</li><li>Kontak person dari universitas asal atau institusi pengirim.</li></ul><blockquote>Untuk kebutuhan spesifik, mahasiswa internasional disarankan menghubungi KUI lebih awal agar proses koordinasi berjalan lebih tertata.</blockquote>',
                'content_en' => '<h2>Services For International Students</h2><p>This page provides a brief guide for international students participating in academic activities at Universitas Juanda. The International Office supports early coordination regarding campus information, orientation, administrative communication, and assistance during the academic process.</p><h3>Information To Prepare</h3><ul><li>Identity data and active contact information.</li><li>Acceptance letter or academic documents from the relevant unit.</li><li>Program information, study period, and academic administration needs.</li><li>Contact person from the home university or sending institution.</li></ul><blockquote>For specific needs, international students are encouraged to contact the International Office early so the coordination process can run properly.</blockquote>',
                'content_ar' => '<h2>الخدمات للطلاب الدوليين</h2><p>توفر هذه الصفحة دليلاً موجزاً للطلاب الدوليين الذين يشاركون في الأنشطة الأكاديمية بجامعة جواندا. يدعم مكتب الشؤون الدولية التنسيق الأولي المتعلق بمعلومات الحرم الجامعي والتوجيه والتواصل الإداري والمساعدة خلال العملية الأكاديمية.</p>',
            ],
            [
                'slug' => 'layanan-kerja-sama-internasional',
                'title_id' => 'Layanan Kerja Sama Internasional',
                'title_en' => 'International Partnership Services',
                'title_ar' => 'خدمات الشراكات الدولية',
                'content_id' => '<h2>Koordinasi Kemitraan Global</h2><p>KUI Universitas Juanda memfasilitasi komunikasi dan koordinasi kerja sama dengan mitra internasional, termasuk universitas, lembaga riset, organisasi pendidikan, dan jejaring akademik global.</p><p>Layanan ini mencakup pendampingan penyusunan agenda kerja sama, komunikasi awal dengan mitra, koordinasi dokumen, serta tindak lanjut program bersama.</p><h3>Ruang Lingkup</h3><ul><li>MoU, MoA, implementation arrangement, dan dokumen kerja sama sejenis.</li><li>Koordinasi kunjungan akademik dan delegasi internasional.</li><li>Program visiting lecturer, guest lecture, seminar, dan short course.</li><li>Fasilitasi diskusi peluang riset, publikasi, dan program akademik bersama.</li></ul>',
                'content_en' => '<h2>Global Partnership Coordination</h2><p>The International Office facilitates communication and partnership coordination with international partners, including universities, research institutions, education organizations, and global academic networks.</p><p>This service includes support for partnership agendas, initial communication with partners, document coordination, and follow-up for joint programs.</p><h3>Scope</h3><ul><li>MoU, MoA, implementation arrangement, and related partnership documents.</li><li>Coordination of academic visits and international delegations.</li><li>Visiting lecturer, guest lecture, seminar, and short course programs.</li><li>Facilitation of research, publication, and joint academic program discussions.</li></ul>',
                'content_ar' => '<h2>تنسيق الشراكات العالمية</h2><p>يسهل مكتب الشؤون الدولية التواصل وتنسيق الشراكات مع الشركاء الدوليين، بما في ذلك الجامعات ومؤسسات البحث والمنظمات التعليمية والشبكات الأكاديمية العالمية.</p>',
            ],
            [
                'slug' => 'program-mobilitas-akademik',
                'title_id' => 'Program Mobilitas Akademik',
                'title_en' => 'Academic Mobility Programs',
                'title_ar' => 'برامج التنقل الأكاديمي',
                'content_id' => '<h2>Mobilitas Mahasiswa Dan Dosen</h2><p>Program mobilitas akademik mendukung mahasiswa dan dosen Universitas Juanda untuk mendapatkan pengalaman internasional melalui pertukaran, kunjungan akademik, short course, dan kegiatan kolaboratif bersama mitra luar negeri.</p><h3>Bentuk Program</h3><ul><li>Student exchange dan student mobility jangka pendek.</li><li>Inbound program untuk mahasiswa internasional yang datang ke Universitas Juanda.</li><li>Outbound program untuk mahasiswa dan dosen Universitas Juanda.</li><li>Visiting lecturer, guest lecture, joint class, dan kolaborasi akademik daring maupun luring.</li></ul><p>Informasi program aktif akan diumumkan melalui halaman agenda, artikel, dan kanal resmi KUI Universitas Juanda.</p>',
                'content_en' => '<h2>Student And Lecturer Mobility</h2><p>Academic mobility programs support Universitas Juanda students and lecturers in gaining international experience through exchange, academic visits, short courses, and collaborative activities with overseas partners.</p><h3>Program Types</h3><ul><li>Student exchange and short-term student mobility.</li><li>Inbound programs for international students visiting Universitas Juanda.</li><li>Outbound programs for Universitas Juanda students and lecturers.</li><li>Visiting lecturer, guest lecture, joint class, and academic collaboration online or onsite.</li></ul><p>Active program information will be published through the agenda page, articles, and official KUI channels.</p>',
                'content_ar' => '<h2>تنقل الطلاب والمحاضرين</h2><p>تدعم برامج التنقل الأكاديمي طلاب ومحاضري جامعة جواندا لاكتساب الخبرة الدولية من خلال التبادل والزيارات الأكاديمية والدورات القصيرة والأنشطة التعاونية مع الشركاء الدوليين.</p>',
            ],
        ];
    }
}
