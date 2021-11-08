@extends('layouts.manager')

@section('content')




<div class="main-panel">
  <div class="content-wrapper">
    <div class="row" style="margin-left: 1.0rem; margin-right: 1.0rem; margin-bottom: 10px;">
      <div class="col-md-6">
        <span class="material-icons-outlined icon-header" style="font-size: 3.0rem; color: #ffffff; padding: 0.6rem; background: #10425E; border-radius: 0.4rem;">play_lesson</span> 
      </div>
      <div class="col-md-6" style="padding-top: 10px;">
        <a href="{{url('manager/courses')}}" class=" btn btn-sm btn-success float-right">
          <span class="material-icons-outlined">arrow_back</span>
        </a>
      </div>
    </div>
    <div class="row" >



      <div class="col-lg-12 grid-margin stretch-card">
              <div class="card" style="border-bottom: 5px solid #82A448; margin: 0px;">
                <div class="card-body">
                  <h4 class="card-title">{{$title}}</h4>
                  
                  <form method="POST" action="{{ url(app()->getLocale().'/manager/courses/'.$course->id) }}" enctype="multipart/form-data" >
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Department name</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')!=null ? old('name') : $course->name }}" >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-md-2 col-form-label text-md-right">Category</label>

                            <div class="col-md-8">
                                <select id="category" class="form-control @error('category') is-invalid @enderror" name="category">
                                  @foreach($categories as $category)
                                  <option value="{{$category->id}}" {{old('category')==$category->id ? 'selected' : ''}} >
                                    {{$category->name}}
                                  </option>
                                  @endforeach
                                </select>

                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="duration" class="col-md-2 col-form-label text-md-right">Duration of quiz</label>

                            <div class="col-md-8">
                                <input id="duration" type="text" class="form-control @error('name') is-invalid @enderror" name="duration" value="{{ old('duration')!=null ? old('duration') : $course->duration }}" >

                                @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="percentage" class="col-md-2 col-form-label text-md-right">Required percentage</label>

                            <div class="col-md-8">
                                <input id="percentage" type="text" class="form-control @error('percentage') is-invalid @enderror" name="percentage" value="{{ old('percentage')!=null ? old('percentage') : $course->percentage }}" >

                                @error('percentage')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-2 col-form-label text-md-right">Image</label>

                            <div class="col-md-4">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" >

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <img src="{{url('content/courses/'.$course->image)}}" width="50%">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="videos" class="col-md-2 col-form-label text-md-right">Video content</label>

                            <div class="col-md-2">
                                <input id="videos" type="text" class="form-control @error('videos') is-invalid @enderror" name="videos[]" placeholder="1" >

                                @error('videos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <input id="videos" type="text" class="form-control @error('videos') is-invalid @enderror" name="videos[]" placeholder="2" >

                                @error('videos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <input id="videos" type="text" class="form-control @error('videos') is-invalid @enderror" name="videos[]" placeholder="3" >

                                @error('videos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <input id="videos" type="text" class="form-control @error('videos') is-invalid @enderror" name="videos[]" placeholder="4" >

                                @error('videos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            
                            <div class="col-md-3">
                                @foreach($course->contents()->where('type','=','videos')->get() as $content)
                                <a href="{{url('delete-content/'.$content->id)}}" style="max-width: 200px;">
                                  {!! $content->file !!} - <span class="badge badge-danger">x</span> <br/>
                                </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="documents" class="col-md-2 col-form-label text-md-right">Document content</label>

                            <div class="col-md-4">
                                <input id="documents" type="file" class="form-control @error('documents') is-invalid @enderror" name="documents[]"  multiple>

                                @error('documents')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                @foreach($course->contents()->where('type','=','documents')->get() as $content)
                                <a href="{{url('delete-content/'.$content->id)}}">
                                  {{$content->file}} - <span class="badge badge-danger">x</span> <br/>
                                </a>
                                @endforeach
                            </div>
                        </div>

                        
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-10 offset-md-2">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>

                                
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>

    </div>
  </div>
  
</div>




@endsection