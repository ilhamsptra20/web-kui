@php $showMode = $showMode ?? false; @endphp

        <x-form.input name='title_id' type='text' label='Title Id' :value="$video->title_id ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
        <x-form.input name='title_en' type='text' label='Title En' :value="$video->title_en ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='title_ar' type='text' label='Title Ar' :value="$video->title_ar ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='video_url' type='text' label='Video Url' :value="$video->video_url ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
        <x-form.photo-upload label='Thumbnail' name='thumbnail' :value="$video->thumbnail ?? null" :readonly="$showMode" />
        <x-form.switch name='is_active' label='Jadikan Video Profile Aktif' :checked="old('is_active', $video->is_active ?? false)" :disabled="$showMode" />
