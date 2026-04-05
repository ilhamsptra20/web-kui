@php $showMode = $showMode ?? false; @endphp

        <x-form.select name='album_id' label='Album Id' required :disabled="$showMode">
            <option value='' selected>Select Album Id</option>
            @foreach($albums as $item)
                <option value='{{ $item->id }}' {{ (old('album_id', $gallery->album_id ?? '') == $item->id) ? 'selected' : '' }}>{{ $item ? (method_exists($item, 'trans') ? ($item->trans('name') ?? $item->trans('title') ?? $item->id ?? '-') : ($item->name ?? $item->title ?? $item->id ?? '-')) : '-' }}</option>
            @endforeach
        </x-form.select>
        <x-form.input name='title_id' type='text' label='Title Id' :value="$gallery->title_id ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='title_en' type='text' label='Title En' :value="$gallery->title_en ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='title_ar' type='text' label='Title Ar' :value="$gallery->title_ar ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.photo-upload label='Image' name='image' :value="$gallery->image ?? null" :readonly="$showMode" required />
