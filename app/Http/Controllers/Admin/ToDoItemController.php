<?php

namespace App\Http\Controllers\Admin;

use App\Models\ToDoItem;
use App\Models\ToDoList;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ToDoItemController extends Controller
{
    public function __construct(User $user, ToDoItem $item, ToDoList $itemlist)
    {
        $this->module = "list";
        $this->user = $user;
        $this->data = $item;
        $this->itemlist = $itemlist;
        $this->loginUser = Auth::user();
        $this->middleware('auth');
    }
    public function index()
    {
        $module = $this->module;
        
        $completedData = $this->data->where('user_id', Auth::user()->id)->where('status', '1')->orderBy('id', 'DESC')->with('item_list')->with('user')->paginate(15);
        $IncompletedData = $this->data->where('user_id', Auth::user()->id)->where('status', '0')->orderBy('id', 'DESC')->with('item_list')->with('user')->paginate(15);
       
// dd($allData);
        return view('admin.'.$module.'.index', compact('completedData', 'IncompletedData', 'module'));
    }

    public function get_add()
    {
        $module = $this->module;

        $singleData = new ToDoItem();
        $itemlist = $this->itemlist->where('status', 0)->pluck('name', 'id');

        return view('admin.'.$module.'.add_edit', compact('singleData', 'itemlist', 'module'));
    }

    public function post_add(Request $request)
    {
        $module = $this->module;

        $this->data->fill($request->all());
      
        $this->data->user_id =  Auth::user()->id;
       
        $this->data->save();

        $dataId = $this->data->id;

        $sessionMsg = $this->data->title;
        return redirect('item/'.$dataId.'/view')->with('success', 'Data '.$sessionMsg.' has been created');
    }

    public function get_edit($id)
    {
        $module = $this->module;

        $singleData = $this->data->find($id);
        $itemlist = $this->itemlist->where('status', 0)->pluck('name', 'id');

        return view('admin.'.$module.'.add_edit',compact('singleData', 'itemlist', 'module'));
    }

    public function post_edit(Request $request, $id)
    {
        $module = $this->module;

        $this->data = $this->data->find($id);
       
        $this->data->fill($request->all());
    
        $this->data->save();

        $sessionMsg = $this->data->title;
        return redirect('item/'.$id.'/view')->with('success', 'Data '.$sessionMsg.' has been updated');
    }

    public function get_view($id)
    {
        $module = $this->module;

        $singleData = $this->data->find($id);

        return view('admin.'.$module.'.view',compact('singleData', 'module'));
    }

    public function get_delete($id)
    {
        $module = $this->module;

        if($this->data->where('id', $id)->first()->forceDelete()) {
        
            return redirect()->back()->with('success', 'Your data has been permanently deleted');
        }else {
            return redirect()->back()->with('error', 'Your data has not been permanently deleted.');
        }
    }

    public function updateStatus(Request $request){
    //    dd($request->status);
        $status_item = ToDoItem::where('id', $request->item_id)->update([
            'status' => $request->status
        ]);
          
        return [ 'code' => 0, 'msg' => 'success' ];
       
    }

  
}
