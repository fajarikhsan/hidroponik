<?php

namespace App\Models;

use CodeIgniter\Model;

class ObjectDetectionModel extends Model
{
    protected $table = 'object_detection';
    protected $primaryKey = 'id';
    protected $allowedFields = ['class_title', 'score', 'foto_id'];
    protected $useTimestamps = false;
}
