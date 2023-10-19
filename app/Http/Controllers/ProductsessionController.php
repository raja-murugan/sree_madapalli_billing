<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\Session;
use App\Models\Category;
use App\Models\Productsession;


use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use PDF;

class ProductsessionController extends Controller
{
    public function index()
    {
        $data = Product::where('soft_delete', '!=', 1)->orderBy('id', 'DESC')->get();
        $Productdata = [];
        $terms = [];
        foreach ($data as $key => $datas) {

            $productsessiondata = Productsession::where('product_id', '=', $datas->id)->where('soft_delete', '!=', 1)->get();
            foreach ($productsessiondata as $key => $productsessiondatas) {

                $terms[] = array(
                    'sessionname' => $productsessiondatas->sessionname,
                    'product_id' => $productsessiondatas->product_id,
                    'session_id' => $productsessiondatas->session_id,
                    'id' => $productsessiondatas->id,
                );
            }
            $category_id = Category::findOrFail($datas->category_id);

          

            $Productdata[] = array(
                'id' => $datas->id,
                'product_id' => $datas->id,
                'productname' => $datas->name,
                'productimage' => $datas->image,
                'productprice' => $datas->price,
                'category_name' => $category_id->name,
                'terms' => $terms,
            );
        }
        $session = Session::where('soft_delete', '!=', 1)->get();


        $Product = Product::where('soft_delete', '!=', 1)->get();
        $product_Arr = [];
        foreach ($Product as $key => $Product_arr) {

            $productsession_data = Productsession::where('product_id', '=', $Product_arr->id)->where('soft_delete', '!=', 1)->first();

            if($productsession_data == ''){

                $product_Arr[] = array(
                    'id' => $Product_arr->id,
                    'name' => $Product_arr->name,
                );
            }
        }

        return view('page.backend.productsession.index', compact('Productdata', 'session', 'product_Arr', 'Product'));
    }


    public function store(Request $request)
    {

        if($request->get('session_ids') != ""){

            foreach ($request->get('session_ids') as $key => $session_ids) {
                
                $olddata = Productsession::where('session_id', '=', $session_ids)->where('product_id', '=', $request->get('product_id'))->first();
                if($olddata == ""){

                    $session = Session::findOrFail($session_ids);
                    $product = Product::findOrFail($request->get('product_id'));
                    $category = Category::findOrFail($product->category_id);


                    $Productsession = new Productsession;
                    $Productsession->product_id = $request->get('product_id');
                    $Productsession->session_id = $session_ids;
                    $Productsession->sessionname = $session->name;
                    $Productsession->category_id = $product->category_id;
                    $Productsession->category_name = $category->name;
                    $Productsession->productname = $product->name;
                    $Productsession->productimage = $product->image;
                    $Productsession->productprice = $product->price;
                    $Productsession->save();
                }
    
    
            }

            return redirect()->route('productsession.index')->with('message', 'Added !');

        }
        

       
    }


    public function edit(Request $request, $id)
    {

        $getinsertedP_Products = Productsession::where('product_id', '=', $id)->get();
        $Purchaseproducts = array();
        foreach ($getinsertedP_Products as $key => $getinserted_P_Products) {
            $Purchaseproducts[] = $getinserted_P_Products->id;
        }

        $updatedpurchaseproduct_id = $request->productsession_id;
        $updated_PurchaseProduct_id = array_filter($updatedpurchaseproduct_id);
        $different_ids = array_merge(array_diff($Purchaseproducts, $updated_PurchaseProduct_id), array_diff($updated_PurchaseProduct_id, $Purchaseproducts));

        if (!empty($different_ids)) {
            foreach ($different_ids as $key => $different_id) {
                Productsession::where('id', $different_id)->delete();
            }
        }

        error_reporting(0);
        foreach ($request->get('productsession_id') as $key => $productsession_id) {
            if ($productsession_id > 0) {

                if ($request->session_id[$key] > 0) {

                    $ids = $productsession_id;
                    $product_id = $id;
                    $session_id = $request->session_id[$key];

                    DB::table('productsessions')->where('id', $ids)->update([
                        'session_id' => $session_id
                    ]);
                }

            } else if ($productsession_id == '') {
                if ($request->session_id[$key] > 0) {


                    $olddata = Productsession::where('session_id', '=', $request->session_id[$key])->where('product_id', '=', $id)->first();
                    if($olddata == ""){

                        $session = Session::findOrFail($request->session_id[$key]);
                        $product = Product::findOrFail($id);
                        $category = Category::findOrFail($product->category_id);

                        $Productsession = new Productsession;
                        $Productsession->product_id = $id;
                        $Productsession->session_id = $request->session_id[$key];
                        $Productsession->sessionname = $session->name;
                        $Productsession->category_id = $product->category_id;
                        $Productsession->category_name = $category->name;
                        $Productsession->productname = $product->name;
                        $Productsession->productimage = $product->image;
                        $Productsession->productprice = $product->price;
                        $Productsession->save();
                    }
                }
            }
        }

        return redirect()->route('productsession.index')->with('info', 'Updated !');


        
    }



    public function delete($id)
    {
        $data = Productsession::findOrFail($id);

        $data->soft_delete = 1;

        $data->update();

        return redirect()->route('productsession.index')->with('warning', 'Deleted !');
    }
}
