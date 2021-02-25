<?php

namespace App\Http\Controllers\Admin\GoodsType;

use App\Http\Controllers\Controller;
use App\Models\GoodsType;
use Illuminate\Http\Request;

class GoodsTypeController extends Controller
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
            
            $item= GoodsType::skip($page)->take($limit)->orderBy('created_at','desc')->get();
            $total= GoodsType::count();
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
        try {
            $goodsType= $request->title;
            $goodsType = str_replace('，',',',$goodsType);
            $goodsType = explode(',',$goodsType);

            foreach ($goodsType as $value) {
                GoodsType::create([
                    'title'=>$value
                ]);
            }

            return $this->success();

        } catch (\Throwable $th) {
            return $this->failed('物品名称不能重复');
        }
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
        try {
            $data= GoodsType::find($id);
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
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
        try {
            $data= GoodsType::find($id);
            $data->title= $request->title;
            $data->save();
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

    public function goodsTypeStatus(Request $request, $id)
    {
        try {
            $status= 0;
            if($request->status == 0){
                $status= 1;
            }
            GoodsType::where('id',$id)->update([
                'status' => $status
            ]);
            return $this->success();
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
