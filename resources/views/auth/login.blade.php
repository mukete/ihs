@extends('layouts.auth')

@section('content')
<section class="hero is-fullheight">
  <div class="hero-body">
    <div class="container">

      <div class="columns has-text-centered is-centered">
        <div class="column is-5-tablet is-4-desktop is-3-widescreen">
          <img cl src="{{url('ihs.png')}}" style="max-width: 50%;" >
          <form action="{{ route('login') }}" class="box" method="post">
            @csrf
            <div class="field">
              <!-- <label for="" class="label">Email</label> -->
              <div class="control has-icons-left">
                <input type="email" placeholder="Email" class="input @error('email') is-danger @enderror is-rounded" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <p class="help is-danger" >
                        {{ $message }}
                    </p>
                @enderror
              </div>
            </div>
            <div class="field">
              <!-- <label for="" class="label">Password</label> -->
              <div class="control has-icons-left">
                <input type="password" placeholder="Password" class="input @error('password') is-danger @enderror is-rounded" name="password" required autocomplete="current-password">
                @error('password')
                    <p class="help is-danger" >
                        {{ $message }}
                    </p>
                @enderror
              </div>
            </div>
            
            <div class="field">
              <button class="button is-success is-rounded is-fullwidth is-uppercase">
                Login
              </button>
            </div>

            <div class="field">
              <a href="{{ route('password.request') }}" class="is-size-7" >Forgot password</a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>
@endsection
