@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body d-flex justify-content-center">
                    <div>
                        <a href="{{ route('product.index') }}">
                            <button type="button" class="btn btn-primary float-left">
                                <span class="glyphicon glyphicon-th-list"></span> @lang('messages.products')
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
