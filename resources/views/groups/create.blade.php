@extends('groups.layout')



@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Добавить группу :</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('contacts.index') }}"> Назад</a>

            </div>

        </div>

    </div>
     @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif


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



    <form action="{{ route('groups.store') }}" method="POST">

        @csrf



        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Название группы:</strong>

                    <input type="text" name="groups_name" value="" class="form-control" placeholder="Название гркппы">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary">Добавить</button>

            </div>

        </div>



    </form>

    <br>
    <br>
    <br>
     <table class="table table-bordered">

        <tr>

            <th>No</th>

            <th>Название группы</th>

            <th width="280px">Действии</th>

        </tr>
        <input type="hidden" value="{{$i=0}}" /> 
        @foreach ($groups as $key=>$group)

            <tr>

                <td>{{ ++$i }}</td>

                <td>{{ $group }}</td>

                <td>

                    <form action="{{ route('groups.destroy',$key) }}" method="POST">


                        <a class="btn btn-primary" style="width: 80px ;font-size: 12px"  href="{{ route('groups.edit',$key) }}">Изменить</a>



                        @csrf

                        @method('DELETE')



                        <button type="submit" style="width: 70px ;font-size: 12px" class="btn btn-danger">Удалить</button>

                    </form>

                </td>

            </tr>

        @endforeach

    </table>
@endsection
