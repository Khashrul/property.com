<?php

namespace app\controllers;

use app\helpers\UserHelper;
use app\models\PlanConfig;
use app\models\PropertyMeta;
use app\models\States;
use Yii;
use yii\web\Controller;
use app\models\Property;
use app\components\Generic;

class PropertyController extends Controller
{

    /**
     * Display submit property
     * @return string|\yii\web\Response
     */
    public function actionSubmitproperty()
    {
        $user_details = Generic::checkUserDetails();

        if(!$user_details){
            Yii::$app->session->setFlash('error','Please login first');
            return $this->redirect(Yii::$app->urlManager->createUrl(['/']));
        }
        if($user_details->address == '' || $user_details->date_of_birth == ''){
            Yii::$app->session->setFlash('success-container','Please complete your profile first i.e date of birth, address etc.');
            return $this->redirect(Yii::$app->urlManager->createUrl(['/my-profile']));
        }
        $user_helper = new UserHelper();


        $subscription = $user_helper->checkUserSubscription($user_details);
        $packages = PlanConfig::find()->all();
        if($subscription) {
            $plan_id = $user_helper->getSubscribedPlan($user_details->id);
            $subscribed_plan = $user_helper->getPlanDetails($plan_id);
            $already_listed_property = $user_helper->getAllPropertiesOfUser($user_details->id);
            if($already_listed_property != null && count($already_listed_property) >= $subscribed_plan->property_listing){
                return $this->render('expired-plan', ['subscribed_plan' => $subscribed_plan, 'user_details' => $user_details]);
            } else {
                return $this->render('submit-property', ['subscribed_plan' => $subscribed_plan]);
            }
        }
        else
            return $this->render('/profile/package-selection',['packages' => $packages,'user_details' => $user_details]);
    }

    /**
     * Save submitted property
     */
    public function actionSaveproperty(){
        $user_details = Generic::checkUserDetails();

        $region_token = Yii::$app->session->get('region_token');
        $user_helper = new UserHelper();
        $country = $user_helper->getUserCountry($region_token);

        $property_type = Yii::$app->request->post('property_type');
        $transaction_type = Yii::$app->request->post('transaction_type');
        $price = Yii::$app->request->post('price');
        $area = Yii::$app->request->post('area');
        $bedrooms = Yii::$app->request->post('bedrooms');
        $bathrooms = Yii::$app->request->post('bathrooms');
        $rooms = Yii::$app->request->post('rooms');
        $commercial_type = Yii::$app->request->post('commercial_type');
        $land_type = Yii::$app->request->post('land_type');
        $description = Yii::$app->request->post('description');
        $location = Yii::$app->request->post('geocomplete');
        $lng = Yii::$app->request->post('lng');
        $lat = Yii::$app->request->post('lat');
        $air_condition = Yii::$app->request->post('air_condition');
        $internet = Yii::$app->request->post('internet');
        $cable_tv = Yii::$app->request->post('cable_tv');
        $balcony = Yii::$app->request->post('balcony');
        $roof_terrace = Yii::$app->request->post('roof_terrace');
        $terrace = Yii::$app->request->post('terrace');
        $lift = Yii::$app->request->post('lift');
        $garage = Yii::$app->request->post('garage');
        $security = Yii::$app->request->post('security');
        $high_standard = Yii::$app->request->post('high_standard');
        $city_center = Yii::$app->request->post('city_center');
        $furniture = Yii::$app->request->post('furniture');
        $another_option_1 = Yii::$app->request->post('another_option_1');
        $another_option_2 = Yii::$app->request->post('another_option_2');
        $another_option_3 = Yii::$app->request->post('another_option_3');
        $another_option_4 = Yii::$app->request->post('another_option_4');
        $another_option_5 = Yii::$app->request->post('another_option_5');
        $another_option_6 = Yii::$app->request->post('another_option_6');
        $featured = Yii::$app->request->post('featured',0);
        $image_urls = Yii::$app->request->post('image_file');
        $image_urls_array = explode(',',substr($image_urls, 1));
        $image_url = json_encode($image_urls_array);


        $data_result = Generic::getRegionAndCity($lat,$lng);
        if($location == ''){
            $location = $data_result['location'];
        }

        if($property_type != 4) {
            $property_meta = new PropertyMeta();
            $property_meta->air_conditioning = $air_condition;
            $property_meta->internet = $internet;
            $property_meta->cable_tv = $cable_tv;
            $property_meta->balcony = $balcony;
            $property_meta->roof_terrace = $roof_terrace;
            $property_meta->terrace = $terrace;
            $property_meta->lift = $lift;
            $property_meta->garage = $garage;
            $property_meta->security = $security;
            $property_meta->high_standard = $high_standard;
            $property_meta->city_center = $city_center;
            $property_meta->furniture = $furniture;
            $property_meta->custom_option_1 = $another_option_1;
            $property_meta->custom_option_2 = $another_option_2;
            $property_meta->custom_option_3 = $another_option_3;
            $property_meta->custom_option_4 = $another_option_4;
            $property_meta->custom_option_5 = $another_option_5;
            $property_meta->custom_option_6 = $another_option_6;
            $property_meta->save();
        }

        $current_time = new \DateTime();
        $property = new Property();
        $property->property_type = $property_type;
        $property->user_id = $user_details->id;
        $property->transaction_type = $transaction_type;
        $property->price = $price;
        $property->area = $area;
        $property->bedrooms = $bedrooms;
        $property->bathrooms = $bathrooms;
        $property->rooms = $rooms;
        $property->commercial_type = $commercial_type;
        $property->land_type = $land_type;
        $property->description = $description;
        $property->location = str_replace('/','-',$location);
        $property->longitude = $lng;
        $property->latitude = $lat;
        $property->image = $image_url;
        if($property_type != 4) {
            $property->meta_id = $property_meta->id;
        }
        $property->is_featured = $featured;
        $property->country = $country->id;
        $region_name = '';
        if($data_result['region'] != ''){
            $region_name = $data_result['region'];
        } else {
            $region_name = $data_result['city'];
        }

        if($region_name != 'Not found'){
            $property->region = $region_name;
        }

        $state = $data_result['city'];
        $state_object = States::find()
            ->where(['name' => $state])
            ->one();
        if($state_object){
            $property->city = $state_object->id;
        }
        $property->create_datetime = $current_time->format('Y-m-d H:i:s');

        $response = array();
        if ($property->save()) {
            $property_id = $property->id;
            $response['status'] = 'success';
            $response['message'] = 'Your property submitted successfully. Thank you.';
            $response['property_id'] = base64_encode(urlencode($property_id));
            echo json_encode($response);
            return;
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Unsuccessful';
            echo json_encode($response);
        }
    }

    /**
     * Display update property
     * @param $property_id
     * @return string|\yii\web\Response
     */
    public function actionUpdateproperty($property_id){
        $user_details = Generic::checkUserDetails();
        if(!$user_details){
            Yii::$app->session->setFlash('error','Please login first');
            return $this->redirect(Yii::$app->urlManager->createUrl(['/']));
        }
        $property_details = Generic::getPropertyfromid($property_id);
        $images = json_decode($property_details['image']);
        $image_file = ','.implode(',',$images);
        $property_meta = Generic::getPropertyMetaFromMetaId($property_details['meta_id']);
        return $this->render('update-property',array(
            'property_details' => $property_details,
            'images' => $images,
            'image_file' => $image_file,
            'property_id' => $property_id,
            'property_meta' => $property_meta
        ));
    }

    /**
     * Property Update
     * @throws \Exception
     * @throws \Throwable
     */
    public function actionEditproperty(){
        $user_details = Generic::checkUserDetails();

        $region_token = Yii::$app->session->get('region_token');
        $user_helper = new UserHelper();
        $country = $user_helper->getUserCountry($region_token);

        $property_id = Yii::$app->request->post('property_id');
        $meta_id = Yii::$app->request->post('meta_id');
        $property_type = Yii::$app->request->post('property_type');
        $transaction_type = Yii::$app->request->post('transaction_type');
        $price = Yii::$app->request->post('price');
        $area = Yii::$app->request->post('area');
        $bedrooms = Yii::$app->request->post('bedrooms');
        $bathrooms = Yii::$app->request->post('bathrooms');
        $rooms = Yii::$app->request->post('rooms');
        $commercial_type = Yii::$app->request->post('commercial_type');
        $land_type = Yii::$app->request->post('land_type');
        $description = Yii::$app->request->post('description');
        $location = Yii::$app->request->post('geocomplete');
        $lng = Yii::$app->request->post('lng');
        $lat = Yii::$app->request->post('lat');
        $air_condition = Yii::$app->request->post('air_condition');
        $internet = Yii::$app->request->post('internet');
        $cable_tv = Yii::$app->request->post('cable_tv');
        $balcony = Yii::$app->request->post('balcony');
        $roof_terrace = Yii::$app->request->post('roof_terrace');
        $terrace = Yii::$app->request->post('terrace');
        $lift = Yii::$app->request->post('lift');
        $garage = Yii::$app->request->post('garage');
        $security = Yii::$app->request->post('security');
        $high_standard = Yii::$app->request->post('high_standard');
        $city_center = Yii::$app->request->post('city_center');
        $furniture = Yii::$app->request->post('furniture');
        $another_option_1 = Yii::$app->request->post('another_option_1');
        $another_option_2 = Yii::$app->request->post('another_option_2');
        $another_option_3 = Yii::$app->request->post('another_option_3');
        $another_option_4 = Yii::$app->request->post('another_option_4');
        $another_option_5 = Yii::$app->request->post('another_option_5');
        $another_option_6 = Yii::$app->request->post('another_option_6');
        $featured = Yii::$app->request->post('featured',0);
        $image_urls = Yii::$app->request->post('image_file');
        $image_urls_array = explode(',',substr($image_urls, 1));
        $image_url = json_encode($image_urls_array);


        $data_result = Generic::getRegionAndCity($lat,$lng);
        if($location == ''){
            $location = $data_result['city'].', '.$data_result['state'].', '.$data_result['country'];
            if($data_result['region'] != ''){
                $location = $data_result['region'].', '.$location;
            }
        }

        if($property_type != 4) {
            $property_meta = PropertyMeta::findOne($meta_id);
            $property_meta->air_conditioning = $air_condition;
            $property_meta->internet = $internet;
            $property_meta->cable_tv = $cable_tv;
            $property_meta->balcony = $balcony;
            $property_meta->roof_terrace = $roof_terrace;
            $property_meta->terrace = $terrace;
            $property_meta->lift = $lift;
            $property_meta->garage = $garage;
            $property_meta->security = $security;
            $property_meta->high_standard = $high_standard;
            $property_meta->city_center = $city_center;
            $property_meta->furniture = $furniture;
            $property_meta->custom_option_1 = $another_option_1;
            $property_meta->custom_option_2 = $another_option_2;
            $property_meta->custom_option_3 = $another_option_3;
            $property_meta->custom_option_4 = $another_option_4;
            $property_meta->custom_option_5 = $another_option_5;
            $property_meta->custom_option_6 = $another_option_6;
            $property_meta->update();
        }

        $current_time = new \DateTime();
        $property = Property::findOne($property_id);
        $property->property_type = $property_type;
        $property->user_id = $user_details->id;
        $property->transaction_type = $transaction_type;
        $property->price = $price;
        $property->area = $area;
        $property->bedrooms = $bedrooms;
        $property->bathrooms = $bathrooms;
        $property->rooms = $rooms;
        $property->commercial_type = $commercial_type;
        $property->land_type = $land_type;
        $property->description = $description;
        $property->location = $location;
        $property->longitude = $lng;
        $property->latitude = $lat;
        $property->image = $image_url;
        if($property_type != 4) {
            $property->meta_id = $meta_id;
        }
        $property->is_featured = $featured;
        $property->country = $country->id;
        $region_name = '';
        if($data_result['region'] != ''){
            $region_name = $data_result['region'];
        } else {
            $region_name = $data_result['city'];
        }

        if($region_name != 'Not found'){
            $property->region = $region_name;
        }

        $state = $data_result['state'];
        $state_object = States::find()
            ->where(['name' => $state])
            ->one();
        if($state_object){
            $property->city = $state_object->id;
        }
        $property->create_datetime = $current_time->format('Y-m-d H:i:s');

        $response = array();
        if ($property->update()) {
            $response['status'] = 'success';
            $response['message'] = 'Your property Updated successfully. Thank you.';
            echo json_encode($response);
            return;
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Unsuccessful';
            echo json_encode($response);
        }
    }

    /**
     * Delete property
     */
    public function actionDeleteproperty(){
        $response = array();
        $id = Yii::$app->request->get('id');
        $property_details = Generic::getPropertyfromid($id);
        if(!empty($property_details['meta_id'])) {
            Generic::deletePropertyMeta($property_details['meta_id']);
        }
        Generic::deleteProperty($id);
        $response['status'] = 'success';
        $response['message'] = 'Your property Deleted successfully. Thank you.';
        echo json_encode($response);
    }

    /**
     * Mark property as featured
     */
    public function actionMakefeaturedproperty(){
        $response = array();
        $message = '';
        $feature_limit_exceed = 0;
        $user_helper = new UserHelper();
        $user_details = Generic::checkUserDetails();
        $plan_id = $user_helper->getSubscribedPlan($user_details->id);
        $subscribed_plan = $user_helper->getPlanDetails($plan_id);
        $number_of_featured_property = $user_helper->getAllFeaturedPropertiesOfUser($user_details->id);
        $featured_status = 0;
        $id = Yii::$app->request->get('id');
        $property = Property::find()->where(['id' => $id])->one();
        if($property->is_featured == 1){
            $property->is_featured = 0;
            $message = 'property removed successfully from featured list';
        } else {
            if($subscribed_plan->featured_property == 0){
                $feature_limit_exceed = 1;
                $message = 'You can not mark property as featured in free package. Consider to upgrade';
            } else if(count($number_of_featured_property) >= $subscribed_plan->featured_property){
                $feature_limit_exceed = 1;
                $message = 'You have reached to maximum for this package. Consider to upgrade';
            } else {
                $property->is_featured = 1;
                $featured_status = 1;
                $message = 'property marked as featured successfully';
            }
        }
        if($feature_limit_exceed){
            $response['status'] = 'error';
            $response['message'] = $message;
            echo json_encode($response);
        } else {
            $property->update();
            $response['status'] = 'success';
            $response['featured_status'] = $featured_status;
            $response['message'] = $message;
            echo json_encode($response);
        }

    }
}
