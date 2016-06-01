@extends('app')

@section('content')

<div class="container">
	<h3>Cupoms <span class="badge">{{ count($cupoms) }}</span></h3>
	<br />
		<a class="btn btn-default" href="{{ route('admin.cupoms.create') }}">Novo Cupom</a>
	<br /><br />
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Código</th>
				<th>Valor</th>
				<th>Ação</th>
			</tr>
		</thead>

		<tbody>
		@foreach($cupoms as $cupom)
			<tr>
				<td>{{ $cupom->id }}</td>
				<td>{{ $cupom->code }}</td>
				<td>{{ $cupom->value }}</td>
				<td>
					--
				</td>
			</tr>
		@endforeach
		</tbody>

	</table>

	{!! $cupoms->render() !!}

</div>

@endsection