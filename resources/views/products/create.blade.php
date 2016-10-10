@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <h2>Novo Produdo</h2>
        @include('errors._check')
        {!!Form::open(['route'=>'admin.products.store','class'=>'form'])!!}
        @include('products._form')
        <div class="form-group">
            {!!Form::submit('Criar',null,['class'=>'btn btn-primary btn-default'])!!}
        </div>
        {!!Form::close()!!}

    </div>
</div>
@endsection