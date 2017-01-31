@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Редактировать фильтр</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('filter.save') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">
                            <input type="hidden" name="id" value="{{ $filter->id }}">

                            <div class="form-group{{ $errors->has('mark_id') ? ' has-error' : '' }}">
                                <label for="mark_id" class="col-md-4 control-label">Марка</label>

                                <div class="col-md-6">
                                    <select id="mark_id" class="form-control" name="mark_id" required>
                                        <option disabled selected value>Выберите марку</option>
                                        @foreach($marks as $mark)
                                            <option value="{{ $mark->id }}" {{ $mark->id === $filter->mark->id ? 'selected' : '' }}>{{ $mark->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('mark_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('mark_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('model_id') ? ' has-error' : '' }}">
                                <label for="model_id" class="col-md-4 control-label">Модель</label>

                                <div class="col-md-6">
                                    <input type="hidden" id="selected_model_id" value="{{ $filter->model->id }}" disabled>
                                    <select id="model_id" class="form-control" name="model_id"></select>

                                    @if ($errors->has('model_id'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('model_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Цена</label>

                                <div class="col-md-3">
                                    <input id="price_min" type="text" class="form-control" value="{{ $filter->price_min }}" name="price_min" placeholder="Цена от"/>
                                </div>
                                <div class="col-md-3">
                                    <input id="price_max" type="text" class="form-control" value="{{ $filter->price_max }}" name="price_max" placeholder="Цена до"/>
                                </div>
                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="min_year" class="col-md-4 control-label">Год</label>

                                <div class="col-md-3">
                                    <select id="min_year" class="form-control" name="min_year">
                                        <option disabled selected value>Год от</option>
                                        @foreach($years as $year)
                                            <option value="{{ $year }}" {{ $filter->min_year === $year ? 'selected' : '' }}>{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select id="max_year" class="form-control" name="max_year">
                                        <option disabled selected value>Год до</option>
                                        @foreach($years as $year)
                                            <option value="{{ $year }}" {{ $filter->max_year === $year ? 'selected' : '' }}>{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Сохранить
                                    </button>
                                    <a href="{{ url('/') }}" class="btn btn-danger">
                                        Отмена
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
