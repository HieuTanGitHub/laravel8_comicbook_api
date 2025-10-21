<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\DanhmucTruyen;
use App\Models\Truyen;
use App\Models\Theloai;
use App\Models\ThuocDanh;
use App\Models\ThuocLoai;
use Storage;

class TruyenTranhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_truyen = Truyen::with('thuocnhieudanhmuctruyen', 'thuocnhieutheloaitruyen')->where('loaitruyen', '=', 'truyentranh')->orderBy('id', 'DESC')->get();

        return view('admincp.truyentranh.index')->with(compact('list_truyen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $theloai = Theloai::orderBy('id', 'DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id', 'DESC')->get();
        return view('admincp.truyentranh.create')->with(compact('danhmuc', 'theloai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'tentruyen' => 'required|unique:truyen|max:255',
                'slug_truyen' => 'required|unique:truyen|max:255',

                'hinhanh' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',

                'tomtat' => 'required',
                'tukhoa' => 'required',
                'tacgia' => 'required',
                'kichhoat' => 'required',
                'views' => 'required',
                'danhmuc' => 'required',
                'theloai' => 'required',
            ],
            [
                'views.required' => 'Yêu cầu nhập lượt xem',
                'slug_truyen.unique' => 'Tên truyện đã có ,xin điền tên khác',
                'tentruyen.unique' => 'Slug truyện đã có ,xin điền slug khác',
                'tentruyen.required' => 'Tên truyện phải có nhé',
                'tukhoa.required' => 'Từ khóa truyện phải có nhé',
                'tomtat.required' => 'Mô tả truyện phải có nhé',
                'tacgia.required' => 'Tác giả truyện phải có nhé',
                'slug_truyen.required' => 'Slug truyện phải có',
                'hinhanh.required' => 'Hình ảnh truyện phải có',
            ]
        );
        // $data = $request->all();
        // // dd($data);
        $truyen = new Truyen();
        $truyen->tentruyen = $data['tentruyen'];
        $truyen->tukhoa = $data['tukhoa'];
        $truyen->slug_truyen = $data['slug_truyen'];
        $truyen->tomtat = $data['tomtat'];
        $truyen->kichhoat = $data['kichhoat'];
        $truyen->tacgia = $data['tacgia'];
        $truyen->views = $data['views'];
        $truyen->loaitruyen = 'truyentranh';

        $truyen->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        foreach ($data['danhmuc'] as $key => $danh) {
            $truyen->danhmuc_id = $danh[0];
        }
        //upload data to google drive
        Storage::disk('google')->makeDirectory($data['slug_truyen']);


        //them anh vao folder hinh188.jpg
        $get_image = $request->hinhanh;
        $path = 'public/uploads/truyen/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $truyen->hinhanh = $new_image;
        $truyen->save();

        $truyen->thuocnhieudanhmuctruyen()->attach($data['danhmuc']);
        $truyen->thuocnhieutheloaitruyen()->attach($data['theloai']);



        return redirect()->back()->with('status', 'Thêm truyện tranh thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $truyen = Truyen::find($id);

        $thuocdanhmuc = $truyen->thuocnhieudanhmuctruyen;
        $thuoctheloai = $truyen->thuocnhieutheloaitruyen;

        $theloai = Theloai::orderBy('id', 'DESC')->get();
        $danhmuc = DanhmucTruyen::orderBy('id', 'DESC')->get();
        return view('admincp.truyentranh.edit')->with(compact('truyen', 'danhmuc', 'theloai', 'thuocdanhmuc', 'thuoctheloai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'views' => 'required',



                'tentruyen' => 'required|max:255',
                'slug_truyen' => 'required|max:255',
                'tacgia' => 'required',
                'tomtat' => 'required',
                'kichhoat' => 'required',
                'danhmuc' => 'required',
                'theloai' => 'required',
                'tukhoa' => 'required',

            ],
            [
                'views.required' => 'Yêu cầu nhập lượt xem',
                'tukhoa.required' => 'Từ khóa truyện phải có nhé',

                'tentruyen.required' => 'Tên truyện phải có nhé',
                'tomtat.required' => 'Mô tả truyện phải có nhé',
                'tacgia.required' => 'Tác giả truyện phải có nhé',
                'slug_truyen.required' => 'Slug truyện phải có',

            ]
        );
        // $data = $request->all();
        // dd($data);
        $truyen = Truyen::find($id);

        $truyen->thuocnhieudanhmuctruyen()->sync($data['danhmuc']);
        $truyen->thuocnhieutheloaitruyen()->sync($data['theloai']);

        $truyen->tentruyen = $data['tentruyen'];
        $truyen->tukhoa = $data['tukhoa'];
        $truyen->slug_truyen = $data['slug_truyen'];

        $truyen->tomtat = $data['tomtat'];
        $truyen->kichhoat = $data['kichhoat'];
        $truyen->views = $data['views'];
        $truyen->tacgia = $data['tacgia'];
        $truyen->loaitruyen = 'truyentranh';
        $truyen->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        foreach ($data['danhmuc'] as $key => $danh) {
            $truyen->danhmuc_id = $danh[0];
        }
        //them anh vao folder 
        $get_image = $request->hinhanh;
        if ($get_image) {
            $path = 'public/uploads/truyen/' . $truyen->hinhanh;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = 'public/uploads/truyen/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $truyen->hinhanh = $new_image;
        }


        $truyen->save();

        return redirect()->back()->with('status', 'Cập nhật truyện tranh thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $truyen = Truyen::find($id);
        $path = 'public/uploads/truyen/' . $truyen->hinhanh;
        if (file_exists($path)) {
            unlink($path);
        }
        $truyen->thuocnhieudanhmuctruyen()->detach($truyen->danhmuc_id);
        $truyen->thuocnhieutheloaitruyen()->detach($truyen->theloai_id);
        Truyen::find($id)->delete();
        return redirect()->back()->with('status', 'Xóa truyện tranh thành công');
    }
}
