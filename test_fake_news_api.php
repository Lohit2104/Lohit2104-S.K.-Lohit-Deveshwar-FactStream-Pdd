<?php
define('FAKE_NEWS_API_URL', 'https://api-inference.huggingface.co/models/bitsanlp/distilbert-base-uncased-finetuned-fakenews-detection');
define('FAKE_NEWS_API_KEY', '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');

function testFakeNewsAPI($content) {
    $data = json_encode(["inputs" => $content]);

    $ch = curl_init(FAKE_NEWS_API_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer " . FAKE_NEWS_API_KEY
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        die('Curl Error: ' . curl_error($ch));
    }

    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    echo "HTTP Status: $http_status<br>";
    echo "Raw Response:<br>";
    echo "<pre>" . htmlspecialchars($response) . "</pre>";
}

testFakeNewsAPI("This is a sample news article for validation.");
?>
