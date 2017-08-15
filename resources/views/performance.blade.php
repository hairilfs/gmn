@extends('layouts.app')

@section('nav_pb', 'active')

@section('head_css')
<link rel="stylesheet" type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Performance Budget</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">List of Performance Budget</h3>
            </div>

            <div class="box-body"> 
                <a href="{{ url('/performance_budget/add') }}" class="btn btn-primary btn-sm">Add new</a>
                <table class="table table-bordered" id="performance_budget">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Job Title</th>
                            <th>Contract Date</th>
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
    $('#performance_budget').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url("performance_budget/datatables") }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'client_name', name: 'client_name' },
            { data: 'job_title', name: 'job_title' },
            { data: 'contract_date', name: 'contract_date' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});

</script>
@endsection