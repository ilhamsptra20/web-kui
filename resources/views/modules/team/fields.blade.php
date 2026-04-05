@php $showMode = $showMode ?? false; @endphp

        <x-form.select name='position_id' label='Position Id' required :disabled="$showMode">
            <option value='' selected>Select Position Id</option>
            @foreach($positions as $item)
                <option value='{{ $item->id }}' {{ (old('position_id', $team->position_id ?? '') == $item->id) ? 'selected' : '' }}>{{ $item ? (method_exists($item, 'trans') ? ($item->trans('name') ?? $item->trans('title') ?? $item->id ?? '-') : ($item->name ?? $item->title ?? $item->id ?? '-')) : '-' }}</option>
            @endforeach
        </x-form.select>
        <x-form.input name='npp' type='text' label='Npp' :value="$team->npp ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='name' type='text' label='Name' :value="$team->name ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
        <x-form.photo-upload label='Image' name='image' :value="$team->image ?? null" :readonly="$showMode" required />
        <x-form.textarea name='bio_id' label='Bio Id' :readonly="$showMode" :disabled="$showMode">{{ $team->bio_id ?? '' }}</x-form.textarea>
        <x-form.textarea name='bio_en' label='Bio En' :readonly="$showMode" :disabled="$showMode">{{ $team->bio_en ?? '' }}</x-form.textarea>
        <x-form.textarea name='bio_ar' label='Bio Ar' :readonly="$showMode" :disabled="$showMode">{{ $team->bio_ar ?? '' }}</x-form.textarea>
