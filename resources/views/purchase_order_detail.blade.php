@extends('layouts.app')
@section('title', 'Purchase Order Detail')
@section('nav_po', 'active')

@section('head_css')
{{-- <link rel="stylesheet" href="assets/plugins/datepicker/datepicker3.css"> --}}

<style type="text/css">
    .kanan {
        text-align: right;
    }
</style>
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
            <div class="col-md-8">
                <div class="box box-default">
                    <div class="box-header">
                        <h3 class="box-title">List Purchase Order Detail</h3>
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
                        <table class="table table-condensed table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Qty</th>
                                <th>Unit</th>
                                <th>Uraian</th>
                                <th>Harga Satuan (Rp)</th>
                                <th>Total (Rp)</th>
                            </tr>
                            

                            @if ( count($po->po_detail) )
                                <?php $total_aja = 0; ?>                            
                                @foreach ($po->po_detail as $element)

                                    <?php 
                                        $total_row = $element->harga * $element->qty;
                                        $total_aja += $total_row;
                                    ?>

                                    <tr>
                                        <td>
                                            <a href="{{ url('purchase_order/detail/edit/'.$po->id.'/'.$element->id) }}" class="btn btn-xs btn-info" title="Edit"><i class="fa fa-pencil fa-fw"></i></a><br>
                                            <a href="javascript:void(0)" class="btn btn-xs btn-danger" onclick="return confirmDelete({{ $element->id }}, '{{ $element->shortUraian() }}');" title="Delete"><i class="fa fa-close fa-fw"></i></a>
                                        </td>
                                        <td>{{ $element->qty }}</td>
                                        <td>{{ $element->unit }}</td>
                                        <td>{!! $element->uraian !!}</td>
                                        <td class="kanan">{{ number_format($element->harga,0,',','.') }}</td>
                                        <td class="kanan">{{ number_format($total_row,0,',','.') }}</td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="4"></td>
                                    <th>Total (Rp)</th>
                                    <td class="kanan">{{ number_format($total_aja,0,',','.') }}</td>
                                </tr>

                                <?php 
                                    $ppn = $total_aja * 0.10; // PPN 10%
                                    $grand_total = $total_aja + $ppn; // Setelah ditambah PPN
                                ?>
                                <tr>
                                    <td colspan="4"></td>
                                    <th>PPN 10% (Rp)</th>
                                    <td class="kanan">{{ number_format($ppn,0,',','.') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <th>Grand Total (Rp)</th>
                                    <td class="kanan">{{ number_format($grand_total,0,',','.') }}</td>
                                </tr>
                            @endif

                        </table>
                    </div>
                </div>

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $po_detail->id ? 'Edit' : 'Add' }} Purchase Order Detail</h3>
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

                    <form class="form-horizontal" method="post" id="form_po_detail">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="qty" class="col-sm-2 control-label">Qty</label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" id="qty" name="qty" min="1" value="{{ $po_detail->qty }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="unit" class="col-sm-2 control-label">Unit</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="unit" name="unit" value="{{ $po_detail->unit }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="uraian" class="col-sm-2 control-label">Uraian</label>
                                <div class="col-sm-10">
                                    <textarea id="editor1" name="uraian" required>{{ $po_detail->uraian }}</textarea>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="harga" class="col-sm-2 control-label">Harga Satuan</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="harga" name="harga" required>
                                </div>
                            </div>
                        </div>  

                        @if ($po_detail->id)
                            <input type="hidden" name="edit" value="{{ $po_detail->id }}">
                        @endif

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Save</button>
                        </div>

                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <!-- general form elements -->
                <div class="box box-default">
                    <div class="box-header">
                        <h3 class="box-title">Data Purchase Order</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-condensed table-hover">
                            <tr>
                                <th>No. PO</th>
                                <td>{{ $po->purchase_order_no }}</td>
                            </tr>
                            <tr>
                                <th>Kepada</th>
                                <td>{!! $po->kepada.'<br/>'.$po->address !!}</td>
                            </tr>
                            <tr>
                                <th>Phone / Fax.</th>
                                <td>{{ $po->phone }}</td>
                            </tr>
                            <tr>
                                <th>Contact Person</th>
                                <td>{!! $po->person.'<br/>'.$po->position !!}</td>
                            </tr>
                            <tr>
                                <th>Pembayaran</th>
                                <td>{{ $po->pembayaran }}</td>
                            </tr>
                            <tr>
                                <th>Pengiriman</th>
                                <td>{{ $po->pengiriman }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="box-footer">
                        <a href="{{ url('purchase_order/edit/'.$po->id)}}" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                        {{-- <a href="{{ url('purchase_order/detail/export/'.$po->id) }}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export</a> --}}
                    </div>
                </div>
                <!-- /.box -->
            </div>

        </div>
    </section>
</div>
@endsection

@section('bottom_script')
{{-- <script src="assets/plugins/datepicker/bootstrap-datepicker.js"></script> --}}
<script src="https://cdn.rawgit.com/plentz/jquery-maskmoney/master/dist/jquery.maskMoney.min.js"></script>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>

<script type="text/javascript">
    $(function () {
        CKEDITOR.config.toolbar = [
           ['Bold','Italic','Underline','-','Undo','Redo','-','Cut','Copy','Paste'],//'-','Outdent','Indent'],           
           ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
           // ['Source']
        ] ;
        CKEDITOR.replace('editor1');

        $('#harga').maskMoney({
            prefix: 'Rp ',
            thousands: '.',
            decimal: ',',
            precision: 0

        });
        
    });

    $(window).load(function(){
        @if ($po_detail->id)
            $('html, body').animate({
                scrollTop: $("#form_po_detail").offset().top
            }, 1000);

            $('#harga').maskMoney('mask', {{ $po_detail->harga }});
        @endif
    });

    function confirmDelete(id, name) {
        if (confirm('Delete '+name+'?')) {
           window.location.href = '{{ url('purchase_order/detail/delete').'/' }}'+id;
        } else {
            return false;
        }
    }

</script>
@endsection