<?php

namespace app\controllers;

use app\helpers\UserHelper;
use app\models\Company;
use app\models\Saler_info;
use app\models\SocialLinks;
use app\models\User;
use app\models\PlanConfig;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\components\Generic;
use app\components\S3;

class ProfileController extends Controller
{
    /*
     * shows the listings of an agent/owner
     */
    public function actionMyoffer()
    {
        $user_details = Generic::checkUserDetails();
        $user_helper = new UserHelper();
        if(!$user_details){
            Yii::$app->session->setFlash('error','Please login first');
            return $this->redirect(Yii::$app->urlManager->createUrl(['/']));
        }
        if($user_details->address == '' || $user_details->date_of_birth == ''){
        Yii::$app->session->setFlash('success-container','Please complete your profile first i.e date of birth, address etc.');
        return $this->redirect(Yii::$app->urlManager->createUrl(['/my-profile']));
    }
        if(Yii::$app->request->get('filter'))
            $user_property = Generic::getPropertyfromUserId($user_details->id,Yii::$app->request->get('filter'));

        else $user_property = Generic::getPropertyfromUserId($user_details->id);

        $subscription = $user_helper->checkUserSubscription($user_details);
        $packages = PlanConfig::find()->all();
        if($subscription) {
            return $this->render('my-offer', array(
                'user_property' => $user_property,
                'user_details' => $user_details
            ));
        }
        else {
            return $this->render('/profile/package-selection', ['packages' => $packages,'user_details' => $user_details]);
        }
    }

    /*
     * shows profile of an agent/owner
     */
    public function actionMyprofile()
    {
        $user_details = Generic::checkUserDetails();
        if(!$user_details){
            Yii::$app->session->setFlash('error','Please login first');
            return $this->redirect(Yii::$app->urlManager->createUrl(['/']));
        }
        $company_details = Company::find()->where(['id' => $user_details->company])->one();
        return $this->render('my-profile',array(
            'user_details' => $user_details,
            'company' => $company_details
        ));
    }

    /*
     * activate an user from activation sent to email
     */
    public function actionActivateuser(){
        $token = Yii::$app->request->get('token');
        if(!$token){
            Yii::$app->session->setFlash('error','Invalid Request');
            return $this->redirect(Yii::$app->urlManager->createUrl(['/']));
        }
        $decrypted_token = json_decode(base64_decode($token));
        $user_id = $decrypted_token->user_id;
        $user_helper = new UserHelper();
        if(!$user = $user_helper->findUserById($user_id)){
            Yii::$app->session->setFlash('error','No such user in the system');
            return $this->redirect(Yii::$app->urlManager->createUrl(['/']));
        }
        $user_status = $decrypted_token->status;
        if($user_status){
            Yii::$app->session->setFlash('error','User already activated in the system');
            return $this->redirect(Yii::$app->urlManager->createUrl(['/']));
        }
        $user->status = 1;
        $user->update();

        Yii::$app->session->setFlash('success-container','Account has been activated successfully');
        Yii::$app->session->set('user_token',base64_encode(json_encode(['user_id' => $user->id])));
        return $this->redirect(Yii::$app->urlManager->createUrl(['/my-profile']));
    }

    /*
     * Update my profile section
     */
    public function actionUpdateprofile(){
        $user_details = Generic::checkUserDetails();
        $name = Yii::$app->request->post('full_name');
        $email = Yii::$app->request->post('email');
        $phone = Yii::$app->request->post('phone');
        $mobile = Yii::$app->request->post('mobile');
        $address = Yii::$app->request->post('address');
        $date_of_birth = Yii::$app->request->post('date_of_birth');
        $description = Yii::$app->request->post('description');
        $about_us = Yii::$app->request->post('about_us');
        $website_url = Yii::$app->request->post('website_url');

        $facebook = Yii::$app->request->post('facebook');
        $gplus = Yii::$app->request->post('gplus');
        $twitter = Yii::$app->request->post('twitter');
        $skype = Yii::$app->request->post('skype');

        $current_time = new \DateTime();

        if($user_details->social_link){
            $social_links = SocialLinks::findOne($user_details->social_link);
        } else {
            $social_links = new SocialLinks();
        }
        $social_links->facebook_url = $facebook;
        $social_links->google_url = $gplus;
        $social_links->twitter_url = $twitter;
        $social_links->skype_url = $skype;
        $social_links->update_datetime = $current_time->format('Y-m-d H:i:s');

        if($user_details->user_type == 2){
            $company_details = Company::find()->where(['id' => $user_details->company])->one();
            $company_details->name = Yii::$app->request->post('company_name','');
            $company_details->location = Yii::$app->request->post('geocomplete','');
            $company_details->latitude = Yii::$app->request->post('lat','');
            $company_details->longitude = Yii::$app->request->post('lng','');
            $company_details->description = $about_us;
            $company_details->update();
        }

        if($social_links->save()){
            $user = User::findOne($user_details->id);
            $user->name = $name;
            $user->email = $email;
            $user->phone = $phone;
            $user->phone2 = $mobile;
            $user->address = $address;
            $user->date_of_birth = $date_of_birth;
            $user->description = $description;
            $user->about_us = $about_us;
            $user->social_link = $social_links->id;
            $user->website_url = $website_url;
            $user->update_datetime = $current_time->format('Y-m-d H:i:s');

            $response = array();
            if ($user->update()) {
                if($user->address != '' && $user->date_of_birth != ''){
                    Generic::sendRegistrationPaper($user);
                }
                $response['status'] = 'success';
                $response['message'] = 'Your profile updated successfully. Thank you.';
                echo json_encode($response);
                return;
            } else {
                $response['status'] = 'error';
                $response['message'] = 'profile update Unsuccessful';
                echo json_encode($response);
            }
        }
    }

    /*
     * change profile image
     */
    public function actionChangeagentimage(){
        $user_details = Generic::checkUserDetails();
        $model = User::findOne($user_details->id);
        $temp_name = $_FILES['agent-photo']['tmp_name'];
        $info = getimagesize($temp_name);
        $extension = image_type_to_extension($info[2]);
        $imageName = time() + 1;
        $newName = $imageName.$extension;

        if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAIRWFUJGOJ46XGJYA');
        if (!defined('awsSecretKey')) define('awsSecretKey', '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');
        $s3 = new S3(awsAccessKey, awsSecretKey);

        if($imageSaveName = $s3->putObjectFile($temp_name,"lanoyo-property",$newName,S3::ACL_PUBLIC_READ)) {
            $model->photo = "http://lanoyo-property.s3.amazonaws.com/".$newName;
        }
        if($model->update())
            $this->redirect(Yii::$app->urlManager->createUrl('my-profile'));
    }

    /*
     * change Company logo
     */
    public function actionChangecompanyimage(){
        $user_details = Generic::checkUserDetails();
        $model = User::findOne($user_details->id);
        $company_details = Company::find()->where(['id' => $user_details->company])->one();
        $temp_name = $_FILES['company-logo']['tmp_name'];
        $info = getimagesize($temp_name);
        $extension = image_type_to_extension($info[2]);
        $imageName = time() + 1;
        $newName = $imageName.$extension;

        if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAIRWFUJGOJ46XGJYA');
        if (!defined('awsSecretKey')) define('awsSecretKey', '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');
        $s3 = new S3(awsAccessKey, awsSecretKey);

        if($imageSaveName = $s3->putObjectFile($temp_name,"lanoyo-property",$newName,S3::ACL_PUBLIC_READ)) {
            $company_details->logo = "http://lanoyo-property.s3.amazonaws.com/".$newName;
        }
        if($company_details->update())
            $this->redirect(Yii::$app->urlManager->createUrl('my-profile'));
    }

    /*
     * choose payment method
     */
    public function actionSelectpayment(){
        $user_details = Generic::checkUserDetails();
        if(!$user_details){
            Yii::$app->session->setFlash('error','Please login first');
            return $this->redirect(Yii::$app->urlManager->createUrl(['/price-plan']));
        }
        $user_helper = new UserHelper();
        $subscription = $user_helper->checkUserSubscription($user_details);
//        if($subscription){
//            Yii::$app->session->setFlash('success','You have already choose a package');
//            return $this->redirect(Yii::$app->urlManager->createUrl(['/price-plan']));
//        }
        $plan_id = Yii::$app->request->post('package_id');
        $chosen_plan = PlanConfig::find()
            ->where(['id' => $plan_id])
            ->one();
        if($chosen_plan->price == 0){
            $user_helper->createSubscriptionForUser($user_details->id,$plan_id,1);
            return $this->render('transaction-success', array(
                'user_details' => $user_details
            ));
        }
        return $this->render('payment-selection',['plan' => $plan_id,'user_details' => $user_details,'plan_details' => $chosen_plan]);
    }

    /*
     * processes credit card payment
     */
    public function actionPaymentprocessor(){

    }

    /*
     * successful transaction status show
     */
    public function actionTransactionstatus(){
        $user_details = Generic::checkUserDetails();
        $user_helper = new UserHelper();

        $plan_id = Yii::$app->request->post('plan_id','');
        $payment_id = Yii::$app->request->post('payment','');

        $seller_id = Yii::$app->request->post('seller_id','');
        $deposit_amount = Yii::$app->request->post('advanced_payment','');

        $chosen_plan = PlanConfig::find()
            ->where(['id' => $plan_id])
            ->one();

        $existing_seller = Saler_info::find()
            ->where(['saler_id' => $seller_id])
            ->one();

        $payment_status = 'failure';
        $failure_reason = '';

        $payment_details = '';
        $success_indicator = '';
        $order_id = '';
        if(isset(Yii::$app->session['orderID'])) {
            $order_id = Yii::$app->session['orderID'];
            $payment_id = 1;
        }
        if($payment_id == 3 && $existing_seller){
            $user_helper->createSubscriptionForUser($user_details->id,$plan_id,$status = 1);
            $payment_details = $user_helper->createTransactionRecord($user_details->id,$payment_id,$plan_id,1,$seller_id);
            Generic::sendInvoice($user_details->id,$payment_details,$chosen_plan);
            $payment_status = 'success';
        } else if($payment_id == 1){
            /* Todo: credit card payment actions will go here */
            $result_indicator = Yii::$app->request->get('resultIndicator');
            $success_indicator = Yii::$app->session['successIndicator'];

            if(strcmp($result_indicator, $success_indicator) == 0){
                $payment_status = 'success';


            }

            unset(Yii::app()->session['successIndicator']);
            unset(Yii::app()->session['orderID']);
            unset(Yii::app()->session['registered_user_data']);
            unset(Yii::app()->session['ad_post_service']);
            unset(Yii::app()->session['pricing_plan_id']);

        } else if($payment_id == 2){

            $uploaded_bank_receipt = '';
            if(isset($_FILES['bank_receipt'])){
                $imageName = time() + 1;
                if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAIRWFUJGOJ46XGJYA');
                if (!defined('awsSecretKey')) define('awsSecretKey', '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');
                $s3 = new S3(awsAccessKey, awsSecretKey);
                $image_type = explode('.',$_FILES['bank_receipt']['name']);
                $image = $_FILES['bank_receipt']['tmp_name'];

                $image_name = $imageName.".".$image_type[1];


                if($imageSaveName = $s3->putObjectFile($image,"lanoyo-property",$image_name,S3::ACL_PUBLIC_READ)){
                    $uploaded_bank_receipt = "http://lanoyo-property.s3.amazonaws.com/".$image_name;
                }
            }
            $user_helper->createSubscriptionForUser($user_details->id,$plan_id);
            $payment_details = $user_helper->createTransactionRecord($user_details->id,$payment_id,$plan_id,$status = 0,"",$uploaded_bank_receipt);
            Generic::sendInvoice($user_details->id,$payment_details,$chosen_plan);
            $payment_status = 'success';
        }

        if(!$existing_seller){
            $failure_reason = 'Seller Id did not match';
        }

        if($payment_status == 'success') {
            return $this->render('transaction-success', array(
                'user_details' => $user_details,
                'payment_details' => $payment_details
            ));
        } else {
            return $this->render('transaction-failure', array(
                'user_details' => $user_details,
                'payment_details' => $payment_details,
                'failure_message' => $failure_reason
            ));
        }
    }

    /*
     * successful transaction status show
     */
    public function actionTransactionfailure(){

    }

    /*
     * successful transaction status show
     */
    public function actionTransactioncancel(){

    }

    /*
     * subscription upgrade action
     */
    public function actionUpgradesubscription(){
        $user_details = Generic::checkUserDetails();
        $packages = PlanConfig::find()->all();
        $user_helper = new UserHelper();
        $chosen_plan_id = $user_helper->getSubscribedPlan($user_details->id);
        if(!$chosen_plan_id){
            return $this->render('/profile/package-selection', ['packages' => $packages,'user_details' => $user_details]);
        }
        $chosen_plan = $user_helper->getPlanDetails($chosen_plan_id);
        return $this->render('/profile/package-selection', ['packages' => $packages,'user_details' => $user_details,'chosen_plan' => $chosen_plan]);
    }

    public function actionSuccess(){
        $property_id = urldecode(base64_decode(Yii::$app->request->get('property_id')));
        $property_details = Generic::getPropertyfromid($property_id);
        $property_link = Generic::propertyType($property_details['property_type']);
        //$property_link = 'apartment';
        $user_details = Generic::checkUserDetails();
        return $this->render('property-success',array(
            'user_details' => $user_details,
            'property' => $property_link
        ));
    }

}