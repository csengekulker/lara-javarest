<?php

namespace App\Http\Controllers;
use Validator;
use App\Models\Product;
use App\Http\Resources\Product as ProductResource;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function index() {

        $products = Product::all();

        return $this->sendResponse( ProductResource::collection($products), "saját üzenet");
    }

    public function create( Request $request ) {

        $product = $request->all();

        $validator = Validator::make( $product, [
            "name" => "required",
            "itemNumber" => "required",
            "quantity" => "required",
            "price" => "required"
        ]);

        if($validator->fails()) {
            return $this->sendError( $validator, "HIBA");
        }

        $product = Product::create( $product );

        return $this->sendResponse( new ProductResource($product), "üzenet");
    }

    public function show($id) {

        $product = Product::find($id);

        if (is_null($product)) {
            return $this->sendError("Nincs ilyen termék");
        }

        return $this->sendResponse( new ProductResource($product), "Termék felvéve");
    }

    public function update( Request $request, $id ) {

        $input = $request->all();

        $validator = Validator::make( $input, [
            "name" => "required",
            "itemNumber" => "required",
            "quantity" => "required",
            "price" => "required"
        ]);

        if($validator->fails()) {
            return $this->sendError( $validator, "HIBA");
        }

        $product = Product::find($id);
        $product->update($input);

        return $this->sendResponse(new ProductResource($product), "frissitve");
    }

    public function destroy( $id ) {

        $product = Product::find($id);

        $product->destroy($id);

        return $this->sendResponse([], "törölve");
    }


}
