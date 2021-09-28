@extends('layoutcos')
@section('title', 'Detalii produs')
@section('content')
 <div class="panel panel-default">
    <div class="panel-heading">
     <h2>Detalii produs</h2>
    </div>
    <div class="panel-body">
        <div class="pull-right">
         <a class="btn btn-default" href="{{ route('products-list.index') }}">Inapoi</a>
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
        <div>
        <p class="btn-holder"><a href="{{ url('review-form/'.$product->id) }}"
             class="btn btn-warning btn-block text-center" role="button">Adauga un review</a>
        </p>
        <p class="btn-holder"><a href="{{ url('add-to-cart/'.$product->id) }}"
               class="btn btn-warning btn-block text-center" role="button">Pune in cos</a> </p>
        </div>
    </div>
 </div>
@endsection
