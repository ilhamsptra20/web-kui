@php $showMode = $showMode ?? false; @endphp

        <x-form.input name='name' type='text' label='Name' :value="$inbox->name ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
        <x-form.input name='email' type='text' label='Email' :value="$inbox->email ?? ''" :readonly="$showMode" :disabled="$showMode" required floating divider />
        <x-form.input name='subject' type='text' label='Subject' :value="$inbox->subject ?? ''" :readonly="$showMode" :disabled="$showMode" floating divider />
        <x-form.textarea name='message' label='Message' :readonly="$showMode" :disabled="$showMode" required>{{ $inbox->message ?? '' }}</x-form.textarea>
        <x-form.switch name='is_read' label='Is Read' :checked="old('is_read', $inbox->is_read ?? false)" :disabled="$showMode" />
