@extends('layouts.main')
@section('content')
<div class="callout primary">
<div class="row column">
<h1>Reset Your Password</h1>

</div>
</div>
<div class="row small-up-2 medium-up-3 large-up-4">
	<div class="main">
	
Click here to reset your password: <a class="button" href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>

	</div>
</div>
@stop



