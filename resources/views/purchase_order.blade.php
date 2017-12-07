@extends('layouts.app')

@section('nav_po', 'active')

@section('head_css')
<link rel="stylesheet" type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Purchase Order</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List of Purchase Order</h3>
            </div>

            <div class="box-body"> 
                <div class="text-center">
                    <a href="{{ url('purchase_order/add') }}" class="btn btn-primary btn-sm">Add new</a>
                </div>
                <table class="table table-bordered" id="purchase_order">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kepada</th>
                            <th>C/P</th>
                            <th>Perf. Budget</th>
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
    $('#purchase_order').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url("purchase_order/datatables") }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'kepada', name: 'kepada' },
            { data: 'person', name: 'person' },
            { data: 'pb', name: 'pb' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});

function confirmDelete(id, name) {
    if (confirm('Delete '+name+'?')) {
       window.location.href = '{{ url('performance_budget/delete').'/' }}'+id;
    } else {
        return false;
    }
}
</script>
@endsection