@extends('public_view.main')
@section('page-title','New : Technical Clearance')
@section('content')
<div class="card">
  <div class="card-header bg-success">
    <h4 class="card-title">Technical Clearance Registration</h4>
  </div>
  <form action="{{ url('new-license/store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="" >Name<span class="text-danger"> *</span></label>
                <input type="text" class="form-control required" name="name" autocomplete="off">
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">CID No.<span class="text-danger"> *</span></label>
                <input type="text" class="form-control required" name="cid" id="cid" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Proposed location for construction.<span class="text-danger"> *</span></label>
                <input type="text" class="form-control required" name="location" autocomplete="off" >
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Dzongkhag<span class="text-danger"> *</span></label>
                <select  name="dzongkhag" class="form-control select2bs4 required">
                  <option value="" selected="selected"></option>
                  <option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
              </div>                                       
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Gewog<span class="text-danger"> *</span></label>
                <select  name="gewog" class="form-control custom-select required">
                  <option value="">-Select-</option>
                </select>                                        
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group ">
                <label for="">Thromde<span class="text-danger"> *</span></label>
                <input type="text" class="form-control required" name="thromde" autocomplete="off" >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Contact No.<span class="text-danger"> *</span></label>
                <input type="email" name="gewog" class="form-control required" autocomplete="off">
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">No of rooms proposed<span class="text-danger"> *</span></label>
                <input type="text" class="form-control required" name="no_of_rooms" autocomplete="off" >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Tentative construction<span class="text-danger"> *</span> </label>
                <input type="email" name="construction" class="form-control required" autocomplete="off">
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Tentative completion of the construction<span class="text-danger"> *</span></label>
                <input type="text" class="form-control required" name="completion" autocomplete="off" >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label for="">Drawing submission date<span class="text-danger"> *</span></label>
                <input type="text" class="form-control required" name="validity" autocomplete="off" >
              </div>
            </div>
            <div class="col-md-5 offset-md-2">
              <div class="form-group">
                <label for="">Email<span class="text-danger"> *</span></label>
                <input type="email" name="email" class="form-control required" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="">Note:</label>
                <span>Please kindly submit architectural drawing (soft copy) to <a href="ipdd@tourism.gov.bt">ipdd@tourism.gov.bt</a><span>                                    
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="card-footer text-center">
        <button type="submit" class="btn btn-success"><li class="fas fa-check"></li> APPLY</button>
        <button type="reset" class="btn btn-danger"><li class="fas fa-times"></li> RESET</button>
      </div>
    </form>
  </div>
  @endsection







