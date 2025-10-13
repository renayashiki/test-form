<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    /**
     * 管理画面一覧
     */
    public function index(Request $request)
    {
        $query = Contact::with('category');

        // --- 検索条件 ---
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', "%{$request->keyword}%")
                    ->orWhere('last_name', 'like', "%{$request->keyword}%")
                    ->orWhere('email', 'like', "%{$request->keyword}%");
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // --- データ取得 ---
        $contacts = $query->orderByDesc('created_at')->paginate(7);

        // --- カテゴリ一覧を取得（←重要） ---
        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    /**
     * 詳細モーダル表示用
     */
    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        return view('admin.show', compact('contact'));
    }

    /**
     * 削除処理
     */
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin.index')->with('success', '削除しました');
    }

    /**
     * CSVエクスポート
     */
    public function export()
    {
        $contacts = Contact::with('category')->get();
        $csv = "ID,名前,性別,メールアドレス,カテゴリ,内容,登録日\n";

        foreach ($contacts as $c) {
            $csv .= "{$c->id},{$c->last_name}{$c->first_name},{$c->gender},{$c->email},{$c->category->content},\"{$c->detail}\",{$c->created_at}\n";
        }

        $filename = "contacts_" . date('Ymd_His') . ".csv";
        return Response::make(rtrim($csv, "\n"), 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }
}
