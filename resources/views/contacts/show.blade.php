@extends('contacts.layout')

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Контакт</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('contacts.index') }}"> Назад</a>

            </div>

        </div>

    </div>



    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Имя:</strong>

                {{ $contact->name }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Номер телефона:</strong>

                {{ $contact->phone }}

            </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Группа:</strong>

                {{ $groups[$contact->id_group]}}

            </div>

        </div>

    </div>

@endsection
