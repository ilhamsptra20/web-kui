@php $showMode = $showMode ?? false; @endphp

        <x-form.input name='title' type='text' label='Title' :value="$relation->title ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
        <x-form.input name='url' type='text' label='Url' :value="$relation->url ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
