<html lang="en">
@include('frontend.layouts.head')
@yield('css')
<body>
    @if(Request::route()->getName() != 'login' && Request::route()->getName() != 'register' && Request::route()->getName() != 'password.request' && Request::route()->getName() != 'password.reset')
        @include('frontend.layouts.header')
    @endif
        @yield('content')
    @if(Request::route()->getName() != 'login' && Request::route()->getName() != 'register' && Request::route()->getName() != 'password.request' && Request::route()->getName() != 'password.reset')
        @include('frontend.layouts.footer')
    @endif
    @include('admin.layouts.alert')
    @yield('js')
    @livewireScripts
    <script>
        window.addEventListener('swal:modal', event => { 
            swal({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
            });
        });
        
        window.addEventListener('swal:confirm', event => { 
            swal({
            title: event.detail.message,
            text: event.detail.text,
            icon: event.detail.type,
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                window.livewire.emit('remove');
            }
            });
        });
    </script>
</body>
</html>