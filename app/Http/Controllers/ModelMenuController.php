<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\ModelMenu;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ModelMenuController extends Controller
{
    /**
     *  show all Model list
     */
    public function index()
    {
        $model_data = ModelMenu::with('brand')->orderBy('id', 'DESC')->paginate(10);
        $brand_data = Brand::all();
        return view('backend.model_menu.index', compact('model_data', 'brand_data'));
    }
    /**
     *  store model in database
     */
    public function addModel(Request $request)
    {
        $request->validate([
            'brand_id' => 'required',
            'name' => 'required|unique:model_menus'
        ],[
            'name.required' => 'Model name is required.',
            'name.unique' => 'Model name already exists.',
            'brand_id.required' => 'Brand name is required.',
        ]);

        $model = new ModelMenu();
        $model->name = $request->name;
        $model->brand_id = $request->brand_id;
        $model->entry_date = Carbon::now();
        $model->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
    /**
     *  edit model data
     */
    public function editModel($id)
    {
        $brand_data = Brand::all();
        $model_data = ModelMenu::findOrFail($id);
        return view('backend.model_menu.edit_model', compact('brand_data', 'model_data'));
    }
    /***
     *  update model data
     */
    public function updateModel(Request $request, $id)
    {
        $request->validate([
            'brand_id' => 'required',
            'name' => 'required|unique:model_menus,name,'.$id
        ],[
            'name.required' => 'Model name is required.',
            'name.unique' => 'Model name already exists.',
            'brand_id.required' => 'Brand name is required.',
        ]);

        $model_data = ModelMenu::find($id);
        $model_data->brand_id = $request->brand_id;
        $model_data->name = $request->name;
        $model_data->entry_date = Carbon::now();
        $model_data->update();

       return redirect()->route('model.index')->with('success', "Data Updated");
    }
    /***
     *  delete model data
     */
    public function deleteModel($id)
    {
        ModelMenu::findOrFail($id)->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }

}
