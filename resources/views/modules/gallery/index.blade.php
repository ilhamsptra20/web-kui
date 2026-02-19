@extends('layouts.app')

@section('content')
<div class='card'>
    <div class='card-header'>
        <h4 class='card-title'>Gallery</h4>
        <a href='{{ route('galleries.create') }}' class='btn btn-primary'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table' id='gallery-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Album Id</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='gallery-table' :url="route('galleries.list')" :columns="[['data'=>'DT_RowIndex'],['data'=>'album_id'],['data'=>'action']]" :order="[1, 'asc']" />
@endsection