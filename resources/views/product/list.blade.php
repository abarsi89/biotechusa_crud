@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>@lang('messages.products')</div>
                    <div>
                        <a href="{{ route('product.create') }}">
                            <button type="button" class="btn btn-success float-left">
                                <span class="glyphicon glyphicon-plus"></span> @lang('messages.create')
                            </button>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">@lang('messages.product.name')</th>
                            <th scope="col">@lang('messages.product.start_of_publication')</th>
                            <th scope="col">@lang('messages.product.end_of_publication')</th>
                            <th scope="col">@lang('messages.product.price')</th>
                            <th scope="col">@lang('messages.actions')</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td><a href="{{ route('product.show', $product->id) }}" title="@lang('messages.detail')">{{ $product->name }}</a></td>
                                    <td>{{ $product->start_of_publication }}</td>
                                    <td>{{ $product->end_of_publication }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        <a href="{{ route('product.edit', $product->id) }}">
                                            <button type="button" data-toggle="tooltip" title="@lang('messages.edit')" class="btn btn-warning float-left">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </button>
                                        </a>
                                        <form action="{{ route('product.destroy', $product) }}" method="POST" class="float-left">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" data-toggle="tooltip" title="@lang('messages.delete')"  class="btn btn-danger">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
