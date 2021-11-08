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
                 
                  @endif
                  <div class="sortable table-responsive">
                     <table class="sortable table table-striped">
                        
                        <tbody>
                           @foreach($questions as $question)
                           
                           @endforeach
                        </tbody>
                     </table>
                  </div>




                  <p>
                     <div class="modal-body">
                     <h5>Question</h5>
                     <form method="POST" action="{{ url(app()->getLocale().'/manager/questions/'.$question->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="course" value="{{Request::get('course')}}">
                        <div class="form-group row">
                           <div class="form-group col-md-12">
                              <label for="inputEmail4">Question</label>
                              <textarea id="summernote" class="form-control @error('name') is-invalid @enderror" name="question" required="">{{old('question')!=null ? old('question') : $question->name}}
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

                        @foreach($question->answers as $ans)
                        <div class="form-group row">
                           <div class="form-group col-md-8">
                              <label for="inputEmail4">Answer</label>
                              <textarea class="form-control" name="answers[]">{{$ans->name}}</textarea>
                           </div>
                           <div class="form-group col-md-4">
                              <label for="correct">Correct or Not {{$ans->correct}}</label>
                              <select class="custom-select mr-sm-2" name="corrects[]">
                                 <option>Set correctness</option>
                                 <option value="yes" {!! $ans->correct=="yes" ? 'selected' :'' !!} >Ja</option>
                                 <option value="no" {!! $ans->correct=="no" ? 'selected' :'' !!} >Nein</option>
                              </select>
                           </div>
                        </div>
                        @endforeach
                        
                        <div class="form-group row mb-0">
                           <div class="col-md-12">
                              <button type="submit" class="btn btn-primary">
                              {{trans('manager.update')}}
                              </button>
                           </div>
                        </div>
                     </form>
                  </div>
                  </p>




               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection