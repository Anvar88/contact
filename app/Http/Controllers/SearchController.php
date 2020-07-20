<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contacts;
use App\Groups;
use App\Http\ContactsController;
use DB;

class SearchController extends Controller
{
    public function store(Request $request, Contacts $contact){
                $id = Auth()->user()->id;
                $groups = groups();
                $name = $request->name;
                $phone = $request->phone;
                $id_group = $request->id_group;
                $contacts = Contacts::where('name', 'LIKE', "%{$name}%")
                ->where('phone', 'LIKE', "%{$phone}%")
                ->where('id_group', 'LIKE', "%{$id_group}%")
                ->where('user_id',$id)
                ->paginate(5);
            return view('contacts.search',compact('contacts','groups','request'))

                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }



    public function index(Request $request){
        $id = Auth()->user()->id;

        $groups = groups();

        $contacts = Contacts::latest()->where('user_id',$id)->paginate(5);
        return view('contacts.index',compact('contacts','groups','request'))

            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

}


