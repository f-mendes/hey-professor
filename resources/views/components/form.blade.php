@props([
    'action',
    'put' => false,
    'post' => false,
    'delete' => false,
    'patch' => false,    
])

<form action="{{$action}}" method="post">
    @csrf
    @if($put)
        @method('put')
    @endif
    @if($patch)
        @method('patch')
    @endif
    @if($delete)
        @method('delete')
    @endif

    {{$slot}}
</form>