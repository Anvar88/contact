<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Groups;
class GroupsController extends Controller
{
    public function store(Request $request){

       $request->validate([

            'groups_name' => 'required',


        ]);
        Groups::create($request->all());

        return redirect()->route('groups.create')
            ->with('success','Группа успешно добавлена.');


    }

     public function create()
    {
        $groups = groups();
        return view('groups.create',compact('groups'));
    }

    public function edit(Groups $group)
    {
        $groups = groups();

        return view('groups.edit',compact('group','groups'));
    }


    public function update(Request $request, Groups $group)
    {
        $request->validate([

            'groups_name' => 'required',

        ]);



        $group->update($request->all());

            return redirect()->route('groups.create')

            ->with('success','Группа успешно изменена');
    }


    public function destroy ($id)
    {
        Groups::find($id)->delete();

        return redirect()->route('groups.create')

            ->with('success','Группа успешна удалена');
    }
}
