@extends('layouts.admin')
@section('title')
Course
@endsection


@section('content')

      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center"> Add New Course   </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">


      <form action="{{ route('admin.course.store') }}" method="post" >
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
        <a href="{{ route('admin.course.index') }}" class="btn btn-sm btn-danger">cancel</a>

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






