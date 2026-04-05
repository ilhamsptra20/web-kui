@php $showMode = $showMode ?? false; @endphp

        <x-form.input name='title_id' type='text' label='Title Id' :value="$page->title_id ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
        <x-form.input name='title_en' type='text' label='Title En' :value="$page->title_en ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='title_ar' type='text' label='Title Ar' :value="$page->title_ar ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.ckeditor name='content_id' label='Content Id' :value="$page->content_id ?? ''" :readonly="$showMode" :enable-images="! $showMode" required />
        <x-form.ckeditor name='content_en' label='Content En' :value="$page->content_en ?? ''" :readonly="$showMode" :enable-images="! $showMode" />
        <x-form.ckeditor name='content_ar' label='Content Ar' :value="$page->content_ar ?? ''" :readonly="$showMode" :enable-images="! $showMode" />
        <x-form.switch name='status' label='Status' :checked="old('status', $page->status ?? false)" :disabled="$showMode" />
