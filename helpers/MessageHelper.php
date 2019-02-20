<?php

namespace app\helpers;
Use app\models\Message;
use Yii;
use yii\base\Model;

class MessageHelper extends model{
    private $model;

    public function __construct(){
        $this->model = new Message();
        parent::__construct();
    }

    /**
     * Store Messages
     *
     * @param string $from
     * @param string $name
     * @param string $phone
     * @param string $message
     * @param string $receiver
     * @param string $property_id
     * @return boolean
     */
    public function send_message($from='',$name='',$phone='',$message='',$receiver='',$property_id=''){
        $current_datetime = new \DateTime();

        $this->model->property_id = $property_id;
        $this->model->sender_name = $name;
        $this->model->sender_email = $from;
        $this->model->sender_phone = $phone;
        $this->model->receiver = $receiver;
        $this->model->message = $message;
        $this->model->create_datetime = $current_datetime->format('Y-m-d H:i:s');
        return $this->model->save();
    }
}