<?php

namespace App\Http\Controllers;

use App\Models\MyPage;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $limit = 1;
        $page = $request->input('page') ? (int)$request->input('page') : 1;
        $offset = ($page-1) * $limit;
        $page_class = new MyPage();
        $links = $page_class->make_links($request->fullUrlWithQuery(['page'=>$page]),$page,1);
        if($request->input('find')){
            $query = "select posts.*,categories.category from posts join categories on posts.category_id = categories.id
            where tittle like :tittle limit $limit offset $offset";
            $tittle = "%".$request->input('find')."%";
            $rows = DB::select($query,['tittle'=>$tittle]);
        }else{
            $query1 = "select posts.*,categories.category from posts join categories on posts.category_id = categories.id limit $limit offset $offset";
            $rows = DB::select($query1);
        }
        if($request->input('cat')){
            $query2 = "select posts.*,categories.category from posts join categories on posts.category_id = categories.id
            where category_id = :id limit $limit offset $offset";
            $id = $request->input('cat');
            $rows = DB::select($query2,['id'=>$id]);
        }else{
            $query3 = "select posts.*,categories.category from posts join categories on posts.category_id = categories.id limit $limit offset $offset";
            $rows = DB::select($query3);
        }
        $query2 = "select * from categories order by id desc";
        $categories = DB::select($query2);
        $data['rows'] = $rows;
        $data['categories'] = $categories;
        $data['page_tittle'] = 'Home';
        $data['links'] =$links;
        return view('index',$data);
    }
    public function save(Request $request)
    {
        $validate = $request->validate([
            'key' => 'required|string',
        ]);
        return view('view');
    }
}
