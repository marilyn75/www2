@php
    $path = $data['gbn']=="a" ? "/storage/courtauction/":"/storage/onbid/";
    $file = $path . $data['saNo'] . '/' . $data['fn'];
@endphp

<div class="modal fade login_modal logmod aucmod" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-scroll">
                <iframe src="http://apidata.localhost:8080/PDFViewer/full/viewer.html?file={{ $file }}" frameborder="0" height="100%"></iframe>
            </div>

        </div>
    </div>
</div>
