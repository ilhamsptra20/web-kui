@php $showMode = $showMode ?? false; @endphp

        <x-form.select name='category_id' label='Category Id' required :disabled="$showMode">
            <option value='' selected>Select Category Id</option>
            @foreach($categories as $item)
                <option value='{{ $item->id }}' {{ (old('category_id', $post->category_id ?? '') == $item->id) ? 'selected' : '' }}>{{ $item ? (method_exists($item, 'trans') ? ($item->trans('name') ?? $item->trans('title') ?? $item->id ?? '-') : ($item->name ?? $item->title ?? $item->id ?? '-')) : '-' }}</option>
            @endforeach
        </x-form.select>
        <x-form.input name='title_id' type='text' label='Title Id' :value="$post->title_id ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
        <x-form.input name='title_en' type='text' label='Title En' :value="$post->title_en ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='title_ar' type='text' label='Title Ar' :value="$post->title_ar ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.photo-upload label='Image' name='image' :value="$post->image ?? null" :readonly="$showMode" />
        <x-form.ckeditor name='content_id' label='Content Id' :value="$post->content_id ?? ''" :readonly="$showMode" :enable-images="! $showMode" required />
        <x-form.ckeditor name='content_en' label='Content En' :value="$post->content_en ?? ''" :readonly="$showMode" :enable-images="! $showMode" />
        <x-form.ckeditor name='content_ar' label='Content Ar' :value="$post->content_ar ?? ''" :readonly="$showMode" :enable-images="! $showMode" />
        <label class='form-label'>Status</label>
        <div class='d-flex gap-3 flex-wrap mb-2'>
            @foreach(array (
  0 => 'draft',
  1 => 'published',
) as $opt)
                <div class='form-check'>
                    <input class='form-check-input' type='radio' name='status' value='{{ $opt }}' {{ old('status', $post->status ?? '') == $opt ? 'checked' : '' }} @disabled($showMode)>
                    <label class='form-check-label'>{{ ucfirst($opt) }}</label>
                </div>
            @endforeach
        </div>
        <x-form.input name='meta_title' type='text' label='Meta Title' :value="$post->meta_title ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='meta_description' type='text' label='Meta Description' :value="$post->meta_description ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
