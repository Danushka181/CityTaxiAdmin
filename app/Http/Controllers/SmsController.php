<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class SmsController extends Controller
{
    protected Client $client;

    /**
     * SmsController constructor.
     *
     * @throws ConfigurationException
     */
    public function __construct()
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');

        // Initialize Twilio client
        $this->client = new Client($sid, $token);
    }

    /**
     * Send an SMS message.
     *
     * @param string $to      The recipient's phone number
     * @param string $message The SMS message content
     *
     * @return string
     * @throws TwilioException
     */
    public function sendSMS(string $to, string $message): string
    {
        $from = env('TWILIO_FROM');

        // Create and send the SMS message
        return $this->client->messages->create(
            $to,
            [
                'from' => $from,
                'body' => $message,
            ]
        );

    }
}
