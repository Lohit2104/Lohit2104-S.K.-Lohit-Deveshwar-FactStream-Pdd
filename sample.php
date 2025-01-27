<?php
// Define the plagiarism API endpoint
define('PLAGIARISM_API_URL', 'https://api.copyleaks.com/v3/education/scan');
define('PLAGIARISM_API_KEY', '1ed84a1d-add6-451b-9d19-fe448e18d361'); // Use your Copyleaks API key

// Function to check plagiarism
function checkPlagiarism($content) {
    $data = json_encode(["text" => $content]);

    // Initialize cURL
    $ch = curl_init(PLAGIARISM_API_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer " . PLAGIARISM_API_KEY
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    // Execute cURL request and get response
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    curl_close($ch);

    // Check for error in the response
    if (isset($result['error'])) {
        echo 'Plagiarism API Error: ' . $result['error']['message'];
        return false;
    }

    // Example: return whether plagiarism is below a certain threshold (e.g., 20%)
    return isset($result['percent']) && $result['percent'] < 20; // 20% or less is considered acceptable
}

// Sample content to check for plagiarism
$content = "This is some text content to check for plagiarism.";

// Call the plagiarism check function
if (checkPlagiarism($content)) {
    echo "Content passed plagiarism check!";
} else {
    echo "Content has significant plagiarism!";
}
?>
