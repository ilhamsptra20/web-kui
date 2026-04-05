@php $showMode = $showMode ?? false; @endphp

        <x-form.input name='name' type='text' label='Name' :value="$social_media->name ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
        <x-form.input name='icon' type='text' label='Icon' :value="$social_media->icon ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
        <x-form.input name='link' type='text' label='Link' :value="$social_media->link ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
