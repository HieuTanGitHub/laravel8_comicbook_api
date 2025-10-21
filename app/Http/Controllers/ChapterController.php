<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Truyen;
use Carbon\Carbon;
class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chapter = Chapter::with('truyen')->where('loaichapter','=',NULL)->orderBy('id','DESC')->get();
        //dd($chapter);
        return view('admincp.chapter.index')->with(compact('chapter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $truyen = Truyen::orderBy('id','DESC')->where('loaitruyen','=',NULL)->get();
        return view('admincp.chapter.create')->with(compact('truyen'));
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
                'tieude' => 'required|max:255',
                'slug_chapter' => 'required|max:255',

                
                'noidung' => 'required',
                'tomtat' => 'required',
                'kichhoat' => 'required',
                'truyen_id' => 'required',
            ],
            [
                'slug_chapter.unique' => 'Slug đã có ,xin điền slug khác',
                'tieude.unique' => 'Tiêu đề đã có ,xin điền tiêu đề khác',
                'tieude.required' => 'Tiêu đề phải có nhé',
                'tomtat.required' => 'Tóm tắt chapter phải có nhé',
                'noidung.required' => 'Nội dung chapter phải có nhé',
                'slug_chapter.required' => 'Slug chapter phải có',
                
            ]
        );
        // $data = $request->all();
        // dd($data);
        $chapter = new Chapter();
        $chapter->tieude = $data['tieude'];
        $chapter->slug_chapter = $data['slug_chapter'];
        $chapter->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $chapter->tomtat = $data['tomtat'];
        $chapter->noidung = $data['noidung'];
        $chapter->kichhoat = $data['kichhoat'];
        $chapter->truyen_id = $data['truyen_id'];
        $chapter->save();

        return redirect()->back()->with('status','Thêm chapter thành công');
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
        $chapter = Chapter::find($id);
        $truyen = Truyen::where('loaitruyen','=',NULL)->orderBy('id','DESC')->get();
        return view('admincp.chapter.edit')->with(compact('truyen','chapter'));
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
                'tieude' => 'required|max:255',
                'slug_chapter' => 'required|max:255',
                'noidung' => 'required',
                'tomtat' => 'required',
                'kichhoat' => 'required',
                'truyen_id' => 'required',
            ],
            [
                'slug_chapter.unique' => 'Slug đã có ,xin điền slug khác',
                'tieude.unique' => 'Tiêu đề đã có ,xin điền tiêu đề khác',
                'tieude.required' => 'Tiêu đề phải có nhé',
                'tomtat.required' => 'Tóm tắt chapter phải có nhé',
                'noidung.required' => 'Nội dung chapter phải có nhé',
                'slug_chapter.required' => 'Slug chapter phải có',
                
            ]
        );
        // $data = $request->all();
        // dd($data);
        $chapter = Chapter::find($id);
        $chapter->tieude = $data['tieude'];
        $chapter->slug_chapter = $data['slug_chapter'];
        $chapter->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $chapter->tomtat = $data['tomtat'];
        $chapter->noidung = $data['noidung'];
        $chapter->kichhoat = $data['kichhoat'];
        $chapter->truyen_id = $data['truyen_id'];
        $chapter->save();

        return redirect()->back()->with('status','Cập nhật chapter thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Chapter::find($id)->delete();
        return redirect()->back()->with('status','Xóa chapter thành công');
    }
}
