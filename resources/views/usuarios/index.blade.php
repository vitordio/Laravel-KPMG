@extends('layouts.main')

@section('title', trans('titles.usuarios'))

@section('content')
    <div class="card">
        <div class="card-body">
            @include('usuarios._breadcrumbs')
            @include('usuarios.' . $options['viewName'])
        </div>
    </div>
@endsection
