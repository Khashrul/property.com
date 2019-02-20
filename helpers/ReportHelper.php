<?php

namespace app\helpers;
Use app\models\Report;
use Yii;
use yii\base\Model;

class ReportHelper extends model{
    private $model;

    public function __construct(){
        $this->model = new Report();
        parent::__construct();
    }

    /**
     * Store Reports
     *
     * @param string $from
     * @param string $name
     * @param string $phone
     * @param string $report
     * @param string $property_id
     * @return boolean
     */
    public function post_report($from='',$name='',$phone='',$report='',$property_id=''){
        $current_datetime = new \DateTime();

        $this->model->property_id = $property_id;
        $this->model->name = $name;
        $this->model->email = $from;
        $this->model->phone = $phone;
        $this->model->reason = $report;
        $this->model->create_datetime = $current_datetime->format('Y-m-d H:i:s');

        $result = $this->model->save();

        return $result ? 'true' : 'false';
    }
}