@extends('../layout')

{{-- @section('slide')
    @include('pages.slide')
@endsection --}}

@section('content')
    @foreach ($get_theloaitruyentranh['data']['items'] as $key => $theloaitruyen)
        <a href="{{ route('the-loai-truyen-tranh', [$theloaitruyen['slug']]) }}"><span
                class="badge badge-dark">{{ $theloaitruyen['name'] }}</span></a>
    @endforeach
    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>

                <li class="breadcrumb-item active" aria-current="page">
                    {{ $get_truyentranh['data']['seoOnPage']['titleHead'] }}</li>
            </ol>
        </nav>
    </div>
    @include('pages.truyentranh.form_search')
    <select class="form-control" id="dynamic_select">
        @php
            $page = ceil(
                $get_truyentranh['data']['params']['pagination']['totalItems'] /
                    $get_truyentranh['data']['params']['pagination']['totalItemsPerPage'],
            );

        @endphp

        @for ($i = 1; $i <= $page; $i++)
            <option {{ $current_page == $i ? 'selected' : '' }} value="?page={{ $i }}">

                Trang {{ $i }}
            </option>
        @endfor
    </select>

    <div class="card" style="width: 28rem;">
        <ul class="list-group list-group-flush">
            @foreach ($get_truyentranh['data']['items'] as $key => $tranh)
                <li class="list-group-item">

                    <div class="row">

                        <div class="col-md-5">
                            <img src="https://img.otruyenapi.com/uploads/comics/{{ $tranh['thumb_url'] }}" width="100%">
                        </div>
                        <a href="{{ route('xemtruyentranh', $tranh['slug']) }}">
                            <div class="col-md-7">
                                <h5>{{ $tranh['name'] }}</h5>
                                <p>{{ $tranh['origin_name'][0] }}</p>
                                @foreach ($tranh['category'] as $key => $cate)
                                    <a href="{{ route('the-loai-truyen-tranh', [$cate['slug']]) }}"><span
                                            class="badge badge-danger">{{ $cate['name'] }}</span></a>
                                @endforeach
                                <p>{{ $tranh['updatedAt'] }}</p>
                                @if ($tranh['chaptersLatest'])
                                    @foreach ($tranh['chaptersLatest'] as $key => $chapter)
                                        <span class="badge badge-info">Chapter
                                            {{ $chapter['chapter_name'] }}</span>
                                    @endforeach
                                @endif
                            </div>
                        </a>
                    </div>

                </li>
            @endforeach

        </ul>
        <h3 class="title_truyen">Truyện tranh mới cập nhật</h3>
        <p>{{ $get_truyentranh['data']['seoOnPage']['titleHead'] }}</p>


        <p>Tổng truyện : {{ $get_truyentranh['data']['params']['pagination']['totalItems'] }}</p>
        <p>Từng trang : {{ $get_truyentranh['data']['params']['pagination']['totalItemsPerPage'] }}</p>
        <p>Trang hiện tại : {{ $get_truyentranh['data']['params']['pagination']['currentPage'] }}</p>
        <p>Chiều dài trang : {{ $get_truyentranh['data']['params']['pagination']['pageRanges'] }}</p>
    </div>
@endsection
