<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MitraProfile;

class ChatbotController extends Controller
{
    /**
     * Handle incoming chat message to BerkahBot via Gemini 2.5 Flash.
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'history' => 'nullable|array'
        ]);

        $userMessage = trim($request->input('message'));
        $history = $request->input('history', []);

        try {
            $apiKey = config('services.gemini.key');
            $model = config('services.gemini.model', 'gemini-2.5-flash');

            // 1. Ambil data mitra aktif untuk context AI
            $activeMitras = MitraProfile::where('status', 'active')
                ->select('name', 'category', 'location', 'whatsapp', 'materials_needed')
                ->get();

            $mitraSummary = "";
            foreach ($activeMitras as $idx => $m) {
                $num = $idx + 1;
                $mitraSummary .= "{$num}. {$m->name} (Kategori: {$m->category}, Lokasi: {$m->location}, Menerima: {$m->materials_needed}, WA: {$m->whatsapp})\n";
            }

            // 2. Susun System Instruction khusus SisaBerkah (Panjang Sedang & Pas)
            $systemInstruction = "Kamu adalah 'BerkahBot', asisten AI resmi yang ramah, informatif, dan solutif untuk platform digital SisaBerkah (Dari Sisa Menjadi Berkah).
Peranmu:
1. Membantu mengelola sisa makanan dan limbah organik secara bijak (Budidaya Maggot BSF, Kompos, Pakan Ternak, Eco-Enzyme).
2. Tegas DILARANG MEMBAKAR sampah karena berbahaya bagi pernapasan dan lingkungan.
3. Rekomendasi Mitra SisaBerkah aktif:
{$mitraSummary}
Jika pengguna menanyakan mitra atau tempat setor, sebutkan 1-2 mitra yang paling cocok lengkap dengan lokasi dan kontak WA.

PANDUAN PANJANG JAWABAN (SEDANG, PAS & BERBOBOT):
- Berikan jawaban dengan panjang SEDANG (jangan terlalu panjang bertele-tele, dan jangan terlalu pendek hanya satu baris).
- Struktur ideal:
  1. Pengantar ramah 1 kalimat langsung menjawab pertanyaan.
  2. 2 sampai 4 poin penjelasan/langkah praktis yang padat dan informatif.
  3. 1 kalimat tips penutup atau saran lanjutan.
- Panjang total ideal: sekitar 60 hingga 110 kata.
- Format rapi menggunakan bold untuk kata kunci dan bullet points agar nyaman dibaca di jendela chat.";

            if (!empty($apiKey)) {
                // Coba model gemini-3.5-flash-lite terlebih dahulu untuk kecepatan dan kuota tinggi, lalu fallback ke gemini-2.5-flash
                $modelsToTry = ['gemini-3.5-flash-lite', 'gemini-2.5-flash'];
                foreach ($modelsToTry as $mName) {
                    $reply = $this->callGeminiChat($userMessage, $history, $systemInstruction, $apiKey, $mName);
                    if ($reply) {
                        return response()->json([
                            'success' => true,
                            'reply' => $reply
                        ]);
                    }
                }
            }

            // Fallback response jika API offline / quota limit (Panjang Sedang & Pas)
            $fallbackReply = $this->getFallbackReply($userMessage, $activeMitras);
            return response()->json([
                'success' => true,
                'reply' => $fallbackReply
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kendala: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Panggil Gemini API generateContent dengan format chat multi-turn.
     */
    private function callGeminiChat($userMessage, $history, $systemInstruction, $apiKey, $model)
    {
        $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

        $contents = [];

        // Masukkan riwayat percakapan sebelumnya (jika ada)
        if (is_array($history) && count($history) > 0) {
            $recentHistory = array_slice($history, -6);
            foreach ($recentHistory as $msg) {
                if (isset($msg['role']) && isset($msg['text'])) {
                    $role = ($msg['role'] === 'user') ? 'user' : 'model';
                    $contents[] = [
                        'role' => $role,
                        'parts' => [['text' => $msg['text']]]
                    ];
                }
            }
        }

        // Tambahkan pesan user saat ini
        $contents[] = [
            'role' => 'user',
            'parts' => [['text' => $userMessage]]
        ];

        $payload = [
            'system_instruction' => [
                'parts' => [
                    ['text' => $systemInstruction]
                ]
            ],
            'contents' => $contents,
            'generationConfig' => [
                'temperature' => 0.4,
                'maxOutputTokens' => 800
            ]
        ];

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200 && $response) {
            $decoded = json_decode($response, true);
            $reply = $decoded['candidates'][0]['content']['parts'][0]['text'] ?? null;
            if ($reply) {
                return trim($reply);
            }
        }

        return null;
    }

    /**
     * Fallback cerdas untuk BerkahBot dengan panjang sedang & seimbang.
     */
    private function getFallbackReply($userMessage, $activeMitras)
    {
        $lower = strtolower($userMessage);

        if (str_contains($lower, 'mitra') || str_contains($lower, 'setor') || str_contains($lower, 'lokasi') || str_contains($lower, 'alamat')) {
            $reply = "Halo! Anda bisa menyalurkan sisa makanan ke mitra aktif SisaBerkah berikut:\n\n";
            foreach ($activeMitras->take(2) as $m) {
                $reply .= "• **{$m->name}** ({$m->location})\n  Menerima: {$m->materials_needed} (WA: {$m->whatsapp})\n";
            }
            $reply .= "\n**Tips:** Hubungi mitra terlebih dahulu untuk konfirmasi jadwal pengantaran atau cek menu **Profil Mitra**.";
            return $reply;
        }

        if (str_contains($lower, 'maggot') || str_contains($lower, 'bsf') || str_contains($lower, 'larva')) {
            return "Larva Maggot BSF sangat lahap mengurai sampah organik dapur menjadi sumber protein tinggi:\n\n" .
                "• **Makanan Favorit:** Sisa nasi, potongan sayur, ampas tahu, dan buah lunak (pisang/pepaya).\n" .
                "• **Tips Penting:** Pastikan tiriskan kuah berminyak dan singkirkan plastik atau tulang keras.\n" .
                "• **Keuntungan:** Mampu mereduksi sampah hingga 70% dan menghasilkan pupuk kasgot berkualitas.";
        }

        if (str_contains($lower, 'kompos') || str_contains($lower, 'pupuk')) {
            return "Berikut cara membuat kompos organik di rumah agar tidak berbau menyengat:\n\n" .
                "• **Kombinasi Bahan:** Campurkan 1 bagian bahan hijau (sisa sayur/buah) dengan 2 bagian bahan cokelat (daun kering/serbuk kayu).\n" .
                "• **Kelembaban:** Jaga tumpukan tetap lembab seperti spons basah dan simpan di wadah yang berongga udara.\n" .
                "• **Pengadukan:** Aduk seminggu sekali agar oksigen merata. Kompos siap panen dalam 4-6 minggu.";
        }

        if (str_contains($lower, 'bakar') || str_contains($lower, 'dibakar')) {
            return "⚠️ **Dilarang keras membakar sampah organik!**\n\n" .
                "• **Bahaya Kesehatan:** Pembakaran sampah basah memicu asap pekat beracun penyebab ISPA dan batuk kronis.\n" .
                "• **Bahaya Lingkungan:** Menghasilkan gas rumah kaca ($CO_2$) dan membunuh unsur hara tanah yang subur.\n" .
                "• **Solusi Tepat:** Sebaiknya olah jadi kompos rumahan atau salurkan ke peternak mitra SisaBerkah.";
        }

        return "Halo! Saya **BerkahBot**, asisten AI SisaBerkah. Saya siap membantu Anda seputar cara pengolahan limbah organik dapur, panduan budidaya Maggot BSF, kompos tanpa bau, hingga mencarikan mitra terdekat. Ada yang ingin Anda tanyakan?";
    }
}
