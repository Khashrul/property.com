<?php

namespace app\helpers;

use app\components\Generic;
use app\models\Company;
use app\models\Countries;
use app\models\PlanConfig;
use app\models\Property;
use app\models\Transaction;
use app\models\UserSubscription;
Use app\models\SocialLinks;
use Yii;
use yii\base\Model;
use app\models\User;

class UserHelper extends Model
{
    private $model,$social_link;

    public function __construct(){
        $this->model = new User();
        $this->social_link = new SocialLinks();
        parent::__construct();
    }

    /**
     * Find User details by user id
     *
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     */
    public function findUserById($id){
        return $this->model->find()
            ->where(['id' => $id])
            ->one();
    }

    /*
     * Find user details by email
     *
     * @param string $email
     * @return array|null|yii\db\ActiveRecord
     */
    public function findUserByEmail($email){
        return $this->model->find()
                ->where(['email' => $email])
                ->one();
    }

    /*
     * Find user details by phone
     *
     * @param string $phone
     * @return array|null|yii\db\ActiveRecord
     */
    public function findUserByPhone($phone){
        return $this->model->find()
            ->where(['email' => $phone])
            ->one();
    }


    /**
     * Find User social details from tbl_social_links
     *
     * @param $id [social_link @tbl_user]
     * @return array|null|\yii\db\ActiveRecord
     */
    public function findUserSocials($id){
        return $this->social_link->find()
            ->where(['id' => $id])
            ->one();
    }

    /**
     * Validates the user.
     * This method serves as the inline validation for user.
     *
     * @param string $email
     * @return true/false
     */
    public function validateUser($phone,$password)
    {
        if ($hash = User::finduser($phone)) {
            if(password_verify($password, $hash)){
                return User::finduserid($phone);
            }
            else{
                #incorrect password
                return 'incorrect_pass';
            }
        }
        else{
            #user not found !
            return 'user_not_found';
        }
    }

    /*
     * get country of user
     * @param mixed region_token
     * @return Country
     */
    public function getUserCountry($region_token){
        return Countries::find()
            ->where(['md5(sortname)' => $region_token])
            ->one();
    }

    /*
     * check whether user is subscribed or not
     */
    public function checkUserSubscription($user){
        $user_subscription = UserSubscription::find()
            ->where(['user_id' => $user->id])
            ->one();
        if($user_subscription)
            return true;
        else
            return false;
    }

    /*
     * create user subscription
     */
    public function createSubscriptionForUser($user_id,$plan_id,$status = 0){
        $current_datetime = new \DateTime();
        $expire_datetime = new \DateTime();
        $plan_details = PlanConfig::find()->where(['id' => $plan_id])->one();
        $subscription = UserSubscription::find()->where(['user_id' => $user_id])->one();
        if(!$subscription){
            $subscription = new UserSubscription();
        }

        $subscription->user_id = $user_id;
        $subscription->plan_id = $plan_id;
        if($status){
            $subscription->status = $status;
            $expire_datetime->modify($plan_details->duration);
            $subscription->expire_datetime = $expire_datetime->format('Y-m-d H:i:s');
        }
        $subscription->create_datetime = $current_datetime->format('Y-m-d H:i:s');
        $subscription->save();
        return true;
    }

    /*
     * create transactional record
     */
    public function createTransactionRecord($user_id,$payment_id,$plan_id,$payment_status = 1, $seller_id='',$bank_receipt = ''){
        $chosen_plan = PlanConfig::find()
                        ->where(['id' => $plan_id])
                        ->one();
        $current_time = new \DateTime();
        $expire_time = new \DateTime();
        $expire_time->modify('1 month');
        $transaction = new Transaction();
        $transaction->user_id = $user_id;
        $transaction->payment_method = $payment_id;
        $transaction->payment_amount = $chosen_plan->price;
        $transaction->payment_status = $payment_status;
        $transaction->order_id = (string)$current_time->getTimestamp();
        if($seller_id){
            $transaction->saler_id = $seller_id;
        }
        if($bank_receipt){
            $transaction->bank_receipt = $bank_receipt;
        }
        $transaction->transaction_datetime = $current_time->format('Y-m-d H:i:s');
        $transaction->create_datetime = $current_time->format('Y-m-d H:i:s');
        $transaction->save();

        return $transaction;
    }

    /*
     * get all companies
     */
    public function getCompanies(){
        $companies = Company::find()
                        ->orderBy(['id' => SORT_DESC])
                        ->all();
        return $companies;
    }

    /*
     * get agency details from agency_id
     */
    public function getCompany($agency_id){
        return Company::find()->where(['id' =>$agency_id])->one();
    }

    /*
     * get all offers of an agency
     */
    public function getAgencyOffers($agency_id){
        return Property::find()->where(['user_id' => $agency_id])->orderBy(['id' => SORT_DESC])->all();
    }

    public function getSubscribedPlan($user_id){
        $subscription = UserSubscription::find()
                ->where(['user_id' => $user_id])
                ->one();
        return $subscription ? $subscription->plan_id : '';
    }

    public function getPlanDetails($plan_id){
        return PlanConfig::find()->where(['id' => $plan_id])->one();
    }

    /*
     * get all properties of an user
     */
    public function getAllPropertiesOfUser($user_id){
        return Property::find()->where(['user_id' => $user_id])->orderBy(['id' => SORT_DESC])->all();
    }

    /*
     * get all properties of an user
     */
    public function getAllFeaturedPropertiesOfUser($user_id){
        return Property::find()->where(['user_id' => $user_id,'is_featured' => 1])->orderBy(['id' => SORT_DESC])->all();
    }

    /*
     * get agent information from company id
     */
    public function getAgentInformationFromCompanyId($company_id){
        return User::find()->where(['company' => $company_id])->one();
    }
}
