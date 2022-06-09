@extends('layouts.master')
@section('title','edit-category')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('category.update',$category->id)}} "  method="post" id="edit-form">
                            @csrf
                            @method('PUT')
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="col-7">
                                    <input class="form-control text-info" name="name" value="{{$category->name}}"></input>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-outline-info">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {!!JsValidator::formRequest('App\Http\Requests\EditCategory', '#edit-form');!!}
    <script>
        console.log('ASDSFADF')
    </script>
@endsection

