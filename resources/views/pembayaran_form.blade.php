@extends('layouts.app')
@section('title', 'Pembayaran')
@section('nav_pembayaran', 'active')

@section('head_css')
<link rel="stylesheet" href="assets/plugins/datepicker/datepicker3.css">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Pembayaran</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <form role="form" method="post">
                {{ csrf_field() }}
                <div class="col-md-8">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ $pembayaran->id ? 'Edit' : 'New' }} Pembayaran</h3>
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
                                <label for="jenis">Jenis Pembayaran</label>
                                <select class="form-control" name="jenis" required>
                                    <option value="Barang" {{ $pembayaran->jenis == 'Barang' ? 'selected' : '' }}>Barang</option>
                                    <option value="Jasa" {{ $pembayaran->jenis == 'Jasa' ? 'selected' : '' }}>Jasa</option>
                                    <option value="Lain-lain" {{ $pembayaran->jenis == 'Lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                                </select>
                            </div>

                            <div class="form-group" id="invoice_form" {!! $pembayaran->jenis != 'Barang' && $pembayaran->id ? 'style="display: none;"' : '' !!}>
                                <label for="invoice_id">No. Invoice</label>
                                <select class="form-control" name="invoice_id" {!! $pembayaran->jenis == 'Barang' || !$pembayaran->id  ? 'required' : '' !!}>
                                    <option value="" selected>-- Select invoice --</option>
                                    @foreach ($invoice as $element)
                                        <option value="{{ $element->id }}" {{ $element->id == $pembayaran->invoice_id ? 'selected' : '' }}>{{ $element->getDetail() }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" id="pb_form" {!! $pembayaran->jenis == 'Barang' || !$pembayaran->id ? 'style="display: none;"' : '' !!}>
                                <label for="pb_id">Performance Budget</label>
                                <select class="form-control" name="pb_id" {!! $pembayaran->jenis != 'Barang' && $pembayaran->id  ? 'required' : '' !!}>
                                    <option value="" selected>-- Select performance budget --</option>
                                    @foreach ($pb as $element)
                                        <option value="{{ $element->id }}" {{ $element->id == $pembayaran->pb_id ? 'selected' : '' }}>{{ $element->client_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="pembayaran_date">Tanggal Pembayaran</label>
                                <input type="text" class="form-control" id="pembayaran_date" name="pembayaran_date" value="{{ $pembayaran->pembayaran_date ? date('d-m-Y', strtotime($pembayaran->pembayaran_date)) : date('d-m-Y') }}" placeholder="Enter date" required>
                            </div>

                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="text" class="form-control" name="jumlah" id="jumlah" value="{{ $pembayaran->jumlah }}" placeholder="Enter nominal" required>
                            </div>  

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" name="keterangan">{{ $pembayaran->keterangan }}</textarea>
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

    $('#pembayaran_date').datepicker({
      autoclose: true,
      todayHighlight: true,
      format: 'dd-mm-yyyy',
    });

    $('#jumlah').maskMoney({
        prefix: 'Rp ',
        thousands: '.',
        decimal: ',',
        precision: 0

    });
    
    @if ($pembayaran->jumlah)
        $('#jumlah').maskMoney('mask', {{ $pembayaran->jumlah }});
    @endif

    $('select[name=jenis]').on('change', function(){
        var _val = $(this).val();

        if (_val == 'Barang') {
            $('textarea[name=keterangan]').prop('required', false);            
            $('select[name=invoice_id]').prop('required', true);
            $('select[name=pb_id]').prop('required', false);
            $('#invoice_form').show();        
            $('#pb_form').hide();        
        } else {
            $('textarea[name=keterangan]').prop('required', true);
            $('select[name=invoice_id]').val('').prop('required', false);
            $('select[name=pb_id]').prop('required', true);
            $('#invoice_form').hide();
            $('#pb_form').show();        
        }
    });

</script>
@endsection