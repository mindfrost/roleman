@extends('roleman::layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><span style="font-weight: 600;">Пользователь: </span>{{$user->email}}</div>

                <div class="panel-body">
                  <h5>Роли</h5>

                    <table class="table table-hover table-striped">
                        <thead>
                        <th>id</th>
                        <th>name</th>
                        <th>title</th>
                        </thead>

                        <tbody>
                        @foreach($user->roles as $role)
                        <tr>
                            <td>#{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->title}}</td>
                            <td>
                                {!! Form::open(array('method'=>'post',"route"=>["store_user",$user->id])) !!}
                                {!! Form::hidden('user_id',$user->id) !!}
                                {!! Form::hidden('action','detach') !!}
                                {!! Form::hidden('role',$role->id) !!}

                                {{ Form::submit('Снять',['class'=>'btn btn-danger btn-sm']) }}

                                {!! Form::close() !!}

                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! Form::open(array('method'=>'post',"route"=>["store_user",$user->id])) !!}
                    {!! Form::hidden('user_id',$user->id) !!}
                    {!! Form::hidden('action','attach') !!}
                    <div class="form-group @if ($errors->has('role')) has-error  @endif">
                        <div class="col-sm-4">

                            <select class="form-control" name="role" id="role" >
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->title}}</option>
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
                    {{ Form::submit('Добавить роль',['class'=>'btn btn-primary btn-md']) }}
                    {!! Form::close() !!}

                    <h5>Разрешения</h5>

                    <table class="table table-hover table-striped">
                        <thead>
                        <th>id</th>
                        <th>name</th>
                        <th>title</th>
                        </thead>

                        <tbody>
                        @foreach($user->permissions as $permission)
                            <tr>
                                <td>#{{$permission->id}}</td>
                                <td>{{$permission->name}}</td>
                                <td>{{$permission->title}}</td>

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
