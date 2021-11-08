@extends('layouts.manager')

@section('content')




<div class="main-panel">
  <div class="content-wrapper">
    <div class="row" style="margin-left: 1.0rem; margin-right: 1.0rem; margin-bottom: 10px;">
      <div class="col-md-6">
        <span class="material-icons-outlined icon-header" style="font-size: 3.0rem; color: #ffffff; padding: 0.6rem; background: #10425E; border-radius: 0.4rem;">apartment</span> 
      </div>
      <div class="col-md-6" style="padding-top: 10px;">
        <a href="{{url('manager/departments/create')}}" class=" btn btn-sm btn-success float-right">
          <span class="material-icons-outlined">add</span>
        </a>
      </div>
    </div>
    <div class="row" >



      <div class="col-lg-12 grid-margin stretch-card">
              <div class="card" style="border-bottom: 5px solid #82A448; margin: 0px;">
                <div class="card-body">
                  <!-- <h4 class="card-title">&nbsp;</h4> -->
                  
                  <div class="sortable table-responsive">
                    <table class="sortable table table-striped">
                      <thead>
                        <tr>
                          <th>
                            {{trans('manager.department')}}
                          </th>
                          <th>
                            {{trans('manager.users')}}
                          </th>
                          <!-- <th>
                            {{trans('manager.courses')}}
                          </th> -->
                          <th>
                            {{trans('manager.settings')}}
                          </th>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach($departments as $department)
                        <tr>
                          
                          <td>
                            {{$department->name}}
                          </td>
                          <td>
                            {{$department->users()->count()}}                          
                          </td>
                          <!-- <td>
                            $ 77.99
                          </td> -->
                          <td>

                            <div class="dropdown">
                              <a class="btn btn-sm btn-link !dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="material-icons">more_horiz</span>
                              </a>

                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{url('manager/departments/'.$department->id)}}"><span class="material-icons">visibility</span></a>
                                <a class="dropdown-item" href="{{url('manager/departments/'.$department->id.'/edit')}}"><span class="material-icons">edit</span></a>
                                <a class="dropdown-item" href="{{url('manager/departments/'.$department->id)}}">{{trans('manager.manage_users')}}</a>
                              </div>
                            </div>

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