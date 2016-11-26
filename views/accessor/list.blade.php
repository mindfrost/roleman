@extends('roleman::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Accessors</div>

                    <div class="panel-body">
                        <table class="table table-hover table-striped">
                            <thead>
                            <th>id</th>
                            <th>Имя</th>
                            <th>Имя класса</th>
                            <th>Действия</th>
                            </thead>

                            <tbody>
                            @foreach($accessors as $accessor)
                                <tr>
                                    <td>#{{$accessor->id}}</td>
                                    <td>{{$accessor->name}}</td>
                                    <td>{{$accessor->classname}}</td>
                                    <td>
                                        <a href="{{route('edit_accessor',$accessor->id)}}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{route('delete_accessor',$accessor->id)}}">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>

                                <a href="{{route('edit_accessor',-1)}}" class="btn btn-success">
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
