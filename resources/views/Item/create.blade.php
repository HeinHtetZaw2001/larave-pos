@extends('layouts.master')
@section('title','item-create')
@section('extra-css')
    <style>
        .img-preview img{
            width: 400px;
            height: 300px;

        }

    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('item.store')}} "  method="post" id="create-form"  enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="">
                                    <label for="">Dish Name</label>
                                    <input class="form-control text-info" name="name" ></input>
                                </div>
                                <div class="">
                                    <label for="">Category</label>
                                    <select class="form-control" aria-label="Default select example" name="category_id">
                                        <option selected>Open this select menu</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                                <div class="">
                                    <label for="">Price</label>
                                    <input type="number" name="price" class="form-control">
                                </div>
                            <div class="form-group mt-3">
                                <label for="">Upload Profile</label>
                                <input type="file" name='photo' class="form-control p-1 " id="profile_img" multiple >
                                <div class="img-preview mt-3 rounded">
                                </div>
                            </div>
                            <div class="">
                                <button class="btn btn-block btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {!!JsValidator::formRequest('App\Http\Requests\ItemCreate', '#create-form');!!}
    <script>
        $('#profile_img').on('change',function(){
            var file_length=document.getElementById('profile_img').files.length;
            $('.img-preview').html('');
            for(var i=0;i < file_length; i++){
                $('.img-preview').append(`<img  src="${ URL.createObjectURL(event.target.files[i])}"/>`)
            }
        });
    </script>
@endsection

