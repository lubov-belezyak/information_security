@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-5">
            {{Form::open(['url' => route('lab22.result'), 'method' => 'GET'])}}
            @include('lab2._form')
            <div class="row justify-content-center mt-3">
                <div class="col-auto">
                    <button class="btn btn-outline-success">Результат</button>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
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
