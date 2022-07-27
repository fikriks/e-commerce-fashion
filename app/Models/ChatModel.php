<?php

namespace App\Models;

use CodeIgniter\Model;


class ChatModel extends Model
{
    protected $table            = 'message';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['sender_id', 'recipient_id', 'message', 'is_read', 'time'];

    function getAll()
    {
        $builder = $this->db->table('message');
        $builder->join('user', 'user.id = message.sender_id');
        $builder->orderBy('time', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    function getList()
    {
        $builder = $this->db->table('message_latest');
        $builder->join('message', 'message.id = message_latest.message_id');
        $builder->join('user', 'user.id = message.user_id');
        
        $query = $builder->get();

        return $query->getResultArray();
    }
}
