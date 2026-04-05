@php $showMode = $showMode ?? false; @endphp

        <x-form.input name='title_id' type='text' label='Title Id' :value="$announcement->title_id ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
        <x-form.input name='title_en' type='text' label='Title En' :value="$announcement->title_en ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='title_ar' type='text' label='Title Ar' :value="$announcement->title_ar ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.textarea name='content_id' label='Content Id' :readonly="$showMode" :disabled="$showMode" required>{{ $announcement->content_id ?? '' }}</x-form.textarea>
        <x-form.textarea name='content_en' label='Content En' :readonly="$showMode" :disabled="$showMode">{{ $announcement->content_en ?? '' }}</x-form.textarea>
        <x-form.textarea name='content_ar' label='Content Ar' :readonly="$showMode" :disabled="$showMode">{{ $announcement->content_ar ?? '' }}</x-form.textarea>
        <x-form.input name='file_path' type='text' label='File Path' :value="$announcement->file_path ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.switch name='is_active' label='Is Active' :checked="old('is_active', $announcement->is_active ?? false)" :disabled="$showMode" />
