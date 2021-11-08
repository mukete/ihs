@extends('layouts.manager')

@section('content')




<div class="main-panel">
  <div class="content-wrapper">
    <div class="row" style="margin-left: 1.0rem; margin-right: 1.0rem; margin-bottom: 10px;">
      <div class="col-md-6">
        <span class="material-icons-outlined icon-header" style="font-size: 3.0rem; color: #ffffff; padding: 0.6rem; background: #10425E; border-radius: 0.4rem;">people</span> 
      </div>
      <div class="col-md-6" style="padding-top: 10px;">
        <a href="{{url('manager/departments')}}" class=" btn btn-sm btn-success float-right">
          <span class="material-icons-outlined">arrow_back</span>
        </a>
      </div>
    </div>
    <div class="row" >



        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card" style="border-bottom: 5px solid #82A448; margin: 0px;">
                <div class="card-body">
                  <h4 class="card-title">{{$title}}</h4>
                  <table class="sortable table">
                      <tr>
                          <th>{{trans('manager.name')}}</th>
                          <td>{{$department->name}}</td>
                      </tr>

                      <tr>
                          <th>{{trans('manager.users')}}</th>
                          <td>{{$department->users->count()}}</td>
                      </tr>
                      
                  </table>
                </div>
            </div>
        </div>



        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card" style="border-bottom: 5px solid #82A448; margin: 0px;">
                <div class="card-body">

                  <div class="row">

                    <div class="col-md-6">
<h4>Select user(s) to add to department</h4>


                      <form method="post" action="{{ url('add-to-department') }}">
                        @csrf

                        <input type="hidden" name="department" value="{{$department->id}}">

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">{{ trans('manager.users') }}</label>

                            <div class="col-md-8">
                              <select class="form-control selectpicker" multiple data-live-search="true" name="users[]">
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{ $user->name }} - {{ $user->email }}</option>
                                @endforeach

                              </select>
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

                    <div class="col-md-6">
                      <h4>Users in department</h4>

                      <table class="sortable table table-sm">
                        @foreach($department->users as $dptUsr)
                        <tr>
                          <td>
                            {{$dptUsr->name}}
                          </td>
                          <td>
                            {{$dptUsr->email}}
                          </td>
                          <td>
                            <a href="{{url('remove-user-department/'.$dptUsr->id.'/'.$department->id)}}" class="btn btn-sm btn-danger">
                              <span class="material-icons" style="font-size: 1.0rem;">remove_circle_outline</span>
                            </a>
                          </td>
                        </tr>
                        @endforeach
                      </table>
                    </div>
                    
                  </div>



                </div>
            </div>
        </div>

        






        


    </div>
  </div>
</div>




@endsection