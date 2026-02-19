@extends('layouts.app')

@section('content')
<div class='card'>
    <div class='card-header'>
        <h4 class='card-title'>Category</h4>
        <a href='{{ route('categories.create') }}' class='btn btn-primary'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table' id='category-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='category-table' :url="route('categories.list')" :columns="[['data'=>'DT_RowIndex'],['data'=>'title'],['data'=>'action']]" :order="[1, 'asc']" />
@endsection