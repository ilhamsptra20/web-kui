@php $showMode = $showMode ?? false; @endphp

        <x-form.input name='name_id' type='text' label='Name Id' :value="$agenda->name_id ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
        <x-form.input name='name_en' type='text' label='Name En' :value="$agenda->name_en ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='name_ar' type='text' label='Name Ar' :value="$agenda->name_ar ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.textarea name='description_id' label='Description Id' :readonly="$showMode" :disabled="$showMode">{{ $agenda->description_id ?? '' }}</x-form.textarea>
        <x-form.textarea name='description_en' label='Description En' :readonly="$showMode" :disabled="$showMode">{{ $agenda->description_en ?? '' }}</x-form.textarea>
        <x-form.textarea name='description_ar' label='Description Ar' :readonly="$showMode" :disabled="$showMode">{{ $agenda->description_ar ?? '' }}</x-form.textarea>
        <x-form.input name='location_id' type='text' label='Location Id' :value="$agenda->location_id ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='location_en' type='text' label='Location En' :value="$agenda->location_en ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='location_ar' type='text' label='Location Ar' :value="$agenda->location_ar ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.datepicker name='start_date' label='Start Date' :value="$agenda->start_date ?? ''" :readonly="$showMode" :disabled="$showMode" required />
        <x-form.datepicker name='end_date' label='End Date' :value="$agenda->end_date ?? ''" :readonly="$showMode" :disabled="$showMode" />
