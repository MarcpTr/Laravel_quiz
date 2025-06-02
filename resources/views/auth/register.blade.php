@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('register') }}" class="bg-blue-300 w-96 flex flex-col place-items-center h-fit rounded-2xl space-y-6 pt-3 pb-16 text-white">
        <div class="text-4xl">Registrate</div>
        @csrf
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="w-5 h-5 " viewBox="0 0 60.671 60.671" xml:space="preserve" fill="#000000">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <g>
                            <g>
                                <ellipse style="fill:#8ec5ff;" cx="30.336" cy="12.097" rx="11.997" ry="12.097">
                                </ellipse>
                                <path style="fill:#8ec5ff;"
                                    d="M35.64,30.079H25.031c-7.021,0-12.714,5.739-12.714,12.821v17.771h36.037V42.9 C48.354,35.818,42.661,30.079,35.64,30.079z">
                                </path>
                            </g>
                        </g>
                    </g>
                </svg>
            </span>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name"
                autofocus placeholder="nombre"
                class="pl-10 pr-4 py-2 bg-white text-blue-500 border border-gray-300  focus:outline-none focus:ring-2 " />
        </div>

        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="w-5 h-5 " viewBox="0 0 24 24" fill="#8ec5ff">
                    <g stroke-width="0"></g>
                    <g stroke-linecap="round" stroke-linejoin="round"></g>
                    <g>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M3.75 5.25L3 6V18L3.75 18.75H20.25L21 18V6L20.25 5.25H3.75ZM4.5 7.6955V17.25H19.5V7.69525L11.9999 14.5136L4.5 7.6955ZM18.3099 6.75H5.68986L11.9999 12.4864L18.3099 6.75Z"
                            fill="#8ec5ff"></path>
                    </g>
                </svg>
            </span>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                autofocus placeholder="correo electronico"
                class="pl-10 pr-4 py-2 bg-white text-blue-500 border border-gray-300  focus:outline-none focus:ring-2 " />
        </div>

        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g stroke-width="0"></g>
                    <g stroke-linecap="round" stroke-linejoin="round"></g>
                    <g>
                        <path
                            d="M12 14.5V16.5M7 10.0288C7.47142 10 8.05259 10 8.8 10H15.2C15.9474 10 16.5286 10 17 10.0288M7 10.0288C6.41168 10.0647 5.99429 10.1455 5.63803 10.327C5.07354 10.6146 4.6146 11.0735 4.32698 11.638C4 12.2798 4 13.1198 4 14.8V16.2C4 17.8802 4 18.7202 4.32698 19.362C4.6146 19.9265 5.07354 20.3854 5.63803 20.673C6.27976 21 7.11984 21 8.8 21H15.2C16.8802 21 17.7202 21 18.362 20.673C18.9265 20.3854 19.3854 19.9265 19.673 19.362C20 18.7202 20 17.8802 20 16.2V14.8C20 13.1198 20 12.2798 19.673 11.638C19.3854 11.0735 18.9265 10.6146 18.362 10.327C18.0057 10.1455 17.5883 10.0647 17 10.0288M7 10.0288V8C7 5.23858 9.23858 3 12 3C14.7614 3 17 5.23858 17 8V10.0288"
                            stroke="#8ec5ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg></span>

            <input type="password" id="password" name="password" value="{{ old('Password') }}" required
                autocomplete="new-password" minlength="8" autofocus placeholder="contraseña"
                class="pl-10 pr-4 py-2 bg-white text-blue-500 border border-gray-300  focus:outline-none focus:ring-2 " />

        </div>

        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g stroke-width="0"></g>
                    <g stroke-linecap="round" stroke-linejoin="round"></g>
                    <g>
                        <path
                            d="M12 14.5V16.5M7 10.0288C7.47142 10 8.05259 10 8.8 10H15.2C15.9474 10 16.5286 10 17 10.0288M7 10.0288C6.41168 10.0647 5.99429 10.1455 5.63803 10.327C5.07354 10.6146 4.6146 11.0735 4.32698 11.638C4 12.2798 4 13.1198 4 14.8V16.2C4 17.8802 4 18.7202 4.32698 19.362C4.6146 19.9265 5.07354 20.3854 5.63803 20.673C6.27976 21 7.11984 21 8.8 21H15.2C16.8802 21 17.7202 21 18.362 20.673C18.9265 20.3854 19.3854 19.9265 19.673 19.362C20 18.7202 20 17.8802 20 16.2V14.8C20 13.1198 20 12.2798 19.673 11.638C19.3854 11.0735 18.9265 10.6146 18.362 10.327C18.0057 10.1455 17.5883 10.0647 17 10.0288M7 10.0288V8C7 5.23858 9.23858 3 12 3C14.7614 3 17 5.23858 17 8V10.0288"
                            stroke="#8ec5ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg></span>

            <input type="password" id="password_confirmation" name="password_confirmation" required
                autocomplete="new-password" minlength="8" autofocus placeholder="confirma la contraseña"
                class="pl-10 pr-4 py-2 bg-white text-blue-500 border border-gray-300  focus:outline-none focus:ring-2 " />
        </div>
        <div>            
                <button type="submit" class="rounded-4xl bg-blue-500 px-4 py-2 hover:bg-blue-600">
                    Crear cuenta
                </button>
        </div>
        @foreach (['password', 'email', 'name'] as $field)
            @error($field)
                <span role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        @endforeach
        <a class="hover:underline hover:text-blue-600 m-4"  href="{{ route('login') }}">¿Tienes una cuenta? Inicia sesión</a>
    </form>
@endsection
