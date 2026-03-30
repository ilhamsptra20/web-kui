<div class="btn-group">
	<a href="{{ route('lembagas.edit', $row->id) }}" class="btn btn-sm btn-primary">
		<i class="feather icon-edit"></i>
	</a>
	<button type="button" class="btn btn-sm btn-danger" onclick="handleDelete('{{ route('lembagas.destroy', $row->id) }}')">
		<i class="feather icon-trash"></i>
	</button>
</div>