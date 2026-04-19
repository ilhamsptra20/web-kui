<?php

namespace App\Http\Requests;

use App\Models\Navigation;

class UpdateNavigationRequest extends StoreNavigationRequest
{
    public function rules(): array
    {
        return parent::rules();
    }

    public function withValidator($validator): void
    {
        parent::withValidator($validator);

        $validator->after(function ($validator): void {
            /** @var Navigation|null $navigation */
            $navigation = $this->route('navigation');

            if ($navigation && $this->input('parent_id') === $navigation->id) {
                $validator->errors()->add('parent_id', 'Parent navigation tidak boleh dirinya sendiri.');
            }

            if (! $navigation || blank($this->input('parent_id'))) {
                return;
            }

            $parent = Navigation::query()->find($this->input('parent_id'));

            while ($parent) {
                if ($parent->parent_id === $navigation->id) {
                    $validator->errors()->add('parent_id', 'Parent navigation tidak boleh memakai child dari menu ini.');

                    return;
                }

                $parent = $parent->parent;
            }
        });
    }
}
