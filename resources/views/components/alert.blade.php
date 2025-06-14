@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire('Sucesso!', "{!! session('success') !!}", 'success');
        })
    </script>
@endif

@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire('Erro!', "{!! session('error') !!}", 'error');
        })
    </script>
@endif

@if(session('warning'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire('Atenção!', "{!! session('warning') !!}", 'warning');
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
