@if(session('mensajeerror'))
    <script>
        Swal.fire({
            icon: 'error',
            title: '{{ session('mensajeerror') }}'
        });
    </script>
@endif