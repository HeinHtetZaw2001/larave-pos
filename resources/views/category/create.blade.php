@extends('layouts.master')
@section('title','edit-category')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('category.store')}} "  method="post" id="create-form">
                        @csrf
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="col-7">
                                <input class="form-control text-info" name="name"></input>
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
    {!!JsValidator::formRequest('App\Http\Requests\CreateCategory', '#create-form');!!}
<script>
    console.log('ASDSFADF')
</script>
@endsection

