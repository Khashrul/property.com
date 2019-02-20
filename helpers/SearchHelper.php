<?php

namespace app\helpers;

use Yii;
use yii\base\Model;
use app\models\Property;

class SearchHelper extends Model
{
    private $model;

    public function __construct(){
        $this->model = new Property();
        parent::__construct();
    }

    /**
     * Fetch property listings
     * This method search listing based on terms order by create date time.
     *
     * @param array $terms
     * @param string $filter
     * @return object property listings
     */
    public function findProperty($terms,$filter=''){

        #apartment or house
        if($terms[0] == 1 || $terms[0] == 2){
            return $this->model->find()->where([
                'and',
                ['property_type' => $terms[0]],
                (!empty($terms[1]) ? ['transaction_type' => $terms[1]] : ''),
                ['country' => $terms[2]],
                (!empty($terms[3]) ? ['city' => $terms[3]] : ''),
                (!empty($terms[4]) ? ['like','location',$terms[4]] : ''),
                ['between','price', $terms[5], $terms[6]],
                [
                    'or',
                    (!empty($terms[4]) ? ['like','region',$terms[4]] : ''),
                    ['between','area', $terms[7], $terms[8]],
                    ['between','bedrooms', $terms[9], $terms[10]],
                    ['between','bathrooms', $terms[11], $terms[12]]
                ],
            ])
            ->orderBy([
                'create_datetime'=>SORT_DESC,
                'price'=> !empty($filter) ? ($filter === 'price_high_low' ? SORT_DESC : SORT_ASC) : '',
                'area'=> !empty($filter) ? ($filter === 'area_high_low' ? SORT_DESC : SORT_ASC) : '',
            ])
            ->all();

        }
        #commercial
        elseif ($terms[0] == 3){
            return $this->model->find()->where([
                'and',
                ['property_type' => $terms[0]],
                (!empty($terms[1]) ? ['transaction_type' => $terms[1]] : ''),
                ['country' => $terms[2]],
                (!empty($terms[3]) ? ['city' => $terms[3]] : ''),
                (!empty($terms[4]) ? ['like','location',$terms[4]] : ''),
                ['between','price', $terms[5], $terms[6]],
                [
                    'or',
                    (!empty($terms[4]) ? ['like','region',$terms[4]] : ''),
                    ['between','area', $terms[7], $terms[8]],
                    ['between','rooms', $terms[10], $terms[11]],
                    ['commercial_type' => $terms[9]]
                ],
            ])
            ->orderBy([
                'create_datetime'=>SORT_DESC,
                'price'=> !empty($filter) ? ($filter === 'price_high_low' ? SORT_DESC : SORT_ASC) : '',
                'area'=> !empty($filter) ? ($filter === 'area_high_low' ? SORT_DESC : SORT_ASC) : '',
            ])
            ->all();
        }
        #land
        else{
            return $this->model->find()->where([
                'and',
                ['property_type' => $terms[0]],
                (!empty($terms[1]) ? ['transaction_type' => $terms[1]] : ''),
                ['country' => $terms[2]],
                (!empty($terms[3]) ? ['city' => $terms[3]] : ''),
                (!empty($terms[4]) ? ['like','location',$terms[4]] : ''),
                ['between','price', $terms[5], $terms[6]],
                [
                    'or',
                    (!empty($terms[4]) ? ['like','region',$terms[4]] : ''),
                    ['between','area', $terms[7], $terms[8]],
                    ['land_type' => $terms[9]]
                ],
            ])
            ->orderBy([
                'create_datetime'=>SORT_DESC,
                'price'=> !empty($filter) ? ($filter === 'price_high_low' ? SORT_DESC : SORT_ASC) : '',
                'area'=> !empty($filter) ? ($filter === 'area_high_low' ? SORT_DESC : SORT_ASC) : '',
            ])
            ->all();
        }
    }
}

