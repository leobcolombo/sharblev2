@extends('app')

@section('content')

<div class="container">
	<h3>Categorias <span class="badge">{{ count($categories) }}</span></h3>
	<br />
		<a class="btn btn-default" href="{{ route('admin.categories.create') }}">Nova Categoria</a>
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
		@foreach($categories as $category)
			<tr>
				<td>{{ $category->id }}</td>
				<td>{{ $category->name }}</td>
				<td>
					<a href="{{ route('admin.categories.edit',['id'=>$category->id])}}" class="btn btn-primary btn-sm">Editar</a>
					<a href="{{ route('admin.categories.destroy',['id'=>$category->id])}}" class="btn btn-danger btn-sm">Remover</a>
				</td>
			</tr>
		@endforeach
		</tbody>

	</table>

	{!! $categories->render() !!}

</div>

@endsection