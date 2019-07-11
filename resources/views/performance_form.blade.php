@extends('layouts.app')
@section('title', 'Performance Budget')
@section('nav_pb', 'active')

@section('head_css')
<link rel="stylesheet" href="assets/plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Performance Budget</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <form role="form" method="post">
                {{ csrf_field() }}
                <div class="col-md-8">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">New Performance Budget</h3>
                        </div>

                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="box-body">
                            <div class="form-group">
                                <label for="client_name">Client Name</label>
                                <input type="text" class="form-control" name="client_name" id="client_name" value="{{ $pb->client_name }}" placeholder="Enter name" >
                            </div>
                            <div class="form-group">
                                <label for="client_address">Client Address</label>
                                <textarea class="form-control" name="client_address" rows="3" id="client_address" placeholder="Enter client address" required>{{ $pb->client_address }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="job_title">Job Title</label>
                                <input type="text" class="form-control" id="job_title" name="job_title" value="{{ $pb->job_title }}" placeholder="Enter job title" required>
                            </div>
                            <div class="form-group">
                                <label for="contract_number">Contract Number</label>
                                <input type="text" class="form-control" id="contract_number" name="contract_number" value="{{ $pb->contract_number }}" placeholder="Enter contract number" required>
                            </div>

                            <div class="form-group">
                                <label for="contract_date">Contract Date</label>
                                <input type="text" class="form-control" id="contract_date" name="contract_date" value="{{ $pb->contract_date ? date('d-m-Y', strtotime($pb->contract_date)) : '' }}" placeholder="Enter contract date" required>
                            </div>

                            <!-- Date range -->
                            <div class="form-group">
                                <label>Waktu Pelaksanaan</label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="pelaksanaan" name="pelaksanaan" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="value">Value</label>
                                <input type="text" class="form-control" id="value" name="value" placeholder="Enter contract value" required>
                            </div>

                        </div>
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Action</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>

            </div>
        </form>
    </section>
</div>
@endsection

@section('bottom_script')
<script src="assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="assets/plugins/daterangepicker/moment.min.js"></script>
<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>

<script type="text/javascript">
    $('#contract_date').datepicker({
      autoclose: true,
      todayHighlight: true,
      format: 'dd-mm-yyyy',
    });

    $('#value').maskMoney({
        prefix: 'Rp ',
        thousands: '.',
        decimal: ',',
        precision: 0

    });
    
    $('#pelaksanaan').daterangepicker({
        "showDropdowns": true,
        "locale": {
            "format": "DD-MM-YYYY",
            "separator": " s.d. "            
        },
        "startDate": '{{ $pb->getStartDate() }}',
        "endDate": '{{ $pb->getEndDate() }}',
        "drops": "up"
    }, function(start, end, label) {
      console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
    });

    @if ($pb->value)
        $('#value').maskMoney('mask', {{ $pb->value }});
    @endif

</script>
@endsection