@extends('layouts.user')
@section('content')


<section class="section is-main-section">

   <div class="columns">

      <div class="column is-4">
         <div class="card tile is-child">
            <div class="card-content">
               <div class="columns">
                  <div class="col ml-2">
                     <span class="material-icons is-size-1" style="color:#2980b9;">school</span>
                  </div>
                  <div class="col ml-6">
                     <h2 class="is-size-4" >{{ auth()->user()->company->courses()->where('status','=',1)->count() }}</h2>
                     <h4 class="is-size-5" >{{ trans('fe.courses_to_do') }}</h4>
                  </div>
               </div>
               
            </div>
         </div>
      </div>

      <div class="column is-4">
         <div class="card tile is-child">
            <div class="card-content">
               <div class="columns">
                  <div class="col ml-2">
                     <span class="material-icons is-size-1" style="color:#2980b9;">av_timer</span>
                  </div>
                  <div class="col ml-6">
                     <h2 class="is-size-4" >{{ auth()->user()->company->courses()->where('status','=',1)->count() - auth()->user()->took->count() }}</h2>
                     <h4 class="is-size-5" >{{ trans('fe.overdue_courses') }}</h4>
                  </div>
               </div>
               
            </div>
         </div>
      </div>

      <div class="column is-4">
         <div class="card tile is-child">
            <div class="card-content">
               <div class="columns">
                  <div class="col ml-2">
                     <span class="material-icons is-size-1" style="color:#2980b9;">military_tech</span>
                  </div>
                  <div class="col ml-6">
                     <h2 class="is-size-4" >{{ auth()->user()->took->count() }}</h2>
                     <h4 class="is-size-5" >{{ trans('fe.completed_courses') }}</h4>
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
                  <div class="col ml-12">
                     <h2 class="is-size-5 is-capitalize" >{{ trans('fe.certificates') }} ( {{\App\Take::where('user_id','=',auth()->user()->id)->where('pass','=','yes')->count()}} )</h2>
                     <!-- <h4 class="is-size-7" >View latest certificates</h4> -->
                     <p>
                        <a href="{{url('zertifikate')}}" class="button is-info">{{ trans('fe.view_all') }}</a>
                     </p>
                  </div>
               </div>
               
            </div>
         </div>
      </div>

   </div>  

   <div class="columns">
                     <div class="column is-12">
                        <table class="sortable table is-fullwidth">
                           <tr>
                              <th>{{ trans('fe.course') }}</th>
                              <th></th>
                              <th>{{ trans('fe.quiz_time') }}</th>
                              <th>{{ trans('fe.no_questions') }}</th>
                              <th>{{ trans('fe.status') }}</th>
                              <th>{{ trans('fe.progress') }}</th>
                           </tr>




                           @foreach($courses as $course)
                           <tr>

                              <td>
                                 <img src="{{url('content/courses/'.$course->image)}}" width="100">


                              </td>
                              <td>
                                 {{$course->name}}
                              </td>

                              <td>
                              
                                 {{$course->duration}} {{ trans('fe.min') }}
                                 
                              </td>
                           
                              <td>
                                 
                              
                                 {{$course->random}}
                                 
                                
                              </td>

                              <td >
                              @if(\App\Take::where('course_id','=',$course->id)->where('user_id','=',auth()->user()->id)->first() != null)

                                 <div class="columns">
                                    <div class="column is-1">
                                       <div style="margin-top: 0.4rem; width:0.8rem;height:0.8rem;background: green; border-radius: 0.4rem;"> </div>
                                    </div>
                                    <div class="column is-11">
                                       {{\App\Take::where('course_id','=',$course->id)->where('user_id','=',auth()->user()->id)->first()->times }} time(s)

                                 <a href="{{url('results/'.$course->slug)}}" >{{ trans('fe.view') }}</a>
                                    </div>
                                 </div>
                                 
                                 

                                 

                                    

                              @else
                                 <div style=" margin-top: 0.4rem; width:0.8rem;height:0.8rem;background: grey; border-radius: 0.4rem;"> </div>
                              @endif


                              </td>

                              <td>
                                 @if(\App\Take::where('course_id','=',$course->id)->where('user_id','=',auth()->user()->id)->first() != null)

                                 @if(\App\Take::where('course_id','=',$course->id)->where('user_id','=',auth()->user()->id)->first()->times == 3)

                                 <button class="button  is-rounded is-link is-light " disabled="">{{ trans('fe.done') }}</button>

                                 @else

                                 <a href="{{url('kurse/'.$course->slug)}}" class="button is-rounded is-link ">{{ trans('fe.continue') }}</a>
                                 @endif

                                 
                                 @else
                                 <a href="{{url('kurse/'.$course->slug)}}" class="button is-rounded is-link  is-outlined">{{ trans('fe.start') }}</a>
                                 @endif
                              </td>


                              
                           </div>

                        </div>

                        </tr>
                        @endforeach




                        </table>
                     </div>
                     
                  </div>
   
</section>
@endsection