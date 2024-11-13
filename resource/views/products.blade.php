@extends('layouts.app')
@section('title','PRODUCTS')
@section('content')

<style type="text/css">
   body { background: DodgerBlue !important; }
</style>

<div class="container pt-4">
  
  <div class="card-deck">
    <div class="card bg-light">
      <div class="card-body">
      <p class="font-weight-bold">CD</p>
      
        <p class="card-text">
        
        @foreach($cds as $product)

        <p class="font-weight-bold">{{ $product->getTitle() }}</p>
{{ $product->getFirstName()}} {{ $product->getMainName()}}<br>
${{ $product->getPrice()}}<br>
Play Length: {{ $product->getPlayLength()}}<br>

<hr>
<div class ="text-right">
<a class="btn btn-dark" href="{{ url('products/'. $product->getId()) }}" role="button">SELECT</a><br>

</div>
@endforeach</p>
        
      </div>
    </div>
    
    <div class="card bg-light">
      <div class="card-body">
      <p class="font-weight-bold">BOOK</p>
        <p class="card-text"> @foreach($books as $product)

        <p class="font-weight-bold">{{ $product->getTitle() }}</p>
        {{ $product->getFirstName()}} {{ $product->getMainName()}}<br>
${{ $product->getPrice()}}<br>
No of pages: {{ $product->getNumberOfPages() }}<br>

<hr>
<div class ="text-right">
<a class="btn btn-dark" href="{{ url('products/'. $product->getId()) }}" role="button">SELECT</a><br><br>
</div>
@endforeach</p>
        
      </div>
    </div>
    <div class="card bg-light">
      <div class="card-body text-center">
        <p class="card-text"><div style="padding:30px;">
        
    <form method="POST" action="/products/store">
    @csrf
    <p class="font-weight-bold">
    <label> PRODUCT TYPE: </label>
    </p>
    <select name="type" class="form-control">
        <option value="cd">CD</option>
        <option value="book">Book</option> 
    </select><br>
    <input type="text" class="form-control" name="title" placeholder="Title" required><br/> 
    <input type="text" class="form-control" name="firstname" placeholder="First Name"><br/>
    <input type="text" class="form-control" name="surname" placeholder="surname"><br/>
    <input type="text" class="form-control" name="price" placeholder="Price in Dollars"><br/>
    <input type="text" class="form-control" name="papl" placeholder="Pages/Play Length"></br>
    <hr>
    <div class ="text-right">
    <button type= "submit" name="save" class="btn-dark">ADD NEW</button>
    </div>
     </form>
    </div></p>
      </div>
    </div>
    </div>  
  </div>


@endsection
