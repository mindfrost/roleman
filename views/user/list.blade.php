@extends('roleman::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Пользователи</div>

                    <div class="panel-body">
                        <table class="table table-hover table-striped">
                            <thead>
                            <th>id</th>
                            <th>Имя</th>
                            <th>Действия</th>
                            </thead>

                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>#{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>
                                        <a href="{{route('edit_user',$user->id)}}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{route('delete_user',$user->id)}}">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>

                                <a style="display:none;" href="{{route('edit_user',0)}}" class="btn btn-success">
                                    <span class="glyphicon glyphicon-open"></span> Создать
                                </a>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
