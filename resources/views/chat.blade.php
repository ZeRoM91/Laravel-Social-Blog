@extends('layouts.app')
@section('content')




<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>

<script>
    var socket = io(':6001');
</script>
@endsection