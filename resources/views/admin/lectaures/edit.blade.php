@extends('layouts.admin')
@section('title')

edit lectaure
@endsection



@section('contentheaderlink')
<a href="{{ route('admin.lectaure.index') }}">  lectaure </a>
@endsection

@section('contentheaderactive')
Edit
@endsection


@section('content')

      <div class="card">
        <div class="card-header">
          <h3 class="card-title card_title_center"> edit lectaure </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">


      <form action="{{ route('admin.lectaure.update',$data['id']) }}" method="post" >
        <div class="row">
        @csrf

        <div class="form-group col-md-6">
            <label for="courses">Course Name <span class="text-danger">*</span></label>
            <select class="form-control" name="course" id="course">
                <option disabled>Select Course</option>
                @foreach($courses as $course)
                    <option value="{{$course->id}}">{{$course->name}}</option>
                @endforeach
            </select>
        </div>

<div class="col-md-6">
<div class="form-group">
  <label>name</label>
  <input name="name" id="name" class="form-control" value="{{ old('name',$data['name']) }}"    >
  @error('name')
  <span class="text-danger">{{ $message }}</span>
  @enderror
</div>
</div>

<div class="col-md-6">

    <div class="form-group mt-0" id="multi_file">
        <label for="mobile">video</label>
        <input type="file"
            class="form-control @if ($errors->has('video_lectaure')) is-invalid @endif"
            id="video_lectaure" placeholder="" name="video_lectaure[]">
        <div class="text-end">
            <i class="fa fa-plus-circle" id="add_button" style="width: 200px"></i>
        </div>

        @if ($errors->has('video_lectaure'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('video_lectaure') }}</strong>
            </span>
        @endif
    </div>

</div>

<div class="col-md-6">

    <div class="form-group mt-0" id="multi_file_file">
        <label for="mobile">Files</label>
        <input type="file"
            class="form-control @if ($errors->has('data_lectaure')) is-invalid @endif"
            id="data_lectaure" placeholder="" name="data_lectaure[]">
        <div class="text-end">
            <i class="fa fa-plus-circle" id="add_button_file" style="width: 200px"></i>
        </div>

        @if ($errors->has('data_lectaure'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('data_lectaure') }}</strong>
            </span>
        @endif
    </div>

</div>



<div class="col-md-6">
      <div class="form-group">
        <label>   active</label>
        <select name="active" id="active" class="form-control">
         <option value="">select </option>
        <option {{  old('active',$data['active'])==1 ? 'selected' : ''}}  value="1"> active</option>
         <option {{  old('active',$data['active'])==0 ? 'selected' : ''}}   value="0"> disactive</option>
        </select>
        @error('is_archived')
        <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
      </div>


      <div class="col-md-12">
      <div class="form-group text-center">
        <button id="do_add_item_cardd" type="submit" class="btn btn-primary btn-sm"> update</button>
        <a href="{{ route('admin.lectaure.index') }}" class="btn btn-sm btn-danger">cancel</a>

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
<script>
    $('#add_button').click(function() {
        $('#multi_file').append(
            '<input type="file" class="form-control @if ($errors->has('video_lectaure')) is-invalid @endif" id="img_salad" placeholder="" name="video_lectaure[]">'
        )
    })
</script>
<script>
    $('#add_button_file').click(function() {
        $('#multi_file_file').append(
            '<input type="file" class="form-control @if ($errors->has('data_lectaure')) is-invalid @endif" id="img_salad" placeholder="" name="data_lectaure[]">'
        )
    })

</script>
@endsection






