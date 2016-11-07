@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <h4>name: {{$user->name}}</h4>
                    {!! Form::open(array('method'=>'post',"url"=>"/user/$user->id")) !!}

                    {!! Form::hidden('user_id',$user->id) !!}
                    <div class="form-group @if ($errors->has('role')) has-error  @endif">
                        {{ Form::label('role', 'Назначить\Снять:', array('class' => 'control-label col-sm-4')) }}
                        <div class="col-sm-8">

                            Назначить: <input   name="action" value="attach" type="radio"> <br>
                           Снять: <input  name="action"  value="detach" type="radio">
                        </div>
                    </div>
                    <div class="form-group @if ($errors->has('role')) has-error  @endif">
                        {{ Form::label('role', 'Роль:', array('class' => 'control-label col-sm-4')) }}
                        <div class="col-sm-8">

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
                    {{ Form::submit('Отправить',['class'=>'btn btn-primary btn-md']) }}
                    {!! Form::close() !!}
                    <table class="table table-hover table-striped">
                        <thead>
                        <th>id</th>
                        <th>name</th>
                        <th>title</th>
                        </thead>

                        <tbody>
                        @foreach($user->roles as $role)
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
