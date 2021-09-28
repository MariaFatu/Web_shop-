@extends('layoutcos')
@section('title', 'Produse')
@section('content')
    <div class="container products">
    <div class="row">
    @foreach($products as $product)
        <div class="col-xs-18 col-sm-6 col-md-3">
            <div class="thumbnail">
             <img src="{{ asset('/images/'.$product->image) }}" width="200" height="200">
             <div class="caption">
              <h4>{{ $product->name }}</h4>
              <p>{{ str_limit(strtolower($product->description), 50) }}</p>
              <p><strong>Pret: </strong> {{ $product->price }}$</p>
              <p class="btn-holder"><a href="{{ url('add-to-cart/'.$product->id) }}"
               class="btn btn-warning btn-block text-center" role="button">Pune in cos</a> </p>
               <p class="btn-holder"><a href="{{ url('product-details/'.$product->id) }}"
             class="btn btn-warning btn-block text-center" role="button">Detalii produs</a> </p>
             </div>
            </div>
        </div>
    @endforeach
    </div><!-- End row -->
    </div>
@endsection
