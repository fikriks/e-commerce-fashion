<?php

namespace App\Controllers;

use App\Models\ChatModel;
use App\Models\RoomModel;
use App\Models\ProfileModel;
use CodeIgniter\I18n\Time;

class Chat extends BaseController
{
    public function __construct()
    {
        helper('text');
        $this->chat = new ChatModel();
        $this->room = new RoomModel();
        $this->user = new ProfileModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Chat',
            // 'chat'  => $this->room->getAll(),
            'chatList'  => $this->chat->getList(),
        ];
        
        return view('back-end/chat/data', $data);
    }

    public function list()
    {
        if ($this->request->isAJAX()) {
            $room_number = $this->request->getVar('room_number');

            $user = $this->chat->join('user', 'user.id = message.user_id')
                    ->where('room_number', $room_number)->first();
            $chat = $this->chat->join('user', 'user.id = message.user_id')
                    ->where('room_number', $room_number)->findAll();

             $msg = [
                'data' => view('back-end/chat/content', [
                        'user' => $user,
                        'chat' => $chat
                ])
            ];

            echo json_encode($msg);

            // return view('back-end/chat/content', [
            //     'user' => $user,
            //     'chat' => $chat
            // ]);
            

            // $sender_id = $this->request->getVar('sender_id');

            // $chat = $this->chat->find($sender_id);
            // $user = $this->user->find($sender_id);
            
            // $user_admin = $this->user->find(session('id'));
            // $chat_admin = $this->room->getAll();


            // $data = [
            //     'sender_id' => $sender_id,
            //     'recipient_id' => $chat_admin['recipient_id'],
            //     'message' => $chat_admin['message'],
            //     'time' => $chat_admin['time'],
            //     'image' => $chat_admin['image'],
            //     'first_name' => $chat_admin['first_name'],
            //     'last_name' => $chat_admin['last_name'],
            //     'status' => $chat_admin['status'],
            //     'message_admin' => $chat_admin['message'],
            //     'time_admin' => $chat_admin['time'],
            //     'image_admin' => $user_admin['image'],
            // ];

            // $msg = [
            //     'data' => view('back-end/chat/content', $chat_admin)
            // ];

            // var_dump($chat_admin[0]['message']);
            // dd($data);
            // echo json_encode($this->request->getVar('room_number'));
        }
    }

    public function send()
    {
        $sender_id = $this->request->getVar('sender_id');
        $message = $this->request->getVar('message');

        $params = [
            'sender_id'     => session('id'),
            'recipient_id'  => $sender_id,
            'message'       => $message,
            'time'          => Time::now('Asia/Jakarta', 'en_ID'),
        ];

        $this->chat->insert($params);
        return redirect()->to(site_url('chat'));
    }
}
