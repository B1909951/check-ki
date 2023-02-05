<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Product;
use App\Models\Cart;

use App\Http\Resources\Product as ProductResource;
class ProductController extends Controller
{
    public function index()
    {   
        $products = Product::with('getCart')->get();
        $carts = Cart::all();

        $arr = [
            'status' => true,
            'message' => "Danh sách sản phẩm",
            'data'=> collect($products),

        ];
        return response()->json($arr, 200);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required', 'price' => 'required'
        ]);
        if($validator->fails()){
            $arr = [
                'success' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validator->errors()
            ];
            return response()->errors();

        }
        $product = Product::create($input);
        $arr = [
            'status' => true,
            'message' => "Sản phẩm đã lưu thành công",
            'data' => new ProductResource($product)     
        ];
        return response()->json($arr, 201);
    }
    public function show($id)
    {
        $product = Product::find($id);
        echo 'Nam';
        if (is_null($product)){
            $arr = [
                'status' => false,
                'message' => "Khong tim thay san pham nay",
                'data' => [],
            ];
            return response()->json($arr, 200);
        }
       
        $arr = [
            'status' => true,
            'message' => "Chi tiết sản phẩm ",
            'data' => new ProductResource($product),
        ];
        return response()->json($arr, 201);
    }
    public function update(Request $request,Product $product)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required', 'price' => 'required'
        ]);
        if($validator->fails()){
            $arr = [
                'success' => false,
                'message' => 'Lỗi kiểm tra dữ liệu',
                'data' => $validator->errors()
            ];
            return response()->json($arr, 200);

        }
        $product->name = $input['name'];
        $product->price = $input['price'];
        $product->save();
        $arr = [
            'status' => true,
            'message' => 'Sản phẩm cập nhật thành công',
            'data' => new ProductResource($product)
        ];
        return response()->json($arr, 200);
    }
    public function destroy(Product $product){
        $product->delete();
        $arr = [
           'status' => true,
           'message' =>'Sản phẩm đã được xóa',
           'data' => [],
        ];
        return response()->json($arr, 200);
     }
}
