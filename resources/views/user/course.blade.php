@extends('layouts.user')
@section('content')


<section class="section is-main-section">

   <div class="columns">
      <div class="column is-6">
         <a href="{{url('kurses')}}" class="button is-danger is-outlined"><span class="material-icons">arrow_back</span> &nbsp; {{ trans('fe.back') }} </a> 
      </div>
      <div class="column is-6 ">
         @if($course->questions()->count() > 0)
            @if($took == null)
            <a href="{{url('quiz/'.$course->slug)}}" class="button is-link is-pulled-right" >{{ trans('fe.take_quiz') }}</a>
            @endif

            @if($took != null)
               <a href="{{url('results/'.$course->slug)}}" class="button is-primary is-pulled-right">{{ trans('fe.quiz_results') }}</a>
            @endif

         @endif
      </div>
   </div>
   <!-- <div class="tile is-ancestor">
      <div class="tile is-parent">
         <div class="card tile is-child">
            <div class="card-content">
               <div class="is-mobile">
                  <div class="columns">
                        <div class="column is-12">
                           <h2>Fortschritt</h2>
                        </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div> -->



   <!-- <div class="columns">
      <div class="column is-4">
         <div class="card tile is-child">
            <div class="card-content">
               <div class="columns">
                  <div class="col ml-2">
                     <span class="material-icons is-size-1">quiz</span>
                  </div>
                  <div class="col ml-6">
                     <h2 class="is-size-4" >{{$course->random}}</h2>
                     <h4 class="is-size-5" >Total questions</h4>
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
                     <span class="material-icons is-size-1">credit_score</span>
                  </div>
                  <div class="col ml-6">
                     <h2 class="is-size-4">{{$course->percentage}}%</h2>
                     <h4 class="is-size-5">Required score</h4>
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
                     <span class="material-icons is-size-1">timer</span>
                  </div>
                  <div class="col ml-6">
                     <h2 class="is-size-4">{{$course->duration}} minutes</h2>
                     <h4 class="is-size-5">Time to complete</h4>
                     
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div> -->


   <div class="columns">
      <div class="column is-6">

         <div class="card tile is-child">
            <div class="card-content">
               <div class="is-mobile">
                  <h2 class="is-underlined has-text-weight-bold">{{ trans('fe.documents') }}</h2> <br/>

                  @foreach($course->contents->where('type','=','documents') as $content)
                  <article class="media">
                     <figure class="media-left">
                            <p class="image ">
                              <img src="{{url('content/courses/'.$course->image)}}" style="width: 8.0rem;">
                            </p>
                          </figure>

                     <div class="media-content">
                      <div class="content">
                        <p>
                          <span class="has-text-weight-bold">{{$course->name}}</span> <br/>
                          {{$content->file}} <br/> 
                          <a href="{{url('kurse-view-document/'.$content->id)}}" class="button is-primary is-small">{{ trans('fe.view_document') }}</a> 
                        </p>
                      </div>
                      
                    </div>
                  </article>
                  @endforeach
               </div>
            </div>
         </div>
      </div>

      <div class="column is-6">
         <div class="card tile is-child">
            <div class="card-content">
               <div class="is-mobile">
                  <h2 class="is-underlined has-text-weight-bold">{{ trans('fe.videos') }}</h2> <br/>

                  @foreach($course->contents->where('type','=','videos') as $content)
                  <article class="media">
                     <figure class="media-left">
                            <p class="image ">
                              <img src="{{url('content/courses/'.$course->image)}}" style="width: 8.0rem;">
                            </p>
                          </figure>

                     <div class="media-content">
                      <div class="content">
                        <p>
                          <span class="has-text-weight-bold">{{$course->name}}</span> <br/>
                          &nbsp; <br/> 
                          <a href="{{url('kurse-watch-video/'.$content->id)}}" class="button is-primary is-small">{{ trans('fe.watch_video') }}</a> 
                        </p>
                      </div>
                      
                    </div>
                  </article>
                  @endforeach
                  
               </div>
            </div>
         </div>
      </div>

   </div>
   
</section>
@endsection