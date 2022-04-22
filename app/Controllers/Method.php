<?php

namespace App\Controllers;

use App\Models\EarthquakeModel;

class Method extends BaseController
{
    protected $EarthquakeModel;

    public function __construct()
    {
        $this->EarthquakeModel = new EarthquakeModel();
    }
    public function index()
    {
        $eq = $this->EarthquakeModel->findAll();
        $data = [
            'gempa' => $eq
        ];
        return view('tes', $data);
    }
}
