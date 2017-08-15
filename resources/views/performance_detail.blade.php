@extends('layouts.app')

@section('nav_pb', 'active')

@section('head_css')
<link rel="stylesheet" type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Performance Budget - {{ $pb->client_name }}</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Job : {{ $pb->job_title }}</h3>
            </div>

            <div class="box-body"> 
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Add new</button>
                <table class="table table-bordered" id="performance_budget">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pekerjaan</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th>Total Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <form method="post" class="form-horizontal" id="new_detail">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Tambah Pekerjaan</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pekerjaan" class="col-sm-2 control-label">Pekerjaan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="qty" class="col-sm-2 control-label">Quantity</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="qty" name="qty" placeholder="Quantity" min="1" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="satuan" class="col-sm-2 control-label">Satuan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="satuan" name="satuan" placeholder="kg, unit, set, dll" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="harga" class="col-sm-2 control-label">Harga</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="harga" name="harga" placeholder="Rp 123.000.000" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>
                </div>
            </div>
        </div>
            
    </section>
</div>
@endsection

@section('bottom_script')
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>

<script>

$(function() {

    $('#performance_budget').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url("performance_budget/detail/datatables/".$pb->id) }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'pekerjaan', name: 'pekerjaan' },
            { data: 'qty', name: 'qty' },
            { data: 'satuan', name: 'satuan' },
            { data: 'harga', name: 'harga' },
            { data: 'total_harga', name: 'total_harga' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    $('#harga').maskMoney({
        prefix: 'Rp ',
        thousands: '.',
        decimal: ',',
        precision: 0

    });

    $('#new_detail').on('submit', function(){
        $(this).find('[type=submit]').html('Saving...');
    });

});

</script>
@endsection