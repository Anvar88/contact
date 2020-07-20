@extends('contacts.layout')



@section('content')



    <div class="row">

        <div class="col-lg-12 margin-tb" style="margin-top: 30px" >

            <div class="">

                <h1 style="">Список контактов</h1>

            </div>

            <div class="pull-right">

                <a class="btn btn-success" style="position: relative;" href="{{ route('contacts.create') }}"> Добавить контакт</a>
                <a class="btn btn-success" style="position: relative;" href="{{ route('groups.create') }}"> Добавить группу</a>

            </div>

        </div>

    </div>


    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif


    <br>
    <table class="table table-bordered">
        <tr>

            <th>No</th>

            <th>Имя</th>

            <th>Номер телефона</th>
            <th>Группа</th>

            <th width="280px">Действии</th>

        </tr>

        <tr>
        <form action="{{ route('search.store') }}" method="POST">
            <th></th>

            <th><input type="text" name="name" value="" class="form-control" placeholder="Имя контакта"></th>

            <th><input type="text" name="phone" value="" class="form-control" placeholder="Номер телефона"></th>
            <th>
                    <select name="id_group" id="id_group" title="Группа" >
                        <option   value="" >Выберите группу </option>
                        @foreach($groups as $key=>$value)
                            <option  value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
            </th>
             @csrf
            <th width="280px"><button type="submit" class="btn btn-primary">Найти</button></th>
        </form>
        </tr>

        @foreach ($contacts as $contact)

            <tr>

                <td>{{ ++$i }}</td>

                <td>{{ $contact->name }}</td>

                <td>{{ $contact->phone }}</td>
                <td>{{ $groups[$contact->id_group] }}</td>

                <td>

                    <form action="{{ route('contacts.destroy',$contact->id) }}" method="POST">



                        <a class="btn btn-info" style="width: 75px ;font-size: 12px ;" href="{{ route('contacts.show',$contact->id) }}">Показать</a>



                        <a class="btn btn-primary" style="width: 80px ;font-size: 12px"  href="{{ route('contacts.edit',$contact->id) }}">Изменить</a>



                        @csrf

                        @method('DELETE')



                        <button type="submit" style="width: 70px ;font-size: 12px" class="btn btn-danger">Удалить</button>

                    </form>

                </td>

            </tr>

        @endforeach

    </table>



    {!! $contacts->links() !!}



@endsection
