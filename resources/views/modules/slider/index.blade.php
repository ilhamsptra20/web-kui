@extends('layouts.app')
@section('title', 'Daftar Slider')

@section('content')
<div class='card border-0 shadow-sm'>
    <div class='card-header d-flex flex-column flex-lg-row align-items-lg-center justify-content-between'>
        <div>
            <h4 class='card-title mb-25'>Manage Sliders</h4>
            <p class='text-muted mb-0'>Atur visual hero, teks pendukung, CTA, dan urutan tampil slider beranda.</p>
        </div>
        <a href='{{ route('sliders.create') }}' class='btn btn-primary mt-1 mt-lg-0'>Add New</a>
    </div>
    <div class='card-body'>
        <div class='table-responsive'>
            <table class='table table-hover align-middle' id='slider-table'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Slider</th>
                        <th>CTA</th>
                        <th>Order</th>
                        <th>Updated</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<x-table.datatable-script id='slider-table' :url="route('sliders.list')" :columns="[['data'=>'DT_RowIndex','orderable'=>false,'searchable'=>false],['data'=>'slider_identity','name'=>'title_id'],['data'=>'cta_label','name'=>'btn_text_id'],['data'=>'order_label','name'=>'order'],['data'=>'updated_at_label','name'=>'updated_at'],['data'=>'action','orderable'=>false,'searchable'=>false]]" :order="[[3, 'asc']]" />
@endsection
