@extends('layouts.app')
@section('title','CDPRODUCTS')
@section('content')

<style type="text/css">
   body { background: DodgerBlue !important; }
</style>
<div style="padding:30px;">

@foreach($id as $product)
@endforeach
</div>
<div class="container">
<div style="width:750px;">
<div style="padding-left:300px">
    <div class="card-deck">
    <div class="card bg-light">
      <div class="card-body text-center">
      <p class="card-text"><div style="padding:10px;">
    <form method="POST" action="{{ route('product.update', $product->getId()) }}">
    @csrf
    @method('PUT')
    <p class="card-text">
    <p class="font-weight-bold"><h2>CD</p></h2>
    <input type="text" class="form-control" name="title" value="{{ $product->getTitle() }}" required><br/> 
    <input type="text" class="form-control" name="firstname" value="{{ $product->getFirstName() }}"><br/>
    <input type="text" class="form-control" name="surname" value="{{ $product->getMainName() }}"><br/>
    <input type="text" class="form-control" name="price" value="{{ $product->getPrice() }}"><br/>
    <input type="text" class="form-control" name="papl" value="{{ $product->getPlayLength() }}"></br>
    <p class="text-left"><button type= "submit" name="save" class="btn btn-dark">UPDATE</button>
     </form>
     <form method="POST" action="{{ route('product.delete', $product->getId()) }}">
    @csrf
    @method('delete')
    <hr>
<p class="text-right"><button class="btn btn-dark">DELETE</button></p>
</form>
     </div>
     </div>
     </div>
     </div>
     </div>
     </p>

@endsection
