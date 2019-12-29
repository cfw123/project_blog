<?php

namespace App\Http\Controllers;

use App\Cate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatesController extends Controller
{
    /**
     *显示分类列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //读取分类
        $cates = self::getCates();

        //解析模板
        return  view('admin.cate.index', ['cates'=>$cates, 'request'=>$request]);

    }

    /**
     * 获取所有的分类信息 并排序
     */
    public static function getCates()
    {
        $cates = Cate::select(DB::raw('*, concat(path,",",id) as paths'))->orderBy('paths')->get();

        //遍历数组 调整分类的名称  laravel   =====>  |-------laravel
        foreach ($cates as $key => $value) {
            //判断当前的分类是几级分类
            $tmp = count(explode(',', $value->path)) - 1;
//            var_dump($tmp);
            $prefix = str_repeat('|-------', $tmp);
            $value->name = $prefix . $value->name;
        }

        return $cates;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //读取所有分类
        $cates = Cate::get();
        return view('admin.cate.add', ['cates'=>$cates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        //如果要添加的是顶级分类  pid 和path都是0
        if($data['pid'] == 0 ){
            $data['path'] = '0';
        }else{//如果不是顶级分类
            //读取父级分类的信息
            $info = Cate::find($data['pid']);
            $data['path'] = $info->path.','.$info->id;
        }
        //创建模型
        $cate = new Cate;
        $cate->name = $data['name'];
        $cate->pid = $data['pid'];
        $cate->path = $data['path'];
        //
        if($cate->save()) {
            return redirect('/cate')->with('info', '分类添加成功');
        }else{
            return back()->with('info','分类添加失败');
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
        //读取当前分类的信息
        $info = Cate::findOrFail($id);//
        //读取
        $cates = Cate::get();
        //解析模板
        return view('admin.cate.edit', ['info'=>$info,'cates'=>$cates]);
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
        //
        $cate = Cate::findOrFail($id);
        $cate->name = $request->name;
        $cate->pid = $request->pid;

        if($cate->save()){
            return redirect('/cate')->with('info', '分类更新成功');
        }else{
            return back()->with('info', '分类更新失败');
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

        //删除分类
        $cate = Cate::findOrFail($id);
        //删除子集分类
        $path = $cate->path . ','.$cate->id;
        DB::table('cates')->where('path','like',$path.'%')->delete();
        if($cate->delete()) {
            return back()->with('info','删除成功');
        }else{
            return back()->with('info','删除失败');
        }
    }
}
