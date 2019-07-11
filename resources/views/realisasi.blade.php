@extends('layouts.app')
@section('title', 'Realisasi')
@section('nav_realisasi', 'active')

@section('head_css')
<link rel="stylesheet" type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Realisasi</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List of Performance Budget</h3>
            </div>

            <div class="box-body">
                <table class="table table-bordered" id="realisasi">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Client</th>
                            <th>Job Title</th>
                            <th>Contract Date</th>
                            <th>Value</th>
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
    $('#realisasi').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url("realisasi/datatables") }}',
        columns: [
            // { data: 'id', name: 'id' },
            { data: 'DT_Row_Index', orderable: false, searchable: false},
            { data: 'client_name', name: 'client_name' },
            { data: 'job_title', name: 'job_title' },
            { data: 'contract_date', name: 'contract_date' },
            { data: 'value', name: 'value' },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});

function confirmDelete(id, name) {
    if (confirm('Delete '+name+'?')) {
       window.location.href = '{{ url('realisasi/delete').'/' }}'+id;
    } else {
        return false;
    }
}
</script>
@endsection