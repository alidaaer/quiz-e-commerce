@extends('layout.main')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><strong>Dashboard</strong></div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
                @else
                <div class="alert alert-success">
                    Hello, Admin, You are logged in!
                    
                </div>
                <br><br>
                Explore <a href="/products">Products</a> OR <a href="/categories">Categories</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection