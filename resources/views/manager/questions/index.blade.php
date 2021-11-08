@extends('layouts.manager')

@section('content')




<div class="main-panel">
  <div class="content-wrapper">
    <div class="row" style="margin-left: 1.0rem; margin-right: 1.0rem; margin-bottom: 10px;">
      <div class="col-md-6">
        <span class="material-icons-outlined icon-header" style="font-size: 3.0rem; color: #ffffff; padding: 0.6rem; background: #364552; border-radius: 0.4rem;">quiz</span> 
      </div>
      <div class="col-md-6" style="padding-top: 10px;">
        <!-- <a href="{{url('manager/questions/create')}}" class=" btn btn-sm btn-success float-right">
          <span class="material-icons-outlined">add</span>
        </a> -->
      </div>
    </div>
    <div class="row" >




<!-- Modal -->
<div class="modal fade" id="addQuestion" tabindex="-1" aria-labelledby="addQuestionLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addQuestionLabel">Add question & answer(s) to course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Question</h5>

        <form method="POST" action="{{ url(app()->getLocale().'/manager/questions') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="course" value="{{Request::get('course')}}">

                        <div class="form-group row">

                            <div class="form-group col-md-12">
                                
<label for="inputEmail4">Question</label>
                                <textarea id="summernote" class="form-control @error('name') is-invalid @enderror" name="question" required="">
                                  
                                </textarea>

                                @error('question')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <hr>
                        <h5>Answers</h5>

                        <div class="form-group row">
                            <div class="form-group col-md-8">
                              <label for="inputEmail4">Answer</label>
                              <textarea class="form-control" name="answers[]"></textarea>
                            </div>
                          <div class="form-group col-md-4">
                            <label for="correct">Correct or Not</label>
                            <select class="custom-select mr-sm-2" name="corrects[]">
                              <option selected>Set correctness</option>
                              <option value="yes">Ja</option>
                              <option value="no">Nein</option>
                            </select>
                          </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="form-group col-md-8">
                              <label for="inputEmail4">Answer</label>
                              <textarea class="form-control" name="answers[]"></textarea>
                            </div>
                          <div class="form-group col-md-4">
                            <label for="correct">Correct or Not</label>
                            <select class="custom-select mr-sm-2" name="corrects[]">
                              <option selected>Set correctness</option>
                              <option value="yes">Ja</option>
                              <option value="no">Nein</option>
                            </select>
                          </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="form-group col-md-8">
                              <label for="inputEmail4">Answer</label>
                              <textarea class="form-control" name="answers[]"></textarea>
                            </div>
                          <div class="form-group col-md-4">
                            <label for="correct">Correct or Not</label>
                            <select class="custom-select mr-sm-2" name="corrects[]">
                              <option selected>Set correctness</option>
                              <option value="yes">Ja</option>
                              <option value="no">Nein</option>
                            </select>
                          </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="form-group col-md-8">
                              <label for="inputEmail4">Answer</label>
                              <textarea class="form-control" name="answers[]"></textarea>
                            </div>
                          <div class="form-group col-md-4">
                            <label for="correct">Correct or Not</label>
                            <select class="custom-select mr-sm-2" name="corrects[]">
                              <option selected>Set correctness</option>
                              <option value="yes">Ja</option>
                              <option value="no">Nein</option>
                            </select>
                          </div>
                        </div>

                        
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-10 offset-md-2">
                                <button type="submit" class="btn btn-primary">
                                    {{trans('manager.save')}}
                                </button>

                                
                            </div>
                        </div>
                    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Done</button>
      </div>
    </div>
  </div>
</div>



      <div class="col-lg-12 grid-margin stretch-card">
              <div class="card" style="border-bottom: 5px solid #82A448; margin: 0px;">
                <div class="card-body">
                  <!-- <h4 class="card-title">&nbsp;</h4> -->




                  <h4>Manage Questions</h4> 

                  <form action="" method="get">
                    <div class="col-md-12">
                        <select id="category" class="form-control @error('course') is-invalid @enderror" name="course" onchange="submit()" style="margin-left: -15px;" >
                          <option >Select course</option>
                          @foreach($courses as $course)
                          
                          <option value="{{$course->id}}" {{Request::get('course')==$course->id ? 'selected' : ''}} >
                            {{$course->name}}
                          </option>
                          @endforeach
                        </select>
                        <br/>

                        @error('category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </form>

                  <!-- Button trigger modal -->
      @if(Request::get('course') != null)
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addQuestion">
  Add question
</button>
@endif


                  
                  <div class="sortable table-responsive">
                    <table class="sortable table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Course
                          </th>
                          <th>
                            Question
                          </th>
                          <th>
                            Answers
                          </th>
                          <th>
                            Settings
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($questions as $question)
                        <tr>
                          <td>
                            {{$question->course->name}}
                          </td>
                          <td>
                            {{$question->name}}
                          </td>
                          <td>
                            {{$question->name}}
                          </td>
                          <td>
                            <div class="dropdown">
                              <a class="btn btn-sm btn-link !dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="material-icons">more_horiz</span>
                              </a>

                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <!-- <a class="dropdown-item " href="{{url('manager/questions/'.$question->id.'/edit')}}">
                                  <span class="material-icons">edit</span>
                                </a>
                                <br/>
                                <a class="dropdown-item " href="#">
                                  <span class="material-icons">visibility</span>
                                </a> -->
                                <br/>
                                <a class="dropdown-item "  href="{{ url(app()->getLocale().'/manager/questions/'.$question->id) }}" onclick="event.preventDefault();
                                                     document.getElementById('delete-form-{{$question->id}}').submit();">
                                  <span class="material-icons">delete_outline</span>
                                </a>
                                <form id="delete-form-{{$question->id}}" action="{{ url(app()->getLocale().'/manager/questions/'.$question->id) }}" method="post" style="display: none;">
                                    @csrf
                                    @method('delete')
                                </form>
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