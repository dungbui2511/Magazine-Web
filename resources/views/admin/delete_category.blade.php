@include('admin.header');
@include('admin.sidebar');
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>{{$page_tittle}}</h2>
            </div>
            <br style="clear:both;">
            <div class="container-fluid py-6 col-lg-12" style="margin-top:60px;">
            <h4>Are you sure you want to delete this catgory?</h4> <br>
                <form method="post">
                    <div class="mb-3">
                        <label for="file" class="form-label">Category name</label><br>
                        <input disabled value="{{$row->category}}" type="text" class="form-control" placeholder="Category"
                            name="category" autofocus><br>
                    </div>
                    @csrf
                    <input class="btn btn-primary" type="submit" value="Delete">
                    <a href="{{url('admin/categories')}}">
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
