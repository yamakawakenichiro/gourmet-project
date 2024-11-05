<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gemini\Laravel\Facades\Gemini;
use Gemini\Client;
use Gemini\Transporter; // 正しい名前空間の Transporter クラスをインポート
use Gemini\Contracts\TransporterContract;

class GeminiController extends Controller
{
    public function post(Request $request)
    {
        // バリデーション
        $request->validate([
            'sentence' => 'required|string',
        ]);

        // 受け取った文
        $sentence = $request->input('sentence');

        // APIを通じて応答を生成
        try {
            $result = Gemini::geminiPro()->generateContent($sentence);
            $aiGeneratedDescription = $result->text();
        } catch (\Exception $e) {
            // エラーハンドリング
            return response()->json([
                'error' => 'AI生成中にエラーが発生しました。',
                'details' => $e->getMessage()
            ], 500);
        }

        // AIの生成コンテンツを返す（非同期のため、javascriptで）
        return response()->json([
            'aiGeneratedDescription' => $aiGeneratedDescription
        ]);
    }
}
