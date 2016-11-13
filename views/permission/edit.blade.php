@extends('roleman::layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Панель управления</div>

                <div class="panel-body">
                    <h4>{{$permission->title}}</h4>
                    <div class="row">


                    {!! Form::model($permission,array('method'=>'post','route'=>$permission->id?["store_permission",$permission->id]:["store_permission",0],'class'=>'form-horizontal','role'=>'form')) !!}
{{--                    {!! Form::hidden('user_id',Request::input('user_id')?Request::input('user_id'):Auth::user()->id) !!}--}}
                    <div class="col-lg-10">
                        <div class="form-group @if ($errors->has('name')) has-error  @endif">
                            {{ Form::label('name', 'Имя разрешения:', array('class' => 'control-label col-sm-4')) }}
                            <div class="col-sm-8">
                                {{Form::text('name',  Request::old('name'), ['class' => 'form-control','placeholder'=>'Имя разрешения..']) }}
                                {{--            {{ Form::text('name',, ['class' => 'form-control','placeholder'=>'Название компании']) }}--}}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('title')) has-error  @endif">
                            {{ Form::label('title', 'Отображаемое имя разрешения:', array('class' => 'control-label col-sm-4')) }}
                            <div class="col-sm-8">
                                {{Form::text('title',  Request::old('title'), ['class' => 'form-control','placeholder'=>'Отображаемое имя разрешения..']) }}
                                {{--            {{ Form::text('name',, ['class' => 'form-control','placeholder'=>'Название компании']) }}--}}
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('description')) has-error  @endif">
                            {{ Form::label('description', 'Описание разрешения:', array('class' => 'control-label col-sm-4')) }}
                            <div class="col-sm-8">
                                {{Form::text('description',  Request::old('description'), ['class' => 'form-control','placeholder'=>'Описание разрешения..']) }}
                                {{--            {{ Form::text('name',, ['class' => 'form-control','placeholder'=>'Название компании']) }}--}}
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{ Form::submit('Сохранить',['class'=>'btn btn-primary btn-md']) }}

                    {!!Form::close()!!}
                    </div>

<h5>Список ролей имеющих разрешение:</h5>
                    <table class="table table-hover table-striped">
                        <thead>
                        <th>id</th>
                        <th>Системное имя</th>
                        <th>Отображаемое имя</th>
                        </thead>

                        <tbody>
                        @foreach($permission->roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->title}}</td>
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
