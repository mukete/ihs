@extends('layouts.manager')

@section('content')




<div class="main-panel">
  <div class="content-wrapper">
    <div class="row" style="margin-left: 1.0rem; margin-right: 1.0rem; margin-bottom: 10px;">
      <div class="col-md-6">
        <span class="material-icons-outlined icon-header" style="font-size: 3.0rem; color: #ffffff; padding: 0.6rem; background: #10425E; border-radius: 0.4rem;">category</span> 
      </div>
      <div class="col-md-6" style="padding-top: 10px;">
        <a href="{{url('manager/categories')}}" class=" btn btn-sm btn-success float-right">
          <span class="material-icons-outlined">arrow_back</span>
        </a>
      </div>
    </div>
    <div class="row" >



      <div class="col-lg-12 grid-margin stretch-card">
              <div class="card" style="border-bottom: 5px solid #82A448; margin: 0px;">
                <div class="card-body">
                  <h4 class="card-title">{{$title}}</h4>

                  
                  <form method="POST" action="{{ url(app()->getLocale().'/manager/categories/'.$category->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{trans('manager.category_name')}}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')!=null ? old('name') : $category->name }}" >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{trans('manager.category_image')}}</label>

                            <div class="col-md-8">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" >

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-10 offset-md-2">
                                <button type="submit" class="btn btn-primary">
                                    {{trans('manager.update')}}
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