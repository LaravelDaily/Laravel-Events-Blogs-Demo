@extends('layouts.front')

@section('content')

<section class="blog single-blog section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1 col-lg-12 offset-lg-0">
				<article class="single-post">
					<h3>{{ $post->title }}</h3>
					<ul class="list-inline">
						<li class="list-inline-item">{{ $post->created_at }}</li>
                    </ul>
                    @if($post->photo)
                        <img src="{{ $post->photo->front }}" alt="article-01">
                    @endif
                    {!! $post->full_text !!}
                    <hr>
                    @if($post->sport)
                        <a href="{{ route('events.index', ['sport_id' => $post->sport->id]) }}">
                            <span class="badge badge-primary">{{ $post->sport->name }}</span>
                        </a>
                    @endif
                    @if($post->event)
                        @if($post->event->region)
                            <a href="{{ route('events.index', ['region_id' => $post->event->region->id]) }}">
                                <span class="badge badge-success">{{ $post->event->region->name }}</span>
                            </a>
                        @endif
                        @if($post->event->charity)
                            <a href="{{ route('events.index', ['charity_id' => $post->event->charity->id]) }}">
                                <span class="badge badge-warning">{{ $post->event->charity->name }}</span>
                            </a>
                        @endif
                    @endif
				</article>
			</div>
		</div>
	</div>
</section>
@endsection
