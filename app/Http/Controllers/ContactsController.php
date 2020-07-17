<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contacts;
use DB;
class ContactsController extends Controller
{

    public function index(){
        $id = Auth()->user()->id;
        $check = DB::table('contacts')->where('user_id',$id)->first();
        if(!$check){
              $contacts = array();
        }elseif($check){
              $contacts = DB::table('contacts')
            ->join('users', 'contacts.user_id', '=', 'users.id')
            ->join('groups', 'contacts.id_group', '=', 'groups.id')
            ->select('users.name', 'contacts.*', 'groups.groups_name')->where('contacts.user_id',$id)
            ->get();
        }


        return view('index',['contacts' => $contacts]);

    }

    public function store(Request $request){
         $id = Auth()->user()->id;
         $result = Contacts::create(['name' => $request['name'], 'phone' => $request['phone'],'user_id'=>$id,'id_group' => $request['group']]);
         $groups_name = DB::table('groups')->where('id',$request['group'])->first();
         $data = ['id' => $result->id, 'name' => $request['name'], 'phone' => $request['phone'],'group' => $groups_name->groups_name];
         //$data = array();
         return $data;

    }
    public function show($id)
    {
        $contact = Contacts::find($id);

        return view('show',['contact' => $contact]);
    }
    public function destroy ($id)
    {
        Contacts::find($id)->delete();
        return $id;
    }

}
