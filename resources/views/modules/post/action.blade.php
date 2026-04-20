<div class="btn-group">
	@if($row->status === 'published' && $row->slug)
		<a href="{{ route('article.show-marketing', $row->slug) }}" target="_blank" rel="noopener" class="btn btn-sm btn-info" title="Lihat di website"><i class="feather icon-eye"></i></a>
	@endif
	<a href="{{ route('posts.edit', $row->id) }}" class="btn btn-sm btn-primary"><i class="feather icon-edit"></i></a>
	<button type="button" class="btn btn-sm btn-danger" onclick="handleDelete('{{ route('posts.destroy', $row->id) }}')"><i class="feather icon-trash"></i></button>
</div>
