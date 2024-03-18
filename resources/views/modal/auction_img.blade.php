<div class="modal fade login_modal auction_img" id="auctionImgModal" tabindex="-1" aria-labelledby="loginModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-scroll">
                <div class="img-container">
                    <img class="big-img" id="selectedImg" src="/images/auction/auction01.png" alt="">
                    <div class="image-index" id="imageIndex">
                        1/3
                    </div>
                </div>
                <div class="small-images">
                    <img class="small-img" onclick="changeImg('/images/auction/auction01.png', 1)"
                        src="/images/auction/auction01.png" alt="">
                    <img class="small-img" onclick="changeImg('/images/auction/auction02.png', 2)"
                        src="/images/auction/auction02.png" alt="">
                    <img class="small-img" onclick="changeImg('/images/auction/auction03.png', 3)"
                        src="/images/auction/auction03.png" alt="">
                        <img class="small-img" onclick="changeImg('/images/auction/auction01.png', 1)"
                        src="/images/auction/auction01.png" alt="">
                    <img class="small-img" onclick="changeImg('/images/auction/auction02.png', 2)"
                        src="/images/auction/auction02.png" alt="">
                    <img class="small-img" onclick="changeImg('/images/auction/auction03.png', 3)"
                        src="/images/auction/auction03.png" alt="">
                </div>
            </div>
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
<script>
    let totalImages = 3; // Total number of images
    let currentIndex = 1; // Current index of selected image

    // JavaScript functions to handle image changes and modal functionality
    function openModal() {
        document.getElementById('auctionImgModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('auctionImgModal').style.display = 'none';
    }

    function changeImg(imgSrc, index) {
        document.getElementById('selectedImg').src = imgSrc;
        updateIndex(index);
    }

    function updateIndex(index) {
        currentIndex = index;
        document.getElementById('imageIndex').innerText = currentIndex + '/' + totalImages;
    }
</script>
