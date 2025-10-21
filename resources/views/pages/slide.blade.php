<h3 class="title_truyen">HAY NÊN ĐỌC</h3>
            <style type="text/css">
                .item img {
                      
                        height: 230px;
                        border: 3px solid #000;
                        padding: 3px;
                    }
                    .card.mb-3.box-shadow img {
                         height: 230px;
                        border: 3px solid #000;
                        padding: 3px;
                }
            </style>
            <div class="owl-carousel owl-theme mb-5">

                @foreach($slide_truyen as $key => $slide)

                    <div class="item">
                        <div class="info_truyen">
                            @if($slide->loaitruyen=='truyentranh')
                            <span class="badge badge-info loaitruyen">Truyện tranh</span>   
                            @else
                            <span class="badge badge-danger loaitruyen">Truyện đọc</span>   
                            @endif  
                        </div>
                        <img src="{{asset('public/uploads/truyen/'.$slide->hinhanh)}}">

                        <h5>{{$slide->tentruyen}}<br><i class="fas fa-eye"></i>{{$slide->views}}</h5>

                      
                        @foreach($slide->thuocnhieudanhmuctruyen as $thuocdanh)
                             
                        <a href="{{url('danh-muc/'.$thuocdanh->slug_danhmuc)}}"><span class="badge badge-dark">{{$thuocdanh->tendanhmuc}}</span></a>
                        @endforeach

                        @foreach($slide->thuocnhieutheloaitruyen as $thuocloai)
                             
                        <a href="{{url('the-loai/'.$thuocloai->slug_theloai)}}"><span class="badge badge-info">{{$thuocloai->tentheloai}}</span></a>
                        @endforeach
                        <a class="btn btn-danger btn-sm"  href="{{url('xem-truyen/'.$slide->slug_truyen)}}">Xem truyện</a>

                    </div>

                @endforeach  



            </div>