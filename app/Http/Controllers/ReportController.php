<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReportRequest;

use App\Models\Menu;
use App\Models\User;
use App\Models\Category;
use App\Models\Report;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class ReportController extends Controller
{
    public function create(Menu $menu)
    {
        if ($menu->user_id !== Auth::id()) {
            $categories = Category::all();
            return view('reports.create')->with(['menu' => $menu, 'categories' => $categories]);
        }
        return redirect()->route('show', ['menu' => $menu->id]);
    }
    public function store(ReportRequest $request, Menu $menu, Report $report,)
    {
        //reportsテーブルに保存
        $input = $request['report'];
        $report->user_id = $request->userId();
        $report->menu_id = $menu->id;
        $report->fill($input)->save();

        //メール情報を取得
        $reporter = User::where('id', $report->user_id)->value('name');
        $userName = User::where('id', $menu->user_id)->value('name');
        $category = Category::find($report->category_id);
        $created_at = now();

        //メール送信
        if ($report) {
            $recipient = config('mail.mailers.smtp.username');
            $subject = 'グルメモ報告通知';

            Mail::send('emails.report', [
                'reporter' => $reporter,
                'userName' => $userName,
                'report' => $report,
                'categoryName' => $category->name,
                'created_at' => $created_at,
            ], function ($message) use ($recipient, $subject) {
                $message->from(config('mail.from.address'), config('mail.from.name'))
                    ->to($recipient)
                    ->subject($subject);
            });
        }
        return redirect()->route('index');
    }
}
