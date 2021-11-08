@extends('layouts.user')
@section('content')


<section class="section is-main-section">

   <div class="columns">
      <div class="column is-12">
         <a href="{{url('kurses')}}" class="button is-danger is-outlined "><span class="material-icons">arrow_back</span> &nbsp; {{ trans('fe.back') }} </a>
      </div>
   </div>

   <div class="columns is-multiline">
      
      <div class="column is-6">
         <div class="card tile is-child">
            <div class="card-content">
               <div class="columns">
                  <div class="col ml-2">
                     <span class="material-icons is-size-1" style="color:#2980b9;">help_outline</span>
                  </div>
                  <div class="col ml-6">
                     <h2 class="is-size-4" >{{$answerUser->count()}}</h2>
                     <h4 class="is-size-5" >{{ trans('fe.total_questions') }}</h4>
                  </div>
               </div>
               
            </div>
         </div>
      </div>

      <div class="column is-6">
         <div class="card tile is-child">
            <div class="card-content">
               <div class="columns">
                  <div class="col ml-2">
                     <span class="material-icons is-size-1" style="color: #c0392b;">dangerous</span>
                  </div>
                  <div class="col ml-6">
                     <h2 class="is-size-4" >{{$answerUser->where('correct','=',0)->count()}}</h2>
                     <h4 class="is-size-5"  >{{ trans('fe.wrong') }}</h4>
                  </div>
               </div>
               
            </div>
         </div>
      </div>

      <div class="column is-6">
         <div class="card tile is-child">
            <div class="card-content">
               <div class="columns">
                  <div class="col ml-2">
                     <span class="material-icons is-size-1" style="color:#2ecc71;">fact_check</span>
                  </div>
                  <div class="col ml-6">
                     <h2 class="is-size-4" >{{$answerUser->where('correct','=',1)->count()}}</h2>
                     <h4 class="is-size-5" >{{ trans('fe.correct') }}</h4>
                  </div>
               </div>
               
            </div>
         </div>
      </div>

      <div class="column is-6">
         <div class="card tile is-child">
            <div class="card-content">
               <div class="columns">
                  <div class="col ml-2">
                     <span class="material-icons is-size-1" style="color:#2980b9;" >auto_awesome</span>
                  </div>
                  <div class="col ml-6">
                     @if($answerUser->where('correct','=',1)->count() == 0) 

                        <h2 class="is-size-4">0 %</h2>

                     @else

                        <h2 class="is-size-4">{{ intval(( $answerUser->where('correct','=',1)->count()/$answerUser->count())* 100 ) }} %</h2>

                     @endif
                     <h4 class="is-size-5">{{ trans('fe.percentage') }}</h4>
                  </div>
               </div>
               
            </div>
         </div>
      </div>

      
   </div>

   <div class="columns">
      <div class="column is-12">
         <div class="card tile is-child">
            <div class="card-content">
               <div class="columns">
                  <div class="col is-12 ">
                     <span class="is-size-5 ">


                        {{ trans('fe.text_to_take_quiz') }}<br/>
                        {{ trans('fe.you_have') }} {{3 - $took->times}} {{ trans('fe.times_to_take') }} <br/>

                        <br/><br/>
                        @if($took->times <= 3)
                        <a href="{{url('quiz/'.$course->slug)}}" class="button is-link">{{ trans('fe.take_quiz_again') }}</a>
                        @endif

                        @if($answerUser->where('correct','=',1)->count() > 0) 

                        @if( intval(( $answerUser->where('correct','=',1)->count()/$answerUser->count())* 100 ) >= $answerUser->first()->course->percentage )
                        <a href="{{url('get-certificate/'.\App\Take::where('user_id','=',auth()->user()->id)->where('course_id','=',$course->id)->where('pass','=','yes')->first()->id )}}" class="button is-success is-light ">{{ trans('fe.view_certificate') }}</a>
                        @endif

                        @endif
                     </span>
                  </div>
                  
               </div>
               
            </div>
         </div>
      </div>

      
   </div>
   



  
   
</section>
@endsection