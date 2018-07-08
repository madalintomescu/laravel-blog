@if (session('success'))
<script>alertify.success('{{ session('success') }}');</script>
@endif

@if (session('error'))
<script>alertify.error('{{ session('error') }}');</script>
@endif
