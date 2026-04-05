<?php

namespace App\Http\Controllers\Marketing;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use App\Services\SettingService;
use Illuminate\Support\Facades\Schema;

class ContactController extends Controller
{
    public function index(SettingService $settingService)
    {
        $contactPage = $settingService->only([
            'contact_page_subtitle' => 'HUBUNGI KUI UNIDA',
            'contact_page_title' => 'Mari Bangun Kolaborasi Internasional Bersama Kantor Urusan Internasional Universitas Juanda',
            'contact_page_description' => 'KUI Unida terbuka untuk komunikasi terkait kerja sama internasional, mobilitas mahasiswa, visiting lecture, program akademik global, dan kebutuhan informasi internasional lainnya.',
            'contact_page_card_title' => 'Kantor Urusan Internasional',
            'contact_page_response_note' => 'Tim kami akan merespons pertanyaan dan usulan kerja sama secepat mungkin pada jam kerja.',
            'contact_page_hours_title' => 'Jam Layanan',
            'contact_page_hours_value' => 'Senin - Jumat, 08.00 - 16.00 WIB',
            'contact_page_map_embed_url' => '',
        ]);

        $contactInfo = $settingService->only([
            'footer_address' => 'Kampus Universitas Juanda, Bogor, Jawa Barat, Indonesia',
            'footer_email' => 'kui@unida.ac.id',
            'footer_phone' => '+62 251 8246475',
        ]);

        $socialLinks = Schema::hasTable('social_media')
            ? SocialMedia::query()
                ->orderBy('name')
                ->get()
                ->map(fn (SocialMedia $item) => [
                    'title' => $item->name ?: 'Social Media',
                    'icon' => $item->icon ?: 'ri-global-line',
                    'url' => $item->link ?: '#',
                ])
                ->values()
                ->all()
            : [];

        return view('pages.marketing.contact', [
            'contactPage' => $contactPage,
            'contactInfo' => $contactInfo,
            'socialLinks' => $socialLinks,
        ]);
    }
}
