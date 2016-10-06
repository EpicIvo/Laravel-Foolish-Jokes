@if(Auth::user()->role == 'user')
    <script>
        window.location.replace("http://homestead.app");
    </script>
@endif
