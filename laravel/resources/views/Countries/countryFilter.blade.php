@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12 margin-tb">
			<div class="pull-left">
				<?php
					$continent = '';
					$goverment = '';
					$numberFrom = '';
					$numberTo = '';
					$filter = '';
						if(request()->continent){
							$continent = request()->continent;
							$filter.=' - '.$continent;
						}
						if(request()->goverment){
							$goverment = request()->goverment;
							$filter.=' - '.$goverment;
						}
						if(request()->numberFrom){
							$numberFrom = request()->numberFrom;
						}
						if(request()->numberTo){
							$numberTo = request()->numberTo;
						}
						if($numberFrom!='' || $numberTo!=''){
							$filter.=' - IndepYear from '.$numberFrom.' to '.$numberTo;
						}
				?>
				<h2>Filter by Countries <span style="color: #cc1c1c;">{{$filter}}</span></h2>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-lg-12 margin-tb">
			<div class="col-sm-3 margin-tb">
				<div class="row">
					<div class="form-group">
						<a href="{{url('filter/')}}">Все государства</a>
					</div>
					<form action="{{url('filterSelect')}}" method="GET">
						<div class="form-group">
							<label>Select continent</label>
							<select class="form-control" name="continent">
								<option value="" selected>Continent</option>
								@foreach ($continents as $continent)
									<option value="{{$continent->continent}}">{{$continent->continent}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Select GovernmentForm</label>
							<select class="form-control" name="goverment">
								<option value="" selected>GovernmentForm</option>
								@foreach ($governments as $government)
									<option value="{{$government->GovernmentForm}}">{{$government->GovernmentForm}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Select IndepYear</label><br>
							from <input type="number" name="numberFrom" value="{{$numberMin->IndepYear}}" class="form-control">
							to <input type="number" name="numberTo" value="{{$numberMax->IndepYear}}" class="form-control">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary mb-2">Filter send</button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-sm-9">
				@if (count($countries ?? '' ) > 0)
					<table class="table table-striped">
						<tr>
							<th style="width: 10%">NN</th>
							<th style="width: 10%">Code</th>
							<th style="width: 20%">Country name</th>
							<th style="width: 20%">Continent</th>
							<th style="width: 20%">GovernmentForm</th>
							<th style="width: 20%">IndepYear</th>
						</tr>
						<?php $k=0; ?>
						@foreach ($countries as $country)
							<?php $k++; ?>
							<tr>
								<td>{{$k}}</td>
								<td>{{$country->Code}}</td>
								<td>{{$country->Name}}</td>
								<td>{{$country->Continent}}</td>
								<td>{{$country->GovernmentForm}}</td>
								<td>{{$country->IndepYear}}</td>
							</tr>
						@endforeach
					</table> 
				@else
					<p>Data not found</p>
				@endif
				<p><strong>Всего государств: </strong>{{count($countries)}}</p>
			</div>
		</div>
	</div>
</div>
@endsection