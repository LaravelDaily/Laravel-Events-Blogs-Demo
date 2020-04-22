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
                                <input type="text" class="form-control my-2 my-lg-1 date" id="date_from" name="date_from" value="{{ old('date_from') }}" placeholder="Date from">
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control my-2 my-lg-1 date" id="date_to" name="date_to" value="{{ old('date_to') }}" placeholder="Date to">
                            </div>
                            <div class="form-group col-md-2">
                                <select class="w-100 form-control mt-lg-1 mt-md-2" id="sport_id" name="sport_id">
                                    <option value="">Select sport</option>
                                    @foreach($searchSports as $id => $name)
                                        <option value="{{ $id }}" {{ request()->input('sport_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <select class="w-100 form-control mt-lg-1 mt-md-2" id="region_id" name="region_id">
                                    <option value="">Select region</option>
                                    @foreach($searchRegions as $id => $name)
                                        <option value="{{ $id }}" {{ request()->input('region_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <select class="w-100 form-control mt-lg-1 mt-md-2" id="charity_id" name="charity_id">
                                    <option value="">Select charity</option>
                                    @foreach($searchCharities as $id => $name)
                                        <option value="{{ $id }}" {{ request()->input('charity_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
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
<section class="section-sm">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="product-grid-list">
					<div class="row mt-30">
                        @foreach($events as $event)
						<div class="col-sm-12 col-lg-4 col-md-6">
							<!-- product card -->
                            <div class="product-item bg-light">
                                <div class="card">
                                    <div class="thumb-content">
                                        <a href="{{ route('events.show', $event) }}">
                                            <img class="card-img-top img-fluid" src="{{ asset('images/products/products-1.jpg') }}" alt="Card image cap">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title"><a href="{{ route('events.show', $event) }}">{{ $event->name }}</a></h4>
                                        <ul class="list-inline product-meta">
                                            @if($event->sport)
                                                <li class="list-inline-item">
                                                    <a href="{{ route('events.index', ['sport_id' => $event->sport->id]) }}"><i class="fa fa-futbol-o"></i>{{ $event->sport->name }}</a>
                                                </li>
                                            @endif
                                            <li class="list-inline-item">
                                                <a href="#"><i class="fa fa-calendar"></i>{{ $event->start_time }}</a>
                                            </li>
                                        </ul>
                                        <p class="card-text">{{ Str::limit($event->description, 50) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
					</div>
				</div>
				<div class="pagination justify-content-center">
                    {{ $events->links() }}
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
