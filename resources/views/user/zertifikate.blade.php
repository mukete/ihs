@extends('layouts.user')
@section('content')


<section class="section is-main-section">

   <div class="columns is-multiline is-mobile ">

      @foreach($tookPassed as $cert)

      <div class="column is-one-third">
         <div class="card">
            <div class="card-content">

               <div class="columns">
                  <div class="col is-2">
                     <span class="material-icons is-size-1" style="color:#2980b9;">military_tech</span>
                  </div>
                  <div class="col is-8">
                     <span class="is-uppercase">{{$cert->course->name}}</span> 
                  </div>
                  <div class="col is-pulled-right is-2 ">
                     <div class="dropdown  is-hoverable">
                       <div class="dropdown-trigger">
                         <button class="button is-small is-white" aria-haspopup="true" aria-controls="dropdown-menu-zert">
                           <span><span class="material-icons">more_horiz</span></span>
                           <span class="icon is-small">
                             <i class="fa fa-angle-down" aria-hidden="true"></i>
                           </span>
                         </button>
                       </div>
                       <div class="dropdown-menu" id="dropdown-menu-zert" role="menu">
                         <div class="dropdown-content">
                           <a href="{{url('get-certificate/'.$cert->id)}}" class="dropdown-item" target="_blank">
                             View
                           </a>
                           <a href="{{url('get-certificate/'.$cert->id)}}" class="dropdown-item" target="_blank">
                             Download
                           </a>
                           
                         </div>
                       </div>
                     </div>
                  </div>
               </div>

               <div class="columns">
                  <div class="column is-full is-centered">
                     <span class="is-full">
                        {{trans('fe.validated_on')}} : <br/>

                        {{ strftime("%H:%M",strtotime($cert->updated_at)) }}
                              -
                              {{strftime("%A %e %B, %Y",strtotime($cert->updated_at))}}
                        
                     </span>
                     <hr class="is-centered is-full" style="border-radius: 0.2rem;height:0.4rem;background-image: linear-gradient(to right, #224F7A , #FCF25C); margin-left: 0.1rem;margin-right: 0.1rem;">
                  </div>
               </div>

               
               
            </div>
         </div>
      </div>

      @endforeach

   </div>  
   
</section>
@endsection