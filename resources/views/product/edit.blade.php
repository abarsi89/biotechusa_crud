@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">@lang($header_label)</div>

                <div class="card-body">

                    @if ($route === "product.store")
                    <form action="{{ route($route) }}" method="POST" enctype="multipart/form-data">
                    @elseif ($route === "product.update")
                    <form action="{{ route('product.update', $product->id) }}" method="PUT" enctype="multipart/form-data">
                    @endif

                        <input type="hidden" id="id" name="id" value="{{ $product->id ?? '' }}">

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">@lang('messages.product.name')</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name ?? '' }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-2 col-form-label text-md-right">@lang('messages.product.image')</label>
                            <div class="profile-header-container">
                                <div class="profile-header-img">
                                    <img src="/storage/images/{{ $product->image ?? 'open-box.jpg' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            @csrf
                            <div class="form-group">
                                <input type="file" class="form-control-file" name="image" id="imageFile" aria-describedby="fileHelp">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @error('imageFile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">@lang('messages.product.description')</label>

                            <div class="col-md-6">
                                <textarea id="description" type="textarea" class="form-control ckeditor @error('description') is-invalid @enderror" name="description" rows="8" required autofocus>{{ $product->description ?? '' }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tags" class="col-md-2 col-form-label text-md-right">@lang('messages.product.tags')</label>

                            <div class="col-md-6">
                                <input id="tags" type="text" data-role="tagsinput" class="form-control @error('tags') is-invalid @enderror" name="tags" value="{{ $product_tags ?? '' }}" required autofocus>

                                @error('tags')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_of_publication" class="col-md-2 col-form-label text-md-right">@lang('messages.product.start_of_publication')</label>

                            <div class="col-md-6">
                                <input id="start_of_publication" type="date" class="date form-control @error('start_of_publication') is-invalid @enderror" name="start_of_publication" value="{{ $product->start_of_publication ?? '' }}" required autofocus>

                                @error('start_of_publication')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="end_of_publication" class="col-md-2 col-form-label text-md-right">@lang('messages.product.end_of_publication')</label>

                            <div class="col-md-6">
                                <input id="end_of_publication" type="date" class="date form-control @error('end_of_publication') is-invalid @enderror" name="end_of_publication" value="{{ $product->end_of_publication ?? '' }}" required autofocus>

                                @error('end_of_publication')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">@lang('messages.product.price')</label>

                            <div class="col-md-6">
                                <input id="price" type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price ?? '' }}" required autofocus>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">
                            @lang('messages.save')
                        </button>
                        @if ($route === "product.store")
                        <a href="{{ route('product.index') }}">
                        @elseif ($route === "product.update")
                        <a href="{{ route('product.show', $product->id) }}">
                        @endif
                            <button type="button" class="btn btn-default btn-close">
                                @lang('messages.cancel')
                            </button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
