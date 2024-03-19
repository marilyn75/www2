@php
    $path = $data['gbn']=="a" ? "/storage/courtauction/":"/storage/onbid/";
    $file = $path . $data['saNo'] . '/' . $data['fn']['파일명'];
@endphp

<div class="modal fade login_modal logmod aucpdfmod" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-scroll">
                <a href="{{ env('AUCTION_API_URL') }}/{{ $file }}" target="_blank"><img src="{{ env('AUCTION_API_URL') }}/{{ $file }}" height="100%" style="cursor: pointer;"></img></a>
            </div>

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
