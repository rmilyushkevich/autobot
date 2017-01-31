@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Фильтры
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('filter.new') }}" class="btn btn-primary">Создать фильтр</a>
                            @if (Auth::user()->hasRole('admin'))
                                <a href="{{ route('users') }}" class="btn btn-primary">Пользователи</a>
                            @endif
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Марка</th>
                            <th>Модель</th>
                            <th>Цена от</th>
                            <th>Цена до</th>
                            <th>Год от</th>
                            <th>Год до</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($filters as $filter)
                                <tr>
                                    <td>{{ $filter->mark->name }}</td>
                                    <td>{{ $filter->model->name }}</td>
                                    <td>{{ $filter->price_min }}</td>
                                    <td>{{ $filter->price_max }}</td>
                                    <td>{{ $filter->min_year }}</td>
                                    <td>{{ $filter->max_year }}</td>
                                    <td>
                                        <p>
                                            <a href="{{ route('filter.edit', ['id' => $filter->id]) }}" class="btn btn-success">Редактировать</a>
                                        </p>
                                        <form method="post" action="{{ route('filter.delete', ['id' => $filter->id]) }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="delete">
                                            <button type="submit" class="btn btn-danger">Удалить</button>
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
