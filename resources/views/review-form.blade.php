@extends('layoutcos')
@section('title', 'Add Review')
@section('content')

<div class="container page">
{{ Form::open(array('route' => 'store-review','method'=>'POST')) }}
        <strong>Review: </strong>
            <textarea cols="35" rows="2" name="review"> </textarea><br>
            <input type="hidden" name="product_id" value ="{{ $id }}" />
            @if (!Auth::guest())
              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
            @endif
            <input type="submit" name="buton" value="Trimite"/>
{{ Form::close() }}
</div>
@endsection