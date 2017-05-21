@extends('layouts.app')

@section('content')
    @foreach($posts as $item)
        <div class="panel panel-info">
            <div class="panel-heading">
                {{ $item->user->name }}
            </div>
            <div class="panel-body">
                {{ $item->name }}
            </div>
            <post :id={{ $item->id }} :votes={{ $item->votes }}></post>
        </div>
    @endforeach
    
    <div>
        {{ $posts->links() }}
    </div>
@endsection