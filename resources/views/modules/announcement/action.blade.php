<div class="btn-group">
	@if($row->is_active)
		<a href="{{ route('announcements.marketing.show', $row->id) }}" target="_blank" rel="noopener" class="btn btn-sm btn-info" title="Lihat di website"><i class="feather icon-eye"></i></a>
	@endif
	<a href="{{ route('announcements.edit', $row->id) }}" class="btn btn-sm btn-primary"><i class="feather icon-edit"></i></a>
	<button type="button" class="btn btn-sm btn-danger" onclick="handleDelete('{{ route('announcements.destroy', $row->id) }}')"><i class="feather icon-trash"></i></button>
</div>
