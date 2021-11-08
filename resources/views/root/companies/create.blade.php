@extends('layouts.root')

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
                  
                  <form method="POST" action="{{ url(app()->getLocale().'/root/companies') }}" enctype="multipart/form-data">
                        @csrf

                        <h4>Company infos</h4>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" class="col-md-2 col-form-label ">Company name</label>

                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                        </div>

                        <h4>Manager infos</h4>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="manager" class="col-md-4 col-form-label ">{{trans('manager.first_name')}}</label>

                                    <div class="col-md-8">
                                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" >

                                        @error('manager')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                            </div>

                            <div class="col-md-6">

                                <label for="manager" class="col-md-4 col-form-label ">{{trans('manager.last_name')}}</label>

                            <div class="col-md-8">
                                <input id="manager" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" >

                                @error('manager')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="email" class="col-md-2 col-form-label">{{trans('manager.email')}}</label>

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                        </div>

                        
                        

                        <div class="form-group row ">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{trans('manager.save')}}
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