@extends('roleman::layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Панель управления</div>

                <div class="panel-body">
                    <h4>{{$role->title}}</h4>
                    <div class="row">


                    {!! Form::model($role,array('method'=>'post','route'=>$role->id?["store_role",$role->id]:["store_role",0],'class'=>'form-horizontal','role'=>'form')) !!}
{{--                    {!! Form::hidden('user_id',Request::input('user_id')?Request::input('user_id'):Auth::user()->id) !!}--}}
                    <div class="col-lg-10">
                        <div class="form-group @if ($errors->has('name')) has-error  @endif">
                            {{ Form::label('name', 'Имя роли:', array('class' => 'control-label col-sm-4')) }}
                            <div class="col-sm-8">
                                {{Form::text('name',  Request::old('name'), ['class' => 'form-control','placeholder'=>'Имя роли..']) }}
                                {{--            {{ Form::text('name',, ['class' => 'form-control','placeholder'=>'Название компании']) }}--}}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('title')) has-error  @endif">
                            {{ Form::label('title', 'Отображаемое имя роли:', array('class' => 'control-label col-sm-4')) }}
                            <div class="col-sm-8">
                                {{Form::text('title',  Request::old('title'), ['class' => 'form-control','placeholder'=>'Отображаемое имя роли..']) }}
                                {{--            {{ Form::text('name',, ['class' => 'form-control','placeholder'=>'Название компании']) }}--}}
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('description')) has-error  @endif">
                            {{ Form::label('description', 'Описание роли:', array('class' => 'control-label col-sm-4')) }}
                            <div class="col-sm-8">
                                {{Form::text('description',  Request::old('description'), ['class' => 'form-control','placeholder'=>'Описание роли..']) }}
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
                    <div class="add-permission-form" style="display: none;">
                        {!! Form::open(array('method'=>'post',"url"=>"/user/$role->id")) !!}

                        {!! Form::hidden('user_id',$role->id) !!}
                        <div class="form-group @if ($errors->has('role')) has-error  @endif">
                            {{ Form::label('role', 'Назначить\Снять:', array('class' => 'control-label col-sm-4')) }}
                            <div class="col-sm-8">

                                Назначить: <input   name="action" value="attach" type="radio"> <br>
                                Снять: <input  name="action"  value="detach" type="radio">
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('role')) has-error  @endif">
                            {{ Form::label('role', 'Разрешение:', array('class' => 'control-label col-sm-4')) }}
                            <div class="col-sm-8">

                                <select class="form-control" name="role" id="role" >
                                    @foreach($permissions as $permission)
                                        <option value="{{$permission->id}}">{{$permission->title}}</option>
                                    @endforeach
                                </select>
                                {{--            {{ Form::text('name',, ['class' => 'form-control','placeholder'=>'Название компании']) }}--}}
                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{ Form::submit('Отправить',['class'=>'btn btn-primary btn-md']) }}
                        {!! Form::close() !!}
                    </div>
<h5>Список разрешений роли:</h5>
                    <table class="table table-hover table-striped">
                        <thead>
                        <th>id</th>
                        <th>Системное имя</th>
                        <th>Отображаемое имя</th>
                        </thead>

                        <tbody>
                        @foreach($role->permissions as $permission)
                        <tr>
                            <td>{{$permission->id}}</td>
                            <td>{{$permission->name}}</td>
                            <td>{{$permission->title}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! Form::open(array('method'=>'post',"route"=>["edit_role_permissions",$role->id])) !!}
                    {!! Form::hidden('role_id',$role->id) !!}
                    {!! Form::hidden('action','attach') !!}
                    <div class="form-group @if ($errors->has('permission')) has-error  @endif">
                        <div class="col-sm-4">

                            <select class="form-control" name="permission" id="permission" >
                                @foreach($permissions as $permission)
                                    <option value="{{$permission->id}}">{{$permission->title}}</option>
                                @endforeach
                            </select>
                            {{--            {{ Form::text('name',, ['class' => 'form-control','placeholder'=>'Название компании']) }}--}}
                            @if ($errors->has('permission'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('permission') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    {{ Form::submit('Добавить разрешение',['class'=>'btn btn-primary btn-md']) }}
                    {!! Form::close() !!}


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
