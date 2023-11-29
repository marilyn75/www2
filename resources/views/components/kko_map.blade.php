@php
    $x = $printData['localX'];
    $y = $printData['localY'];
    // 오차 주기 => 위치 특정 못하게
    $pn = (Rand(0,1))?0.0000007:-0.0000007;
    $x = $x + (Rand(0,1000) * $pn);
    $pn = (Rand(0,1))?0.0000007:-0.0000007;
    $y = $y + (Rand(0,1000) * $pn);
    // debug($x,$y);
@endphp

<script src="//dapi.kakao.com/v2/maps/sdk.js?appkey={{ env('KAKAO_SCRIPT_KEY') }}"></script>
<div id="map" style="width:auto;height:400px;">
<script>
    var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
        mapOption = {
            center: new kakao.maps.LatLng({{ $y }}, {{ $x }}), // 지도의 중심좌표
            level: 5, // 지도의 확대 레벨
            mapTypeId : kakao.maps.MapTypeId.ROADMAP // 지도종류
        }; 

    // 지도를 생성한다 
    var map = new kakao.maps.Map(mapContainer, mapOption); 

    // 이미지 마커
    var imageSrc = '/images/map/map_mark.png', // 마커이미지의 주소입니다    
    imageSize = new kakao.maps.Size(65, 65), // 마커이미지의 크기입니다
    imageOption = {offset: new kakao.maps.Point(32.5, 32.5)}; // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.
    // 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다
    var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption),
        markerPosition = new kakao.maps.LatLng({{ $y }}, {{ $x }}); // 마커가 표시될 위치입니다

    // 마커를 생성합니다
    var marker = new kakao.maps.Marker({
        position: markerPosition, 
        image: markerImage // 마커이미지 설정 
    });

    // 마커가 지도 위에 표시되도록 설정합니다
    marker.setMap(map);  
      

    // 지도에 원을 표시한다
    var circle = new kakao.maps.Circle({
        map: map, // 원을 표시할 지도 객체
        center : new kakao.maps.LatLng({{ $y }}, {{ $x }}), // 지도의 중심 좌표
        radius : 300, // 원의 반지름 (단위 : m)
        fillColor: 'rgba(56, 95, 141, 0.44)', // 채움 색
        fillOpacity: 0.9, // 채움 불투명도
        strokeWeight: 3, // 선의 두께
        strokeColor: 'rgba(56, 95, 141, 0.44)', // 선 색
        strokeOpacity: 0.1, // 선 투명도 
        strokeStyle: 'solid' // 선 스타일
    });	
    // 마우스 휠과 모바일 터치를 이용한 지도 확대, 축소를 막는다
    map.setZoomable(false); 

    // 지도에 표시된 마커 객체를 가지고 있을 배열입니다
    var markers = [];

    // 마커를 생성하고 지도위에 표시하는 함수입니다
    function addMarker(position) {
        // 마커를 생성합니다
        var marker = new kakao.maps.Marker({
            position: position
        });

        // 마커가 지도 위에 표시되도록 설정합니다
        marker.setMap(map);
        
        // 생성된 마커를 배열에 추가합니다
        markers.push(marker);
        panTo(position);
    }

    // 지도를 부드럽게 이동시킵니다.
    function panTo(position) {
        map.panTo(position); 
    }

</script>

{{-- <div id="map" style="width:auto;height:400px;">
    @if (!empty($printData['mapUrl']))
    <img src="{{ $printData['mapUrl'] }}">
    @endif
</div> --}}
