@extends('layouts.app')

@section('nav_po', 'active')

@section('head_css')
{{-- <link rel="stylesheet" href="assets/plugins/datepicker/datepicker3.css"> --}}
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Purchase Order</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <form role="form" method="post">
                {{ csrf_field() }}
                <div class="col-md-8">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ $po->id ? 'Edit' : 'New' }} Purchase Order</h3>
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
                                <label for="performance_budget_id">Performance Budget</label>
                                <select class="form-control" name="performance_budget_id" required>
                                    @foreach ($pb as $element)
                                        <option value="{{ $element->id }}" {{ $element->id == $po->performance_budget_id ? 'selected' : '' }}>{{ $element->client_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="purchase_order_no">Nomor Purchase Order</label>
                                <input type="text" class="form-control" name="purchase_order_no" id="purchase_order_no" value="{{ $po->purchase_order_no }}" placeholder="Enter name" >
                            </div>
                            <div class="form-group">
                                <label for="kepada">Kepada</label>
                                <input type="text" class="form-control" name="kepada" id="kepada" value="{{ $po->kepada }}" placeholder="Enter name" >
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea class="form-control" name="address" placeholder="Alamat">{{ $po->address }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone / Fax.</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $po->phone }}" placeholder="Phone / Fax." required>
                            </div>

                            <div class="form-group">
                                <label for="person">C/P</label>
                                <input type="text" class="form-control" id="person" name="person" value="{{ $po->person }}" placeholder="C/P" required>
                            </div>

                            <div class="form-group">
                                <label for="position">Position</label>
                                <input type="text" class="form-control" id="position" name="position" value="{{ $po->position }}" placeholder="Manager, Administrator, dll." required>
                            </div>

                            <div class="form-group">
                                <label for="pembayaran">Pembayaran</label>
                                <textarea class="form-control" name="pembayaran" placeholder="Pembayaran">{{ $po->pembayaran }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="pengiriman">Pengiriman</label>
                                <textarea class="form-control" name="pengiriman" placeholder="Pengiriman">{{ $po->pengiriman }}</textarea>
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
{{-- <script src="assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script> --}}

<script type="text/javascript">


</script>
@endsection