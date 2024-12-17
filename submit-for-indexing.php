<?php
require 'google-api-php-client--PHP8.3/vendor/autoload.php';

// set_time_limit(0); 

// use Google\Client;
// use Google\Service\Indexing;
// use Google\Service\Indexing\UrlNotification;

// function getUrlsFromFile(string $filePath): array {
//     $urls = [];
//     if (file_exists($filePath)) {
//         $file = fopen($filePath, 'r');
//         while (($line = fgets($file)) !== false) {
//             $url = trim($line);
//             if (!empty($url)) {
//                 $urls[] = ['url' => $url];
//             }
//         }
//         fclose($file);
//     } else {
//         echo "File not found: $filePath\n";
//     }
//     return $urls;
// }


// function submitUrlsForIndexing(Indexing $service, array $urls, int $limit = 200) {
//     $count = 0;
   
//     foreach ($urls as $url) {
//         if ($count >= $limit) {
//             break;
//         }
//         $request = new UrlNotification();
//         $request->setUrl($url['url']);
//         $request->setType('URL_UPDATED');

//         try {
//             $response = $service->urlNotifications->publish($request);
//             echo "URL submitted for indexing: " . $url['url'] . "\n";
//             echo "<pre>";
//             echo "Response: " . json_encode($response, JSON_PRETTY_PRINT) . "\n";
//             $count++;
            
//             // Add a small delay to avoid hitting rate limits
//             usleep(500000); // 0.5 second delay
//         } catch (Exception $e) {
//             echo "<pre>";
//             echo 'An error occurred: ' . $e->getMessage() . "\n";
//             exit;
//         }
//     }
//     // echo $count;
//     return $count;
// }


// // Initialize Google Client
// $client = new Client();
// $client->setApplicationName("My Search Console App");
// // $client->setAuthConfig('project1-credentials.json');
// $client->setAuthConfig('project2-credentials.json');
// // $client->setAuthConfig('project3-credentials.json');

// $client->addScope('https://www.googleapis.com/auth/indexing');

// // Create Indexing service
// $indexingService = new Indexing($client);

// // Path to the file containing URLs
// $filePath = 'url-submit-04-09.txt';

// // Retrieve URLs from the file
// $urlsFromFile = getUrlsFromFile($filePath);

// // Submit URLs for indexing
// $submitedUrl = submitUrlsForIndexing($indexingService, $urlsFromFile);

// // Print results
// if (!empty($urlsFromFile)) {
//     // echo "<pre>";
//     // echo "URLs data:\n";
//     // $count = 0;
//     // foreach ($urlsFromFile as $urlData) {
//     //     echo "URL: " . $urlData['url'] . "\n";
//     //     $count++;
//     // }
//     echo "Total URLs submitted: $submitedUrl\n";
// } else {
//     echo "No URLs found or there was an error.\n";
// }

// echo "Script execution completed.\n";


$client = new Google_Client();

// service_account_file.json is the private key that you created for your service account.
$client->setAuthConfig('index1-442813-2c5f8550e176.json');
$client->addScope('https://www.googleapis.com/auth/indexing');

// Get a Guzzle HTTP Client
$httpClient = $client->authorize();
$endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

// Define contents here. The structure of the content is described in the next step.
$content = '{
  "url": "https://www.yourquorum.com/question/did-treat-williams-hair-and-everwood-star-die-at-71",
  "type": "URL_UPDATED"
}';

$response = $httpClient->post($endpoint, [ 'body' => $content ]);
print_r($response);
echo $status_code = $response->getStatusCode();
