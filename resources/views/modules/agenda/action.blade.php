<div class="btn-group">
	<a href="{{ route('agendas.show', $row->id) }}" class="btn btn-sm btn-info"><i class="feather icon-eye"></i></a>
	<a href="{{ route('agendas.edit', $row->id) }}" class="btn btn-sm btn-primary"><i class="feather icon-edit"></i></a>
	<button type="button" class="btn btn-sm btn-danger" onclick="handleDelete('{{ route('agendas.destroy', $row->id) }}')"><i class="feather icon-trash"></i></button>
</div>