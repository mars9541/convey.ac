<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Article;
use App\Country_spec_info;
class ArticleController extends Controller
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
        $maxPriority = Article::max('priority')+1;
        return view('admin.article_manager',compact('maxPriority'));
    }

    public function save_article(Request $request)
    {

        if($request->id)
        {
            $article = Article::find($request->id);
            $article->title = $request->title;
            $article->description = $request->description;
            $article->account_type = $request->account_type;
            $article->priority = $request->priority;
            $article->update();
            return response()->json(['success' => 'Updated Successfully!']);
        }else
        {
            $maxId = \DB::select('SELECT MAX(CAST(SUBSTRING(id, 3, length(id)-2) AS int)) AS MaxNum FROM u_article')[0]->MaxNum;
            $newId = Country_spec_info::value('country_ID').strval($maxId+1);
            $article = new Article;
            $article->id = $newId;
            $article->title = $request->title;
            $article->description = $request->description;
            $article->account_type = $request->account_type;
            $article->priority = $request->priority;
            $article->save();
            return response()->json(['success' => 'Added Successfully!']);
        }
       
        
    }

    public function article_list(Request $request)
    {
        if($request->type != ''){
            $data = Article::where('account_type',$request->type)->get();
        }else
        {
            $data = Article::all();
        }
        
        return response()->json(['data' => $data]);
    }

    public function get_article($id)
    {
        $data = Article::find($id);
        return response()->json(['data'=>$data]);
    }
    public function delete_article($id)
    {
        $data = Article::find($id);
        $data->delete();
        return response()->json(['success'=>'Deleted Successfully!']);
    }

    

}
