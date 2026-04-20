<div class="btn-group">
	<a href="{{ route('relations.edit', $row->id) }}" class="btn btn-sm btn-primary"><i class="feather icon-edit"></i></a>
	<button type="button" class="btn btn-sm btn-danger" onclick="handleDelete('{{ route('relations.destroy', $row->id) }}')"><i class="feather icon-trash"></i></button>
</div>
