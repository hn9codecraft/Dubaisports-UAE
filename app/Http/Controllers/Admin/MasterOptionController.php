<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterOption;
use App\Models\MasterOptionAttribute;
use App\Http\Requests\Backend\MasterOptionRequest;
use App\Jobs\Backend\MasterOptionJob;

class MasterOptionController extends Controller
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
                $where_str .= " and ( name like \"%{$search}%\""
                    . ")";
            }
            
            $data = MasterOption::select('id', 'name', 'status', 'sort')
                ->whereRaw($where_str, $where_params);
                
            $data_count = MasterOption::select('id')
                ->whereRaw($where_str, $where_params)
                ->count();

            $columns = ['id', 'name', 'status', 'sort'];

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

        return view('admin.master_option.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributes = [];
        return view('admin.master_option.create', compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MasterOptionRequest $request)
    {
        $params = $request->all();
        
        dispatch(new MasterOptionJob($params));
 
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
        $data = MasterOption::find($id);

        $masterOptionAttributes = MasterOptionAttribute::where('master_option_id', $id)->get()->toArray();
        
        $attributes = [];
		if ($masterOptionAttributes) {
			foreach ($masterOptionAttributes as $key => $masterOptionAttribute) {
				$temp_attribute['master_option_attribute_id'] = $masterOptionAttribute['id'];
				$temp_attribute['value'] = $masterOptionAttribute['value'];
				$attributes[] = $temp_attribute;
			}
        }
        
        return view('admin.master_option.edit', compact('data', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MasterOptionRequest $request, $id)
    {
        $params = $request->all();
        
        dispatch(new MasterOptionJob($params));
 
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
        
        MasterOption::whereIn('id',$id)->delete();

        return redirect()->back()->with('message', 'Record Deleted Successfully.')
            ->with('type', 'success');
    }
}
