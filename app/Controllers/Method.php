<?php

namespace App\Controllers;

use App\Models\ConfModel;
use App\Models\EarthquakeModel;

class Method extends BaseController
{
    protected $EarthquakeModel;
    protected $ConfModel;

    public function __construct()
    {
        $this->EarthquakeModel = new EarthquakeModel();
        $this->ConfModel = new ConfModel();
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

        $data = [
            'gempa' => $this->EarthquakeModel->findAll(),
            'conf' => $this->ConfModel->findAll()
        ];
        return view('clarans', $data);
    }
    public function se()
    {

        $data = [
            'gempa' => $this->EarthquakeModel->findAll(),
            'conf' => $this->ConfModel->findAll()
        ];
        return view('silhoute_coefficient', $data);
    }
}
