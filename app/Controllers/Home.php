<?php

namespace App\Controllers;

use App\Models\ConfModel;
use App\Models\EarthquakeModel;
use App\Models\SseModel;

class Home extends BaseController
{
    protected $EarthquakeModel;
    protected $ConfModel;
    protected $SseModel;

    public function __construct()
    {
        $this->EarthquakeModel = new EarthquakeModel();
        $this->ConfModel = new ConfModel();
        $this->SseModel = new SseModel();
        helper('method');
    }
    public function index()
    {
        $data = [
            'gempa' => $this->EarthquakeModel->findAll(),
            'conf' => $this->ConfModel->findAll()
        ];
        return view('pages/home', $data);
    }
    public function result_elbow()
    {
        $data = [
            'gempa' => $this->EarthquakeModel->findAll(),
            'conf' => $this->ConfModel->findAll(),
            'ssem' => $this->SseModel->findAll(),
        ];
        return view('pages/result_elbow', $data);
    }
    public function result_clarans()
    {
        $data = [
            'gempa' => $this->EarthquakeModel->findAll(),
            'conf' => $this->ConfModel->findAll(),
            'ssem' => $this->SseModel->findAll(),
        ];
        return view('pages/result_clarans', $data);
    }
    public function result_se()
    {
        $data = [
            'gempa' => $this->EarthquakeModel->findAll(),
            'conf' => $this->ConfModel->findAll(),
            'ssem' => $this->SseModel->findAll(),
        ];
        return view('pages/result_se', $data);
    }
}
