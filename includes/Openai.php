<?php
class Openai{
    private function secret_key(){
        return $secret_key = 'Bearer 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';
    }

    public function request($engine, $prompt, $max_tokens){

        $request_body = [
        'model' => $engine,
        "prompt" => $prompt,
        "max_tokens" => $max_tokens,
        "temperature" => 0.7,
        "top_p" => 1,
        "presence_penalty" => 0.75,
        "frequency_penalty"=> 0.75,
        "best_of"=> 1,
        "stream" => false,
        "echo" => true,
        ];

        $postfields = json_encode($request_body);
        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.openai.com/v1/completions",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $postfields,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Authorization: ' . $this->secret_key()
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "Error #:" . $err;
        } else {
            return $response;
        }

    }

    public function search($engine, $documents, $query){

        $request_body = [
        "max_tokens" => 10,
        "temperature" => 0.7,
        "top_p" => 1,
        "presence_penalty" => 0.75,
        "frequency_penalty"=> 0.75,
        "documents" => $documents,
        "query" => $query
        ];

        $postfields = json_encode($request_body);
        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.openai.com/v1/engines/" . $engine . "/search",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $postfields,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Authorization: ' . $this->secret_key()
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "Error #:" . $err;
        } else {
            return $response;
        }

    }

    public function edits($engine, $input, $instruction){

        $request_body = [
        'model' => $engine,
        "input" => $input,
        "instruction" => $instruction,
        // "max_tokens" => $max_tokens,
        "temperature" => 0.7,
        "top_p" => 1,
        //"n" => 2,
        // "presence_penalty" => 0,
        // "frequency_penalty"=> 0,
        // "best_of"=> 1,
        // "stream" => false,
        // "echo" => true,
        ];

        $postfields = json_encode($request_body);
        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.openai.com/v1/edits",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $postfields,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Authorization: ' . $this->secret_key()
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function complit($engine, $prompt, $max_tokens){

        $request_body = [
        //'model' => $engine,
        "prompt" => $prompt,
        "max_tokens" => $max_tokens,
        "temperature" => 0.7,
        "top_p" => 1,
        "presence_penalty" => 0.75,
        "frequency_penalty"=> 0.75,
        "best_of"=> 1,
        "stream" => false,
        "echo" => true,
        ];

        $postfields = json_encode($request_body);
        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.openai.com/v1/engines/text-davinci-003/completions",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $postfields,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Authorization: ' . $this->secret_key()
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function complit_new($engine, $prompt, $max_tokens){

        $request_body = [
        //'model' => $engine,
        "prompt" => $prompt,
        "max_tokens" => $max_tokens,
        "temperature" => 0.7,
        "top_p" => 1,
        "presence_penalty" => 0.75,
        "frequency_penalty"=> 0.75,
        "best_of"=> 1,
        "stream" => false,
        "echo" => true,
        ];

        $postfields = json_encode($request_body);
        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.openai.com/v1/engines/text-davinci-003/completions",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $postfields,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Authorization: ' . $this->secret_key()
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function questions($system, $user){
        $request_body = [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                [
                    "role" => "system",
                    "content" => $system
                ],
                [
                    "role" => "user",
                    "content" => $user
                ]
            ]
        ];
        $postfields = json_encode($request_body);
        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.openai.com/v1/chat/completions",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $postfields,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Authorization: ' . $this->secret_key()
        ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return "Error #:" . $err;
        } else {
            return $response;
        }
    }

}
