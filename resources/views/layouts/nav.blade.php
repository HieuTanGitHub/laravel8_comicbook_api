<div class="container-fluid">
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
                   
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                          <li class="nav-item active">
                            <a class="nav-link" href="{{route('home')}}">Admin <span class="sr-only">(current)</span></a>
                          </li>
                         <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Thông tin web
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{route('information.create')}}">Cập nhật thông tin website</a>
                            
                            </div>
                          
                          </li>
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Quản lý danh mục
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{route('danhmuc.create')}}">Thêm danh mục</a>
                              <a class="dropdown-item" href="{{route('danhmuc.index')}}">Liệt kê danh mục</a>
                            </div>

                          </li>
                           <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Thể loại
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{route('theloai.create')}}">Thêm thể loại</a>
                              <a class="dropdown-item" href="{{route('theloai.index')}}">Liệt kê thể loại</a>
                            </div>

                          </li>
                           <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Truyện Đọc
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{route('truyen.create')}}">Thêm sách truyện đọc</a>
                              <a class="dropdown-item" href="{{route('truyen.index')}}">Liệt kê sách truyện đọc</a>
                            </div>
                          
                          </li>

                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Truyện Tranh
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{route('truyentranh.create')}}">Thêm truyện tranh</a>
                              <a class="dropdown-item" href="{{route('truyentranh.index')}}">Liệt kê truyện tranh</a>
                            </div>
                          
                          </li>

                           <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Chapter
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{route('chapter.create')}}">Thêm chapter truyện đọc</a>
                              <a class="dropdown-item" href="{{route('chapter.index')}}">Liệt kê chapter truyện đọc</a>
                              <a class="dropdown-item" href="{{route('chaptertranh.create')}}">Thêm chapter truyện tranh</a>
                              <a class="dropdown-item" href="{{route('chaptertranh.index')}}">Liệt kê chapter truyện tranh</a>
                            </div>
                          
                          </li>
                         
                         
                        </ul>
                       {{--  <form class="form-inline my-2 my-lg-0">
                          <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm" aria-label="Search">
                          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
                        </form> --}}
                      </div>
                    </nav>
                    
</div>
 