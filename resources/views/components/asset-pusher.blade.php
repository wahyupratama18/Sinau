@push('css')
@foreach ($css ?? [] as $key)
<link rel="stylesheet" type="text/css" href="{{ $key }}">
@endforeach
@endpush

@push('js')    
@foreach ($js ?? [] as $key)
<script src="{{ $key }}"></script>
@endforeach
@endpush