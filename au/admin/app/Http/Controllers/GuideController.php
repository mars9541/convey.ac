<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Guide;
use App\Gallery;
//use Intervention\Image\ImageManagerStatic as Image;
class GuideController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('global');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.guide_manager');
    }
    public function save_guide(Request $request)
    {
        $result = Guide::where('flag', $request->flag)->update(['content' => $request->content]);
        return response()->json(['success' => 'Updateds Successfully!']);
    }

    public function gallery()
    {
        return view('admin.gallery');
    }

    public function gallery_list(Request $request)
    {
        $gallery = Gallery::get();

        return response()->json(['data' => $gallery]);
    }

    public function get_gallery($id)
    {
        if(request()->ajax())
        {
            $data = Gallery::findOrFail($id);

            return response()->json(['data' => $data]);
        }
    }

    public function delete_gallery($id)
    {
        if(request()->ajax())
        {
            // $data = Employees::findOrFail($id);
            // $record_history = RecordHistory::where('NI_identity_number',$data->NI_Insurance_Number)->exists();
            // if($record_history)
            //     return response()->json(['warning'=>'This employee has recorders']);
            $data = Gallery::findOrFail($id);
            $data->delete();
            return response()->json(['success' => 'Data is successfully deleted']);
        }
    }

    public function gallery_add(Request $request)
    {
        /*$file = $_FILES['image']['tmp_name'];
        $source_properties = getimagesize($file);
        $image_type = $source_properties[2];
        $fileName = Storage::disk('file_upload')->put('images', $request->file('image'));*/

//        $manager = new ImageManager(array('driver' => 'imagick'));
//        Image::configure(array('driver' => 'imagick'));
        $image = $request->file('image');
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        /*$destinationPath = public_path('upload/images');
        $destinationPath = str_replace('\admin', '', $destinationPath);
        $resize_image = \Image::make($image->getRealPath());

        $resize_image->resize(500, 333, function($constraint){
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $image_name);*/

        $destinationPath = public_path('upload/images');
        $destinationPath = str_replace('admin', '', $destinationPath);
        $image->move($destinationPath, $image_name);
        /*        $resize_image = Image::make($image->getRealPath());

                $resize_image->resize(1200, 800, function($constraint){
                    $constraint->aspectRatio();
                })->save($destinationPath . '/' . $image_name);*/

        if(isset($request->recommend_post)) {
            $recommend_post = 1;
            Gallery::where('is_recommend', 1)->update(['is_recommend' => '0']);
        } else {
            $recommend_post = 0;
        }

        $form_data = array(
            'id' => 0,
            'gallery_title' => $request->gallery_title,
            'gallery_text' => $request->gallery_text,
            'path_big' => $image_name,
            'is_recommend' => $recommend_post
        );

        Gallery::Insert($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }

    public function gallery_update(Request $request)
    {
        if(isset($request->recommend_post)) {
            $recommend_post = 1;
            Gallery::where('is_recommend', 1)->update(['is_recommend' => '0']);
        } else {
            $recommend_post = 0;
        }

        if($request->file('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('upload/images');
            $destinationPath = str_replace('admin', '', $destinationPath);
            $image->move($destinationPath, $image_name);

            $form_data = array(
                'gallery_title' => $request->gallery_title,
                'gallery_text' => $request->gallery_text,
                'path_big' => $image_name,
                'is_recommend' => $recommend_post
            );
        } else {
            $form_data = array(
                'gallery_title' => $request->gallery_title,
                'gallery_text' => $request->gallery_text,
                'is_recommend' => $recommend_post
            );
        }

        Gallery::whereId($request->image_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
    }

}
