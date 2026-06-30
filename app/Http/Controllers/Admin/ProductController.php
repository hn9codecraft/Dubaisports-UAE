<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductSpecification;
use App\Http\Requests\Backend\ProductRequest;
use App\Jobs\Backend\ProductJob;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            
            $where_str = '1 = ?';
            $where_params = [1];

            if ($request->has('sSearch')) {
                $search = $request->get('sSearch');
                $where_str .= " and ( products.title like \"%{$search}%\""
                    . ")";
            }
            
            $data = Product::select('products.id', 'products.title', 'main_image', 'price', 'categories.title as category_title', 'products.status')
                ->leftjoin('categories', 'categories.id', '=', 'products.category_id')
                ->whereRaw($where_str, $where_params);
                
            $data_count = Product::select('products.id')
                ->whereRaw($where_str, $where_params)
                ->leftjoin('categories', 'categories.id', '=', 'products.category_id')
                ->count();

            $columns = ['id', 'title', 'main_image', 'price', 'category_title', 'status'];

            if ($request->has('iDisplayStart') && $request->get('iDisplayLength') != '-1') {
                $data = $data->take($request->get('iDisplayLength'))->skip($request->get('iDisplayStart'));
            }
            if ($request->has('iSortCol_0')) {
                for ($i = 0; $i < $request->get('iSortingCols'); $i++) {
                    $column = $columns[$request->get('iSortCol_' . $i)];
                    if (false !== ($index = strpos($column, ' as '))) {
                        $column = substr($column, 0, $index);
                    }
                    $data = $data->orderBy($column, $request->get('sSortDir_' . $i));
                }
            }

            $data = $data->get();
            
            $response['iTotalDisplayRecords'] = $data_count;
            $response['iTotalRecords'] = $data_count;

            $response['sEcho'] = intval($request->get('sEcho'));

            $response['aaData'] = $data;

            return $response;
        }

        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $params = $request->all();
        
        dispatch(new ProductJob($params));
 
        return redirect()->back()->with('message', 'Record Saved Successfully.')
            ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::find($id);

        $optionAttributes = ProductSpecification::where('product_id', $id)->get()->toArray();

        foreach ($optionAttributes as $key => $optionAttribute) {
            $data['option_'.$optionAttribute['option_id']] = $optionAttribute['option_id'].'_'.$optionAttribute['option_attribute_id'];
        }
        if(!empty($data['other_images'])) {
            $data['other_images'] = json_decode($data['other_images']);
        }
        return view('admin.product.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $params = $request->all();
        
        dispatch(new ProductJob($params));
 
        return redirect()->back()->with('message', 'Record Saved Successfully.')
            ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->get('id');
        
        if(!is_array($id)){
            $id = array($id);
        }
        
        Product::whereIn('id',$id)->delete();

        return redirect()->back()->with('message', 'Record Deleted Successfully.')
            ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function removeOtherImage(Request $request) {
        $params = $request->all();
        
        $data = Product::find($params['productId']);
        
        if($data && $data['other_images']) {
            $images = json_decode($data['other_images'], true);
            unlink(public_path($images[$params['index']]));
            unset($images[$params['index']]);

            Product::where('id', $params['productId'])->update(['other_images' => json_encode($images)]);

            return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Something went wrong.']);
        }
        
    }
}
