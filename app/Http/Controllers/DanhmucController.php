<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhmucTruyen;
use Carbon\Carbon;
class DanhmucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $danhmuctruyen = DanhmucTruyen::orderBy('id','DESC')->get();
        return view('admincp.danhmuctruyen.index')->with(compact('danhmuctruyen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.danhmuctruyen.create');
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
                'tendanhmuc' => 'required|unique:danhmuc|max:255',
                'slug_danhmuc' => 'required|unique:danhmuc|max:255',
                'hinhanh' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',

                'mota' => 'required|max:255',
                'kichhoat' => 'required',
                'tukhoa' => 'required|max:255',
            ],
            [
                'slug_danhmuc.unique' => 'Tên danh mục đã có ,xin điền tên khác',
                'tukhoa.required' => 'Từ khóa phải có',
                'tendanhmuc.unique' => 'Slug danh mục đã có ,xin điền slug khác',
                'tendanhmuc.required' => 'Tên danh mục phải có nhé',
                'mota.required' => 'Mô tả danh mục phải có nhé',
                'hinhanh.required' => 'Hình ảnh phải có',
            ]
        );
       
        $danhmuctruyen = new DanhmucTruyen();
        $danhmuctruyen->tukhoa = $data['tukhoa'];
        $danhmuctruyen->tendanhmuc = $data['tendanhmuc'];
        $danhmuctruyen->slug_danhmuc = $data['slug_danhmuc'];
        $danhmuctruyen->mota = $data['mota'];
        $danhmuctruyen->kichhoat = $data['kichhoat'];
        $danhmuctruyen->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        //them anh vao folder hinh188.jpg
        $get_image = $request->hinhanh;
        $path = 'public/uploads/danhmuc/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path,$new_image);
        
        $danhmuctruyen->hinhanh = $new_image;

        $danhmuctruyen->save();

        return redirect()->back()->with('status','Thêm danh mục truyện thành công');

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
        $danhmuc = DanhmucTruyen::find($id);
        return view('admincp.danhmuctruyen.edit')->with(compact('danhmuc'));
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
                'tendanhmuc' => 'required|max:255',
                'slug_danhmuc' => 'required|max:255',
                'mota' => 'required|max:255',
                'kichhoat' => 'required',
                'tukhoa' => 'required|max:255',



            ],
            [
                'tukhoa.required' => 'Từ khóa phải có',
                'slug_danhmuc.required' => 'Slug danh mục phải có nhé',
                'tendanhmuc.required' => 'Tên danh mục phải có nhé',
                'mota.required' => 'Mô tả danh mục phải có nhé',
            ]
        );
        // $data = $request->all();
        // dd($data);
        $danhmuctruyen = DanhmucTruyen::find($id);
        $danhmuctruyen->tukhoa = $data['tukhoa'];
        $danhmuctruyen->tendanhmuc = $data['tendanhmuc'];
        $danhmuctruyen->slug_danhmuc = $data['slug_danhmuc'];
        $danhmuctruyen->mota = $data['mota'];
        $danhmuctruyen->kichhoat = $data['kichhoat'];
        $danhmuctruyen->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        //them anh vao folder hinh188.jpg
        
        $get_image = $request->hinhanh;

        if($get_image){
            $path = 'public/uploads/danhmuc/'.$danhmuctruyen->hinhanh;
            if(file_exists($path)){
                unlink($path);
            }
            $path = 'public/uploads/danhmuc/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            
            $danhmuctruyen->hinhanh = $new_image;
        }

        $danhmuctruyen->save();

        return redirect()->back()->with('status','Cập nhật danh mục truyện thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $danhmuctruyen = DanhmucTruyen::find($id);
        $path = 'public/uploads/danhmuc/'.$danhmuctruyen->hinhanh;
        if(file_exists($path)){
            unlink($path);
        }
        $danhmuctruyen->delete();
        return redirect()->back()->with('status','Xóa danh mục truyện thành công');
    }


}
