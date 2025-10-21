<div class="row">
    <div class="col-md-12">
        <form autocomplete="off" class="form-inline my-2 my-lg-0" action="{{ route('search-truyentranh') }}" method="GET">

            <input class="form-control mr-sm-2" type="search" id="keywords" name="tim-kiem"
                placeholder="Từ khóa truyện tranh..." aria-label="Search">

            <div id="search_ajax"></div>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm truyện tranh</button>



        </form>
    </div>
</div>
