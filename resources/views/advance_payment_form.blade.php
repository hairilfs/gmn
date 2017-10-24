@extends('layouts.app')

@section('nav_ap', 'active')

@section('head_css')
<link rel="stylesheet" href="assets/plugins/datepicker/datepicker3.css">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Advance Payment</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <form role="form" method="post">
                {{ csrf_field() }}
                <div class="col-md-8">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ $advance_payment->id ? 'Edit' : 'New' }} Advance Payment</h3>
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
                                <label for="pb_id">Performance Budget</label>
                                <select class="form-control" name="pb_id" required>
                                    <option value="" selected>-- Select performance budget --</option>
                                    @foreach ($pb as $element)
                                        <option value="{{ $element->id }}" {{ $element->id == $advance_payment->pb_id ? 'selected' : '' }}>{{ $element->client_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nip">No. Pegawai</label>
                                <input type="text" class="form-control" name="nip" id="nip" value="{{ $advance_payment->nip }}" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Pegawai</label>
                                <input type="text" class="form-control" name="nama" id="nama" value="{{ $advance_payment->nama }}" required>
                            </div>
                            <div class="form-group">
                                <label for="request">Jumlah Permohonan</label>
                                <input type="text" class="form-control" name="request" id="request" value="{{ $advance_payment->request }}" required>
                            </div>  
                            <div class="form-group">
                                <label for="request_date">Tanggal Permohonan</label>
                                <input type="text" data-date-end-date="0d" class="form-control" id="request_date" name="request_date" value="{{ $advance_payment->request_date ? date('d-m-Y', strtotime($advance_payment->advance_payment_date)) : date('d-m-Y') }}" required>
                            </div>  
                            <div class="form-group">
                                <label for="request_note">Keterangan Permohonan</label>
                                <textarea name="request_note" id="request_note" class="form-control">{{ $advance_payment->request_note }}</textarea>
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
                            <button type="submit" class="btn btn-primary">Save</button>
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
<script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>

<script type="text/javascript">

    $('#request_date').datepicker({
      autoclose: true,
      todayHighlight: true,
      format: 'dd-mm-yyyy',
    });

    $('#request').maskMoney({
        prefix: 'Rp ',
        thousands: '.',
        decimal: ',',
        precision: 0

    });

    @if ($advance_payment->request)
        $('#request').maskMoney('mask', {{ $advance_payment->request }});
    @endif
</script>
@endsection