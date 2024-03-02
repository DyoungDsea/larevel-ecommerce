<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function AllBrand()
    {
        $brands = Brand::latest()->get();
        return view('admin.brand.all_brand', compact('brands'));
    }
    public function AddBrand()
    {
        return view('admin.brand.add_brand');
    }

    public function StoreBrand(Request $request)
    {

        $image = $request->file('brand_image');
        $filename =  hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/brand/' . $filename);
        $image_url = 'upload/brand/' . $filename;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ','-', $request->brand_name)), 
            'brand_image' => $image_url, 
        ]);

        $notification = array([
            'alert-type' => 'success',
            'message' => 'Brand inserted successfully.'
        ]);


        return redirect()->route('all.brand')->with($notification);
    }


    public function EditBrand($id){
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit_brand', compact('brand'));
    }
}
