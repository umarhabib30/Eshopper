@extends('admin.layout')
@section('title','Edit Category')
@section('pagename','Edit Category')

@section('content')

<div class="container-fluid mt-5">
    <h4>Update Category</h4>
    <form action="{{route('admin.subcategory.update')}}" method="POST">
        @csrf
        <input type="hidden" value="{{$subcategory->id}}" name="id">
        <div class="mb-3 mt-3">
            <label for="category">Select Category</label>
            <select class="form-control" id="category" name="parent_id">
                @foreach (App\Models\Category::all() as $category)
                <option value="{{$category->id}}"  @if ($category->id == $subcategory->parent_id) selected
                @endif>{{$category->name}}</option>
                @endforeach
            </select>
          </div>
        <div class="row">
            <div class="col-12">
                 <input type="text" name="name" value="{{$subcategory->name}}" class="form-control">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>


</div>

@endsection
