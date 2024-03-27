<style>
.iframe100 {
    display: block;
    border: none;
    height: 100vh;
    width: 100vw;
}

</style>
<form action="" name="fm">
    <input type="hidden" name="mode" value="{{ $data['mode'] }}">
    <input type="hidden" name="jiwonNm" value="{{ $data['jiwonNm'] }}">
    <input type="hidden" name="sano" value="{{ $data['sano'] }}">
    <input type="hidden" name="no" value="{{ $data['no'] }}">
    <input type="hidden" name="type" value="">
</form>
<div class="pop_sect">
    <select name="page_type" id="page_type" onchange="fm.type.value=this.value;fm.submit()">
        <option value="RetrieveRealEstDetailInqSaList.laf" @if($data['type']=="RetrieveRealEstDetailInqSaList.laf"){{ __("selected") }}@endif>사건내역</option>
        <option value="RetrieveRealEstSaDetailInqGiilList.laf" @if($data['type']=="RetrieveRealEstSaDetailInqGiilList.laf"){{ __("selected") }}@endif>기일내역</option>
        <option value="RetrieveRealEstSaHjosa.laf" @if($data['type']=="RetrieveRealEstSaHjosa.laf"){{ __("selected") }}@endif>현황조사</option>
        <option value="RetrieveRealEstSaDetailInqMungunSongdalList.laf" @if($data['type']=="RetrieveRealEstSaDetailInqMungunSongdalList.laf"){{ __("selected") }}@endif>문건송달내역</option>
        <option value="RetrieveRealEstCarHvyMachineMulDetailInfo.laf" @if($data['type']=="RetrieveRealEstCarHvyMachineMulDetailInfo.laf"){{ __("selected") }}@endif>물건상세</option>
    </select>
</div>
<div class="pop_wr">
    @empty($data['html'])
    <iframe src="{{ $data['link_url'] }}" frameborder="0" id="iframe" class="iframe100"></iframe>
    @else
    <div class="pop_table">
        {!! $data['html'] !!}
    </div>
    @endempty
</div>
