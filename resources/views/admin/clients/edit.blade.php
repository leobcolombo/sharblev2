@extends('app')

@section('content')

<div class="container">
	<h3>Editando Clientes: {{ $client->user->name }}</h3>

	@include('errors._check')

	{!! Form::model($client, ['route'=>['admin.clients.update', $client->id]]) !!}

	@include('admin.clients._form')

	<div class="form-group">
		{!! Form::submit('Salvar Cliente', ['class'=>'btn btn-primary']) !!}
	</div>


	{!! Form::close() !!}

</div>

@endsection