@extends('../layout')



@section('content')
    <style>
        ul.chuong {
            padding: 0;
            margin: 10px;
            list-style: none;
            height: 400px;
            overflow: scroll;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        @foreach ($get_truyentranh['data']['item']['category'] as $bread)
                            <li class="breadcrumb-item" aria-current="page">
                                <a href="{{ route('the-loai-truyen-tranh', $bread['slug']) }}">
                                    {{ $bread['name'] }}</a>
                            </li>
                        @endforeach
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $get_truyentranh['data']['seoOnPage']['titleHead'] }}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-2">

                <img src="https://img.otruyenapi.com/uploads/comics/{{ $get_truyentranh['data']['item']['thumb_url'] }}"
                    width="100%">
            </div>

            <div class="col-md-8">
                @foreach ($chitiettruyentranh as $key => $chitiet)
                    <h4 class="text text-danger">{{ $chitiet['name'] }}</h4>

                    <h5 class="text text-info">
                        <p> Tác giả
                            @foreach ($chitiet['origin_name'] as $key => $origin)
                                <span class="badge badge-danger">{{ $origin }}</span>
                            @endforeach
                        </p>
                    </h5>
                    <p><b>Trạng thái : {{ $chitiet['status'] }}</b></p>
                    <p>
                        @foreach ($chitiet['author'] as $key => $author)
                            <span class="badge badge-info">{{ $author }}</span>
                        @endforeach
                    </p>
                    <p> Thể loại
                        @foreach ($chitiet['category'] as $key => $cate)
                            <a href="{{ route('the-loai-truyen-tranh', $cate['slug']) }}"><span
                                    class="badge badge-dark">{{ $cate['name'] }}</span></a>
                        @endforeach
                    </p>

                    <p class="mota">{!! $chitiet['content'] !!}</p>
                @endforeach
                <h5>DANH SÁCH CHƯƠNG</h5>
                <ul class="chuong">
                    @foreach ($get_truyentranh['data']['item']['chapters'] as $chapter)
                        @foreach ($chapter['server_data'] as $chap)
                            <a class="chapter-truyentranh" data-chapter_name="{{ $chap['chapter_name'] }}"
                                data-chapter_api_data="{{ $chap['chapter_api_data'] }}" style="cursor: pointer;"
                                data-toggle="modal" data-target="#exampleModalLong">
                                <li>Chapter {{ $chap['chapter_name'] }}</li>
                            </a>
                        @endforeach
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
    <style>
        .lds-heart,
        .lds-heart div,
        .lds-heart div:after,
        .lds-heart div:before {
            box-sizing: border-box;
        }

        .lds-heart {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
            transform: rotate(45deg);
            transform-origin: 40px 40px;
        }

        .lds-heart div {
            top: 28px;
            left: 28px;
            position: absolute;
            width: 32px;
            height: 32px;
            background: currentColor;
            animation: lds-heart 1.2s infinite cubic-bezier(0.215, 0.61, 0.355, 1);
        }

        .lds-heart div:after,
        .lds-heart div:before {
            content: " ";
            position: absolute;
            display: block;
            width: 32px;
            height: 32px;
            background: currentColor;
        }

        .lds-heart div:before {
            left: -24px;
            border-radius: 50% 0 0 50%;
        }

        .lds-heart div:after {
            top: -24px;
            border-radius: 50% 50% 0 0;
        }

        @keyframes lds-heart {
            0% {
                transform: scale(0.95);
            }

            5% {
                transform: scale(1.1);
            }

            39% {
                transform: scale(0.85);
            }

            45% {
                transform: scale(1);
            }

            60% {
                transform: scale(0.95);
            }

            100% {
                transform: scale(0.9);
            }
        }
    </style>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><span id="chapter_name"></span></h5><br>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body">
                    <span class="text text-success lds-heart-notify">Chờ tui tải hình ảnh truyện nha ae😄😄😄</span>
                    <div class="lds-heart">

                        <div></div>

                    </div>
                </div>
                <div id="chapter_content"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
    </div>
@endsection
