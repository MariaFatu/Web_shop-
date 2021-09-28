@extends('layoutcos')
@section('title', 'View Reviews')
@section('content')
<div class="panel panel-default">
 <div class="panel-heading">
 Lista produselor
 </div>
 <div class="panel-body">
 <div class="form-group">
 <div class="pull-right">
 <table class="table table-bordered table-stripped">
    <tr>
        <th width="300">Review</th>
        <th>Sentiment</th>
        <th>Scor</th>
    </tr>
    @if (count($reviews) > 0)
        @foreach ($reviews as $key => $review)
        <tr>   
            <td>{{ $review->review }}</td>
            <td>{{ $review->sentiment }}</td>
            <td>{{ $review->scor }}</td>
        </tr>
        @endforeach
    @else
    Nu exista review-uri!
    @endif
 </table>
 </div>
 </div>
 </div>
 </div>
 @endsection