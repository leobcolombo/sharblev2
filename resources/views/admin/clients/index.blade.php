@extends('app')

@section('content')

<div class="container">
	<h3>Clientes <span class="badge">{{ count($clients) }}</span></h3>
	<br />
		<a class="btn btn-default" href="{{ route('admin.clients.create') }}">Novo Cliente</a>
	<br /><br />
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>Ação</th>
			</tr>
		</thead>

		<tbody>
		@foreach($clients as $client)
			<tr>
				<td>{{ $client->id }}</td>
				<td>{{ $client->user->name }}</td>
				<td>
					<a href="{{ route('admin.clients.edit',['id'=>$client->id])}}" class="btn btn-primary btn-sm">Editar</a>
					<a href="{{ route('admin.clients.destroy',['id'=>$client->id])}}" class="btn btn-danger btn-sm">Remover</a>
				</td>
			</tr>
		@endforeach
		</tbody>

	</table>

	{!! $clients->render() !!}

</div>

@endsection