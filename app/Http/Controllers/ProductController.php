<?php

namespace App\Http\Controllers;

use Response;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $result = Product::all(array('*'));

         $response = array(
              'error' => false,
              'status' => 1,
              'message' => 'Products List',
              'result' =>  $result,
              'messageCode' => 101
      );
      return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = \Validator::make($request->all(), [
            'sku' => 'required|integer|unique:products',
            'name' => 'required|string|max:500',
            'description' => 'required|string|max:1000',
            'price' => 'required|integer',
            'quantity' => 'required|integer'
          ]);

        if($validator->fails()){
          $response = array(
                'error'  => true,
    			'status' => 0,
    			'message'=>'Error',
                'result' => $validator->errors(),
                'messagecode'=>100
          );
            return response()->json($response);
        }

        $product = new Product;
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price =  $request->price;
        $product->quantity = $request->quantity;
        if($product->save()){

            $response = array(
                'error'  => false,
    			'status' => 1,
    			'message'=>'Product saved Successfully.',
                'result' => $product,
                'messagecode'=>101
        );
        return response()->json($response);
         
        }
        else {

              $response = array(
                'error'  => true,
    			'status' => 2,
    			'message'=>'Something is wrong',
                'result' => '',
                'messagecode'=>102
              );
              
              return response()->json($response);
        }


    }

      /**
     * Display the specified resource.
     *
     * @param  \App\Product  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $product = Product::find($id);

      if ($product != null){

         $response = array(
                'error'  => false,
    			'status' => 1,
    			'message'=>'Product Detail',
                'result' => $product,
                'messagecode'=>101
               );
               return response()->json($response);
         }
            else {
              $response = array(
                'error'  => true,
    			'status' => 2,
    			'message'=>'Product is not Found ',
                'result' => '',
                'messagecode'=>102
               );
              
              return response()->json($response);
        }
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
          $validator = \Validator::make($request->all(), [
            'id' => 'required|integer',
            'sku' => 'required|integer',
            'name' => 'required|string|max:500',
            'description' => 'required|string|max:1000',
            'price' => 'required|integer',
            'quantity' => 'required|integer'
          ]);

        if($validator->fails()){
          $response = array(
                'error'  => true,
    			'status' => 0,
    			'message'=>'Error',
                'result' => $validator->errors(),
                'messagecode'=>100
          );
            return response()->json($response);
        }

        $product = Product::findorNew($request->id);
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price =  $request->price;
        $product->quantity = $request->quantity;
        if($product->save()){
           $response = array(
                'error'  => false,
    			'status' => 1,
    			'message'=>'Product Update Successfully.',
                'result' => $product,
                'messagecode'=>101
           );
        return response()->json($response);
         
        }
        else {

              $response = array(
                'error'  => true,
    			'status' => 2,
    			'message'=>'Something is wrong',
                'result' => '',
                'messagecode'=>102
              );
              
              return response()->json($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required|integer'
          ]);

        if($validator->fails()){
          $response = array(
                'error'  => true,
    			'status' => 0,
    			'message'=>'Error',
                'result' => $validator->errors(),
                'messagecode'=>100
          );
            return response()->json($response);
        }

        $product = Product::where('id',$request->id)->first();

        if ($product != null){
             
            if($product->delete()){
              $response = array(
                'error'  => false,
    			'status' => 1,
    			'message'=>'Product Delete Successfully.',
                'result' => "",
                'messagecode'=>101
               );
               return response()->json($response);
              }
               else {

               $response = array(
                'error'  => true,
    			'status' => 2,
    			'message'=>'Product is not Found ',
                'result' => '',
                'messagecode'=>102
             );
              return response()->json($response);
             }

           }
            else {
              $response = array(
                'error'  => true,
    			'status' => 2,
    			'message'=>'Product is not Found ',
                'result' => '',
                'messagecode'=>102
               );
              
              return response()->json($response);
        }


    }
}
