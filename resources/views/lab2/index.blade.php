@extends('layouts.app')
@section('content')
    @if (isset($result))
        <div class="row justify-content-center mt-3">
            <div class="col-5">
                @forelse($result as $message)
                    <div class="alert alert-{{$message['type']}}" role="alert">
                        <b>{{$message['header']}}</b>
                        {{$message['text']}}
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    @endif
@endsection
