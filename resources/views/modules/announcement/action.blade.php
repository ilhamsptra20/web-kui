<div class="btn-group">
	<a href="{{ route('announcements.show', $row->id) }}" class="btn btn-sm btn-info"><i class="feather icon-eye"></i></a>
	<a href="{{ route('announcements.edit', $row->id) }}" class="btn btn-sm btn-primary"><i class="feather icon-edit"></i></a>
	<button type="button" class="btn btn-sm btn-danger" onclick="handleDelete('{{ route('announcements.destroy', $row->id) }}')"><i class="feather icon-trash"></i></button>
</div>