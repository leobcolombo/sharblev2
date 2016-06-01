@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home
				</div>

				<div class="panel-body">
<div class="well" role="alert">Olá <b>{{ Auth::user()->name }}</b>. Bem Vindo ao sistema!</div>
	<br /><br />
  <div class="col-lg-6">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Busca...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Buscar!</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->

	<br /><br />

				</div>
<div class="jumbotron">
  <h1>Central de atendimento!</h1>
  <p>Tire suas dúvidas sobre os componentes e as funcionalidades do sistema.<br />
  Temos uma equipe sempre pronta para lhe atender!<br /><br/ >
  <b>#academiadaweb</b><br />
  <a href="http://www.academiadaweb.com.br">www.academiadaweb.com.br</a></p>
  <p><a class="btn btn-primary btn-lg" href="http://www.academiadaweb.com.br/help" role="button">Abrir chamado</a></p>
</div>
			</div>
		</div>

	</div>
</div>
@endsection
