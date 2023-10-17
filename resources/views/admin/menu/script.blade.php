<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    $(document).ready(function(){
        tinymce.init({
            selector: '#content',
            mobile: {
                menubar: true
            },
            language: 'ko_KR',
            plugins: 'quickbars',
            quickbars_selection_toolbar: 'bold italic | blocks | quicklink blockquote',
            
        });
    });

    $(document).on("change", "input[name='type']", function(){
        var type = this.value;

        $(".type-addInput").hide();
        // alert($("#addInput-" + type).html());
        $("#addInput" + type).removeClass("d-none");
        $("#addInput" + type).show();
    });
</script>