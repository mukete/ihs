@extends('layouts.manager')

@section('content')




<div class="main-panel">
  <div class="content-wrapper">
    <div class="row" style="margin-left: 1.0rem; margin-right: 1.0rem; margin-bottom: 10px;">
      <div class="col-md-6">
        <span class="material-icons-outlined icon-header" style="font-size: 3.0rem; color: #ffffff; padding: 0.6rem; background: #10425E; border-radius: 0.4rem;">people</span> 
      </div>
      <div class="col-md-6" style="padding-top: 10px;">
        <a href="{{url('manager/users/create')}}" class=" btn btn-sm btn-success float-right">
          <span class="material-icons-outlined">add</span>
        </a>
      </div>
    </div>
    <div class="row" >



      <div class="col-lg-12 grid-margin stretch-card">
              <div class="card" style="border-bottom: 5px solid #82A448; margin: 0px;">
                <div class="card-body">
                  <h4 class="card-title">{{$title}}</h4>
                  
                  <div class="sortable table-responsive">
                    <table class="sortable table table-striped">
                      <thead>
                        <tr>
                          <th>
                            {{trans('manager.name')}}
                          </th>
                          <th>
                            {{trans('manager.email')}}
                          </th>
                          <th>
                            {{trans('manager.departments_courses')}}
                          </th>
                          
                          <th>
                            {{trans('manager.settings')}}
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                        <tr>
                          <td class="py-1">
                            {{$user->name}}
                          </td>
                          <td>
                            {{$user->email}}
                          </td>
                          <td>
                            {{$user->departments()->count()}}
                          </td>
                          
                          <td>
                            <a  href="{{url('manager/users/'.$user->id.'/edit')}}"><span class="material-icons">edit</span></a>
                                <a  href="{{url('manager/users/'.$user->id)}}"><span class="material-icons">visibility</span></a>
                            
                          </td>
                        </tr>
                        @endforeach
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
      




    </div>
  </div>
  
</div>




@endsection