<?php
// Get the values of the GET parameters
$slackName = $_GET['slack_name'] ?? '';
$track = $_GET['track'] ?? '';

// Validate the 'track' parameter
$validTracks = ['Backend Software Development', 'Frontend Software Development', 'Data Science', 'Mobile App Development'];
if (!in_array($track, $validTracks)) {
    echo json_encode(['error' => 'Invalid track parameter.']);
    exit;
}

// Get the current day of the week
$currentDay = date('l');

// Get the current UTC time
$currentUtcTime = gmdate('Y-m-d H:i:s', time());

// Validate the time within +/-2 hours
$currentTime = strtotime($currentUtcTime);
$twoHoursAgo = strtotime('-2 hours');
$twoHoursLater = strtotime('+2 hours');

if ($currentTime < $twoHoursAgo || $currentTime > $twoHoursLater) {
    echo json_encode(['error' => 'Current time is not within +/-2 hours of UTC time.']);
    exit;
}

// Define GitHub URLs 
$fileUrl = 'https://github.com/owolabinofisat/repo/hng.git';
$sourceCodeUrl = 'https://github.com/owolabinofisat';

// Prepare the response
$response = [
    'slack_name' => $slackName,
    'day' => $currentDay,
    'current_utc_time' => $currentUtcTime,
    'track' => $track,
    'file_url' => $fileUrl,
    'source_code_url' => $sourceCodeUrl,
    'status_code' => 'success',
];

// Set the content type to JSON
header('Content-Type: application/json');

// Output the JSON response
echo json_encode($response);
