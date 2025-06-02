@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('register') }}" class="bg-blue-300 md:w-xl flex flex-col place-items-center h-fit">
        <div>{{ __('Register') }}</div>
        @csrf
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                  <svg class="w-5 h-5 " viewBox="0 0 60.671 60.671" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <ellipse style="fill:#8ec5ff;" cx="30.336" cy="12.097" rx="11.997" ry="12.097"></ellipse> <path style="fill:#8ec5ff;" d="M35.64,30.079H25.031c-7.021,0-12.714,5.739-12.714,12.821v17.771h36.037V42.9 C48.354,35.818,42.661,30.079,35.64,30.079z"></path> </g> </g> </g></svg>
            </span>
            <input
              type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name"
              autofocus
              placeholder={{ __('Name') }}
              class="pl-10 pr-4 py-2 bg-white text-blue-500 border border-gray-300  focus:outline-none focus:ring-2 "
            />
            @error('name')
                    <span role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
          </div>
          
        

        <div>
            <label for="email">{{ __('Email Address') }}</label>
            <div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    autocomplete="email">

                @error('email')
                    <span role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div>
            <label for="password">{{ __('Password') }}</label>
            <div>
                <input id="password" type="password" name="password" required autocomplete="new-password">

                @error('password')
                    <span role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div>
            <label for="password-confirm">{{ __('Confirm Password') }}</label>
            <div>
                <input id="password-confirm" type="password" name="password_confirmation" required
                    autocomplete="new-password">
            </div>
        </div>

        <div>
            <div>
                <button type="submit">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </form>
@endsection
