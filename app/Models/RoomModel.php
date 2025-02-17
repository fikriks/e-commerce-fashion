<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model
{
    protected $table            = 'rooms';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['user_id', 'message_id', 'room', 'created_at', 'modified_at'];

    function getAll()
    {
        $builder = $this->db->table('message_room');
        $builder->join('user', 'user.id = message_room.user_id');
        $builder->join('message', 'message.id = message_room.message_id');
        $builder->where('user_id = user.id');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
