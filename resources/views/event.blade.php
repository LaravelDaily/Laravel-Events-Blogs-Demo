@extends('layouts.front')

@section('content')

<section class="page-search">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Advance Search -->
				<div class="advance-search">
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
							<div class="form-group col-md-2">
								<button type="submit" class="btn btn-primary">Search Now</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section bg-gray">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<!-- Left sidebar -->
			<div class="col-md-8">
				<div class="product-details">
					<h1 class="product-title">{{ $event->name }}</h1>
					<div class="product-meta">
						<ul class="list-inline">
                            @if($event->created_by)
                                <li class="list-inline-item"><i class="fa fa-user-o"></i> By {{ $event->created_by->name }}</li>
                            @endif
                            @if($event->sport)
                                <li class="list-inline-item"><i class="fa fa-futbol-o"></i> Sport<a href="{{ route('events.index', ['sport_id' => $event->sport->id]) }}">{{ $event->sport->name }}</a></li>
                            @endif
                            @if($event->region)
                                <li class="list-inline-item"><i class="fa fa-location-arrow"></i> Region<a href="{{ route('events.index', ['region_id' => $event->region->id]) }}">{{ $event->region->name }}</a></li>
                            @endif
                            @if($event->charity)
                                <li class="list-inline-item"><i class="fa fa-gift"></i> Charity<a href="{{ route('events.index', ['charity_id' => $event->charity->id]) }}">{{ $event->charity->name }}</a></li>
                            @endif
						</ul>
					</div>

                    <!-- product slider -->
                    @if($event->photo)
                        <div class="product-slider-item my-4">
                            <img class="img-fluid w-100" src="{{ $event->photo->front }}" alt="product-img">
                        </div>
                    @endif
					<!-- product slider -->
                    @if($event->description)
                        <div class="content mt-5 pt-5">
                            <div class="tab-content">
                                <h3 class="tab-title">Event Description</h3>
                                {{ $event->description }}
                                <hr>

                                @if($event->sport)
                                    <a href="{{ route('events.index', ['sport_id' => $event->sport]) }}">
                                        <span class="badge badge-primary">{{ $event->sport->name }}</span>
                                    </a>
                                @endif
                                @if($event->region)
                                    <a href="{{ route('events.index', ['region_id' => $event->region->id]) }}">
                                        <span class="badge badge-success">{{ $event->region->name }}</span>
                                    </a>
                                @endif
                                @if($event->charity)
                                    <a href="{{ route('events.index', ['charity_id' => $event->charity->id]) }}">
                                        <span class="badge badge-warning">{{ $event->charity->name }}</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
				</div>
			</div>
			<div class="col-md-4">
				<div class="sidebar">
					<div class="widget price text-center">
						<h4>Start time</h4>
                        <p>{{ $event->start_time }}</p>
                        @if($event->end_time)
                            <hr>
                            <h4>End time</h4>
                            <p>{{ $event->end_time }}</p>
                        @endif
					</div>
                    <!-- User Profile widget -->
                    @if($event->created_by)
                        <div class="widget user text-center">
                            <h4><a href="#">{{ $event->created_by->name }}</a></h4>
                            <p class="member-time">Member Since {{ $event->created_by->created_at }}</p>
                        </div>
                    @endif
				</div>
			</div>

		</div>
	</div>
	<!-- Container End -->
</section>
@endsection
