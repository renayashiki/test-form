<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Maatwebsite\Excel\Facades\Excel; // 【重要】エクスポート機能で必要
use App\Exports\ContactsExport;      // 【重要】エクスポートクラスのインポート

class AdminController extends Controller
{
    /**
     * 検索クエリを構築するプライベートメソッド
     * index() と export() の両方で検索条件のロジックを共有するために使用します。
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function buildQuery(Request $request)
    {
        // CategoryリレーションをEager Loadする
        $query = Contact::with('category');

        // --- 検索条件 ---

        // 1. キーワード検索（名前またはメールアドレスの部分一致）
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', "%{$request->keyword}%")
                    ->orWhere('last_name', 'like', "%{$request->keyword}%")
                    ->orWhere('email', 'like', "%{$request->keyword}%");
            });
        }

        // 2. 性別検索
        if ($request->filled('gender') && $request->gender != '') {
            $query->where('gender', $request->gender);
        }

        // 3. お問い合わせ種類検索
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 4. 特定日付検索（元のロジックを維持）
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // 登録日の降順でソート
        $query->orderByDesc('created_at');

        return $query;
    }

    /**
     * 管理画面一覧 (検索条件保持と7件表示)
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        // buildQueryメソッドを使用して検索クエリを取得
        $query = $this->buildQuery($request);

        // 7件表示、検索条件をページネーションリンクに付与
        $contacts = $query->paginate(7)->appends($request->query());

        return view('admin.index', compact('contacts', 'categories'));
    }

    /**
     * 削除処理 (CRUD)
     */
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        // 削除後、一覧画面にリダイレクト
        return redirect()->route('admin.index')->with('success', 'お問い合わせを削除しました。');
    }

    /**
     * お問い合わせデータをCSV形式でエクスポートする。
     * 絞り込み検索の結果をエクスポートする。
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(Request $request)
    {
        // indexと同じく、絞り込み条件を適用したクエリを取得
        $query = $this->buildQuery($request);

        // ファイル名を定義 (例: contacts_20251014.csv)
        $fileName = 'contacts_' . now()->format('Ymd') . '.csv';

        // Excelファサードのdownloadメソッドを使用してCSVを生成し、ダウンロードさせる
        return Excel::download(new ContactsExport($query), $fileName);
    }
}
