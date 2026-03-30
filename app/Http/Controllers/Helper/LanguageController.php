<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;

class LanguageController extends Controller
{
    protected array $allowed = ['id', 'en', 'ar'];

    public function switch(string $locale)
    {
        if (!in_array($locale, $this->allowed)) {
            abort(400);
        }

        session(['locale' => $locale]);

        return redirect()->back();
    }
}