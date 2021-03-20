<?php

namespace App\Http\Controllers\Admin\RealName;

use App\Http\Controllers\Controller;
use App\Models\RealName;
use Illuminate\Http\Request;

class RealNameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        try {
            $all= $request->all(); 
            $limit = $all['limit'];
            $page = ($all['page'] -1)*$limit;
            
            $item= RealName::skip($page)->take($limit)->with(['userInfo'=>function($query){
                $query->select('id', 'nickname'); // 需要同时查询关联外键的字段
            }])->orderBy('created_at','desc')->get();
            $total= RealName::count();
            $data['item'] = $item;
            $data['total'] = $total;
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
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
    public function store(Request $request)
    {
        //
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
    {  return $this->success($request->all());
        try {
            if($request->status == 2){
                $status= 1;
            }else{
                $status= 2;
            }
            RealName::where('id',$id)->update([
                'status'=>$status
            ]);
            return $this->success();
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
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
}
