@extends('layouts.app')

@section('content')

@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cập nhật thông tin website</div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{route('information.update',[$info->id])}}"  enctype='multipart/form-data'>
                        @method('PUT')
                        @csrf
                      <div class="form-group">
                        <label for="exampleInputEmail1">Tiêu đề website</label>
                        <input type="text" class="form-control" value="{{$info->tieude}}" name="tieude" aria-describedby="emailHelp" placeholder="Tên danh mục...">
                        
                      </div>
                       <div class="form-group">
                        <label for="exampleInputEmail1">Copyright</label>
                        <input type="text" class="form-control" value="{{$info->copyright}}" name="copyright" aria-describedby="emailHelp" placeholder="">
                        
                      </div>
                       <div class="form-group">
                        <label for="exampleInputEmail1">Tiêu đề footer</label>
                        <input type="text" class="form-control" value="{{$info->tieude_footer}}" name="tieude_footer" aria-describedby="emailHelp" placeholder="">
                        
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Mô tả website</label>
                        <input type="text" class="form-control" value="{{$info->mota}}" name="mota" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Mô tả website">
                        
                      </div>
                       <div class="form-group">
                        <label for="exampleInputEmail1">Bản đồ</label>
                        <textarea class="form-control" rows="5" style="resize: none" name="map" id="exampleInputEmail1"  placeholder="Map">{{$info->map}}</textarea> 
                        
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Hình ảnh logo</label>
                        <input type="file" class="form-control-file" name="logo">
                        <img src="{{asset('public/uploads/logo/'.$info->logo)}}" height="100" width="180">
                      </div>
                      
                     
                      <button type="submit" name="theminfo" class="btn btn-primary">Cập nhật</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
