<?php

namespace App\Controllers;

use App\Models\EarthquakeModel;

class Method extends BaseController
{
    protected $EarthquakeModel;

    public function __construct()
    {
        $this->EarthquakeModel = new EarthquakeModel();
        helper('method');
    }
    public function elbow()
    {
        $eq = $this->EarthquakeModel->findAll();
        $data = [
            'gempa' => $eq
        ];
        return view('elbow', $data);
    }
    public function clarans()
    {
        $eq = $this->EarthquakeModel->findAll();
        $data = [
            'gempa' => $eq
        ];
        return view('clarans', $data);
    }
}
