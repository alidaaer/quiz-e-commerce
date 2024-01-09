@extends('layout.main')

@section('content')

<h2>Product Update</h2>
        <form method="POST" action="{{ route('update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="product_id">Product ID</label>
                <input type="text" class="form-control" id="product_id" value="{{ $product->id }}" disabled>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category">
                    @foreach($Categories as $cat)
                        <option value="{{$cat->id}}" {{ $product->category->name == $cat->name ? 'selected' : '' }}>{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>

        @stop