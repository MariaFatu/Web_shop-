@extends('layouts.app')
@section('content')
 @if ($message = Session::get('success'))
 <div class="alert alert-success">
 <p>{{ $message }}</p>
 </div>
 @endif
 <div class="panel panel-default">
 <div class="panel-heading">
 Lista review-urilor
 </div>
 <div class="panel-body">

 <table class="table table-bordered table-stripped">
    <tr>
        <th>Produs</th>
        <th width="300">Poza produs</th>
        <th>Media scorurilor</th>
        <th width="300">Actiune</th>
    </tr>
    @if (count($reviews_details) > 0)
     @foreach ($reviews_details as $key => $review_details)
        <tr>   
            <td>{{ $review_details->name }}</td>
            <td> <img class="image" src="{{ asset('/images/'.$review_details->img) }}" width="100" height="100"></td>
            <td>{{ $review_details->avg_scor }}</td>
            <td>
                <a class="btn btn-primary" href="{{ route('view-reviews',$review_details->id) }}">Vizualizare reviews</a>
            </td>
        </tr>
     @endforeach
    @else
        <tr>
        <td colspan="6">Nu exista review-uri!</td>
        </tr>
    @endif
 </table>
 </div>
 </div>
@endsection
