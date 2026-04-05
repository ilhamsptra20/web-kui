<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\Lembaga;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Team;
use App\Services\SettingService;

class AboutController extends Controller
{
    public function index(SettingService $settingService)
    {
        $settings = $settingService->only([
            'about_page_subtitle' => 'PROFILE KUI UNIDA',
            'about_page_title' => 'Mendorong Internasionalisasi Universitas Juanda Melalui Kolaborasi Global Yang Relevan',
            'about_page_lead' => 'Kantor Urusan Internasional Universitas Juanda hadir untuk memperluas jejaring global, mendukung mobilitas akademik, dan memperkuat ekosistem kampus yang terbuka, kolaboratif, dan berdaya saing internasional.',
            'about_page_intro_title' => 'Tentang Kantor Urusan Internasional Universitas Juanda',
            'about_page_intro_description' => 'KUI Unida berperan sebagai penghubung utama antara Universitas Juanda dengan mitra internasional, mahasiswa asing, program pertukaran, serta berbagai inisiatif kolaborasi lintas negara. Fokus kami adalah menghadirkan pengalaman internasional yang nyata, terukur, dan berdampak bagi sivitas akademika.',
            'about_page_image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1200&q=80',
            'about_page_mission_title' => 'Misi KUI Unida',
            'about_page_mission_description' => 'Mengembangkan layanan internasional yang terintegrasi untuk mendukung kerja sama global, pertukaran akademik, promosi kampus, dan penguatan kapasitas internasional seluruh unit di Universitas Juanda.',
            'about_page_vision_title' => 'Visi KUI Unida',
            'about_page_vision_description' => 'Menjadi pusat layanan internasional universitas yang profesional, adaptif, dan strategis dalam memperluas reputasi global Universitas Juanda.',
            'about_page_values_title' => 'Nilai Utama',
            'about_page_values' => [
                'Kolaboratif dalam membangun kemitraan internasional yang berkelanjutan.',
                'Responsif terhadap kebutuhan mahasiswa, dosen, dan mitra global.',
                'Profesional dalam pengelolaan layanan akademik lintas negara.',
                'Inklusif dalam mendukung lingkungan kampus multikultural.',
            ],
            'about_page_programs_title' => 'Fokus Layanan',
            'about_page_programs' => [
                'Pengembangan kerja sama internasional universitas.',
                'Pendampingan program inbound dan outbound mobility.',
                'Promosi kampus kepada calon mitra dan mahasiswa internasional.',
                'Layanan administrasi dasar untuk aktivitas akademik internasional.',
                'Penguatan branding global Universitas Juanda.',
            ],
            'about_page_cta_title' => 'Siap Berkolaborasi Dengan KUI Unida',
            'about_page_cta_description' => 'Hubungi kami untuk menjajaki kerja sama, program mobilitas, kunjungan akademik, atau inisiatif internasional lainnya bersama Universitas Juanda.',
            'about_page_cta_button_text' => 'Hubungi KUI',
            'about_page_cta_button_url' => route('contact-marketing'),
        ]);

        $stats = [
            [
                'label' => 'Mitra/Lembaga',
                'value' => Lembaga::query()->count(),
                'suffix' => '+',
            ],
            [
                'label' => 'Tim Terkelola',
                'value' => Team::query()->count(),
                'suffix' => '+',
            ],
            [
                'label' => 'Artikel Publikasi',
                'value' => Post::query()->where('status', 'published')->count(),
                'suffix' => '+',
            ],
            [
                'label' => 'Layanan Inti',
                'value' => is_array($settings['about_page_programs']) ? count($settings['about_page_programs']) : 0,
                'suffix' => '',
            ],
        ];

        $partnerItems = Lembaga::query()
            ->latest()
            ->take(8)
            ->get()
            ->map(fn (Lembaga $item) => [
                'name' => $item->trans('name'),
                'description' => $item->trans('description'),
                'logo_url' => Setting::resolveImageUrl($item->image),
            ]);

        $teamPreview = Team::query()
            ->with('position')
            ->orderBy('position_id')
            ->orderBy('name')
            ->take(4)
            ->get()
            ->map(fn (Team $item) => [
                'slug' => $item->slug,
                'name' => $item->name,
                'position' => $item->position?->trans('name'),
                'bio' => $item->trans('bio'),
                'image_url' => Setting::resolveImageUrl($item->image),
            ]);

        return view('pages.marketing.about', [
            'aboutPage' => $settings,
            'aboutStats' => $stats,
            'partnerItems' => $partnerItems,
            'teamPreview' => $teamPreview,
        ]);
    }
}
