<?php

namespace App\Models;

use CodeIgniter\Model;

class EarthquakeModel extends Model
{
    protected $table      = 'tb_earthquake';
    protected $primaryKey = 'idx';
    protected $useTimestamps = true;
}
