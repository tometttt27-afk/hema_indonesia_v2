<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="success" content="{{ session('success') }}">
    <meta name="error" content="{{ session('error') }}">
    <meta name="errors" content='@json($errors->all())'>
    <title>Reset Password | Hema.Indonesia</title>
    {{-- Auth css --}}
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    {{-- Font Urbanist --}}
    <link rel="stylesheet" href="{{ asset('library/font/urbanist.css') }}">
    {{-- Sweetalert css --}}
    <link rel="stylesheet" href="{{ asset('library/sweetalert/sweetalert2.min.css') }}">
    {{-- Icon Fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/app.css')
</head>

<body class="bg-[#f5f5f5] font-urbanist">
    <section class="container w-full py-6 h-dvh flex justify-center items-center auth">
        <main class="content bg-white p-5 md:p-8 rounded w-full md:1/3 xl:w-1/2">
            <h1 class="lg:text-3xl md:text-2xl text-xl text-center font-bold mb-2">
                <span class="text-primary">Hema</span>.Indonesia
            </h1>
            <div class="my-6">
                <h2 class="font-semibold md:text-xl text-lg">Reset your password</h2>
                <p class="text-gray-500 text-[13.3px] md:text-[14px]">Enter your new password below</p>
            </div>
            <form action="{{ route('resetPasswordPost') }}" method="post">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group mb-4">
                    <label
                        class="label-form block mb-1 text-gray-800 text-[13.5px] md:text-[14.7px] tracking-wider">Email</label>
                    <input type="text"
                        class="inline-block placeholder:text-[13.5px] md:placeholder:text-[14.7px] text-[13.5px] md:text-[14.7px] tracking-wide bg-white border-[1.8px] border-gray-600 w-full py-2.5 px-3 focus:border-primary outline-none rounded-md"
                        name="email" placeholder="Enter your email" id="email"
                        value="{{ old('email', $email) }}" autocomplete="off">
                </div>
                <div class="form-group mb-4 relative">
                    <label
                        class="label-form block mb-1 text-gray-800 text-[13.5px] md:text-[14.7px] tracking-wider">New
                        Password</label>
                    <input type="password"
                        class="inline-block placeholder:text-[13.5px] md:placeholder:text-[14.7px] text-[13.5px] md:text-[14.7px] tracking-wide bg-white border-[1.8px] border-gray-600 w-full py-2.5 px-3 focus:border-primary outline-none rounded-md"
                        name="password" placeholder="Enter your new password" id="password" autocomplete="off">
                </div>
                <div class="form-group mb-6 relative">
                    <label
                        class="label-form block mb-1 text-gray-800 text-[13.5px] md:text-[14.7px] tracking-wider">Confirm
                        Password</label>
                    <input type="password"
                        class="inline-block placeholder:text-[13.5px] md:placeholder:text-[14.7px] text-[13.5px] md:text-[14.7px] tracking-wide bg-white border-[1.8px] border-gray-600 w-full py-2.5 px-3 focus:border-primary outline-none rounded-md"
                        name="password_confirmation" placeholder="Confirm your new password" id="password_confirmation"
                        autocomplete="off">
                </div>
                <div class="form-group">
                    <button
                        class="inline-block text-[13.5px] md:text-[14.7px] font-medium tracking-widest text-center rounded-md bg-gradient-to-r from-primary to-secondary text-white py-2.5 px-3 w-full hover:opacity-[90%]"
                        type="submit">Reset Password</button>
                </div>
                <p class="text-center text-[13.5px] md:text-sm mt-4 text-gray-500">Back to <a
                        href="{{ url('auth/sign-in') }}" class="text-primary font-medium">Sign In</a></p>
            </form>
        </main>
    </section>

    <script src="{{ asset('library/sweetalert/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/auth.js') }}"></script>
    <script src="{{ asset('js/alert.js') }}"></script>

</body>

</html>
