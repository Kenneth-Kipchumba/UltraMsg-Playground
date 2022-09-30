<?php

namespace App\Controllers;

use UltraMsg\WhatsAppApi;

use App\Models\MessageModel;

class Message extends BaseController
{
    public function index()
    {
        $model = model(MessageModel::class);

        $data['messages'] = $model->findAll();
        //dd($data);

        return view('home', $data);
    }

    public function message()
    {
        $validated = $this->validate([
            'phone_number' => 'required',
            'message' => 'required',
            'img' => [
                'uploaded[img]',
                'mime_in[img, image/jpg, image/jpeg, image/png, image/gif]',
                'max_size[file,16384]'
            ],
        ]);

        $post = $this->request->getMethod();

        if ($this->request->getMethod() === 'post')
        {
            //dd($this->request->getFile('img'));
            $ultramsg_token="xgs6tvyn5yovheqe"; // Ultramsg.com token
            $instance_id="instance18923"; // Ultramsg.com instance id

            $client = new WhatsAppApi($ultramsg_token, $instance_id);

            $to    = $this->request->getPost('phone_number'); 
            $body  = $this->request->getPost('message');
            $image = $this->request->getFile('img');
            $caption = $this->request->getPost('caption');
            $priority = 10;
            $referenceId = "SDK";
            $nocache = false;

            $api_message  = $client->sendChatMessage($to,$body);

            $api_image = $client->sendImageMessage($to, $image, $caption, $priority, $referenceId, $nocache);

            if ($api_message || $api_image)
            {
                // Save Sent Message in the database table
                $model = model(MessageModel::class);

                $image_name = $image->getClientName() ?? 'No Image';

                $model->save([
                    'phone_number' => $this->request->getPost('phone_number'),
                    'message' => $this->request->getPost('message'),
                    'img' =>  $image_name
                ]);

                $image->move(WRITEPATH . 'whatsapp/images');

                $msg = 'Message sent';
                return redirect()->back()->with('msg', $msg);
            }
            //print_r($api);
        }

        $msg = 'Method was not Post and Validation did not work';

        return redirect()->back()->with('msg', $msg);
    }
}
