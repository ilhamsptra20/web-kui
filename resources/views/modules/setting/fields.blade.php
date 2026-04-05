@php $showMode = $showMode ?? false; @endphp

        <x-form.input name='key' type='text' label='Key' :value="$setting->key ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
        <x-form.textarea name='value' label='Value' :readonly="$showMode" :disabled="$showMode">{{ $setting->value ?? '' }}</x-form.textarea>
