<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GalleryModel;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index(){
        return view('pages.admin.gallery.gallery', ['images' => GalleryModel::all()]);
    }

    public function create(){
        return view('pages.admin.gallery.gallery_add_image');
    }

    public function store(Request $request) {
        if($request->has('btnCreate')) {

            $request->validate([
                'title'     => 'required|regex:/^[A-Z][a-z]{2,14}$/',
                'image'     => 'required|mimes:jpeg,jpg,png|max:5000',
                'featured'  => 'required',
            ]);

            $photo = $request->file('image');
            $extension = $photo->getClientOriginalExtension();
            $tmp_path = $photo->getPathName();
            chmod("/img/gallery", 0644);
            $folder = 'img/gallery/';
            $file_name = time().".".$extension;
            $new_path = public_path($folder).$file_name;
        
        
            try{
                File::move($tmp_path, $new_path);
                $galleryImage = new GalleryModel();
                $galleryImage->img_path = $folder . $file_name;
                $galleryImage->title = $request->get('title');
                $galleryImage->featured = $request->get('featured');
                $galleryImage->save();
                return redirect()->back()->with('success','Image added');
            }

            catch(QueryException $ex){ 
                \Log::error($ex->getMessage());
                return redirect()->back()->with('error','Error please try again later');
            }
            catch(\Symfony\Component\HttpFoundation\File\Exception\FileException $ex) { 
                \Log::error('Upload error: '.$ex->getMessage());
                return redirect()->back()->with('error','Eror while uploading the file');
            }
        }

    }

    public function delete($id){
        try{
            $singleImage = GalleryModel::find($id);

            if($singleImage !== null){
                $image_path = public_path($singleImage->img_path);
                if(unlink($image_path)) {
                    $singleImage->delete();
                    return redirect()->back()->with('success', 'Image Deleted');   
                }
                    
            }

            return redirect()->back()->with('error', 'Error while deleting image please try again later');       
                
            
        }   
        catch(QueryException $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Error while deleting image please try again later');
        }
        
    }

    public function edit($id) {
        return view('pages.admin.gallery.gallery_edit_image', ['image' => GalleryModel::find($id)]);
    }

    public function update(Request $request){
        if($request->has('btnEdit')) {

            $request->validate([
                'title'     => 'required|regex:/^[A-Z][a-z]{2,14}$/',
                'image'     => 'required|mimes:jpeg,jpg,png|max:5000',
                'featured'  => 'required',
                'img_id'    => 'required',
            ]);

            $photo = $request->file('image');
            $extension = $photo->getClientOriginalExtension();
            $tmp_path = $photo->getPathName();
            
            $folder = 'img/gallery/';
            $file_name = time().".".$extension;
            $new_path = public_path($folder).$file_name;
            
            $galleryImage = GalleryModel::find($request->get('img_id'));
        
        
            try{
                if($galleryImage !== null) {
                    if(unlink(public_path($galleryImage->img_path))) {
                        File::move($tmp_path, $new_path);
                        $galleryImage->img_path = $folder . $file_name;
                        $galleryImage->title = $request->get('title');
                        $galleryImage->featured = $request->get('featured');
                        $galleryImage->save();
                        return redirect()->back()->with('success','Image updated');
                    }      
                }

                return redirect()->back()->with('error','Error please try again later');
            }

            catch(QueryException $ex){ 
                \Log::error($ex->getMessage());
                return redirect()->back()->with('error','Error please try again later');
            }
            catch(\Symfony\Component\HttpFoundation\File\Exception\FileException $ex) { 
                \Log::error('Upload error: '.$ex->getMessage());
                return redirect()->back()->with('error','Eror while uploading the file');
            }
        }
    }
}
