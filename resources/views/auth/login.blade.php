<!DOCTYPE html>
<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-slot name="logo_text">
            <x-auth-text />
        </x-slot>
        <x-validation-errors class="mb-4" />
        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Parol') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>


            <div class="form-group mt-3">
            {!! NoCaptcha::renderJs('uz', false, 'onloadCallBack') !!}
            {!! NoCaptcha::display() !!}
            </div>



            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Parolni unutdingizmi?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Kirish') }}
                </x-button>




            </div>

        </form>
    </x-authentication-card>
</x-guest-layout>









<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
   // let errors = @json($errors->all());
 //   @if($errors->any())
   // let msg = '';
  //  for (let i = 0; i < errors.length; i++) {
   //     msg += (i + 1) + '-xatolik ' + errors[i] + '\n';
 //   }
  //  Swal.fire({
 //       icon: 'error',
 //       title: 'Xatolik',
  //      text: msg,
//    });
//    @endif
 //   @if(session('msg'))
//    Swal.fire({
 //       icon: 'success',
//        title: 'Muvaffaqiyatli',
 //       text: '{{ session('msg') }}',
  //  });


//    @endif

</script>
<script>
    var onloadCallBack = function() {
        alert('grecaptcha is ready!');
    }
    </script>
</body>
</html>

