
@if(session('success'))
    <script>
        swiftalert('{{ session('success') }}', 'success', {closable:false});
    </script>
@endif

@if(session('danger'))
    <script>
        swiftalert('{{ session('danger') }}', 'danger', {closable:false});
    </script>
@endif

@if(session('warning'))
    <script>
        swiftalert('{{ session('warning') }}', 'warning', {closable:false});
    </script>
@endif

@if(session('question'))
    <script>
        swiftalert('{{ session('question') }}', 'question', {closable:false});
    </script>
@endif

@if(session('info'))
    <script>
        swiftalert('{{ session('info') }}', 'info', {closable:false});
    </script>
@endif

@if(session('default') or session('message'))
    <script>
        swiftalert('{{ session('default') or session('message') }}', 'default', {closable:false});
    </script>
@endif
