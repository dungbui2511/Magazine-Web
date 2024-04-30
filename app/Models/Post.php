<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Post extends Model
{
    use HasFactory;
    public $timestamps = true;
    public function category()
    {
        return $this->hasMany(Category::class,'id','category_id');
    }
    public function str_to_url($url){
        // Chuyển khoảng trắng và các ký tự không hợp lệ thành dấu gạch ngang
        $url = preg_replace('~[^\pL0-9_]+~u', '-', $url);
        
        // Loại bỏ dấu gạch ngang ở đầu và cuối chuỗi
        $url = trim($url, "-");
        
        // Chuyển đổi ký tự có dấu thành ký tự không dấu
        $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
        
        // Chuyển tất cả thành chữ thường
        $url = strtolower($url);
        
        // Loại bỏ ký tự không hợp lệ khác
        $url = preg_replace('~[^-a-z0-9]+~', '', $url);
        
        return $url;
    }
    
}
