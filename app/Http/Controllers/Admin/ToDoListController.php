<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ToDoItem;
use App\Models\ToDoList;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ToDoListController extends Controller
{
    public function __construct(ToDoItem $item, ToDoList $itemlist)
    {
        $this->module = "list";
        $this->data = $itemlist;
        $this->item = $item;
        $this->middleware('auth');
    }

    public function index($id = null)
    {
        $module = $this->module;

        $allData = $this->data->orderBy('id', 'DESC')->get();
        // dd($allData);
        if($id) {
            $singleData = $this->data->find($id);
        }else {
            $singleData = new ToDoList();
        }

        return view('admin.'.$module.'.list', compact('allData', 'singleData', 'module'));
    }

    public function post_add(Request $request)
    {
        $module = $this->module;

        $this->data->fill($request->all());
        $this->data->user_id = Auth::user()->id;
        $this->data->save();

        $sessionMsg = $this->data->name;
        return redirect('items/list')->with('success', 'Data '.$sessionMsg.' has been created');
    }

    public function post_edit(Request $request, $id)
    {
        $module = $this->module;

        $this->data = $this->data->find($id);
        $this->data->fill($request->all());
    
        $this->data->save();

        $sessionMsg = $this->data->name;
        return redirect('items/list')->with('success', 'Data '.$sessionMsg.' has been updated');
    }

    public function get_delete($id)
    {
        $module = $this->module;

        $listData = $this->item->where('list_id', $id)->get();
        if(count($listData)>0) {
            return redirect('items/list')->with('error', 'Please delete corresponding data before delete the category');
        }else {
            $this->data->find($id)->delete();
            return redirect('items/list')->with('success', 'Your data has been deleted successfully.');       }
    }
}
