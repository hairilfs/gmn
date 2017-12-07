@extends('layouts.app')

@section('nav_invoice', 'active')

@section('head_css')
<link rel="stylesheet" type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Invoice</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List of Invoice</h3>
            </div>

            <div class="box-body"> 
                <div class="text-center">
                    <a href="{{ url('invoice/add') }}" class="btn btn-primary btn-sm">Add new</a>
                </div>
                <table class="table table-bordered" id="invoice">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>No Invoice</th>
                            <th>PO</th>
                            <th>Tipe</th>
                            <th>Nominal</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>

</div>
@endsection

@section('bottom_script')
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>

$(function() {
    $('#invoice').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url("invoice/datatables") }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'no_invoice', name: 'no_invoice' },
            { data: 'po_id', name: 'po_id' },
            { data: 'tipe', name: 'tipe' },
            { data: 'nominal', name: 'nominal' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});

function confirmDelete(id, name) {
    if (confirm('Delete '+name+'?')) {
       window.location.href = '{{ url('invoice/delete').'/' }}'+id;
    } else {
        return false;
    }
}
</script>
@endsection