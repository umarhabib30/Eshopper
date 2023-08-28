@extends('admin.layout')
@section('title','Edit Category')
@section('pagename','Edit Category')

@section('content')

<div class="container-fluid mt-5">
    <h4>Update Category</h4>
    <form action="{{route('admin.category.update')}}" method="POST">
        @csrf
        <input type="hidden" value="{{$category->id}}" name="id">
        <div class="row">
            <div class="col-12">
                 <input type="text" name="name" value="{{$category->name}}" class="form-control">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>


</div>

@endsection
