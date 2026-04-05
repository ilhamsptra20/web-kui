<?php

namespace App\Support\Admin;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class AdminTable
{
    public static function stack(?string $primary, ?string $secondary = null): string
    {
        $primaryText = e(filled($primary) ? $primary : '-');
        $html = '<div class="d-flex flex-column">';
        $html .= '<span class="font-weight-bold text-dark">'.$primaryText.'</span>';

        if (filled($secondary)) {
            $html .= '<small class="text-muted">'.e($secondary).'</small>';
        }

        $html .= '</div>';

        return $html;
    }

    public static function image(?string $url, string $title, ?string $secondary = null): string
    {
        $placeholder = strtoupper(Str::substr(trim($title), 0, 1) ?: '?');

        $media = filled($url)
            ? '<img src="'.e($url).'" alt="'.e($title).'" style="width:44px;height:44px;object-fit:cover;border-radius:12px;border:1px solid #e5e7eb;">'
            : '<div style="width:44px;height:44px;border-radius:12px;background:#eef2ff;border:1px solid #dbe4ff;color:#5d5fef;display:flex;align-items:center;justify-content:center;font-weight:700;">'.e($placeholder).'</div>';

        return '<div class="d-flex align-items-center">'.$media.'<div class="ml-1">'.self::stack($title, $secondary).'</div></div>';
    }

    public static function badge(string $label, string $variant = 'secondary'): string
    {
        return '<span class="badge badge-light-'.$variant.'">'.e($label).'</span>';
    }

    public static function boolean(bool $value, string $trueLabel = 'Active', string $falseLabel = 'Inactive'): string
    {
        return $value
            ? self::badge($trueLabel, 'success')
            : self::badge($falseLabel, 'secondary');
    }

    public static function limit(?string $text, int $length = 90): string
    {
        return Str::limit((string) ($text ?: '-'), $length);
    }

    public static function dateTime(null|Carbon|string $value): string
    {
        if (! $value) {
            return '-';
        }

        $date = $value instanceof Carbon ? $value : Carbon::parse($value);

        return self::stack($date->format('d M Y'), $date->format('H:i'));
    }

    public static function externalLink(?string $url, string $fallback = '-'): string
    {
        if (! filled($url)) {
            return e($fallback);
        }

        $label = Str::limit($url, 42);

        return '<a href="'.e($url).'" target="_blank" rel="noopener noreferrer" class="text-primary">'.e($label).'</a>';
    }
}
