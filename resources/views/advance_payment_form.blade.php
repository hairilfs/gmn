@extends('layouts.app')
@section('title', 'Advance Payment')
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
                                <input type="text" class="form-control money" name="request" id="request" value="{{ $advance_payment->request }}" required>
                            </div>  
                            <div class="form-group">
                                <label for="request_date">Tanggal Permohonan</label>
                                <input type="text" data-date-end-date="0d" class="form-control datepick" id="request_date" name="request_date" value="{{ $advance_payment->request_date ? date('d-m-Y', strtotime($advance_payment->request_date)) : date('d-m-Y') }}" required>
                            </div>  
                            <div class="form-group">
                                <label for="request_note">Keterangan Permohonan</label>
                                <textarea name="request_note" id="request_note" class="form-control">{{ $advance_payment->request_note }}</textarea>
                            </div>                        
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
            </form>
            <form role="form" method="post" id="form_confirm" action="advance_payment/confirm/{{ $advance_payment->id }}">
                {{ csrf_field() }}
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Confirm</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="confirm_date">Tanggal Konfirmasi</label>
                                <input type="text" data-date-end-date="0d" class="form-control datepick" id="confirm_date" name="confirm_date" value="{{ $advance_payment->confirm_date ? date('d-m-Y', strtotime($advance_payment->confirm_date)) : date('d-m-Y') }}" required>
                            </div>  
                            <div class="form-group">
                                <label for="confirm">Jumlah Konfirmasi</label>
                                <input type="text" class="form-control money" name="confirm" id="confirm" value="{{ $advance_payment->confirm }}" required>
                            </div>  
                            <div class="form-group">
                                <label for="confirm_note">Keterangan Konfirmasi</label>
                                <textarea name="confirm_note" id="confirm_note" class="form-control">{{ $advance_payment->confirm_note }}</textarea>
                            </div>                        
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-warning">Confirm</button>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
            </form>

            </div>
    </section>
</div>
@endsection

@section('bottom_script')
<script src="assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>

<script type="text/javascript">

    $('.datepick').datepicker({
      autoclose: true,
      todayHighlight: true,
      format: 'dd-mm-yyyy',
    });

    $('.money').maskMoney({
        prefix: 'Rp ',
        thousands: '.',
        decimal: ',',
        precision: 0

    });

    @if ($advance_payment->request)
        $('#request').maskMoney('mask', {{ $advance_payment->request }});
    @endif

    @if ($advance_payment->id && $advance_payment->confirm )
        $('#confirm').maskMoney('mask', {{ $advance_payment->confirm }});
        $("#form_confirm :input").prop("disabled", true);
    @elseif($advance_payment->id && !$advance_payment->confirm)
        $('#confirm').maskMoney('mask', {{ $advance_payment->confirm }});
    @else 
        $("#form_confirm :input").prop("disabled", true);
    @endif

    $('#form_confirm').on('submit', function(e){

        var x = confirm('Yakin akan konfirmasi Advance Payment ini?');
        if(x) {
            return true;
        } else {
            e.preventDefault();
            return false;
        }
    });
</script>
@endsection