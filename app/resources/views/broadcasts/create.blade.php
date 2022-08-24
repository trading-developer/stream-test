@extends('layouts.main')
@section('content')
    <form method="post" action="{{ route('broadcast.create') }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

        <h1 class="h3 mb-3 fw-normal">Добавить стрим</h1>

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                   placeholder="" required="required" autofocus>
            <label for="">Название</label>
        @if ($errors->has('name'))
                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="description" value="{{ old('description') }}" placeholder="Имя"
                   required="required" autofocus>
            <label for="">Описание</label>
            @if ($errors->has('description'))
                <span class="text-danger text-left">{{ $errors->first('description') }}</span>
            @endif
        </div>

        <div class="form-group mb-3">
            <label for="">Превьюшка</label>
            <input type="file" class="form-control" name="preview"
                   required="required">
            @if ($errors->has('preview'))
                <span class="text-danger text-left">{{ $errors->first('preview') }}</span>
            @endif
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Добавить</button>
    </form>
@endsection
