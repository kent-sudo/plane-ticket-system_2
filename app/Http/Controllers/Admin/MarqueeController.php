<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Marquee;
use Illuminate\Support\Facades\DB;
class MarqueeController extends Controller
{
    public function index()
    {
        $marquees = Marquee::all();
        return view('admin.marquee',compact('marquees'));
    }
    public function edit($id)
    {
        $marquee = Marquee::findOrFail($id);
        return view('admin.marquee_edit', compact('marquee'));
    }
    public function updata(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $marquee = Marquee::findOrFail($id);
            $marquee->content = $request->input('content');
            $marquee->show = $request->input('show');
            $marquee->save();
            DB::commit();
            return redirect()->route('admin.marquee') ->with('success', '上傳成功');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.marquee') ->with('error', '上傳失敗');
        }
    }

    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $marquee = new Marquee();
            $marquee->content = $request->input('content');
            $marquee->show = $request->input('show');
            $marquee->save();
            DB::commit();
            return redirect()->route('admin.marquee') ->with('success', '上傳成功');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.marquee') ->with('error', '上傳失敗');
        }
    }
}
