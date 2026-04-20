<div class="btn-group">
    <a href="{{ route('users.edit', $row->id) }}" class="btn btn-sm btn-primary"><i class="feather icon-edit"></i></a>
    @if((int) auth()->id() !== (int) $row->id)
        <button type="button" class="btn btn-sm btn-danger" onclick="handleDelete('{{ route('users.destroy', $row->id) }}')"><i class="feather icon-trash"></i></button>
    @endif
</div>
