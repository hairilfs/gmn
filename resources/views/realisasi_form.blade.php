@extends('layouts.app')
@section('title', 'Realisasi')
@section('nav_realisasi', 'active')

@section('head_css')
<link rel="stylesheet" href="assets/plugins/datepicker/datepicker3.css">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Realisasi Performance Budget</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $pb->client_name }}</h3>
                    </div>

                    <div class="box-body">
                        <table class="">
                            <tr>
                                <th style="width: 100px">Alamat</th>
                                <td style="width: 10px">:</td>
                                <td>{{ $pb->client_address }}</td>
                            </tr>
                            <tr>
                                <th style="width: 100px">Pekerjaan</th>
                                <td style="width: 10px">:</td>
                                <td>{{ $pb->job_title }}</td>
                            </tr>
                            <tr>
                                <th style="width: 100px">No. Kontrak</th>
                                <td style="width: 10px">:</td>
                                <td>{{ $pb->contract_number }}</td>
                            </tr>
                            <tr>
                                <th style="width: 100px">Biaya</th>
                                <td style="width: 10px">:</td>
                                <td>{{ "Rp " . number_format($pb->value,0,',','.') }}</td>
                            </tr>
                        </table> <br>
                        <table class="table table-striped">
                            <tr>
                                <th class="">No.</th>
                                <th class="">Date</th>
                                <th class="">Info</th>
                                <th class="">Progress</th>
                                <th class="">Biaya</th>
                                <th class="">Saldo</th>
                            </tr>

                            <?php $saldo = $pb->value; $belanja = 0; $no = 1;?>
                            @foreach ($realisasi as $key => $element)
                                <?php 
                                    $saldo -= $element['jumlah']; 
                                    $belanja += $element['jumlah']; 
                                    $percent = ($belanja / $pb->value) * 100;
                                    $percent = number_format($percent, 2);

                                    if($percent <= 25.00) {
                                        $color = 'success';
                                    } else if($percent >= 25.01 && $percent <= 50.00) {
                                        $color = 'primary';
                                    } else if($percent >= 50.01 && $percent <= 75.00) {
                                        $color = 'warning';
                                    } else {
                                        $color = 'danger';
                                    }
                                ?>
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $element['date'] }}</td>
                                    <td>{{ $element['jenis'] == 'Advance Payment' ? 'Advance Payment: '.$element['detail'] : $element['detail'] }}</td>
                                    <td>
                                        <div class="progress progress-sm" title="{{ $percent }}%">
                                        <div class="progress-bar progress-bar-{{ $color }}" style="width: {{ $percent }}%"></div>
                                        </div>
                                    </td>
                                    <td>{{ "Rp " . number_format($element['jumlah'],0,',','.') }}</td>
                                    <td>{{ "Rp " . number_format($saldo,0,',','.') }}</td>
                                    {{-- <td><span class="badge bg-red">55%</span></td> --}}
                                </tr>

                                <?php $no++; ?>
                            @endforeach
                          </table>
                    </div>
                </div>
                <!-- /.box -->
            </div>

            <div class="col-md-2">
                <!-- general form elements -->
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Action</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-footer">
                        {{-- <button type="button" class="btn btn-success">Download</button> --}}
                        <a href="{{ url('realisasi/download/'.$pb->id) }}" class="btn btn-success">Download</a>
                    </div>
                </div>
                <!-- /.box -->
            </div>

        </div>
    </section>
</div>
@endsection

@section('bottom_script')
<script src="assets/plugins/datepicker/bootstrap-datepicker.js"></script>
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

</script>
@endsection