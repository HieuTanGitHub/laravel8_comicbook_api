<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info;
use Carbon\Carbon;
class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info = Info::find(1);
        return view('admincp.info.edit')->with(compact('info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
                'copyright' => 'required|max:255',
                'tieude_footer' => 'required|max:255',


                'map' => 'required|max:255',
                'mota' => 'required|max:255',
              
            ],
            [
               
                'tieude.required' => 'Tiêu đề phải có nhé',
                'map.required' => 'Map phải có nhé',
                'copyright.required' => 'Copyright phải có nhé',
                'tieude_footer.required' => 'Tiêu đề footer phải có nhé',
                'mota.required' => 'Mô tả phải có nhé',
            ]
        );
       
        $info = Info::find($id);
        $info->tieude = $data['tieude'];
        $info->copyright = $data['copyright'];
        $info->tieude_footer = $data['tieude_footer'];
        $info->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $info->mota = $data['mota'];
        $info->map = $data['map'];
        //them anh vao folder logos
        $get_image = $request->logo;
        if($get_image){
            $path = 'public/uploads/logo/'.$info->logo;
            if(file_exists($path)){
                unlink($path);
            }
            $path = 'public/uploads/logo/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $info->logo = $new_image;
        }
        
        

        $info->save();

        return redirect()->back()->with('status','Cập nhật thông tin web thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
