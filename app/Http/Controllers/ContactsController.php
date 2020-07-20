<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contacts;
use App\Groups;
use DB;
class ContactsController extends Controller
{



    public function index(){
        $id = Auth()->user()->id;

        $groups = groups();

        $contacts = Contacts::latest()->where('user_id',$id)->paginate(5);
        return view('contacts.index',compact('contacts','groups'))

            ->with('i', (request()->input('page', 1) - 1) * 5);

    }



    public function create()
    {
        $groups = groups();
        return view('contacts.create',compact('groups'));
    }


    public function store(Request $request){
       $id = Auth()->user()->id;
       $request->validate([

            'name' => 'required',

            'phone' => 'required',

            'id_group' => 'required',

        ]);
        $request['user_id'] = $id;
        Contacts::create($request->all());

        return redirect()->route('contacts.index')
            ->with('success','Контакт успешно добавлен.');


    }


    public function show(Contacts $contact)
    {
        $groups = groups();

         return view('contacts.show',compact('contact','groups'));
    }


    public function edit(Contacts $contact)
    {
        $groups = groups();

        return view('contacts.edit',compact('contact','groups'));
    }


    public function update(Request $request, Contacts $contact)
    {
        $request->validate([

            'name' => 'required',

            'phone' => 'required',

            'id_group' => 'required',

        ]);



        $contact->update($request->all());

            return redirect()->route('contacts.index')

            ->with('success','Контакт успешно изменен');
    }


    public function destroy ($id)
    {
        Contacts::find($id)->delete();
       
        return redirect()->route('contacts.index')

            ->with('success','Контакт успешно удален');
    }

}
