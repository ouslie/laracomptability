@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.base.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.accounts.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('global.base.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($base) ? $base->name : '') }}">
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.base.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('global.base.fields.description') }}</label>
                <textarea id="description" name="description" class="form-control ">{{ old('description', isset($base) ? $base->description : '') }}</textarea>
                @if($errors->has('description'))
                    <em class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.base.fields.description_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                <label for="price">{{ trans('global.base.fields.price') }}</label>
                <input type="number" id="price" name="price" class="form-control" value="{{ old('price', isset($base) ? $base->price : '') }}" step="0.01">
                @if($errors->has('price'))
                    <em class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.base.fields.price_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection
