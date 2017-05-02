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
            <favorite :id={{ $item->id }} :votes={{ $item->votes }}></favorite>
        </div>
    @endforeach
    
    <div>
        {{ $posts->links() }}
    </div>
@endsection