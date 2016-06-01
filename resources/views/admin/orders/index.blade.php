@extends('app')

@section('content')

<div class="container">
	<h3>Pedidos</h3>
	<br />
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Total</th>
				<th>Data</th>
				<th>Itens</th>
				<th>Entregador</th>
				<th>Status</th>
				<th>Ação</th>
			</tr>
		</thead>

		<tbody>
		@foreach($orders as $order)
			<tr>
				<td>#{{ $order->id }}</td>
				<td>R${{ $order->total }}</td>
				<td>{{ $order->created_at }}</td>
				<td>
					<ul>
					@foreach($order->items as $item)
						<li>{{$item->product->name}}</li>
					@endforeach
					</ul>
				</td>
				<td>
					@if($order->develiveryman)
						{{$order->develiveryman->name}}
					@else
						--
					@endif
				</td>
				<td>
					@if($order->status == 0)
						<span class="label label-danger">Pendente</span>
					@elseif($order->status == 1)
						<span class="label label-warning">A caminho</span>
					@else
						<span class="label label-success">Entregue</span>
					@endif
				</td>
				<td>
					<a href="{{ route('admin.orders.edit',['id'=>$order->id]) }}" class="btn btn-primary btn-sm">Editar</a>
				</td>
			</tr>
		@endforeach
		</tbody>

	</table>

	{!! $orders->render() !!}

</div>

@endsection