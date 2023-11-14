<script>
    var data = '{{ $data }}';
    data = data.replace(/&quot;/g, '"');
    data = JSON.parse(data);
 
    $(document).ready(function(){
        var table = new DataTable('.table',{
            data:data,
            "columns" : [
                {"data":"category"},
                {
                    "data":"title",
                    "render": function(data, type, row) {
                        return '<a href="'+row.link+'" target="_blank" class="btn-view">' + data + '</a>';
                    }
                },
                {"data":"link", "visible":false},
                {"data":"pubDate"},
            ],
            //info:false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Korean.json",
            },
            // order:[[0, 'desc']],
           
        });
        
       
    });
</script>

<div class="w-100">    
    <div class="my_dashboard_review mb40">
        <div class="property_table">
            <div class="table-responsive mt0">

                <table class="table w100" id="tblList">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">카테고리</th>
                        <th scope="col">제목</th>
                        <th scope="col">링크</th>
                        {{-- <th scope="col">내용</th> --}}
                        <th scope="col">등록일시</th>
                        {{-- <th scope="col">태그</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
{{-- <style>
    .thumb {width:340px; height: 230px;}
</style>
<div class="col-lg-12">
    <div class="row">
        @foreach ($data->item as $post)
        <div class="col-lg-4">
            <div class="for_blog feat_property">
                <div class="thumb">
                    <img class="img-whp" src="images/blog/1.jpg" alt="1.jpg">
                    <div class="blog_tag">Construction</div>
                </div>
                <div class="details">
                    <div class="tc_content">
                        <h4>{{ $post->title }}</h4>
                        <ul class="bpg_meta">
                            <li class="list-inline-item"><a href="#"><i class="flaticon-calendar"></i></a></li>
                            <li class="list-inline-item"><a href="#">January 16, 2020</a></li>
                        </ul>
                        <p>{{ $post->description }}</p>
                    </div>
                    <div class="fp_footer">
                        <ul class="fp_meta float-left mb0">
                            <li class="list-inline-item"><a href="#"><img src="images/property/pposter1.png" alt="pposter1.png"></a></li>
                            <li class="list-inline-item"><a href="#">Ali Tufan</a></li>
                        </ul>
                        <a class="fp_pdate float-right text-thm" href="#">Read More <span class="flaticon-next"></span></a>
                    </div>
                </div>
            </div>
        </div>    
        @endforeach
        
        
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="mbp_pagination mt20">
                <ul class="page_navigation">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true"> <span class="flaticon-left-arrow"></span> Prev</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                    <li class="page-item"><a class="page-link" href="#">29</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#"><span class="flaticon-right-arrow"></span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
 --}}
