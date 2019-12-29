<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tags = Tag::orderBy('id','desc')
            ->where(function($query) use ($request){
                //获取关键字
                $keyword = $request->input('keyword');
                //检测参数
                if(!empty($keyword)) {
                    $query->where('name','like','%'.$keyword.'%');
                }
            })
            ->paginate($request->input('num', 10));

        //分配变量 解析模板
        return view('admin.tag.index', ['tags'=>$tags,'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags'
        ], [
            'name.required' => '标签名不能为空',
            'name.unique' => '标签名已经存在'
        ]);
        //创建模型
        $tag = new Tag;
        $tag -> name = $request->input('name');
        //插入
        if($tag->save()) {
            return redirect('/tag') -> with('info','添加成功');
        }else{
            return back()->with('info','添加失败');
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
        //读取
        $tag = Tag::findOrFail($id);
        return view('admin.tag.edit', ['tag'=>$tag]);
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
        //创建模型
        $tag = Tag::findOrFail($id);
        //修改对象的属性
        $tag->name = $request->input('name');
        //插入
        if($tag->save()) {
            return redirect('/tag') -> with('info','更新成功');
        }else{
            return back()->with('info','更新失败');
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
        //创建模型
        $tag = Tag::findOrFail($id);
        //删除
        if($tag->delete()) {
            return redirect('/tag') -> with('info','删除成功');
        }else{
            return back()->with('info','删除失败');
        }
    }

    /**
     * 获取标签的内容
     */
    public static function getTags()
    {
        return Tag::orderBy('id','desc')->get();
    }
}
