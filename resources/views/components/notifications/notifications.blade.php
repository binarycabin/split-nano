@if (isset($errors) && $errors->any())
    @foreach($errors->getMessages() as $errorKey => $errors)
        @foreach($errors as $error)
            <script>
                window.toastr.error('{{ $error }}', '{{ ucwords($errorKey) }}')
            </script>
        @endforeach
    @endforeach
@endif

@if ($message = Session::get('status'))
    <script>
        window.toastr.info('{{ $message }}')
    </script>
@endif

@if ($message = Session::get('success'))
    <script>
        window.toastr.success('{{ $message }}')
    </script>
@endif

@if ($message = Session::get('error'))
    <script>
        window.toastr.error('{{ $message }}')
    </script>
@endif

@if ($message = Session::get('warning'))
    <script>
        window.toastr.warning('{{ $message }}')
    </script>
@endif

@if ($message = Session::get('info'))
    <script>
        window.toastr.info('{{ $message }}')
    </script>
@endif