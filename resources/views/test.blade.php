@extends('layout.layout')

@section('content')

<p onclick="$alertLoading();">[loading]</p>

<p onclick="Snackbar.show({ text:'Notice', actionText: 'Thanks!', pos: 'bottom-center' });">[snackbar]</p>
</section>

@endsection