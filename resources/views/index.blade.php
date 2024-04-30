	@include('header');
	<div class="container-fluid">
		<div class="row fh5co-post-entry">	
			<?php foreach($rows as $row):?>
				<article class="col-lg-3 col-md-3 col-sm-3 col-xs-6 col-xxs-12 animate-box">
				<a href="{{url('single/'.$row->slag)}}">
				<figure>
					<img style="width: 527px; height: 400px;" src="{{url('uploads/'.$row->image)}}" alt="Image" class="img-responsive">
				</figure>
				<span class="fh5co-meta">{{ucfirst($row->category)}}</span>
				<h2 class="fh5co-article-title">{{ucfirst($row->tittle)}}</h2>
				<span class="fh5co-meta fh5co-date">{{date('F jS Y',strtotime($row->created_at))}}</span>
				</a>
			</article>
			<?php endforeach; ?>
			@include('pagination')
			<div class="clearfix visible-xs-block"></div>
		</div>
	</div>
	@include('footer');

