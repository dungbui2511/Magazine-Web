@include('admin.header');
<link rel="stylesheet" href="{{url('summernote/summernote-lite.min.css')}}" />
@include('admin.sidebar');
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>{{$page_tittle}}</h2>
            </div>
            <br style="clear:both;">
            <div class="container-fluid py-6 col-lg-12" style="margin-top:60px;">
                <form method="post" enctype="multipart/form-data">
                    @if($errors->all())
                    <div class="alert alert-danger text-center">
                        @foreach($errors->all() as $error)
                        {{$error}} <br>
                        @endforeach
                    </div>
                    @endif
                    <div class="mb-3">
                        <label for="file" class="form-label">Post tittle</label><br>
                        <input value="{{$row->tittle}}" type="text" class="form-control" placeholder="Tittle"
                            name="tittle" autofocus><br>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Featured image</label><br>
                        <input id="file" type="file" class="form-control" placeholder="File" name="file" id=""><br>
                        <img style="width:150px;" src="{{url('uploads/'.$row->image)}}" alt="">
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Post category</label> <br>
                        <select name="category_id" id="" class="form-control">
                            <option value="{{$row->category_id}}">{{$category->category}}</option>
                            @foreach($categories as $cate)
                            <option value="{{$cate->id}}">{{$cate->category}}</option>
                            @endforeach
                        </select>
                    </div>
                    @csrf
                    <h3>Post content</h3>
                    <textarea name="content" id="summernote" cols="30" rows="10">{{$row->content}}</textarea>
                    <input class="btn btn-primary" type="submit" value="Post">
                    <a href="{{url('admin/posts')}}">
                        <input class="btn btn-success" style="float:right;" type="button" value="Back">
                    </a>
                </form>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />

        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>
@include('admin.footer');
<script src="{{url('summernote/summernote-lite.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('#summernote').summernote();
});
</script>