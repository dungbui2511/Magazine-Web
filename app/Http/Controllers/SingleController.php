<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SingleController extends Controller
{
    public function index(Request $request,$id =''){
        $query = "select * from posts where slag = :slag limit 1";
        $row = DB::select($query,['slag' =>$id]);
        if($row){
            $query1 = "select * from categories where id = :id order by id desc";
            $category = DB::select($query1,['id' => $row[0]->category_id]);
            $data['row'] = $row[0];
            $data['category'] = $category[0];
        }
        $query2 = "select * from categories order by id desc";
        $categories = DB::select($query2);
        $data['categories'] = $categories;
        return view('single',$data);
    }
    public function save(Request $request){
        // $validate = $request->validate([
        //     'key'=>'required|string',
        //     'key'=>required|image
        // ]);
        return view('view');
    }
}
