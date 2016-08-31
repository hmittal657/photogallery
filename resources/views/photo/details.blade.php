@extends('layouts.main')
@section('content')
<div class="callout primary">
<div class="row column">
<a href="/gallery/show/{{$photo->gallery_id}}">Back to Gallery</a>
<h1 style="text-align: center;">{{$photo->title}}</h1>
<h5>Location:  {{$photo->location}}</h5>
<p class="lead">{{$photo->description}}</p>
</div>
</div>
<div class="row small-up-2 medium-up-3 large-up-4">

		
		<img class="main-image" src="/images/{{$photo->image}}">
		
		
		


</div>
@stop