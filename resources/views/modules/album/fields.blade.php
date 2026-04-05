@php $showMode = $showMode ?? false; @endphp

        <x-form.input name='name_id' type='text' label='Name Id' :value="$album->name_id ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
        <x-form.input name='name_en' type='text' label='Name En' :value="$album->name_en ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='name_ar' type='text' label='Name Ar' :value="$album->name_ar ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.photo-upload label='Image' name='image' :value="$album->image ?? null" :readonly="$showMode" />
