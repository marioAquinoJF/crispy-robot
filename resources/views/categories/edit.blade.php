@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <h2>Nova Categoria</h2>
        
        @include('errors._check')
        
        {!!Form::model($category,['route'=>['admin.categories.update',$category->id], 'method'=>'PUT'])!!}
        @include('categories._form')
        <div class="form-group">
        {!!Form::submit('Criar',null,['class'=>'btn btn-primary btn-default'])!!}
        </div>
        {!!Form::close()!!}
        
    </div>
</div>
@endsection