@php $showMode = $showMode ?? false; @endphp

        <x-form.input name='title_id' type='text' label='Title Id' :value="$category->title_id ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
        <x-form.input name='title_en' type='text' label='Title En' :value="$category->title_en ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='title_ar' type='text' label='Title Ar' :value="$category->title_ar ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
