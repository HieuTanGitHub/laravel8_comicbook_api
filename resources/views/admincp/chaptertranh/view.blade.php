

@extends('layouts.app')

@section('content')

@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Xem truyện tranh</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                  	<ul style="list-style: none">

					@foreach($files as $key => $file)
						<h4>{{$file['filename']}}</h4>
						<li>{{$key}} - <a onclick="return confirm('Bạn muốn xóa tranh truyện này không?');" href="{{url('delete-file/'.$file['filename'].'/'.$file['extension'].'/'.$file['timestamp'])}}">Delete file</a><img src="https://drive.google.com/uc?id={{$file['basename']}}" width="200" height="200"></li>
					@endforeach
					</ul>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
