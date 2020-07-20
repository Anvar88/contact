@extends('contacts.layout')



@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Редактирование контакта</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('contacts.index') }}"> Назад</a>

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



    <form action="{{ route('contacts.update',$contact->id) }}" method="POST">

        @csrf

        @method('PUT')



        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Имя:</strong>

                    <input type="text" name="name" value="{{ $contact->name }}" class="form-control" placeholder="Имя">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Номер телефона :</strong>

                    <input type="text" name="phone" value="{{ $contact->phone }}" class="form-control" placeholder="Номер телефона">

                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Группа :</strong>

                    <select name="id_group" id="id_group" >
                        <option disabled="disabled" >Выберите группу </option>
                        @foreach($groups as $key=>$value)
                            <option {{ $contact->id_group == $key ? "selected=selected" : "" }}  value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>

                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary">Изменить</button>

            </div>

        </div>



    </form>

@endsection
