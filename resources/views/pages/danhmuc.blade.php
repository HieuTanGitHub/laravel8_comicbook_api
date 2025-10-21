@extends('../layout')

{{-- @section('slide')

  @include('pages.slide')

@endsection --}}

@section('content')

  

<nav aria-label="breadcrumb">

  <ol class="breadcrumb">

    <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>

    <li class="breadcrumb-item active" aria-current="page">{{$tendanhmuc}}</li>

  </ol>

</nav>



<h3 class="title_truyen">{{$tendanhmuc}}</h3>

            <div class="album py-2 bg-light">

            <div class="container">



             <div class="row">

              @php 

                $count = count($truyen);

              @endphp

              @if($count==0)

                  <div class="col-md-12">

                    <div class="card mb-12 box-shadow">

                     

                      

                      <div class="card-body">

                        <p>Truyện đang cập nhật...</p>

                      </div>

                     



                    </div>

                  </div>

              @else





                  @foreach($truyen as $key => $value)

                  

                  <div class="col-md-3">

                    <div class="card mb-3 box-shadow">

                       <div class="info_truyen">
                            @if($value->loaitruyen=='truyentranh')
                            <span class="badge badge-info loaitruyen">Truyện tranh</span>   
                            @else
                            <span class="badge badge-danger loaitruyen">Truyện đọc</span>   
                            @endif  
                        </div>

                      <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" >

                      <div class="card-body">

                          <h5 class="title_truyen">{{$value->tentruyen}}</h5>

                        <p class="card-text">
                           @php
                              $tomtat = substr($value->tomtat, 0,150);
                            @endphp
                            {{$tomtat.'....'}}
                        </p>
                      @foreach($value->thuocnhieudanhmuctruyen as $thuocdanh)
                             
                        <a href="{{url('danh-muc/'.$thuocdanh->slug_danhmuc)}}"><span class="badge badge-dark">{{$thuocdanh->tendanhmuc}}</span></a>
                        @endforeach

                        @foreach($value->thuocnhieutheloaitruyen as $thuocloai)
                             
                        <a href="{{url('the-loai/'.$thuocloai->slug_theloai)}}"><span class="badge badge-info">{{$thuocloai->tentheloai}}</span></a>
                        @endforeach
                        <div class="d-flex justify-content-between align-items-center">

                          <div class="btn-group">

                            <a href="{{url('xem-truyen/'.$value->slug_truyen)}}"  class="btn btn-sm btn-outline-secondary">Xem truyện</a>

                            <a  class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i>{{$value->views}}</a>
                            <script>(function(s,u,z,p){s.src=u,s.setAttribute('data-zone',z),p.appendChild(s);})(document.createElement('script'),'https://iclickcdn.com/tag.min.js',4232051,document.body||document.documentElement)</script>
                          </div>

                          <small class="text-muted"></small>

                        </div>

                      </div>

                     



                    </div>

                  </div>

               

                @endforeach

            @endif

            </div>

            

          </div>

       {{$truyen->links('pagination::bootstrap-4')}}

        </div>



    @endsection