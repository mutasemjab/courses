@extends('layouts.admin')
@section('title')
Customer
@endsection


@section('content')

      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center"> Add New Customer   </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">


      <form action="{{ route('admin.customer.store') }}" method="post" >
        <div class="row">
        @csrf

<div class="col-md-6">
<div class="form-group">
  <label>  Name</label>
  <input name="name" id="name" class="form-control" value="{{ old('name') }}"    >
  @error('name')
  <span class="text-danger">{{ $message }}</span>
  @enderror
</div>
</div>




          <div class="col-md-6">
            <div class="form-group">
              <label>   email </label>
              <input name="email" id="name" class="form-control" value="{{ old('email') }}"    >
              @error('email')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                  <label>   password </label>
                  <input name="password" id="password" class="form-control" value="{{ old('password') }}"    >
                  @error('password')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>   phone</label>
              <input name="phone" id="notes" class="form-control" value="{{ old('phone') }}"    >
              @error('phone')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            </div>
              <div class="col-md-6">
            <div class="form-group">
              <label>   Mac Device ID</label>
              <input name="device_id" id="notes" class="form-control" value="{{ old('device_id') }}"    >
              @error('device_id')
              <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            </div>

<div class="col-md-6">
      <div class="form-group">
        <label>  activate</label>
        <select name="active" id="active" class="form-control">
         <option value=""> select</option>
        <option   @if(old('active')==1  || old('active')=="" ) selected="selected"  @endif value="1"> active</option>
         <option @if( (old('active')==0 and old('active')!="")) selected="selected"  @endif   value="0"> disactive</option>
        </select>
        @error('active')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
      </div>


      <div class="col-md-12">
      <div class="form-group text-center">
        <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm"> submit</button>
        <a href="{{ route('admin.customer.index') }}" class="btn btn-sm btn-danger">cancel</a>

      </div>
    </div>

  </div>
            </form>



            </div>




        </div>
      </div>






@endsection


@section('script')
<script src="{{ asset('assets/admin/js/customers.js') }}"></script>
@endsection






