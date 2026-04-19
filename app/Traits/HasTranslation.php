<?php

namespace App\Traits;

trait HasTranslation
{
    /**
     * Magic accessor: $model->title → $model->title_id / title_en / title_ar
     * sesuai locale aktif
     */
    public function trans(string $field): ?string
    {
        $locale = app()->getLocale(); // 'id', 'en', 'ar'
        $column = "{$field}_{$locale}";

        // fallback ke _id kalau kolom locale tidak ada, null, atau string kosong
        if (! isset($this->attributes[$column]) || blank($this->attributes[$column])) {
            return $this->attributes["{$field}_id"] ?? null;
        }

        return $this->attributes[$column];
    }
}
