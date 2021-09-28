@extends('layouts.app')
@section('content')
 <div class="panel panel-default">
 <div class="panel-heading">
 View Produs
 </div>
 <div class="panel-body">
 <div class="pull-right">
 <a class="btn btn-default" href="{{ route('products.index') }}">Inapoi</a>
 </div>
 <div class="form-group">
 <strong>Nume: </strong> {{ $product->name }}
 </div>
 <div class="form-group">
 <strong>Descriere: </strong> {{ $product->description }}
 </div>
 <div class="form-group">
 <strong>Imagine: </strong> <img src="{{ asset('/images/'.$product->image) }}" width="200" height="200">
 </div>
 <div class="form-group">
 <strong>Pret: </strong> {{ $product->price }}
 </div>
 </div>
 </div>
@endsection
