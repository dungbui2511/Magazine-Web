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
                    <div class="mb-3">
                        <label for="file" class="form-label">User name</label><br>
                        <input disabled value="{{$row->name}}" type="text" class="form-control" placeholder="username"
                            name="username" autofocus><br>
                    </div>
                    @csrf
                    <input class="btn btn-primary" type="submit" value="Delete user">
                    <a href="{{url('admin/users')}}">
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
