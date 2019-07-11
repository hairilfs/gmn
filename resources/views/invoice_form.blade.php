@extends('layouts.app')
@section('title', 'Invoice')
@section('nav_invoice', 'active')

@section('head_css')
<link rel="stylesheet" href="assets/plugins/datepicker/datepicker3.css">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Invoice</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <form role="form" method="post">
                {{ csrf_field() }}
                <div class="col-md-8">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ $invoice->id ? 'Edit' : 'New' }} Invoice</h3>
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
                                <label for="purchase_order_id">Purchase Order</label>
                                <select class="form-control" name="purchase_order_id" required>
                                    @foreach ($po as $element)
                                        <option data-nom="{{ $element->getNom()->total }}" value="{{ $element->id }}" {{ $element->id == $invoice->po_id ? 'selected' : '' }}>{{ $element->kepada }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="no_invoice">Nomor Invoice</label>
                                <input type="text" class="form-control" name="no_invoice" id="no_invoice" value="{{ $invoice->no_invoice }}" placeholder="Enter no invoice" >
                            </div>

                            <div class="form-group">
                                <label for="invoice_date">Invoice Date</label>
                                <input type="text" class="form-control" id="invoice_date" name="invoice_date" value="{{ $invoice->invoice_date ? date('d-m-Y', strtotime($invoice->invoice_date)) : date('d-m-Y') }}" placeholder="Enter date" required>
                            </div>

                            <div class="form-group">
                                <label for="nominal">Nominal</label>
                                <input type="text" class="form-control" name="nominal" id="nominal" value="{{ $invoice->nominal }}" placeholder="Enter nominal" required>
                            </div>  

                            <div class="form-group">
                                <label for="tipe">Jenis Invoice</label>
                                <div class="form-group">
                                  <div class="radio">
                                    <label>
                                      <input type="radio" name="tipe" value="0" required {{ $invoice->tipe == 0 ? 'checked' : '' }} {{ $invoice->id ? 'disabled' : '' }} >
                                      Invoice Uang Muka
                                    </label>
                                  </div>
                                  <div class="radio">
                                    <label>
                                      <input type="radio" name="tipe" value="1" required {{ $invoice->tipe == 1 ? 'checked' : '' }} {{ $invoice->id ? 'disabled' : '' }}>
                                      Invoice Pelunasan
                                    </label>
                                  </div>
                                </div>
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

    $('select[name=purchase_order_id]').on('change', function(){
        var _id = $(this).val();
        $('#nominal').val('').attr('placeholder', 'Loading...');
        $.get('invoice/nom/'+_id, function(resp){
            console.log(resp);
            $('#nominal').maskMoney('mask', resp);
        }, 'json');
    });

    $('#invoice_date').datepicker({
      autoclose: true,
      todayHighlight: true,
      format: 'dd-mm-yyyy',
    });

    $('#nominal').maskMoney({
        prefix: 'Rp ',
        thousands: '.',
        decimal: ',',
        precision: 0

    });

    @if ($invoice->nominal)
        $('#nominal').maskMoney('mask', {{ $invoice->nominal }});
    @endif
</script>
@endsection