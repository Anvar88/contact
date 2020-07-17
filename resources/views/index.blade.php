<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
 <script src="{{ asset('js/app.js') }}" defer></script>
<title>Список контактов</title>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<!--[if lt IE 9]>

<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<![endif]-->

</head>

<body>
<div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Выход') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
</div>
<div class="container">

<h1>Список контактов</h1>

<div class='row'>

<button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#addContact">

Добавить контакт

</button>

</div>

<br />

<div class='row @if(count($contacts)!= 0) show @else hidden @endif' id='contacts-wrap'>

<table class="table table-striped ">

<thead>

<tr>

<th>ID</th>

<th>Контакты</th>

<th>Номер телефона</th>

<th>Группа</th>
<th></th>

</tr>

</thead>

<tbody>

@foreach($contacts as $contact)

<tr>

<td>{{ $contact->id }}</td>

<td><a href="{{ route('contacts.show',$contact->id) }}">{{ $contact->name }}</a></td>
<td><a href="{{ route('contacts.show',$contact->id) }}">{{ $contact->phone }}</a></td>
<td><a href="{{ route('contacts.show',$contact->id) }}">{{ $contact->groups_name }}</a></td>
<td><a href="" class="delete" data-href=' {{ route('contacts.destroy',$contact->id) }} '>Удалить</a></td>

</tr>

@endforeach

</tbody>

</table>

</div>

<div class="row">

<!--<div class="alert alert-warning @if($contacts) hidden @else show @endif" role="alert"> Записей нет count($contacts)</div>-->


</div>

</div>

<!-- Modal -->

<div class="modal fade" id="addContact" tabindex="-1" role="dialog" aria-labelledby="addContactLabel">

<div class="modal-dialog" role="document">

<div class="modal-content">

<div class="modal-header">
    <h4 class="modal-title" id="addContactLabel">Добавление контакта</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

<div class="modal-body">
    <div class="form-group">
        <label for="title">Имя</label>
        <input type="text" class="form-control" id="name">
    </div>

</div>

<div class="modal-body">
    <div class="form-group">
        <label for="text">Номер телефона</label>
        <input type="text" class="form-control" id="phone">
    </div>
</div>

<div class="modal-body">
    <div class="form-group">
        <label for="text">Группа</label>
        <p></p>
        <select name="group" id="group" >
        <option value="1">Одноклассники</option>
        <option value="2">Однокурсники</option>
        <option  value="3">Родные</option>
    </select>
    </div>
</div>

<div class="modal-footer">

<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>

<button type="button" id="save" class="btn btn-primary">Сохранить</button>

</div>

</div>

</div>

</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->

<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script>
 $(function() {

    $('#save').on('click',function(){

         var name = $('#name').val();
         var phone = $('#phone').val();
         var group = $('#group').val();
        //alert (name+phone+group);
        $.ajax({

            url: '{{ route('contacts.store') }}',
            type: "POST",
            data: {name:name,phone:phone,group:group},
            headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

             $('#addContact').modal('hide');

             $('#contacts-wrap').removeClass('hidden').addClass('show');

            $('.alert').removeClass('show').addClass('hidden');

            var str = '<tr><td>'+data['id']+

            '</td><td><a href="/contacts/'+data['id']+'">'+data['name']+'</a>'+
            '</td><td><a href="/contacts/'+data['id']+'">'+data['phone']+'</a>'+
            '</td><td><a href="/contacts/'+data['id']+'">'+data['group']+'</a>'+
             '</td><td><a href="" class="delete" data-href=/contacts/'+data['id']+'>Удалить</a></td></tr>';
            $('.table > tbody:last').append(str);

            },
            error:function(msg){
                alert('error');
            }
        });
    });
}) ;

$('body').on('click','.delete',function(e){

e.preventDefault();

var url = $(this).data('href');

var el = $(this).parents('tr');

$.ajax({

url: url,

type: "DELETE",

headers: {

'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

},

success: function (data) {

el.detach();

},

error: function (msg) {

alert('Ошибка');

}

});

});

</script>
</body>

</html>