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
        echo view('elbow', $data);
        return redirect()->route('Result-elbow');
    }
    public function clarans()
    {

        $data = [
            'gempa' => $this->EarthquakeModel->findAll(),
            'conf' => $this->ConfModel->findAll()
        ];
        echo view('clarans', $data);
        return redirect()->route('Result-clarans');
    }
    public function se()
    {

        $data = [
            'gempa' => $this->EarthquakeModel->findAll(),
            'conf'  => $this->ConfModel->findAll()
        ];
        echo view('silhoute_coefficient', $data);
        return redirect()->route('Result-silhoute-coefficient');
    }
}
