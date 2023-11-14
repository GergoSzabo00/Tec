<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }} | Admin</title>
        
        <!-- FONTS -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- BOOTSTRAP -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
        <!-- FONTAWESOME -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" rel="stylesheet"  integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <!-- BOOTSTRAP SELECT -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- CUSTOM STYLES -->
        <link href="{{ url('/css/main.css') }}" rel="stylesheet">
        <link href="{{ url('/css/flag-icons.css') }}" rel="stylesheet">
        <link href="{{ url('/css/admin.css')}}" rel="stylesheet">
        @stack('styles')

        <!-- ICONS -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ url('/images/favicons/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ url('/images/favicons/favicon-16x16.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ url('/images/favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ url('/images/favicons/android-chrome-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="512x512" href="{{ url('/images/favicons/android-chrome-512x512.png') }}">
        <link rel="manifest" href="{{ url('/images/favicons/site.webmanifest') }}">

        <!-- COOKIE CONSENT -->
        <link rel="stylesheet" type="text/css" href="{{asset("vendor/cookie-consent/css/cookie-consent.css")}}">

    </head>
    <body class="bg-light">
        <div class="d-flex">
            @include('layouts._adminsidebar')
            <div class="d-flex flex-column flex-grow-1 overflow-hidden">
                @include('layouts._adminheader')
                <main class="container py-3">
                    @include('layouts._alerts')
                    @yield('content')
                </main>
            </div>
        </div>
        @include('layouts._footer')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment-with-locales.min.js" integrity="sha512-vFABRuf5oGUaztndx4KoAEUVQnOvAIFs59y4tO0DILGWhQiFnFHiR+ZJfxLDyJlXgeut9Z07Svuvm+1Jv89w5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-plugins/1.11.5/dataRender/datetime.min.js" integrity="sha512-Y3Ulty7sQ+NtFcJgnpiQae1cANhX4Ozfwo+Hn7JaZtpKkLHtb60P7i+b/v0ponlLjWF+DEXPPnUuHEBg84K7Hw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.all.min.js" integrity="sha256-aHuHTU7SdMUuRBFzJX+PRkbfy9kd0uGHS8uc4M/NVBo=" crossorigin="anonymous"></script>
        <script src="{{ url('/js/admin.js') }}"></script>
        @stack('scripts')
    </body>
</html>
