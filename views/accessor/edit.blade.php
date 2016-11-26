@extends('roleman::layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Панель управления</div>

                <div class="panel-body">
                    <h4>#{{$accessor->id}}</h4>
                    <div class="row">


                    {!! Form::model($accessor,array('method'=>'post','route'=>$accessor->id?["store_accessor",$accessor->id]:["store_accessor",-1],'class'=>'form-horizontal','role'=>'form')) !!}
{{--                    {!! Form::hidden('user_id',Request::input('user_id')?Request::input('user_id'):Auth::user()->id) !!}--}}
                    <div class="col-lg-10">
                        <div class="form-group @if ($errors->has('name')) has-error  @endif">
                            {{ Form::label('name', 'Имя :', array('class' => 'control-label col-sm-4')) }}
                            <div class="col-sm-8">
                                {{Form::text('name',  Request::old('name'), ['class' => 'form-control','placeholder'=>'Имя..']) }}
                                {{--            {{ Form::text('name',, ['class' => 'form-control','placeholder'=>'Название компании']) }}--}}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('classname')) has-error  @endif">
                            {{ Form::label('name', 'Класс-обработчик:', array('class' => 'control-label col-sm-4')) }}
                            <div class="col-sm-8">
{{--                                {{Form::text('classname',  Request::old('classname'), ['class' => 'form-control','placeholder'=>'Имя разрешения..']) }}--}}
                                <select class="form-control" name="classname" id="classname" value="{{$accessor->classname}}" >
                                    @foreach($classes as $class)
                                        <option value="{{$class}}" {{($accessor->classname==$class)?"selected":""}}>{{$class}}</option>

                                    @endforeach
                                </select>
                                {{--            {{ Form::text('name',, ['class' => 'form-control','placeholder'=>'Название компании']) }}--}}
                                @if ($errors->has('classname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('classname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                    {{ Form::submit('Сохранить',['class'=>'btn btn-primary btn-md']) }}

                    {!!Form::close()!!}
                    </div>

{{--<h5>Список разрешений использующих accessor:</h5>--}}
                    {{--<table class="table table-hover table-striped">--}}
                        {{--<thead>--}}
                        {{--<th>id</th>--}}
                        {{--<th>Системное имя</th>--}}
                        {{--<th>Отображаемое имя</th>--}}
                        {{--</thead>--}}

                        {{--<tbody>--}}
                        {{--@foreach($accessor->permissions as $permission)--}}
                        {{--<tr>--}}
                            {{--<td>{{$permission->id}}</td>--}}
                            {{--<td>{{$permission->name}}</td>--}}
                            {{--<td>{{$permission->title}}</td>--}}
                        {{--</tr>--}}
                        {{--@endforeach--}}
                        {{--</tbody>--}}
                    {{--</table>--}}



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
