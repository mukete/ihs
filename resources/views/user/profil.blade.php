@extends('layouts.user')
@section('content')


<section class="section is-main-section">
   <div class="tile is-ancestor">
      <div class="tile is-parent">
         <div class="card tile is-child">
            <div class="card-content">
               <div class="columns">
                  <div class="column is-half">

                     <h5>{{ trans('fe.update_avatar') }}</h5>
                     @if(auth()->user()->avatar == null)
                     <img src="https://avatars.dicebear.com/v2/initials/{{auth()->user()->name}}.svg" width="25%">
                     @else
                      <img src="{{url('content/users/'.auth()->user()->avatar)}}" width="30%">
                     @endif
                     <form action="{{url('change-avatar')}}" method="post" enctype="multipart/form-data">
                      @csrf

                        <div class="field">
                          <label class="label">{{ trans('fe.image') }}</label>
                          <div class="control">
                            <input class="input @error('image') is-danger @enderror" type="file" name="image" onchange="submit()">
                            @error('image')
                                <p class="help is-danger" >
                                    {{ $message }}
                                </p>
                            @enderror
                          </div>
                        </div>

                     </form>

                     <hr/>
                     <h5>{{ trans('fe.update_display_name') }}</h5>
                     <form action="{{url('change-name')}}" method="post">
                      @csrf

                        <div class="columns">
                          <div class="column is-6">
                            <div class="field">
                              <label class="label">{{ trans('fe.first_name') }}</label>
                              <div class="control">
                                <input class="input @error('vorname') is-danger @enderror" type="text" name="vorname" value="{{ explode(' ',trim(auth()->user()->name))[0]}}">
                                @error('vorname')
                                    <p class="help is-danger" >
                                        {{ $message }}
                                    </p>
                                @enderror
                              </div>
                            </div>
                          </div>

                          <div class="column is-6">
                            <div class="field">
                              <label class="label">{{ trans('fe.last_name') }}</label>
                              <div class="control">
                                <input class="input @error('nachname') is-danger @enderror" type="text" name="nachname" value="{{ explode(' ',trim(auth()->user()->name))[1]}}">
                                @error('nachname')
                                    <p class="help is-danger" >
                                        {{ $message }}
                                    </p>
                                @enderror
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="field is-grouped">
                          <div class="control">
                            <button type="submit" class="button is-link">{{ trans('fe.update_name') }}</button>
                          </div>

                        </div>

                     </form>

                     

                     

                  </div>

                  <div class="column is-half">

                     <h5>{{ trans('fe.update_password') }}</h5>

                     <form>

                        <div class="field">
                          <label class="label">{{ trans('fe.current_password') }}</label>
                          <div class="control">
                            <input class="input" type="password" name="current_password" >
                          </div>
                        </div>

                        <div class="field">
                          <label class="label">{{ trans('fe.new_password') }}</label>
                          <div class="control">
                            <input class="input" type="password" name="password" >
                          </div>
                        </div>

                        <div class="field">
                          <label class="label">{{ trans('fe.confirm_new_password') }}</label>
                          <div class="control">
                            <input class="input" type="password" name="password_confirmation" >
                          </div>
                        </div>

                        <div class="field is-grouped">
                          <div class="control">
                            <button type="submit" class="button is-link">{{ trans('fe.update_password') }}</button>
                          </div>

                        </div>

                     </form>
                     
                  </div>

               </div>
            </div>
         </div>
      </div>
        
   </div>
   
</section>
@endsection