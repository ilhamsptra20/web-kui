@php $showMode = $showMode ?? false; @endphp

        <x-form.input name='name_id' type='text' label='Name Id' :value="$position->name_id ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
        <x-form.input name='name_en' type='text' label='Name En' :value="$position->name_en ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='name_ar' type='text' label='Name Ar' :value="$position->name_ar ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
