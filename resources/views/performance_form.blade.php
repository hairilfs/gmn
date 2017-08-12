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
        <div class="row">
        <form role="form">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">New Performance Budget</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                  <div class="box-body">
                    <div class="form-group">
                      <label for="client_name">Client Name</label>
                      <input type="text" class="form-control" name="client_name" id="client_name" placeholder="Enter name" required>
                    </div>
                    <div class="form-group">
                      <label for="client_address">Client Address</label>
                      <textarea class="form-control" name="client_address" rows="3" id="client_address" placeholder="Enter client address" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="job_title">Job Title</label>
                      <input type="text" class="form-control" id="job_title" name="job_title" placeholder="Enter job title" required>
                    </div>
                    <div class="form-group">
                      <label for="contract_number">Contract Number</label>
                      <input type="text" class="form-control" id="contract_number" name="contract_number" placeholder="Enter contract number" required>
                    </div>
                    
                    <div class="form-group">
                      <label for="contract_date">Contract Date</label>
                      <input type="text" class="form-control" id="contract_date" name="contract_date" placeholder="Enter contract number" required>
                    </div>

                    <div class="form-group">
                      <label for="value">Valur</label>
                      <input type="text" class="form-control" id="value" name="value" placeholder="Enter contract number" required>
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