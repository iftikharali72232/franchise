<?php

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
function removeImages($imageArray, $multi_images = 0) {
    // print_r($imageArray); exit;
    if($multi_images == 1)
    {
        foreach($imageArray as $img)
        {
            if(File::exists(public_path('/images/'.$img))) {
            //     echo "success"; exit;
                File::delete(public_path('/images/'.$img));
            }
        }
    } else {
        if(File::exists(public_path('/images/'.$imageArray))) {
            //     echo "success"; exit;
                File::delete(public_path('/images/'.$imageArray));
            }
    }
    
}

function formatDateTimeToEnglish($dateTimeString)
{
    $currentFormat = "Y-m-d H:i:s";
    // Parse the input date and time string using Carbon
    $dateTime = Carbon::createFromFormat($currentFormat, $dateTimeString);

    // Format the date and time to English with AM/PM
    $formattedDateTime = $dateTime->format('l, F j, Y g:i A');

    return $formattedDateTime;
}

function formatCreatedAt($created_at) {
    // Convert the created_at string to a DateTime object
    $createdDateTime = new DateTime($created_at);
    
    // Get the current date and time
    $currentDateTime = new DateTime();

    // Calculate the difference between the current date and the created_at date
    $interval = $currentDateTime->diff($createdDateTime);

    // Check the difference and format accordingly
    if ($interval->d > 0) {
        // Less than one hour, show in minutes
        return $interval->d . trans('lang.days_ago');
    } elseif ($interval->h < 24) {
        // Less than 24 hours, show in hours
        return $interval->h . trans('lang.hours_ago');
    } else {
        // More than 24 hours, show in days
        return $interval->i . trans('lang.minutes_ago');
    }
}
function generateRandomCode() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';
    $max = strlen($characters) - 1;
    
    for ($i = 0; $i < 10; $i++) {
        $code .= $characters[mt_rand(0, $max)];
    }
    
    return $code;
}
function send_message($data, $mobile)
{
    $ch = curl_init();

    $payload = json_encode([
        "messaging_product" => "whatsapp",
        "recipient_type" => "individual",
        "to" => $mobile,
        "type" => "template",
        "template" => [
            "name" => "parcel_receiver_address_template ",
            "language" => ["code" => "en"],
            "components" => [
                [
                    "type" => "body",
                    "parameters" => [
                        [
                            "type" => "text",
                            "text" => $data['code']
                        ]
                    ]
                ]
            ]
        ]
    ]);
    curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/v21.0/378517282013470/messages');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    $headers = array();
    $headers[] = 'Authorization: Bearer EAAOh9TZC2MtUBOZCzd0p4u5w9YoFZAqLJF7sZBMsdDdirZCvZChVUj5UZCNv4yqZAwyXHFIEb4QFbv7qLDGhPFcwZA0fJuNYlfe23qx7wPeZCxaWdcNya1aRZC7hdZCuEpf49gWKk28rgT2twDWmFOq8yg7I3A2v1emQZBWdoQhPTu78UUjqNSwkBTBZBmhnUjSHF3yyjHDAZDZD';
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    $result = json_decode($result, true);
    return $result;
}
function sendReportWhatsapp($data)
{
    $curl = curl_init();
		
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://graph.facebook.com/v20.0/378517282013470/messages',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
        "messaging_product": "whatsapp",
        "recipient_type": "individual",
        "to": "'.$data['mobile'].'",
        "type": "template",
        "template": {
            "name": "report_sending_link",
            "language": {
                "code": "en"
            },
            "components": [
                {
                    "type": "body",
                    "parameters": [
                        {
                            "type": "text",
                            "text": "'.$data['branch_name'].'"
                        }
                    ]
                },
                {
                    "type": "button",
                    "index": "0",
                    "sub_type": "url",
                    "parameters": [
                        {
                            "type": "text",
                            "text": "/'.base64_encode($data['id']).'"
                        }
                    ]
                }
            ]
        }
    }',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer EAAOh9TZC2MtUBOZCzd0p4u5w9YoFZAqLJF7sZBMsdDdirZCvZChVUj5UZCNv4yqZAwyXHFIEb4QFbv7qLDGhPFcwZA0fJuNYlfe23qx7wPeZCxaWdcNya1aRZC7hdZCuEpf49gWKk28rgT2twDWmFOq8yg7I3A2v1emQZBWdoQhPTu78UUjqNSwkBTBZBmhnUjSHF3yyjHDAZDZD'
    ),
    ));

    $result = curl_exec($curl);
    if (curl_errno($curl)) {
        echo 'Error:' . curl_error($curl);
    }
    curl_close($curl);
    $result = json_decode($result, true);
    return $result;
}

function cleanText($text) {
    // Remove newlines and tabs
    $text = str_replace(array("\n", "\r", "\t"), ' ', $text);

    // Replace multiple spaces with a single space
    $text = preg_replace('/ {2,}/', ' ', $text);

    // Replace more than four consecutive spaces with four spaces
    $text = preg_replace('/ {5,}/', '    ', $text);

    return $text;
}

function subtractFivePercent($amount) {
    // Calculate 5% of the amount
    $percentage = $amount * 0.05;

    // Subtract 5% from the original amount
    $remainingAmount = $amount - $percentage;

    return $remainingAmount;
}

function getFivePercent($amount) {
    // Calculate 5% of the amount
    $percentage = $amount * 0.05;


    return $percentage;
}

function getCityFromCoordinates($latitude, $longitude, $complete = 0)
{
    $client = new Client();
    $url = 'https://maps.googleapis.com/maps/api/geocode/json';

    try {
        $response = $client->get($url, [
            'query' => [
                'latlng' => "$latitude,$longitude",
                'key' => "AIzaSyDdwlGhZKKQqYyw9f9iME40MzMgC9RL4ko", // Your actual API key here
            ],
        ]);

        $data = json_decode($response->getBody(), true);

        if (isset($data['results']) && count($data['results']) > 0) {
            // Return full address if $complete = 1
            if ($complete == 1) {
                return $data['results'][0]['formatted_address'];
            }

            // Extract the city name
            foreach ($data['results'][0]['address_components'] as $component) {
                if (in_array('locality', $component['types'])) {
                    return $component['long_name'];
                }
            }
        }

        return null;
    } catch (\Exception $e) {
        return null;
    }
}


if (!function_exists('sendEmail')) {
    function sendEmail($to, $subject, $messageBody, $from = null, $attachments = [])
    {
        $fromAddress = $from['address'] ?? config('mail.from.address');
        $fromName = $from['name'] ?? config('mail.from.name');

        try {
            Mail::send([], [], function ($message) use ($to, $subject, $messageBody, $fromAddress, $fromName, $attachments) {
                $message->to($to)
                    ->subject($subject)
                    ->from($fromAddress, $fromName)
                    ->setBody($messageBody, 'text/html');

                // Attach files if any
                foreach ($attachments as $filePath => $fileName) {
                    $message->attach($filePath, ['as' => $fileName]);
                }
            });

            return response()->json(['status' => true, 'message' => 'Email sent successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
