@extends('layouts.app')

@section('content')
<div class='card'>
    <div class='card-header'>
        <h4 class='card-title'>Slider</h4>
        <a href='{{ route('sliders.create') }}' class='btn btn-primary'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table' id='slider-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Link</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='slider-table' :url="route('sliders.list')" :columns="[['data'=>'DT_RowIndex'],['data'=>'link'],['data'=>'action']]" :order="[1, 'asc']" />
@endsection