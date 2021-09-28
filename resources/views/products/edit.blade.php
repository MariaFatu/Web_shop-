@extends('layouts.app')
@section('content')
 <div class="panel panel-default">
 <div class="panel-heading"> Modificare informatii Produs</div>
 <div class="panel-body">
<!—exista inregistrari in tabelul product 
 @if (count($errors) > 0)
 <div class="alert alert-danger">
 <strong>Eroare:</strong>
 <ul>
 @foreach ($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>
 </div>
 @endif
<!—populez campurile formularului cu datele aferente din tabela produse -->
 {!! Form::model($product, ['method' => 'PATCH','route' => ['products.update', $product->id]]) !!}
 <div class="form-group">
 <label for="name">Nume</label>
 <input type="text" name="name" class="form-control" value="{{$product->name }}">
 </div>
 <div class="form-group">
 <label for="description">Descriere</label>
 <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
 </div>
 <div class="form-group">
<label for="name">Imagine</label>
<input type="text" name="image" class="form-control" value="{{$product->image }}">
</div>
<div class="form-group">
<label for="name">Pret</label>
<input type="text" name="price" class="form-control" value="{{ $product->price }}">
</div>
 <div class="form-group">
 <input type="submit" value="Salvare Modificari" class="btn btn-info">
 <a href="{{route('products.index') }}" class="btn btn-default">Cancel</a>
 </div>
  {!! Form::close() !!}

 </div>
 </div>
@endsection