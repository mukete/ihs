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

                    

                    <!-- {{$document->course}} -->

                    @if(substr($document->file, -3) == "pdf")
                    
                    @endif




                    <iframe src="https://docs.google.com/viewer?url={{url('content/documents/'.$document->file)}}&embedded=true" style="width:80%; height:720px; background: #ffffff;" frameborder="5"></iframe>


                     <!-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=https://filesamples.com/samples/document/ppt/sample3.ppt' width='100%' height='720' frameborder='5'></iframe> -->
                     
                  </div>

               </div>
            </div>
         </div>
      </div>
        
   </div>
   
</section>
@endsection