@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', () => {
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: '{{ session('success') }}',
        });
    })
</script>
@endif

@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', () => {
        Swal.fire({
            icon: 'error',
            title: 'Erro!',
            text: '{{ session('error') }}',
        });
    })
</script>
@endif

@if ($errors->any())
    @php $message = ''; @endphp

    @foreach ($errors->all() as $error)
        @php $message .= ($error) . '<br>'; @endphp
    @endforeach

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                html: '{!! $message !!}',
            });
        })
    </script>
@endif
