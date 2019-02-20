<?php

namespace app\helpers;

use Yii;
use yii\base\Model;
use app\models\Countries;
use app\models\States;

class CountryCityHelper extends Model
{
    private $country_model,$state_model;

    public function __construct(){
        $this->country_model = new Countries();
        $this->state_model = new States();
        parent::__construct();
    }

    /**
     * Get country list
     *
     * Get country lists from country table
     *
     * @return object countries
     */
    public function getCountry(){
        return $this->country_model->find()->all();
    }

    /**
     * Get city list
     *
     * Get city lists from states table based on country
     *
     * @param string country
     * @return object states
     */
    public function getCity($country = ''){
        if(!empty($country)){
            return $this->state_model->find()->where(['country_id' => $country])->all();
            /*
             * 06.06.2017
             * For Ajax Call (Incomplete)
            $cities = $this->state_model->find()->where(['country_id' => $country])->all();
            $ul_block = '';
            $option_block = '';
            $count = 1;
            foreach($cities as $city){
                $option_block .= '<option value="'.$city->id.'">'.$city->name.'</option>';
                $ul_block .= '<li data-original-index="'.$count.'"><a tabindex="0" class="" style="" data-tokens="null"><span class="text">'.$city->name.'</span><span class="glyphicon glyphicon-ok check-mark"></span></a></li>';
                $count++;
            }
            $response['ul_block'] = $ul_block;
            $response['option_block'] = $option_block;
            echo json_encode($response);
            */
        }
        else{

            /*
             * For Ajax Call (Incomplete)
            $option_block = '<option value="">--Select City--</option>';
            $ul_block = '';
            $response['ul_block'] = $ul_block;
            $response['option_block'] = $option_block;
            echo json_encode($response);
            */
        }
    }

    /**
     * Get state name by state id
     *
     * Get name of the city/state by it's id from states table
     *
     * @param string id
     * @return object state->name
     */
    public function getCityNameById($id = ''){
        if(!empty($id)){
            return $this->state_model->find()->where(['id' => $id])->one()->name;
        }
    }
}