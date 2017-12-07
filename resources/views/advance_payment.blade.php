@extends('layouts.app')

@section('nav_ap', 'active')

@section('head_css')
<link rel="stylesheet" type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Advance Payment</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List of Advance Payment</h3>
            </div>

            <div class="box-body">
                <div class="text-center">
                    <a href="{{ url('advance_payment/add') }}" class="btn btn-primary btn-sm">Add new</a>
                </div>
                <table class="table table-bordered" id="advance_payment">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pegawai</th>
                            <th>Nominal</th>
                            <th>Tgl.</th>
                            <th>Keterangan</th>
                            <th>Status</th>
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
    $('#advance_payment').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url("advance_payment/datatables") }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nama', name: 'nama' },
            { data: 'request', name: 'request' },
            { data: 'request_date', name: 'request_date' },
            { data: 'request_note', name: 'request_note' },
            { data: 'status', name: 'status' },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});

function confirmDelete(id, name) {
    if (confirm('Delete '+name+'?')) {
       window.location.href = '{{ url('advance_payment/delete').'/' }}'+id;
    } else {
        return false;
    }
}
</script>
@endsection