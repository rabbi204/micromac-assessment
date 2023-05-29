<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BrandController extends Controller
{
    /**
     * show all brand list.
     */
    public function index()
    {
        $brand_data = Brand::latest()->paginate(10);
        return view('backend.brand.index', compact('brand_data'));
    }
    /**
     * store brand data.
     */
    public function addBrand(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands'
        ],[
            'name.required' => 'Brand name is required.',
            'name.unique' => 'Brand name already exists.',
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->entry_date = Carbon::now();
        $brand->save();

        return response()->json([
            'status' => 'success'
        ]);

    }
    /***
     *  Edit brand data
     */
    public function editBrand($id)
    {
        $brand = Brand::findOrFail($id);

        return [
            'id' => $brand->id,
            'name' => $brand->name,
        ];
    }
    /**
     *  update brand data
     */
    public function updateBrand(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:brands,name,' .$id
        ],[
            'name.required' => 'Brand name is required.',
            'name.unique' => 'Brand name already exists.',
        ]);

       $brand_data = Brand::findOrFail($id);
       $brand_data->name = $request->name;
       $brand_data->entry_date = Carbon::now();
       $brand_data->update();

       return response()->json([
           'status' => 'success'
       ]);
    }

    /***
     *  delete brand data
     */
    public function deleteBrand($id)
    {
        Brand::findOrFail($id)->delete();

        return response()->json([
            'status' => 'success',
        ]);
        
    }
}
