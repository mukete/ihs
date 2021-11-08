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
                          <td>{{$user->name}}</td>
                      </tr>
                      <tr>
                          <th>{{trans('manager.email')}}</th>
                          <td>{{$user->email}}</td>
                      </tr>
                      <tr>
                          <th>{{trans('manager.account_type')}}</th>
                          <td>{{$user->type}}</td>
                      </tr>

                      <tr>
                          <th>{{trans('manager.avatar')}}</th>
                          <td>
                            @if(auth()->user()->avatar == null)
                            <img src="https://avatars.dicebear.com/v2/initials/{{auth()->user()->name}}.svg" >
                            @else
                            <img src="{{url('content/users/'.$user->avatar)}}" >
                            @endif
                          </td>
                      </tr>
                  </table>
                </div>
            </div>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card" style="border-bottom: 5px solid #82A448; margin: 0px;">
                <div class="card-body">
                  <h4 class="card-title">{{trans('manager.departments')}}</h4>
                  <p>
                    @foreach($user->departments as $department)
                    {{$department->name}} &nbsp; &nbsp; - &nbsp; &nbsp;
                    @endforeach
                  </p>
                </div>
            </div>
        </div>



        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card" style="border-bottom: 5px solid #82A448; margin: 0px;">
                <div class="card-body">
                  <h4 class="card-title">{{trans('manager.courses')}}</h4>

                  <table class="sortable table">
                      <tr>
                          <th>Course</th>
                          <td>Completed (times)</td>
                          <td>Status</td>
                      </tr>

                      @foreach($user->took as $took)
                      <tr>
                        <td>
                          {{$took->course->name}}
                        </td>
                        <td>
                          {!! $took->completed==true ? 'ja' : 'nein' !!} - ({{$took->times}}) - <a href="{{url('reset-course-taken-times/'.$took->id)}}" class="badge badge-success">reset</a>
                        </td>

                        <td>
                          {{$took->pass}}
                        </td>
                      </tr>
                      @endforeach
                      
                  </table>
                </div>
            </div>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card" style="border-bottom: 5px solid #82A448; margin: 0px;">
                <div class="card-body">
                  <h4 class="card-title">{{trans('manager.certificates')}}</h4>
                  <table class="sortable table">
                      <tr>
                          <th>course</th>
                          <td>-</td>
                      </tr>

                      @foreach($user->took() as $course)
                      @endforeach
                      
                  </table>
                </div>
            </div>
        </div>


    </div>
  </div>
</div>




@endsection