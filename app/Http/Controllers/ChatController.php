<?php

namespace App\Http\Controllers;

use Gemini\Data\Content;
use Gemini\Enums\Role;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function __invoke(Request $request): string
    {
        try {
            $message =  $request->post('content');
            $chat = Gemini::chat()
                ->startChat(history: [
                    Content::parse(part: 'please call yourself as car service chat bot'),
                    Content::parse(part: "Hi! I'm your friendly car service chatbot. I'm here to help you with all your car service needs. Whether you need to book an appointment, get a quote, or track the status of your current service, I'm here to help. Just ask me a question 
and I'll do my best to answer it.", role: Role::MODEL)
                ]);
            $response = $chat->sendMessage($message);
            return $response->text();
        } catch (Throwable $e) {
            return "Something went wrong";
        }
    }
}
