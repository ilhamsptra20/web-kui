@props([
    'id' => 'ajax-datatables',
    'url',
    'columns',
    'order' => '[2, "asc"]',
    'filterIds' => [],
    'customScript'
])

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"/>
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>
        $(document).ready(function() {
            const table = $('#{{ $id }}').DataTable({
                serverSide: true,
                responsive: true,
                processing: true,
                ajax: {
                    url: '{{ $url }}',
                    data: function (d) {
                        // Ambil semua input filter secara otomatis
                        @foreach($filterIds as $filter)
                            d.{{ $filter }} = $('#filter-{{ $filter }}').val();
                        @endforeach
                    }
                },
                columns: @json($columns),
                order: @json($order),
                dom: 'Bfrtip',
                buttons: [
                    { extend: 'csvHtml5', title: 'Data Export', className: 'd-none', exportOptions: { columns: ':visible' } },
                    { extend: 'pdfHtml5', title: 'Data Export', orientation: 'portrait', className: 'd-none', exportOptions: { columns: ':visible' } }
                ],
            });

            // Filter Logic
            $('#apply-filters').click(() => {
                table.ajax.reload()
            });
            
            $('#reset-filters').click(() => {
                @foreach($filterIds as $filter)
                    $('#filter-{{ $filter }}').val('');
                @endforeach
                table.ajax.reload();
            });

            // Export Logic
            $('#export-csv').click(() => table.button(0).trigger());
            $('#export-pdf').click(() => table.button(1).trigger());

            @if(isset($customScript))
                {!! $customScript !!}
            @endif
        });
    </script>
@endpush