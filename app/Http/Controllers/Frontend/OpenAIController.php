<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class OpenAIController extends Controller
{
    public function getChatbotResponse(Request $request) {
        $userIp = $request->ip();
        $cacheKey = "openai_request_count_" . $userIp;

        // Kiểm tra xem người dùng đã gửi yêu cầu trong 5 giây qua chưa
        if (Cache::has($cacheKey)) {
            return response()->json(['error' => 'Vui lòng chờ trước khi gửi yêu cầu khác.'], 429);
        }

        // Lưu vào cache trong 5 giây để hạn chế gửi yêu cầu liên tục
        Cache::put($cacheKey, true, now()->addSeconds(5));

        // Tạo Guzzle client và gửi yêu cầu
        $client = new Client();

        try {
            $response = $client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $request->input('message')
                        ]
                    ],
                    'max_tokens' => 150,
                    'temperature' => 0.7,
                ],
            ]);
            \Log::info($response->getBody());

            $responseBody = json_decode($response->getBody(), true);
            return response()->json(['response' => $responseBody['choices'][0]['message']['content']]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Lỗi: Không thể kết nối với OpenAI. Vui lòng thử lại sau.'], 500);
        }
    }
    public function getChat(){
        return view('frontend.emails.chatbot');
    }
}
