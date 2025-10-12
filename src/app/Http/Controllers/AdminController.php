<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query()->with('category');

        // 検索入力取得
        $name = $request->input('name');
        $email = $request->input('email');
        $gender = $request->input('gender');
        $category = $request->input('category_id');
        $from = $request->input('from_date');
        $to = $request->input('to_date');
        $match_type = $request->input('match_type', 'partial'); // partial | exact

        // 名前検索（姓、名、フルネームに対応）
        if ($name !== null && $name !== '') {
            if ($match_type === 'exact') {
                $query->whereRaw("CONCAT(last_name, ' ', first_name) = ?", [$name])
                    ->orWhere('last_name', $name)
                    ->orWhere('first_name', $name);
            } else {
                $query->where(function ($q) use ($name) {
                    $q->where('last_name', 'like', "%{$name}%")
                        ->orWhere('first_name', 'like', "%{$name}%")
                        ->orWhereRaw("CONCAT(last_name, ' ', first_name) like ?", ["%{$name}%"]);
                });
            }
        }

        if ($email !== null && $email !== '') {
            if ($match_type === 'exact') $query->where('email', $email);
            else $query->where('email', 'like', "%{$email}%");
        }

        if ($gender && $gender !== 'all') {
            $query->where('gender', $gender);
        }

        if ($category && $category !== 'all') {
            $query->where('category_id', $category);
        }

        if ($from) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to) {
            $query->whereDate('created_at', '<=', $to);
        }

        $contacts = $query->orderBy('created_at', 'desc')->paginate(7)->withQueryString();
        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function show(Contact $contact)
    {
        return view('admin.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.index')->with('status', '削除しました');
    }

    // CSV Export（フィルタした結果をエクスポート）
    public function export(Request $request)
    {
        // 同様のフィルタを適用（重複コードだが簡潔のため）
        $query = Contact::with('category');

        // Apply same filters as index (コピー略。実際は共通化するのがよい)
        if ($name = $request->input('name')) {
            $query->where(function ($q) use ($name) {
                $q->where('last_name', 'like', "%{$name}%")
                    ->orWhere('first_name', 'like', "%{$name}%")
                    ->orWhereRaw("CONCAT(last_name, ' ', first_name) like ?", ["%{$name}%"]);
            });
        }
        if ($email = $request->input('email')) {
            $query->where('email', 'like', "%{$email}%");
        }
        if ($gender = $request->input('gender') && $request->input('gender') !== 'all') {
            $query->where('gender', $request->input('gender'));
        }
        if ($category = $request->input('category_id') && $request->input('category_id') !== 'all') {
            $query->where('category_id', $request->input('category_id'));
        }
        if ($from = $request->input('from_date')) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to = $request->input('to_date')) {
            $query->whereDate('created_at', '<=', $to);
        }

        $fileName = 'contacts_export_' . now()->format('YmdHis') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
        ];

        $columns = ['ID', '姓', '名', '性別', 'メール', '電話', '住所', 'カテゴリー', '内容', '作成日'];

        $callback = function () use ($query, $columns) {
            $file = fopen('php://output', 'w');
            // BOM (Excelで文字化け防止)
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($file, $columns);
            $query->orderBy('created_at', 'desc')->chunk(100, function ($rows) use ($file) {
                foreach ($rows as $row) {
                    $genderText = match ($row->gender) {
                        1 => '男性',
                        2 => '女性',
                        3 => 'その他',
                        default => '',
                    };
                    fputcsv($file, [
                        $row->id,
                        $row->last_name,
                        $row->first_name,
                        $genderText,
                        $row->email,
                        $row->tel,
                        $row->address,
                        $row->category->name ?? '',
                        $row->body,
                        $row->created_at,
                    ]);
                }
            });
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
