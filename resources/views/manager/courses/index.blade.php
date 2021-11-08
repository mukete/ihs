@extends('layouts.manager')

@section('content')




<div class="main-panel">
  <div class="content-wrapper">
    <div class="row" style="margin-left: 1.0rem; margin-right: 1.0rem; margin-bottom: 10px;">
      <div class="col-md-6">
        <span class="material-icons-outlined icon-header" style="font-size: 3.0rem; color: #ffffff; padding: 0.6rem; background: #364552; border-radius: 0.4rem;">play_lesson</span> 
      </div>
      <div class="col-md-6" style="padding-top: 10px;">
        <a href="{{url('manager/courses/create')}}" class=" btn btn-sm btn-success float-right">
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
                            Category
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Content files
                          </th>
                          <th>
                            Status
                          </th>
                          <th>
                            Settings
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($courses as $course)
                        <tr>
                          <td>{{$course->category->name}}</td>
                          <td>{{$course->name}}</td>
                          <td>
                            
                            @foreach($course->contents as $content)
                            <a href="">
                              {{$content->type}} - {{$content->file}} <br/>
                            </a>
                            @endforeach
                          </td>
                          <td>

                            


                            @if($course->status != 1)
                            


                            <form action="{{url('change-status/'.$course->id)}}" method="post" id="status-change-d-{{$course->id}}">
                              @csrf
                              <div class="custom-control custom-switch">
                                <label class="custom-control-label" for="customSwitch{{$course->id}}"  >
                                  <!-- <span class="badge badge-danger" style="border-radius:50%; font-size: 0.5rem;">&nbsp;</span> -->
                                </label>

                                <input name="status" type="checkbox" value="1" class="custom-control-input " id="customSwitch{{$course->id}}" onchange="submit()">
                                
                              </div>
                            </form>

                            

                            @elseif($course->status == 1)
                            
                           

                            <form action="{{url('change-status/'.$course->id)}}" method="post" id="status-change-a-{{$course->id}}">
                              @csrf


                              <div class="custom-control custom-switch">
                              <input checked="" type="checkbox" class="custom-control-input" id="customSwitch1{{$course->id}}" onchange="submit()">
                              <label class="custom-control-label" for="customSwitch1{{$course->id}}">
                                <!-- <span class="badge badge-success" style="border-radius:50%; font-size: 0.5rem;">&nbsp;</span> -->
                              </label>
                            </div>
                            </form>


                            


                            @endif
                          </td>
                          <td>
                            <div class="dropdown">
                              <a class="btn btn-sm btn-link !dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="material-icons">more_horiz</span>
                              </a>

                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item " href="{{url('manager/courses/'.$course->id.'/edit')}}">
                                  <span class="material-icons">edit</span>
                                </a>
                                <br/>
                                <a class="dropdown-item " href="#">
                                  <span class="material-icons">visibility</span>
                                </a>
                                <br/>
                                <a class="dropdown-item "  href="#">
                                  <span class="material-icons">delete_outline</span>
                                </a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>

                    {!! $courses->links() !!}
                  </div>
                </div>
              </div>
            </div>
      




    </div>
  </div>
  
</div>




@endsection