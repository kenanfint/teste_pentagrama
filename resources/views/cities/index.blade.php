@extends('layouts.cities')

@section('title')
Relatório de Cidades
@endsection

@section('content')

<div class="container-xl">
	<div class="table-responsive">
		<form action="{{ route('cities.filter') }}" class="d-flex justify-content-center pb-2" method="post">
			@csrf
			<input type="text" class="form-control w-100 mr-5" placeholder="Digite o nome da cidade" name="city_name">
			<input type="text" maxlength="10" class='js-date form-control w-100 mr-5' name="foundation_date" value="" placeholder="Insira a data">
			<input type="text" class="form-control w-100 mr-5" placeholder="Digite o nome do bairro" name="district">
			<button onClick="submit" class="btn btn-primary ml-1">filtrar</button>
		</form>

		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Relatório de<b>Cidades</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addCity" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Adicionar Cidade</span></a>
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th></th>
						<th>Cidade</th>
						<th>Estado</th>
						<th>Fundação</th>
						<th>Bairro</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($cities as $city)
					<tr>
						<td></td>
						<td>{{$city->name}}</td>
						<td>{{$city->state}}</td>
						<td>{{ date('d/m/Y', strtotime($city->foundation_date)) }}</td>

						@if(!empty($city->district->name))
						<td>{{$city->district->name}}</td>
						@else
						<td></td>
						@endif
					</tr>
					@endforeach


				</tbody>
			</table>
			<div class="clearfix">
				<ul class="pagination">
					{{$cities->links("pagination::bootstrap-4")}}
				</ul>
			</div>
		</div>
	</div>
</div>

<!-- Add Modal HTML -->
<div id="addCity" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{ route('cities.store')}}">
				@csrf
				<div class="modal-header">
					<h4 class="modal-title">Adicionar Cidade</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Cidade</label>
						<input type="text" style="text-transform:capitalize" class="form-control" name="city_name" placeholder="Ex: São Paulo" required>
					</div>
					<div class="form-group">
						<label>Estado</label>
						<input type="text" maxlength="2" style="text-transform:uppercase" class="form-control" name="state_name" placeholder="Ex: SP" required>
					</div>
					<div class="form-group">
						<label for="date">Data de fundação</label>
						<input type="date" class='form-control' name="foundation_date" value="" placeholder="insira a data" required>
					</div>
					<div class="form-group">
						<label>Bairro</label>
						<input type="text" class="form-control" name="district_name" placeholder="Ex: Centro" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="submit" class="btn btn-success" value="Adicionar">
				</div>
			</form>
		</div>
	</div>
</div>
@endsection