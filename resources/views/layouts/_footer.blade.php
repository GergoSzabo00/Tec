<footer class="bg-dark text-center text-white">
    <div class="container p-3">
        <a href="{{route('privacy.policy')}}">Adatvédelmi nyilatkozat</a>
        <div class="mt-2">
            <a href="https://www.flaticon.com/free-icons/technology" title="technology icons">Technology icons used as a logo and favicon are created by Freepik - Flaticon</a>
        </div>
        <div class="text-center mt-2">
            Copyright &copy; {{ now()->year  }} {{ config('app.name') }}
        </div>
    </div>
</footer>