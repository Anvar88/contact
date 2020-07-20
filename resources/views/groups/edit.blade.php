@extends('groups.layout')



@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Редактирование группы</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('groups.create') }}"> Назад</a>

            </div>

        </div>

    </div>



    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Упссс!</strong> Есть некие проблемы с данными.<br><br>

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif



    <form action="{{ route('groups.update',$group->id) }}" method="POST">

        @csrf

        @method('PUT')



        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Название группы:</strong>

                    <input type="text" name="groups_name" value="{{ $group->groups_name }}" class="form-control" placeholder="Название группы">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary">Изменить</button>

            </div>

        </div>



    </form>

@endsection
