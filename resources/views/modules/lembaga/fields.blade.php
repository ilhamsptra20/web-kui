@php $showMode = $showMode ?? false; @endphp

        <x-form.input name='name_id' type='text' label='Name Id' :value="$lembaga->name_id ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
        <x-form.input name='name_en' type='text' label='Name En' :value="$lembaga->name_en ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='name_ar' type='text' label='Name Ar' :value="$lembaga->name_ar ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.textarea name='description_id' label='Description Id' :readonly="$showMode" :disabled="$showMode">{{ $lembaga->description_id ?? '' }}</x-form.textarea>
        <x-form.textarea name='description_en' label='Description En' :readonly="$showMode" :disabled="$showMode">{{ $lembaga->description_en ?? '' }}</x-form.textarea>
        <x-form.textarea name='description_ar' label='Description Ar' :readonly="$showMode" :disabled="$showMode">{{ $lembaga->description_ar ?? '' }}</x-form.textarea>
        <x-form.photo-upload label='Image' name='image' :value="$lembaga->image ?? null" :readonly="$showMode" />
