@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">{{ $product->name }}</div>

                <div class="card-body">
                        <input type="hidden" id="id" name="id" value="{{ $product->id ?? '' }}">
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">@lang('messages.product.name')</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name ?? '' }}" disabled>
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

                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">@lang('messages.product.description')</label>
                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" rows="8" disabled>{{ $product->description ?? '' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tags" class="col-md-2 col-form-label text-md-right">@lang('messages.product.tags')</label>
                            <div class="col-md-6">
                                <input id="tags" type="text" data-role="tagsinput" class="form-control tagsinput-disabled @error('tags') is-invalid @enderror" name="tags" value="{{ $product_tags ?? '' }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start_of_publication" class="col-md-2 col-form-label text-md-right">@lang('messages.product.start_of_publication')</label>
                            <div class="col-md-6">
                                <input id="start_of_publication" type="date" class="date form-control @error('start_of_publication') is-invalid @enderror" name="start_of_publication" value="{{ $product->start_of_publication ?? '' }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="end_of_publication" class="col-md-2 col-form-label text-md-right">@lang('messages.product.end_of_publication')</label>
                            <div class="col-md-6">
                                @yield('create_or_update_name_type')
                                <input id="end_of_publication" type="date" class="date form-control @error('end_of_publication') is-invalid @enderror" name="end_of_publication" value="{{ $product->end_of_publication ?? '' }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">@lang('messages.product.price')</label>
                            <div class="col-md-6">
                                <input id="price" type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price ?? '' }}" disabled>
                            </div>
                        </div>

                        <a href="{{ route('product.edit', $product) }}">
                            <button type="submit" class="btn btn-warning">
                                @lang('messages.edit')
                            </button>
                        </a>
                        <a href="{{ route('product.index') }}">
                            <button type="button" class="btn btn-default btn-close">
                                @lang('messages.products')
                            </button>
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
