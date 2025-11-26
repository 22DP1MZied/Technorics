<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'language' => 'required|string|in:en,lv,ru'
        ]);

        $language = $request->language;
        $userMessage = $request->message;

        // Check if API key is configured
        if (!env('GROQ_API_KEY')) {
            Log::error('GROQ_API_KEY not configured');
            return response()->json([
                'response' => $this->getErrorMessage($language) . ' (API key not configured)'
            ], 500);
        }

        // Language-specific system prompts
        $systemPrompts = [
            'en' => "You are a helpful AI shopping assistant for Technorics, an electronics store specializing in gaming PCs, laptops, monitors, and peripherals. Help customers find products, answer questions about PC building, provide recommendations, and assist with technical specifications. Be friendly, concise, and helpful. Respond in English.",
            'lv' => "Tu esi noderīgs AI iepirkšanās asistents Technorics elektronikas veikalam, kas specializējas spēļu datoros, portatīvajos datoros, monitoros un perifērijas ierīcēs. Palīdzi klientiem atrast produktus, atbildi uz jautājumiem par datoru būvēšanu, sniedz ieteikumus un palīdzi ar tehniskajām specifikācijām. Esi draudzīgs, kodolīgs un noderīgs. Atbildi latviešu valodā.",
            'ru' => "Вы - полезный AI помощник по покупкам для Technorics, магазина электроники, специализирующегося на игровых ПК, ноутбуках, мониторах и периферии. Помогайте клиентам находить товары, отвечайте на вопросы о сборке ПК, давайте рекомендации и помогайте с техническими характеристиками. Будьте дружелюбны, лаконичны и полезны. Отвечайте на русском языке."
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
                'Content-Type' => 'application/json',
            ])->timeout(30)->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama-3.3-70b-versatile', // Updated to current model
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => $systemPrompts[$language] ?? $systemPrompts['en']
                    ],
                    [
                        'role' => 'user',
                        'content' => $userMessage
                    ]
                ],
                'temperature' => 0.7,
                'max_tokens' => 1000,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['choices'][0]['message']['content'])) {
                    return response()->json([
                        'response' => $data['choices'][0]['message']['content']
                    ]);
                }
                
                Log::error('Unexpected API response structure', ['response' => $data]);
                return response()->json([
                    'response' => $this->getErrorMessage($language)
                ], 500);
            }

            Log::error('Groq API error', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return response()->json([
                'response' => $this->getErrorMessage($language)
            ], 500);

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Connection error to Groq API', ['error' => $e->getMessage()]);
            return response()->json([
                'response' => $this->getErrorMessage($language) . ' (Connection error)'
            ], 500);
        } catch (\Exception $e) {
            Log::error('AI Chat error', ['error' => $e->getMessage()]);
            return response()->json([
                'response' => $this->getErrorMessage($language)
            ], 500);
        }
    }

    private function getErrorMessage($language)
    {
        $errors = [
            'en' => 'Sorry, I encountered an error. Please try again.',
            'lv' => 'Atvainojiet, radās kļūda. Lūdzu, mēģiniet vēlreiz.',
            'ru' => 'Извините, произошла ошибка. Пожалуйста, попробуйте еще раз.'
        ];
        return $errors[$language] ?? $errors['en'];
    }
}
