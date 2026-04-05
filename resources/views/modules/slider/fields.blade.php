@php $showMode = $showMode ?? false; @endphp

        <x-form.input name='subtitle_id' type='text' label='Subtitle Id' :value="$slider->subtitle_id ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='subtitle_en' type='text' label='Subtitle En' :value="$slider->subtitle_en ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='subtitle_ar' type='text' label='Subtitle Ar' :value="$slider->subtitle_ar ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='title_id' type='text' label='Title Id' :value="$slider->title_id ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='title_en' type='text' label='Title En' :value="$slider->title_en ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='title_ar' type='text' label='Title Ar' :value="$slider->title_ar ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='description_id' type='text' label='Description Id' :value="$slider->description_id ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='description_en' type='text' label='Description En' :value="$slider->description_en ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='description_ar' type='text' label='Description Ar' :value="$slider->description_ar ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='btn_text_id' type='text' label='Btn Text Id' :value="$slider->btn_text_id ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='btn_text_en' type='text' label='Btn Text En' :value="$slider->btn_text_en ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='btn_text_ar' type='text' label='Btn Text Ar' :value="$slider->btn_text_ar ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.input name='btn_url' type='text' label='Btn Url' :value="$slider->btn_url ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.photo-upload label='Image' name='image' :value="$slider->image ?? null" :readonly="$showMode" required />
        <x-form.input name='order' type='number' label='Order' :value="$slider->order ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
