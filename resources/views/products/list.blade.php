@extends('layouts.app')
@section('content')
 @if ($message = Session::get('success'))
 <div class="alert alert-success">
 <p>{{ $message }}</p>
 </div>
 @endif
 <div class="panel panel-default">
 <div class="panel-heading">
 Lista produselor
 </div>
 <div class="panel-body">
 <div class="form-group">
 <div class="pull-right">
 <a href="/products/create" class="btn btn-default">Adăugare Produs Nou</a>
 </div>
 </div>
 <table class="table table-bordered table-stripped">
    <tr>
        <th>Nume produs</th>
        <th width="300">Poza produs</th>
        <th>Descriere</th>
        <th>Pret</th>
        <th width="300">Actiune</th>
    </tr>
    @if (count($products) > 0)
    @foreach ($products as $key => $product)
    <tr>   
        <td>{{ $product->name }}</td>
        <td> <img class="image" src="{{ asset('/images/'.$product->image) }}" width="100" height="100"></td>
        <td>{{ $product->description }}</td>
        <td>{{ $product->price }}</td>
        <td>
        <a class="btn btn-success" href="{{ route('products.show',$product->id) }}">Vizualizare</a>
        <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Modificare</a>
        {{ Form::open(['method' => 'DELETE','route' => ['products.destroy', $product->id],'style'=>'display:inline']) }}
        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
        {{ Form::close() }}
        <a class="btn btn-primary" href="{{ route('view-reviews',$product->id) }}">Vizualizare reviews</a>
        </td>
    </tr>
    @endforeach
    @else
    <tr>
    <td colspan="6">Nu exista produse!</td>
    </tr>
    @endif
 </table>
<!-- Introduce nr pagina -->
{{$products->render()}}
 </div>
 </div>
@endsection
