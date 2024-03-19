<div class="modal fade login_modal account_modal" id="accountModal" tabindex="-1" aria-labelledby="loginModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <h4><img src="/images/modal/account.png" alt="">{{ $data['title'] }}</h4>
            @foreach ($data['items'] as $item)
            <div class="pdf_list">
                <div class="pdf_lf">
                    <p class="pdf_bdg">{{ $item['fn']['파일정보']['extension'] }}</p>
                    <div class="pdf_txt">
                        {{-- <p class="date">2022-07-29</p> --}}
                        <p class="name">{{ $item['fn']['파일명'] }}</p>
                        <p class="kb">{{ $item['fn']['파일정보']['print_size'] }}</p>
                    </div>
                </div>
                @if($item['fn']['파일정보']['extension']=="pdf")
                <button class="pdf_list_btn modal-button" data-url="modal.pdfviewer">
                    <input type="hidden" name="params" value='{!! json_encode($item) !!}'>
                    열기
                </button>
                @elseif($item['fn']['파일정보']['extension']=="jpg")
                <button class="pdf_list_btn modal-button" data-url="modal.imgviewer">
                    <input type="hidden" name="params" value='{!! json_encode($item) !!}'>
                    열기
                </button>
                @else
                <a class="pdf_list_btn" href="{{ env('AUCTION_API_URL') }}/download/{{ str_replace("storage/onbid/","",$item['fn']['파일경로']) }}">
                    다운로드
                </a>
                @endif 
            </div>
            @endforeach
            
            {{-- <div class="pdf_list">
                <div class="pdf_lf">
                    <p class="pdf_bdg">pdf</p>
                    <div class="pdf_txt">
                        <p class="date">2022-07-29</p>
                        <p class="name">031 공매재산명세서.pdf</p>
                        <p class="kb">115.24 KB</p>
                    </div>
                </div>
                <button class="pdf_list_btn">열기</button>
            </div> --}}

            {{-- 닫기버튼 --}}
            <div class="mod-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <img src="../images/modal/close_btn.png" alt="">
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
