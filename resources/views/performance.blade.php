@extends('layouts.app')

@section('nav_pb', 'active')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Performance Budget
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">List of Performance Budget</h3>

      </div>
      <div class="box-body"> 
        <a href="{{ url('/performance_budget/add') }}" class="btn btn-primary btn-sm">Add new</a>
        <table class="table table-bordered">
          <tr>
            <th>No.</th>
            <th>Client Name</th>
            <th>Address</th>
            <th>Value</th>
          </tr>
          <tr>
            <td>1</td>
            <td>PT. KRAMAT JATI</td>
            <td>Jl. Gadung No. 23</td>
            <td>Rp. 20.000.000.000</td>
          </tr>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection