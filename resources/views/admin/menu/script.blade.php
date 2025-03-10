{{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> --}}
<script src="/_Editor/mceEditor/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    $(document).ready(function(){
        tinymce.init({
            selector: '#content',
            mobile: {
                menubar: true
            },
            language: 'ko_KR',
            //plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion',
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap emoticons',
            toolbar: "undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl",
            quickbars_selection_toolbar: 'bold italic | blocks | quicklink blockquote',
            
        });
    });

    $(document).on("change", "input[name='type']", function(){
        var type = this.value;
        console.log(type);
        $(".type-addInput").hide();
        // alert($("#addInput-" + type).html());
        $("#addInput" + type).removeClass("d-none");
        $("#addInput" + type).show();
    });
</script>