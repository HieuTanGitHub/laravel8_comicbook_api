<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Truyen;
use App\Models\FileGGDrive;
use Carbon\Carbon;
use Storage;
use File;
class ChapterTranhController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chapter = Chapter::with('truyen')->where('loaichapter','=','truyentranh')->orderBy('id','DESC')->get();
        //dd($chapter);
        return view('admincp.chaptertranh.index')->with(compact('chapter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $truyen = Truyen::orderBy('id','DESC')->where('loaitruyen','=','truyentranh')->get();
        return view('admincp.chaptertranh.create')->with(compact('truyen'));
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
                'tomtat' => 'required',
                'kichhoat' => 'required',
                'truyen_id' => 'required',
            ],
            [
                'slug_chapter.unique' => 'Slug đã có ,xin điền slug khác',
                'tieude.unique' => 'Tiêu đề đã có ,xin điền tiêu đề khác',
                'tieude.required' => 'Tiêu đề phải có nhé',
                'tomtat.required' => 'Tóm tắt chapter phải có nhé',
                
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
        $chapter->noidung = 'noidungtruyentranh';
        $chapter->kichhoat = $data['kichhoat'];
        $chapter->truyen_id = $data['truyen_id'];
        $chapter->loaichapter = 'truyentranh';
        $chapter->save();
        //upload to google drive
        $truyen = Truyen::find($data['truyen_id']);

        $dir = '/';
        $recursive = true; // Get subdirectories also?
        $contents = collect(Storage::disk('google')->listContents($dir, $recursive));

        $dir_truyen = $contents->where('type', '=', 'dir')
            ->where('filename', '=', $truyen->slug_truyen)
            ->first(); 
         

        if ( ! $dir) {
            return redirect()->back()->with('status','Thư mục truyện tranh không tồn tại trong google drive,check lại nhé.');
        }
        // Create sub dir
        Storage::disk('google')->makeDirectory($dir_truyen['path'].'/'.$data['slug_chapter']);
        
       

        //upload multiple file to dir ggdrive
        $dir_img = '/';
        $recursive_img = true; // 
        $contents_image = collect(Storage::disk('google')->listContents($dir_img, $recursive_img));

        $dir_chapter = $contents_image->where('type', '=', 'dir')
                ->where('filename', '=', $data['slug_chapter'])
                ->first();    
        //Change permission for sub dir chapter
        $service = Storage::disk('google')->getAdapter()->getService();
        $permission = new \Google_Service_Drive_Permission();
        $permission->setRole('reader');
        $permission->setType('anyone');
        $permission->setAllowFileDiscovery(false);
        $permissions = $service->permissions->create($dir_chapter['basename'], $permission);  
        $files = $request->file('files');
            if($request->hasFile('files')){

            foreach ($files as $file) {

                $name = $file->getClientOriginalName();
               
                Storage::disk('google')->put($dir_chapter['path'].'/'.$name,File::get($file));

            }
        }
        //store file into db
        //  // For simplicity, this folder is assumed to exist in the root directory.
        // $folder = $data['slug_chapter'];

        // // Get root directory contents...
        // $contents = collect(Storage::disk('google')->listContents('/', true));

        // // Find the folder you are looking for...
        // $dir_folder_file = $contents->where('type', '=', 'dir')
        //     ->where('filename', '=', $folder)
        //     ->first(); // There could be duplicate directory names!

        // if ( ! $dir_folder_file) {
        //     return 'No such folder!';
        // }

        // // Get the files inside the folder...
        // $files = collect(Storage::disk('google')->listContents($dir_folder_file['path'], false))
        //         ->where('type', '=', 'file');
       
        // foreach($files as $key => $file){
        //     $fileggdrive = new FileGGDrive();
        //     $fileggdrive->name = $data['slug_chapter'].'-'.$file['name'];
        //     $fileggdrive->type = $file['type'];
        //     $fileggdrive->path = $file['path'];
        //     $fileggdrive->filename = $file['filename'];
        //     $fileggdrive->extension = $file['extension'];
        //     $fileggdrive->timestamp = $file['timestamp'];
        //     $fileggdrive->mimetype = $file['mimetype'];
        //     $fileggdrive->size = $file['size'];
        //     $fileggdrive->dirname = $file['dirname'];
        //     $fileggdrive->basename = $file['basename'];
        //     $fileggdrive->chapter_id = $chapter->id;
          
        //     $fileggdrive->save();
        // }

        return redirect()->back()->with('status','Thêm chapter truyện tranh thành công');
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
        $truyen = Truyen::where('loaitruyen','=','truyentranh')->orderBy('id','DESC')->get();
        return view('admincp.chaptertranh.edit')->with(compact('truyen','chapter'));
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
                
                'tomtat' => 'required',
                'kichhoat' => 'required',
                'truyen_id' => 'required',
            ],
            [
                'slug_chapter.unique' => 'Slug đã có ,xin điền slug khác',
                'tieude.unique' => 'Tiêu đề đã có ,xin điền tiêu đề khác',
                'tieude.required' => 'Tiêu đề phải có nhé',
                'tomtat.required' => 'Tóm tắt chapter phải có nhé',
              
                'slug_chapter.required' => 'Slug chapter phải có',
                
            ]
        );
        // $data = $request->all();
        // dd($data);
        
        $chapter = Chapter::find($id);

        //rename dir chapter in google drive
        $dir = '/';
        $recursive = true; // Get subdirectories also?
        $contents = collect(Storage::disk('google')->listContents($dir, $recursive));

        $dir_chapter = $contents->where('type', '=', 'dir')
            ->where('filename', '=', $chapter->slug_chapter)
            ->first(); 
       
        //dd($dir_chapter);
        if ( ! $dir_chapter) {
            return redirect()->back()->with('status','Thư mục truyện tranh không tồn tại trong google drive,check lại nhé.');
        }
       
        Storage::disk('google')->move($dir_chapter['basename'], "".$data['slug_chapter']."");
        //update db
        $chapter->tieude = $data['tieude'];
        $chapter->slug_chapter = $data['slug_chapter'];
        $chapter->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $chapter->tomtat = $data['tomtat'];
        $chapter->noidung = 'noidungtruyentranh';
        $chapter->kichhoat = $data['kichhoat'];
        $chapter->truyen_id = $data['truyen_id'];
        $chapter->loaichapter = 'truyentranh';
        $chapter->save();

        return redirect()->back()->with('status','Cập nhật chapter truyện tranh thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $chapter = Chapter::find($id);
        //delete chapter dir in ggdrive
        $dir = '/';
        $recursive = true; // Get subdirectories also?
        $contents = collect(Storage::disk('google')->listContents($dir, $recursive));

        $directory = $contents
            ->where('type', '=', 'dir')
            ->where('filename', '=', $chapter->slug_chapter)
        ->first(); // there can be duplicate file names!
        if($directory){
        Storage::disk('google')->deleteDirectory($directory['path']);
        }
        $fileChapter = FileGGDrive::where('chapter_id',$chapter->id)->delete();
        //delete into db
        Chapter::find($id)->delete();
        return redirect()->back()->with('status','Xóa chapter thành công');
    }
    public function delete_file($filename,$extension,$timestamp){
        $dir = '/';
        $recursive = true; // Get subdirectories also?
        $contents = collect(Storage::disk('google')->listContents($dir, $recursive));

        $file = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', $filename)
            ->where('extension', '=', $extension)
            ->where('timestamp', '=', $timestamp)
        ->first(); 

        if($file){
            // $chapter_file = FileGGDrive::where('path',$file['path'])->first();
            // $chapter_file->delete();
            Storage::disk('google')->delete($file['path']);
            return redirect()->back()->with('status','File truyện tranh xóa thành công');
        }else{
            return redirect()->back()->with('status','File ko tồn tại hoặc xóa ko thành công');
        }

    }
    public function list_folder_truyen(){
        $dir = '/';
        $recursive = true; // Có lấy file trong các thư mục con không?
        $folder = $contents = collect(Storage::disk('google')->listContents($dir, $recursive))
        ->where('type', '=' ,'dir')->where('filename', '=', 'tap-100-chap-1069-nguoi-tuyet');
        if ( ! $folder) {
            return 'No such folder!';
        }

        return $contents;
    }
    public function list_folder(){
        $dir = '/';
        $recursive = true; // Get subdirectories also?
        $contents = collect(Storage::disk('google')->listContents($dir, $recursive));

        return $contents->where('type', '=', 'dir'); // directories
        //return $contents->where('type', '=', 'file'); // files
    }
    public function chapter_truyentranh($slug){
         // The human readable folder name to get the contents of...
            // For simplicity, this folder is assumed to exist in the root directory.
            $folder = $slug;

            // Get root directory contents...
            $contents = collect(Storage::disk('google')->listContents('/', true));

            // Find the folder you are looking for...
            $dir = $contents->where('type', '=', 'dir')
                ->where('filename', '=', $folder)
                ->first(); // There could be duplicate directory names!

            if ( ! $dir) {
                return 'No such folder!';
            }

            // Get the files inside the folder...
            $files = collect(Storage::disk('google')->listContents($dir['path'], false))
                ->where('type', '=', 'file')->sortBy('filename');

            //dd($files);
            // return $files->mapWithKeys(function($file) {
            //     $filename = $file['filename'].'.'.$file['extension'];
            //     $path = $file['path'];

            //     // Use the path to download each file via a generated link..
            //     // Storage::cloud()->get($file['path']);

            //     return [$filename => $path];
            // });
            return view('admincp.chaptertranh.view')->with(compact('files'));
    }
     
}
