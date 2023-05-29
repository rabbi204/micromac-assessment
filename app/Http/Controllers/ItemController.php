<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Item;
use App\Models\ModelMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ItemController extends Controller
{
    /**
     *  show all item data
     */
    public function index()
    {
        $item_data = Item::with('brand', 'model')->orderBy('id', 'DESC')->paginate(10);
        // $item_data = Item::latest()->paginate(10);
        $model_data = ModelMenu::all();
        $brand_data = Brand::all();
       return view('backend.item.index', compact('item_data', 'model_data', 'brand_data'));
    }
    /**
     *  get model data when select brand
     */
    public function getModel($id)
    {
        $data = DB::table('model_menus')->where('brand_id', $id)->get();
        // dd($data);
        return response()->json(['data'=>$data]);
    }
    /**
     *  store item data
     */
    public function addItem(Request $request)
    {
        $request->validate([
            'brand_id' => 'required',
            'model_id' => 'required',
            'name' => 'required|unique:items,name'
        ],[
            'name.required' => 'Item name is required.',
            'name.unique' => 'Item name already exists.',
            'brand_id.required' => 'Brand name is required.',
            'model_id.required' => 'Model name is required.',
        ]);

        $item = new Item();
        $item->name = $request->name;
        $item->brand_id = $request->brand_id;
        $item->model_id = $request->model_id;
        $item->entry_date = Carbon::now();
        $item->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
    /**
     *  edit item data
     */
    public function editItem($id)
    {
        $brand_data = Brand::all();
        $item_data = Item::findOrFail($id);
        return view('backend.item.edit_model', compact('brand_data', 'item_data'));
    }
    /**
     *  update item data
     */
    public function updateItem(Request $request, $id)
    {
        $request->validate([
            'brand_id' => 'required',
            'model_id' => 'required',
            'name' => 'required|unique:items,name,'.$id
        ],[
            'name.required' => 'Item name is required.',
            'name.unique' => 'Item name already exists.',
            'brand_id.required' => 'Brand name is required.',
            'model_id.required' => 'Model name is required.',
        ]);

        $item_data = Item::find($id);
        $item_data->brand_id = $request->brand_id;
        $item_data->model_id = $request->model_id;
        $item_data->name = $request->name;
        $item_data->entry_date = Carbon::now();
        $item_data->update();

       return redirect()->route('item.index')->with('success', "Data Updated successfully");
    }
    /**
     *  delete item data
     */
    public function deleteItem($id)
    {
        Item::findOrFail($id)->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
