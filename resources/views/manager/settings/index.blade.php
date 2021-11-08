@extends('layouts.manager')

@section('content')




<div class="main-panel">
  <div class="content-wrapper">
    <div class="row" style="margin-left: 1.0rem; margin-right: 1.0rem; margin-bottom: 10px;">
      <div class="col-md-6">
        <span class="material-icons-outlined icon-header" style="font-size: 3.0rem; color: #ffffff; padding: 0.6rem; background: #364552; border-radius: 0.4rem;">settings</span> 
      </div>
      <div class="col-md-6" style="padding-top: 10px;">
        <!-- <a href="" class=" btn btn-sm btn-success float-right">
          <span class="material-icons-outlined">add</span>
        </a> -->
      </div>
    </div>
    <div class="row" >



      <div class="col-lg-12 grid-margin stretch-card">
              <div class="card" style="border-bottom: 5px solid #82A448; margin: 0px;">
                <div class="card-body">
                  <h4 class="card-title"></h4>
                  <form method="POST" action="{{ url(app()->getLocale().'/manager/settings') }}" enctype="multipart/form-data" >
                        @csrf

                        <div class="form-group row">
                            <label for="company" class="col-md-2 col-form-label text-md-right">Company</label>

                            <div class="col-md-8">
                                <input id="company" type="text" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ old('company')!=null ? old('company') : auth()->user()->company->name }}" >

                                @error('company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        

                        <div class="form-group row">
                            <label for="image" class="col-md-2 col-form-label text-md-right">Logo (255x80)</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" >

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                              <img src="{{url('content/logos/'.auth()->user()->company->logo)}}" width="100%">
                            </div>
                        </div>

                        

                        

                        
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-10 offset-md-2">
                                <button type="submit" class="btn btn-primary">
                                    Save
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