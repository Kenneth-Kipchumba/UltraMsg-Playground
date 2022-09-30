<?php

namespace App\Controllers;

use UltraMsg\WhatsAppApi;

class Message extends BaseController
{
    public function index()
    {
        return view('home');
    }

    public function message()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'phone_number' => 'required',
            'message' => 'required',
        ]))
        {
            $ultramsg_token="xgs6tvyn5yovheqe"; // Ultramsg.com token
            $instance_id="instance18923"; // Ultramsg.com instance id

            $client = new WhatsAppApi($ultramsg_token, $instance_id);

            $to   = $this->request->getPost('phone_number'); 
            $body = $this->request->getPost('message');

            $api=$client->sendChatMessage($to,$body);
            print_r($api);
        }

        return redirect()->back();
    }
}
