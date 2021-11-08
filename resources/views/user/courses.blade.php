@extends('layouts.user')
@section('content')


<section class="section is-main-section">


   <div class="tile is-ancestor">
      <div class="tile is-parent">
         <div class="card tile is-child">
            <div class="card-content">
               <div class="is-mobile">
                  <div class="columns">

                        <div class="column is-4">
                           <form method="get" action="">
                              <div class="select is-rounded">
                                <select name="category" onchange="submit()">
                                  <option value="null">{{ trans('fe.category') }}</option>
                                  @foreach($categories as $category)

                                  @if($category->courses()->count() == 0)
                                  @continue
                                  @endif
                                  
                                  <option value="{{$category->id}}" {{Request::get('category') == $category->id ? 'selected' : ''}} >{{$category->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                           </form>
                        </div>

                        <div class="column is-4">
                           <input class="input is-rounded" type="text" placeholder="Search" name="course" disabled="">
                        </div>

                        <div class="column is-4">
                           <!-- <h2>Fortschritt</h2> -->
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
                              
                                 {{$course->duration}} min.
                                 
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

                                 <a href="{{url('kurse/'.$course->slug)}}" class="button is-rounded is-link ">Continue</a>
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
                        {!! $courses->links('pagination.bulma') !!}
                     </div>
                     {!! $courses->links('pagination.bulma') !!}
                  </div>



                  
                  
               </div>
            </div>
         </div>
      </div>
        
   </div>
   
</section>
@endsection