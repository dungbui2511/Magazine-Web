<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;
use App\Models\MyPage;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $page_tittle = "Dashboard";
        return view('admin.admin', ['page_tittle' => 'Dashboard']);
    }
    public function posts(Request $request, $type = '', $id = '')
    {
        switch ($type) {
            case 'add':
                if ($request->method() == "POST") {
                    $post = new Post();
                    $validate = $request->validate([
                        'tittle' => 'required|string',
                        'file' => 'required|image',
                        'content' => 'required'
                    ]);
                    $path = $request->file('file')->store('/', ['disk' => 'my_disk']);
                    $data['tittle'] = $request->input('tittle');
                    $data['category_id'] = 1;
                    $data['image'] = $path;
                    $data['content'] = $request->input('content');
                    $data['created_at'] = date("Y-m-d H:i:s");
                    $data['updated_at'] = date("Y-m-d H:i:s");
                    $data['slag'] = $post->str_to_url($data['tittle']);
                    $post->insert($data);
                }
                $query = "select * from categories order by id desc";
                $categories = DB::select($query);
                return view('admin.add_post', ['page_tittle' => 'New Posts','categories'=>$categories]);
                break;
                // case 'edit':
                //     $post = new Post();
                //     $row = $post->find($id);
                //     $category = $row->category()->first();
                //     return view('admin.edit_post', ['page_tittle' => 'Edit Post', 'row' => $row, 'category' => $category]);
                //     break;
            case 'edit':
                $post = new Post();
                if ($request->method() == "POST") {
                    $validate = $request->validate([
                        'tittle' => 'required|string',
                        // 'file' => 'required|image',
                        'content' => 'required'
                    ]);
                    if ($request->file('file')) {
                        $oldrow = $post->find($id);
                        if (file_exists('uploads/'.$oldrow->image)) {
                            unlink('uploads/'.$oldrow->image);
                        }
                        $path = $request->file('file')->store('/', ['disk' => 'my_disk']);
                        $data['image'] = $path;
                    }
                    $data['id'] = $id;
                    $data['category_id'] = $request->input('category_id');
                    $data['tittle'] = $request->input('tittle');
                    $data['content'] = $request->input('content');
                    $data['updated_at'] = date("Y-m-d H:i:s");
                    $post->where('id', $id)->update($data);
                    return redirect('admin/posts/edit/' . $id);
                }
                $row = $post->find($id);
                $category = $row->category()->first();
                $query = "select * from categories order by id desc";
                $categories = DB::select($query);
                return view('admin.edit_post', ['page_tittle' => 'Edit Post', 'row' => $row, 'category' => $category,'categories' => $categories]);
                break;
            case 'delete':
                $post = new Post();
                $row = $post->find($id);
                $category = $row->category()->first();
                if ($request->method() == "POST") {
                    $post->where('id', $id)->delete();
                    return redirect('admin/posts');
                }
                return view('admin.delete_post', [
                    'page_tittle' => 'Delete post',
                    'row' => $row,
                    'category' => $category
                ]);
                break;
            default:
                $post = new Post();
                $limit = 1;
                $page = $request->input('page') ? (int)$request->input('page') : 1;
                $offset = ($page-1) * $limit;
                $page_class = new MyPage();
                $links = $page_class->make_links($request->fullUrlWithQuery(['page'=>$page]),$page,1);
                $query = "select posts.*,categories.category from posts join categories on posts.category_id = categories.id limit $limit offset $offset";
                $rows = DB::select($query);
                $data['rows'] = $rows;
                $data['page_tittle'] = 'Posts';
                $data['links'] = $links;
                return view('admin.posts', $data);
                break;
        }
    }
    public function categories(Request $request, $type = '', $id = '')
    {
        switch ($type) {
            case 'add':
                if ($request->method() == "POST") {
                    $category = new Category();
                    $validate = $request->validate([
                        'category' => 'required|string',
                    ]);
                    $data['category'] = $request->input('category');
                    $data['created_at'] = date("Y-m-d H:i:s");
                    $data['updated_at'] = date("Y-m-d H:i:s");
                    $category->insert($data);
                    return redirect('admin/categories');
                }
                return view('admin.add_category', ['page_tittle' => 'New Category']);
                break;
                // case 'edit':
                //     $category = new Category();
                //     $row = $category->find($id);
                //     return view('admin.edit_category', ['page_tittle' => 'Edit Category', 'row' => $row, 'category' => $category]);
                //     break;
            case 'edit':
                $category = new Category();
                if ($request->method() == "POST") {
                    $validate = $request->validate([
                        'category' => 'required|string',
                    ]);
                    $data['category'] = $request->input('category');
                    $data['updated_at'] = date("Y-m-d H:i:s");
                    $category->where('id', $id)->update($data);
                    return redirect('admin/categories/edit/' . $id);
                }
                $row = $category->find($id);
                return view('admin.edit_category', [
                    'page_tittle' => 'Edit Category',
                    'row' => $row,
                    'category' => $category,
                    
                ]);
                break;
            case 'delete':
                $category = new Category();
                $row = $category->find($id);
                if ($request->method() == "POST") {
                    $category->where('id', $id)->delete();
                    return redirect('admin/categories');
                }
                return view('admin.delete_category', [
                    'page_tittle' => 'Delete category',
                    'row' => $row,
                ]);
                break;
            default:
                $post = new Post();
                $limit = 1;
                $page = $request->input('page') ? (int)$request->input('page') : 1;
                $offset = ($page-1) * $limit;
                $page_class = new MyPage();
                $links = $page_class->make_links($request->fullUrlWithQuery(['page'=>$page]),$page,1);
                $query = "select * from categories order by id desc limit $limit offset $offset";
                $rows = DB::select($query);
                $data['rows'] = $rows;
                $data['page_tittle'] = 'Categories';
                $data['links'] = $links;
                return view('admin.categories', $data);
                break;
        }
        return view('admin.admin', ['page_tittle' => 'Categories']);
    }
    public function users(Request $request,$type='',$id ='')
    {
        switch ($type) {
            case 'edit':
                $user = new User();
                if ($request->method() == "POST") {
                    $validate = $request->validate([
                        'email' =>'required|email',
                    ]);
                    $data['name'] = $request->input('username');
                    $data['email'] = $request->input('email');
                    $data['updated_at'] = date("Y-m-d H:i:s");
                    $user->where('id', $id)->update($data);
                    return redirect('admin/users/edit/' . $id);
                }
                $row = $user->find($id);
                return view('admin.edit_user', [
                    'page_tittle' => 'Edit user',
                    'row' => $row,
                ]);
                break;
            case 'delete':
                $user = new User();
                $row = $user->find($id);
                if ($request->method() == "POST") {
                    $user->where('id', $id)->delete();
                    return redirect('admin/users');
                }
                return view('admin.delete_user', [
                    'page_tittle' => 'Delete user',
                    'row' => $row,
                ]);
                break;
            default:
                $user = new User();
                $limit = 1;
                $page = $request->input('page') ? (int)$request->input('page') : 1;
                $offset = ($page-1) * $limit;
                $page_class = new MyPage();
                $links = $page_class->make_links($request->fullUrlWithQuery(['page'=>$page]),$page,1);
                $query = "select * from users order by id desc limit $limit offset $offset";
                $rows = DB::select($query);
                $data['rows'] = $rows;
                $data['page_tittle'] = 'Users';
                $data['links'] = $links;
                return view('admin.users', $data);
                break;
        }
        return view('admin.admin', ['page_tittle' => 'Users']);
    }
    // public function save(Request $request){
    //     $validate = $request->validate([
    //         'key'=>'required|string',
    //         'key'=>required|image
    //     ]);
    //     return view('view');
    // }
}
