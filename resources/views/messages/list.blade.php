@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Сообщения
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ url('/users') }}" class="btn btn-primary">Назад</a>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Сообщения</th>
                                <th>Дата</th></tr>
                            </thead>
                            <tbody>
                            @foreach($messages as $message)
                                <tr>
                                    <td>{{ $message->id }}</td>
                                    <td>{{ $message->message }}</td>
                                    <td>{{ $message->created_at }}</td>
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
