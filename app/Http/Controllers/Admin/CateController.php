<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CateAddRequest;
use App\Models\Cate;
use DateTime;
use App\Http\Controllers\Controller;
use League\Flysystem\Exception;

class CateController extends Controller
{
    public function getCateAdd()
    {
        $data = Cate::select('id', 'name', 'parent_id')->get()->toArray();
        //print_r($data);
        return view('admin.module.category.add', ['data' => $data]);
    }

    public function postCateAdd(CateAddRequest $request)
    {
        $cate = new Cate();
        $cate->name = $request->input('txtCateName');
        $cate->slug = str_slug($request->input('txtCateName'), '-');
        $cate->parent_id = $request->input('sltCate');
        $cate->created_at = new DateTime();
        $cate->save();
        return redirect()->route('getCateList')->with(['flash_level' => 'result_msg', 'flash_message' => 'Thêm danh mục thành công!']);
    }

    public function getCateList()
    {
        $data = Cate::select('id', 'name', 'parent_id')->get()->toArray();
        return view('admin.module.category.list', ['data' => $data]);
    }

    public function getCateEdit($id)
    {

        $data = Cate::findOrFail($id)->toArray();
        $parent = Cate::select('id', 'name', 'parent_id')->get()->toArray();
//        echo $data['name'];
        return view('admin.module.category.edit', ['data' => $data, 'parent' => $parent]);


    }

    public function postCateEdit($id, CateAddRequest $request)
    {

    }

    public function getCateDelete($id)
    {
        $cate = Cate::find($id);
        if ($cate) {
            $cate->delete();
            return redirect()->route('getCateList')->with(['flash_level' => 'result_msg', 'flash_message' => 'Xóa danh mục thành công!']);
        } else {
            echo '<script type="text/javascript">
            alert("Danh mục không tồn tại. Không thể xóa!");
                  </script>';
            //return redirect()->route('getCateList');
        }

    }
}
