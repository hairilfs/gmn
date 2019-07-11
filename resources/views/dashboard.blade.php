@extends('layouts.app')

@section('nav_dashboard', 'active')

@section('head_css')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>
@endsection

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Hello!</h3>

      </div>
      <div class="box-body">
        Selamat datang {{ Auth::user()->name }}.
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <div class="row">
      <div class="col-md-6 col-xs-12">
        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Daily Report Performance Budget</h3>

          </div>
          <div class="box-body">
            {!! $pb_chart->render() !!}

            <h4 class="text-center">{{ $pb->client_name }}</h4>

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Nilai Kontrak</th>
                  <th>Performance Budget</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ number_format($pb->value) }}</td>
                  <td>{{ number_format($pb->performanceProgress()) }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          
          {{-- {{ $pb }} --}}
          {{-- {{ $pb->detail }} --}}
          <!-- /.box-body -->
        </div>
      </div>
    </div>
    
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection