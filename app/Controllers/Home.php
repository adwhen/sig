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
        $awal = $this->request->getVar('AWAL');
        $akhir = $this->request->getVar('AKHIR');
        $klaster = $this->request->getVar('klaster');

        if (empty($awal) and empty($akhir) and empty($klaster)) {
            $data['gempa'] = $this->EarthquakeModel->findAll();
        } else {
            if (!empty($awal) and !empty($akhir)) {
                $where['created_at >='] = $awal;
                $where['created_at <='] = $akhir;
                $data['awal'] = $awal;
                $data['akhir'] = $akhir;
            }
            if (!empty($klaster)) {
                $where['klaster'] = $klaster;
                $data['klaster'] = $klaster;
            }
            $data['gempa'] = $this->EarthquakeModel->where($where)->findAll();
        }


        $data['conf'] = $this->ConfModel->findAll();
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
