<div class="btn-group">
	@if($row->status && $row->slug)
		<a href="{{ route('pages.show-marketing', $row->slug) }}" target="_blank" rel="noopener" class="btn btn-sm btn-info" title="Lihat di website"><i class="feather icon-eye"></i></a>
	@endif
	<a href="{{ route('pages.edit', $row->id) }}" class="btn btn-sm btn-primary"><i class="feather icon-edit"></i></a>
	<button type="button" class="btn btn-sm btn-danger" onclick="handleDelete('{{ route('pages.destroy', $row->id) }}')"><i class="feather icon-trash"></i></button>
</div>
