<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\Skill;
use App\Models\UserDetail;
use App\Http\Requests\Front\JoinFormRequest;
use App\Jobs\Front\JoinFormJob;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth()->user()->id;

        $data = UserDetail::where('user_id', $userId)->with(['designation'])->first();
        
        if(empty($data)) {
            return redirect()->route('front.user.join.form');
        }

        return view('frontend.user.dashboard', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JoinFormRequest $request)
    {
        $params = $request->all();
        
        dispatch(new JoinFormJob($params));
 
        return redirect()->route('front.user.dashboard')->with('message', 'Record Saved Successfully.')
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $params = $request->except('_token');

        // $this->validate($request, [
        //     'skills' => 'required',
        // ]);

        UserDetail::where('user_id', $id)->update($params);

        return response()->json(['type' => 'success', 'message' => 'Record updated successfully.']);
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

    public function joinForm()
    {
        return view('frontend.user.join_form');
    }
}
