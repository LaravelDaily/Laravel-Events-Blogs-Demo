@extends('layouts.front')

@section('content')

<section class="hero-area bg-1 text-center overly">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Header Contetnt -->
				<div class="content-block">
					<h1>Sports Events</h1>
					<div class="short-popular-category-list text-center">
						<h2>Popular Sports</h2>
						<ul class="list-inline">
                            @foreach($popularSports as $id => $sport)
                                <li class="list-inline-item">
                                    <a href="{{ route('events.index', ['sport_id' => $id]) }}">{{ $sport }}</a>
                                </li>
                            @endforeach
						</ul>
					</div>

				</div>
				<!-- Advance Search -->
				<div class="advance-search">
						<div class="container">
							<div class="row justify-content-center">
								<div class="col-lg-12 col-md-12 align-content-center">
										<form action="{{ route('events.index') }}">
											<div class="form-row">
												<div class="form-group col-md-2">
													<input type="text" class="form-control my-2 my-lg-1 date" id="date_from" name="date_from" placeholder="Date from">
												</div>
												<div class="form-group col-md-2">
													<input type="text" class="form-control my-2 my-lg-1 date" id="date_to" name="date_to" placeholder="Date to">
												</div>
												<div class="form-group col-md-2">
													<select class="w-100 form-control mt-lg-1 mt-md-2" id="sport_id" name="sport_id">
                                                        <option value="">Select sport</option>
                                                        @foreach($searchSports as $id => $name)
                                                            <option value="{{ $id }}">{{ $name }}</option>
                                                        @endforeach
													</select>
												</div>
												<div class="form-group col-md-2">
													<select class="w-100 form-control mt-lg-1 mt-md-2" id="region_id" name="region_id">
                                                        <option value="">Select region</option>
                                                        @foreach($searchRegions as $id => $name)
                                                            <option value="{{ $id }}">{{ $name }}</option>
                                                        @endforeach
													</select>
												</div>
												<div class="form-group col-md-2">
													<select class="w-100 form-control mt-lg-1 mt-md-2" id="charity_id" name="charity_id">
                                                        <option value="">Select charity</option>
                                                        @foreach($searchCharities as $id => $name)
                                                            <option value="{{ $id }}">{{ $name }}</option>
                                                        @endforeach
													</select>
												</div>
												<div class="form-group col-md-2 align-self-center">
													<button type="submit" class="btn btn-primary">Search Now</button>
												</div>
											</div>
										</form>
									</div>
								</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- Container End -->
</section>

<section class=" section bg-gray">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<!-- Section title -->
				<div class="section-title">
					<h2>All Sports</h2>
				</div>
				<div class="row">
                    <!-- Category list -->
                    @foreach($allSports as $sport)
                        <div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
                            <div class="category-block">
                                <div class="header">
                                    <h4>{{ $sport->name }}</h4>
                                </div>
                                <ul class="category-list" >
                                    @foreach($sport->events as $event)
                                        <li><a href="{{ route('events.show', $event) }}">{{ $event->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div> <!-- /Category List -->
                    @endforeach
				</div>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>

<section class="popular-deals section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h2>Our Blog</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
                <div class="row">
                    @foreach($blogPosts as $post)
                        <div class="col-md-4">
                            <!-- product card -->
                            <div class="product-item bg-light">
                                <div class="card">
                                    <div class="thumb-content">
                                        @if($post->photo)
                                            <a href="{{ route('posts.show', $post) }}">
                                                <img class="card-img-top img-fluid" src="{{ $post->photo->thumb_front }}" alt="Card image cap">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h4>
                                        <ul class="list-inline product-meta">
                                            <li class="list-inline-item">
                                                <a href="#"><i class="fa fa-calendar"></i>{{ $post->created_at }}</a>
                                            </li>
                                        </ul>
                                        <p class="card-text">{{ Str::limit(strip_tags($post->full_text), 50 ) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
			</div>


		</div>
	</div>
</section>
@endsection
