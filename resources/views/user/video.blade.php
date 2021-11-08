@extends('layouts.user')
@section('content')


<section class="section is-main-section">
   <div class="tile is-ancestor">
      <div class="tile is-parent">
         <div class="card tile is-child">
            <div class="card-content">
               <div class="columns">
                  

                  <div class="column is-full">
                     <a href="{{url('kurse/'.$document->course->slug)}}" class="button is-danger is-outlined "><span class="material-icons">arrow_back</span> &nbsp; {{ trans('fe.back') }} </a> <br/>

                    <h2 class="is-size-4">{{$document->course->name}}</h2>

                    

                    <{!! $document->file !!}
                     
                  </div>

               </div>
            </div>
         </div>
      </div>
        
   </div>
   
</section>
@endsection