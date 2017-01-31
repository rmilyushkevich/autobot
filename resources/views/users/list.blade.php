@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Пользователи
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ url('/') }}" class="btn btn-primary">Назад</a>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Номер Telegram</th>
                                <th>Сообщения</th>
                                <th>Тестовое сообщение</th>
                                <th>Удалить</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->number }}</td>
                                    <td>
                                        <p>
                                            <a href="{{ route('user.messages', ['id' => $user->id]) }}" class="btn btn-success">Сообщения</a>
                                        </p>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('message.test', ['id' => $user->id]) }}">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-primary">Отправить тестовое cообщение</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="{{ route('user.delete', ['id' => $user->id]) }}">
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
