@extends('layout.layout')

@section('content')

<p onclick="$alertLoading();">[loading]</p>

<p onclick="sbAlert('관심매물로 담겼습니다.')">[스낵바 - 알림]</p>
<p onclick="sbAlert('로그인 후 이용하세요.', 'warning')">[스낵바 - 경고]</p>
</section>

@endsection