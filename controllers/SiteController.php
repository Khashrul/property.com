<?php

namespace app\controllers;

use app\components\S3;
use app\components\Uploader;
use app\helpers\ImageHelper;
use app\models\Company;
use app\models\Countries;
use app\models\SocialLinks;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\components\Generic;
use app\helpers\UserHelper;
use app\helpers\SearchHelper;
use app\helpers\CountryCityHelper;
use app\helpers\MessageHelper;
use app\helpers\ReportHelper;
use app\models\PlanConfig;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        Generic::determineCountry();
        $all_property = Generic::getAllProperty();
        $all_agency = Generic::getAllAgency();
        $featured_property = Generic::getFeaturedProperty();

        $image_helper = new ImageHelper();
        $featured_property_image_size = ["width" => 360, "height" => 269, "crop" => "fill", "gravity" => "center", "radius" => 0,"fetch_format" => "jpg"];
        $agent_image_size = ["width" => 263, "height" => 323, "crop" => "fill", "gravity" => "center", "radius" => 0,"fetch_format" => "jpg"];
        $new_property_image_size = ["width" => 262, "height" => 180, "crop" => "fill", "gravity" => "center", "radius" => 0,"fetch_format" => "jpg"];

        $region_token = Yii::$app->session->get('region_token');
        $user_helper = new UserHelper();
        $country = $user_helper->getUserCountry($region_token);

        $data = new CountryCityHelper();
        $cities = $data->getCity($country->id);

        return $this->render('index',array(
            'all_property' => $all_property,
            'all_agency' => $all_agency,
            'featured_property' => $featured_property,
            'country' => $country,
            'cities' => $cities,
            'image_helper' => $image_helper,
            'featured_image_size' => $featured_property_image_size,
            'agent_image_size' => $agent_image_size,
            'new_property_image_size' => $new_property_image_size
        ));
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Renders Contact Us Page
     */
    public function actionContactus() {
        return $this->render('contact-us');
    }

    /**
	 * Receives feedback (contact-us)
	 */
    public function actionReceivefeedback(){
        #requests
        $request = Yii::$app->request;

        #params
        $to = Yii::$app->params['adminEmail'];

        #values
        $subject = "Feedback";
        $from = $request->post('email');
        $name = $request->post('name');
        $phone = $request->post('phone');
        $msg = $request->post('msg');

        #headers
        $header = "From: ".$name." <".$from.">\r\n";
        $header .= "Reply-To: ".$from."\r\n";
        $message = "Name : $name \nEmail : $from \nPhone : $phone \n\n";
        $message .= "<p align='justify'>".$msg."</p>";

        if(!empty($from) || !empty($name) || !empty($phone) || !empty($msg)){
            $mailed = @mail($to,$subject,$message,$header);
            if($mailed){
                #setting response
                $response['status'] = 'success';
                $response['message'] = 'Thank you for your feedback!';
            }
            else{
                #setting response
                $response['status'] = 'failure';
                $response['message'] = 'Something went wrong!';
            }
        }
        else{
            #setting response
            $response['status'] = 'empty';
            $response['message'] = 'Please Fill The Necessary Fields!';
        }
        echo json_encode($response);
    }

    /*
     * Display property details
     * @param property type, property alias(property id + property location)
     */
    public function actionPropertydetails($property_type,$property_alias)
    {
        $property_id = explode("-",$property_alias)[0];
        $property_details = Generic::getPropertyfromid($property_id);
        $property_meta = Generic::getPropertyMetaFromMetaId($property_details['meta_id']);
        $images = json_decode($property_details['image']);
        $featured = Generic::getFeaturedProperty();
        $featured_property = array_slice($featured, 0, 6);
        $all_property = Generic::getAllProperty();
        Generic::viewCount($property_id);

        $user = new UserHelper();
        $agent = $user->findUserById($property_details['user_id']);
        $social_link = $user->findUserSocials($agent->social_link);

        return $this->render('property-details',array(
            'property_details' => $property_details,
            'property_meta' => $property_meta,
            'images' => $images,
            'featured_property' => $featured_property,
            'all_property' => $all_property,
            'agent' => $agent,
            'social_link' => $social_link,
        ));
    }


    /*
     * Display listing grid view of property
     * @param property type
     */
    public function actionListinggridproperty($property_type)
    {
        $region_token = Yii::$app->session->get('region_token');
        $user_helper = new UserHelper();
        $country = $user_helper->getUserCountry($region_token);

        $transaction = Yii::$app->request->get('transaction');

        $data = new CountryCityHelper();
        $cities = $data->getCity($country->id);

        $all_property = '';
        if($property_type == "apartment") {
            $all_property = Generic::getApartmentProperty($transaction);
        } elseif($property_type == "house"){
            $all_property = Generic::getHouseProperty($transaction);
        } elseif($property_type == "commercial"){
            $all_property = Generic::getCommercialProperty($transaction);
        } elseif($property_type == "land"){
            $all_property = Generic::getLandProperty($transaction);
        }
        return $this->render('listing-grid-property',array(
            'all_property' => $all_property,
            'property_type' => $property_type,
            'country' => $country,
            'cities' => $cities
        ));
    }

    /*
     * Display listing list view of property
     * @param property type
     */
    public function actionListinglistproperty($property_type)
    {
        $region_token = Yii::$app->session->get('region_token');
        $user_helper = new UserHelper();
        $country = $user_helper->getUserCountry($region_token);

        $data = new CountryCityHelper();
        $cities = $data->getCity($country->id);

        $all_property = '';
        if($property_type == "apartment") {
            $all_property = Generic::getApartmentProperty();
        } elseif($property_type == "house"){
            $all_property = Generic::getHouseProperty();
        } elseif($property_type == "commercial"){
            $all_property = Generic::getCommercialProperty();
        } elseif($property_type == "land"){
            $all_property = Generic::getLandProperty();
        }
        return $this->render('listing-list-property',array(
            'all_property' => $all_property,
            'property_type' => $property_type,
            'country' => $country,
            'cities' => $cities
        ));
    }


    /*
     * Display Filtered grid view of property
     * @param property type
     */
    public function actionFiltergridproperty(){
        $region_token = Yii::$app->session->get('region_token');
        $user_helper = new UserHelper();
        $country = $user_helper->getUserCountry($region_token);

        $data = new CountryCityHelper();
        $cities = $data->getCity($country->id);

        $request = Yii::$app->request;
        $type = $request->get('property_type');
        $filter = $request->get('filter');
        $all_property = '';

        if($type == "apartment") {
            $all_property = Generic::getApartmentProperty($filter);
        } elseif($type == "house"){
            $all_property = Generic::getHouseProperty($filter);
        } elseif($type == "commercial"){
            $all_property = Generic::getCommercialProperty($filter);
        } else{
            $all_property = Generic::getLandProperty($filter);
        }

        return $this->render('listing-grid-property',array(
            'all_property' => $all_property,
            'property_type' => $type,
            'country' => $country,
            'cities' => $cities
        ));
    }

    /*
     * Display Filtered list view of property
     * @param property type
     */
    public function actionFilterlistproperty(){
        $region_token = Yii::$app->session->get('region_token');
        $user_helper = new UserHelper();
        $country = $user_helper->getUserCountry($region_token);

        $data = new CountryCityHelper();
        $cities = $data->getCity($country->id);

        $request = Yii::$app->request;
        $type = $request->get('property_type');
        $filter = $request->get('filter');

        $all_property = '';
        if($type == "apartment") {
            $all_property = Generic::getApartmentProperty($filter);
        } elseif($type == "house"){
            $all_property = Generic::getHouseProperty($filter);
        } elseif($type == "commercial"){
            $all_property = Generic::getCommercialProperty($filter);
        } else{
            $all_property = Generic::getLandProperty($filter);
        }
        return $this->render('listing-list-property',array(
            'all_property' => $all_property,
            'property_type' => $type,
            'country' => $country,
            'cities' => $cities
        ));
    }

    /*
     * Display agency details
     */
    public function actionAgencydetails($agency_id)
    {
        $user_helper = new UserHelper();
        $agency = $user_helper->getCompany($agency_id);
        $agent_information = $user_helper->getAgentInformationFromCompanyId($agency_id);
        $agency_offers = $user_helper->getAgencyOffers($agent_information->id);
        $featured_property = Generic::getFeaturedProperty();
        return $this->render('agency-details',[
            'agency' => $agency,
            'agency_offers' => $agency_offers,
            'featured_property' => $featured_property,
            'agent_information' => $agent_information
        ]);
    }

    /*
     * Display agency list page
     */
    public function actionAgencieslisting()
    {
        $user_helper = new UserHelper();
        $companies = $user_helper->getCompanies();
        $featured_property = Generic::getFeaturedProperty();
        return $this->render('agencies-listing',['agencies' => $companies, 'featured_property' => $featured_property]);
    }

    /*
     * register new user
     */
    public function actionRegister(){

        $region_token = Yii::$app->session->get('region_token');
        $user_helper = new UserHelper();
        $country = $user_helper->getUserCountry($region_token);
        $name = Yii::$app->request->post('first-name');
        $phone = Yii::$app->request->post('phone');
        $password = Yii::$app->request->post('password');
        $repeat_password = Yii::$app->request->post('repeat-password');
//        $phone = Yii::$app->request->post('phone');
//        $phone_temp = Yii::$app->request->post('phone_number_personal_hidden');
        $user_type = Yii::$app->request->post('user_type');

        if(trim($phone) == ''){
            $response['status'] = 'error';
            $response['message'] = 'Phone field should not be blank';
            echo json_encode($response);
            return;
        }


        if(strcmp(trim($password),trim($repeat_password))){
            $response['status'] = 'error';
            $response['message'] = 'password did not match';
            echo json_encode($response);
            return;
        }
        if($user_helper->findUserByPhone($phone)){
            $response['status'] = 'error';
            $response['message'] = 'Phone number already exists';
            echo json_encode($response);
            return;
        }

        $current_time = new \DateTime();

        $social_link = new SocialLinks();
        $social_link->create_datetime = $current_time->format('Y-m-d H:i:s');
        $social_link->save();
        $company = new Company();
        if($user_type == 2){
            $company = new Company();
            $company->email = '';
            $company->phone1 = $phone;
            $company->save();
        }

        $user = new User();
        $user->name = $name;
        $user->email = '';
        $user->password = Yii::$app->security->generatePasswordHash($password);
        $user->phone = $phone;
        $user->user_type = $user_type;
        $user->social_link = $social_link->id;
        $user->country = $country->id;
        $user->create_datetime = $current_time->format('Y-m-d H:i:s');
        $user->status = 1;
        if($user_type == 2){
            $user->company = $company->id;
        }

        if($user->save()){
            $activation_link = Url::toRoute(['my-profile']);
            //$message_body = 'Thanks for your registration. Please click on the link below to activate your account.<br/><br/><a href="'.$activation_link.'">Activate Account</a>';
            $message_body = '
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <style type="text/css">
         .wrapper{
            border: solid 1px #979797;
            border-radius: 5px;
            width: 600px;
            margin: 0 auto;
            padding: 1px;
         }
         .message_text{
            border-top:solid 1px #3797dd;
            padding: 25px 10px 5px 10px;
            font-family: helvetica;
            line-height: 26px;
            margin-top: 0px;
         }
         .activation_link {
            background-color: #BF202F;
            padding: 15px 25px 15px;
            text-decoration: none;
            border-radius: 6px;
            color: #fff;
            font-size: 16px;
            font-family: helvetica;
         }

        .header{
            background:url("http://lanoyo-property.s3.amazonaws.com/1497855416.jpg") no-repeat;
            background-size: 100%;
            padding:65px 0;
        }
        .footer{
            background:#333333;
            color: #fff;
            padding:15px 30px;
         font-family: arial;
        }
        .footer a{
            color: #3797dd;
            text-decoration: none;
        }
      </style>
   </head>
   <body>
<div class="wrapper">
<div class="header">
<table width="100%" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="header">
   <tbody>
      <tr>
         <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                           <tbody>
                              <!-- Spacing -->
                              <tr>
                                 <td width="100%" height="10"></td>
                              </tr>
                              <!-- Spacing -->
                              <tr>
                                 <td>
                                    <!-- logo -->
                                    <table width="100%" align="left" border="0" cellpadding="0" cellspacing="0" class="devicewidth">
                                       <tbody>
                                          <tr>
                                             <td align="center">
                                                <div class="imgpop">
                                                   <a target="_blank" href="#">
                                                   <img src="http://lanoyo-property.s3.amazonaws.com/1497851725.png" alt="" border="0" style="border:none; outline:none; text-decoration:none;">
                                                   </a>
                                                </div>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                    <!-- end of logo -->
                                 </td>
                              </tr>

                              <tr>
                                 <td width="100%" height="10"></td>
                              </tr>

                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
</div>

<table width="100%" bgcolor="#f7f7f7" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="full-text">
   <tbody>
      <tr>
         <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
                           <tbody>

                              <tr>
                                 <td>
                                    <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner">
                                       <tbody>


                                          <tr>
                                             <td width="100%" height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                                          </tr>

                                          <tr>
                                             <p class="message_text">
        Dear [username],<br>
        Thank you for registering with lanoyo.com. You can access your profile from the link below:<br>
                                             </p>
                                             <p style="text-align: center;">
                                                <a href="'.$activation_link.'" target="_blank" class="activation_link">My Profile</a>
                                             </p>
                                          </tr>

                                       </tbody>
                                    </table>
                                 </td>
                              </tr>

                              <tr>
                                 <td height="20" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                              </tr>

                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>

<table width="100%" bgcolor="#f7f7f7" cellpadding="0" cellspacing="0" border="0" id="backgroundTable">
   <tbody>
      <tr>
         <td>
            <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
               <tbody>
                  <tr>
                     <td width="100%">
                        <div class="footer">
                           <h3>Need Help?</h3>
                           <p>
        Please feel free to <a href="http://lanoyo.com/contact-us">contact</a> with us
        </p>
                           <p>
        Also stay connected:<br>
                           </p>
                           <p style="margin-bottom: 0px; text-align: center;">
                              <a href="https://www.facebook.com/Lanoyo.co" target="_blank"><img src="http://lanoyo-property.s3.amazonaws.com/1497859871.png" height="30"></a>
                              <a href="https://twitter.com/LanoyoOfficial" target="_blank"><img src="http://lanoyo-property.s3.amazonaws.com/1497859898.png" height="30"></a>
                              <a href="https://plus.google.com/u/0/116734664439452794849" target="_blank"><img src="http://lanoyo-property.s3.amazonaws.com/1497859920.png" height="30"></a>
                              <a href="https://www.instagram.com/Lanoyo.co" target="_blank"><img src="http://lanoyo-property.s3.amazonaws.com/1497859940.png" height="30"></a>
                           </p>
                        </div>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>
 </div>

   </body>
   </html>';
            $message_body = str_replace('[username]',$user->name,$message_body);
            Generic::sendMail($message_body,'User account activation on lanoyo.com',$user->email);
            $response['status'] = 'success';
            $response['message'] = 'An activation link has been sent to your mail.';
            Yii::$app->session->set('user_token',base64_encode(json_encode(['user_id' => $user->id])));
            Yii::trace('User login successful and token set', __METHOD__);
            Yii::$app->session->setFlash('success-container','Logged In Successfully');
            echo json_encode($response);
            return;
        } else {
            $response['status'] = 'error';
            $response['message'] = 'registration not successful';
            echo json_encode($response);
        }

    }

    /*
     * verify an user login
     */
    public function actionVerifylogin(){
        $password = Yii::$app->request->post('password');
        $phone = Yii::$app->request->post('phone');
        $user_helper = new UserHelper();
        if($id = $user_helper->validateUser($phone,$password)){
            if($id == 'incorrect_pass' || $id == 'user_not_found'){
                if($id == 'incorrect_pass'){
                    #Incorrect Password
                    $response['status'] = 'error';
                    $response['message'] = 'Incorrect Password !';
                    echo json_encode($response);
                    return;
                }
                else if($id == 'user_not_found'){
                    #User Not Found
                    $response['status'] = 'error';
                    $response['message'] = 'User not found!!';
                    echo json_encode($response);
                    return;
                }
            }
            else{
                #Set session
                Yii::$app->session->set('user_token',base64_encode(json_encode(['user_id' => $id])));
                Yii::trace('User login successful and token set', __METHOD__);

                #Set response
                $response['status'] = 'success';
                $response['message'] = 'Logged In Successfully !';
                Yii::$app->session->setFlash('success-container','Logged In Successfully');
                echo json_encode($response);
                return;
            }
        }
        else{
            #username or password incorrect
            $response['status'] = 'error';
            $response['message'] = 'Incorrect Username or Password !';
            echo json_encode($response);
            return;
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionUserlogout()
    {
        \Yii::$app->session->remove('user_token');
        return $this->redirect(Yii::$app->urlManager->createUrl(['/']));
    }

    /**
     * Property Search Action
     *
     * Search properties based on transaction type,country,
     * city,location,price,area,bedrooms(apartment,house),
     * bathrooms(apartment,house),type(commercial,land),
     * rooms(commercial).
     *
     * @return object properties, array terms (searched terms)
     */
    public function actionSearchproperty(){
        #requests
        $request = Yii::$app->request;

        #search Terms
        $terms = array();

        #Property Type Identification
        $prop_type = $request->get('prop_id');

        #For apartment
        if($prop_type == 1){
            $transaction = $request->get('transaction1');
            $country = $request->get('country1');
            $city = $request->get('city1');
            $location = ucfirst($request->get('location1'));

            #manipulate price
            $price = $request->get('price1');
            if(!empty($price)){
                $str = explode("-",$price);
                $price_min = trim($str[0]," ");
                $price_max = trim($str[1]," ");
            }
            else{
                $price_min = '';
                $price_max = '';
            }

            #manipulate area
            $area = $request->get('area1');
            if(!empty($area)){
                $str1 = explode("-",$area);
                $area_min = trim($str1[0]," ");
                $area_max = trim($str1[1]," ");
            }
            else{
                $area_min = '';
                $area_max = '';
            }

            #manipulate bed
            $bed = $request->get('bed1');
            if(!empty($bed)){
                $str2 = explode("-",$bed);
                $bed_min = trim($str2[0]," ");
                $bed_max = trim($str2[1]," ");
            }
            else{
                $bed_min = '';
                $bed_max = '';
            }

            #manipulate bath
            $bath = $request->get('bath1');
            if(!empty($bath)){
                $str3 = explode("-",$bath);
                $bath_min = trim($str3[0]," ");
                $bath_max = trim($str3[1]," ");
            }
            else{
                $bath_min = '';
                $bath_max = '';
            }

            array_push($terms,$prop_type,$transaction,$country,$city,$location,$price_min,$price_max,$area_min,$area_max,$bed_min,$bed_max,$bath_min,$bath_max);
        }
        #For house
        else if($prop_type == 2){
            $transaction = $request->get('transaction2');
            $country = $request->get('country2');
            $city = $request->get('city2');
            $location = ucfirst($request->get('location2'));

            #manipulate price
            $price = $request->get('price2');
            if(!empty($price)){
                $str = explode("-",$price);
                $price_min = trim($str[0]," ");
                $price_max = trim($str[1]," ");
            }
            else{
                $price_min = '';
                $price_max = '';
            }

            #manipulate area
            $area = $request->get('area2');
            if(!empty($area)){
                $str1 = explode("-",$area);
                $area_min = trim($str1[0]," ");
                $area_max = trim($str1[1]," ");
            }
            else{
                $area_min = '';
                $area_max = '';
            }

            #manipulate bed
            $bed = $request->get('bed2');
            if(!empty($bed)){
                $str2 = explode("-",$bed);
                $bed_min = trim($str2[0]," ");
                $bed_max = trim($str2[1]," ");
            }
            else{
                $bed_min = '';
                $bed_max = '';
            }

            #manipulate bath
            $bath = $request->get('bath2');
            if(!empty($bath)){
                $str3 = explode("-",$bath);
                $bath_min = trim($str3[0]," ");
                $bath_max = trim($str3[1]," ");
            }
            else{
                $bath_min = '';
                $bath_max = '';
            }

            array_push($terms,$prop_type,$transaction,$country,$city,$location,$price_min,$price_max,$area_min,$area_max,$bed_min,$bed_max,$bath_min,$bath_max);
        }
        #For commercial
        else if($prop_type == 3){
            $transaction = $request->get('transaction3');
            $country = $request->get('country3');
            $city = $request->get('city3');
            $location = ucfirst($request->get('location3'));

            #manipulate price
            $price = $request->get('price3');
            if(!empty($price)){
                $str = explode("-",$price);
                $price_min = trim($str[0]," ");
                $price_max = trim($str[1]," ");
            }
            else{
                $price_min = '';
                $price_max = '';
            }

            #manipulate area
            $area = $request->get('area3');
            if(!empty($area)){
                $str1 = explode("-",$area);
                $area_min = trim($str1[0]," ");
                $area_max = trim($str1[1]," ");
            }
            else{
                $area_min = '';
                $area_max = '';
            }

            $type = $request->get('type3');

            #manipulate rooms
            $rooms = $request->get('room3');
            if(!empty($rooms)){
                $str2 = explode("-",$rooms);
                $rooms_min = trim($str2[0]," ");
                $rooms_max = trim($str2[1]," ");
            }
            else{
                $rooms_min = '';
                $rooms_max = '';
            }

            array_push($terms,$prop_type,$transaction,$country,$city,$location,$price_min,$price_max,$area_min,$area_max,$type,$rooms_min,$rooms_max);
        }
        #For land
        else {
            $transaction = $request->get('transaction4');
            $country = $request->get('country4');
            $city = $request->get('city4');
            $location = ucfirst($request->get('location4'));

            #manipulate price
            $price = $request->get('price4');
            if(!empty($price)){
                $str = explode("-",$price);
                $price_min = trim($str[0]," ");
                $price_max = trim($str[1]," ");
            }
            else{
                $price_min = '';
                $price_max = '';
            }

            #manipulate area
            $area = $request->get('area4');
            if(!empty($area)){
                $str1 = explode("-",$area);
                $area_min = trim($str1[0]," ");
                $area_max = trim($str1[1]," ");
            }
            else{
                $area_min = '';
                $area_max = '';
            }
            $type = $request->get('type4');

            array_push($terms,$prop_type,$transaction,$country,$city,$location,$price_min,$price_max,$area_min,$area_max,$type);
        }

        #terms [
        #   '0' => property_type,
        #   '1' => transaction_type,
        #   '2' => country,
        #   '3' => city,
        #   '4' => location,
        #   '5' => price_min,
        #   '6' => price_max,
        #   '7' => area_min,
        #   '8' => area_max,
        #   '9-12' => others..
        #]

        $filter = $request->get('filter');

        $search = new SearchHelper();
        $properties = $search->findProperty($terms,$filter);

        $region_token = Yii::$app->session->get('region_token');
        $user_helper = new UserHelper();
        $country = $user_helper->getUserCountry($region_token);

        $data = new CountryCityHelper();
        $cities = $data->getCity($country->id);
        $city_name = $data->getCityNameById($terms[3]);
        $featured_property = Generic::getFeaturedProperty();

        return $this->render('search-result',array(
            'properties' => $properties,
            'terms' => $terms,
            'country' => $country,
            'cities' => $cities,
            'city_name' => $city_name,
            'featured_property' => $featured_property
        ));
    }


    /*
     * show session variables
     */
    public function actionShowsession(){
        session_start();
        echo "sfdsd";
        echo "<pre>";
        print_r($_SESSION);
    }

    /*
     * upload image to amazon s3
     */
    public static function actionAjaximageupload(){
        $water_mark = Yii::$app->request->post('watermark',1);
        $uploader = new Uploader();
        $data = $uploader->upload($_FILES['files'], array(
            'limit' => 10, //Maximum Limit of files. {null, Number}
            'watermark' => $water_mark,
            'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
            'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
            'required' => false, //Minimum one file is required for upload {Boolean}
            'uploadDir' => 'uploads/', //Upload directory {String}
            'title' => array('{{timestamp}}'), //New file name {null, String, Array} *please read documentation in README.md
            'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
            'replace' => false, //Replace the file if it already exists  {Boolean}
            'perms' => null, //Uploaded file permisions {null, Number}
            'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
            'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
            'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
            'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
            'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
            'onRemove' => null //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
        ));

        if($data['isComplete']){
            $files = $data['data'];
            echo json_encode($files['metas'][0]['name']);
        }

        if($data['hasErrors']){
            $errors = $data['errors'];
            echo json_encode($errors);
        }
        exit;
    }

    /**
     * Delete Image From Amazon s3
     */
    public static function actionDeleteimagefroms3(){
        if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAIRWFUJGOJ46XGJYA');
        if (!defined('awsSecretKey')) define('awsSecretKey', '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');
        $s3 = new S3(awsAccessKey, awsSecretKey);
        if(isset($_POST['file'])){
            $bucket = "lanoyo-property";
            $s3->deleteObject($bucket,$_POST['file']);
        }
    }

    /*
     * deleting multiple images from Amazon s3
     */
    public function actionDeleteMultiImageFromS3()
    {
        if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAIRWFUJGOJ46XGJYA');
        if (!defined('awsSecretKey')) define('awsSecretKey', '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');
        $s3 = new S3(awsAccessKey, awsSecretKey);
        if(isset($_POST['file'])){
            $images = explode(',',substr($_POST['file'],1));
            foreach ($images as $image) {
                $bucket = "ad-dwit-a";
                $s3->deleteObject($bucket, $image);
            }
        }
    }

    /**
     * Receives message (property-details)
     */
    public function actionSendmessage(){
        #requests
        $request = Yii::$app->request;

        #values
        $from = $request->post('email');
        $name = $request->post('name');
        $phone = $request->post('phone');
        $msg = $request->post('msg');
        $receiver = $request->post('receiver');
        $property_id = $request->post('property_id');

        if(!empty($from) && !empty($name) && !empty($phone) && !empty($msg)){
            $message = new MessageHelper();
            $stat = $message->send_message($from,$name,$phone,$msg,$receiver,$property_id);
            if($stat){
                #setting response
                $response['status'] = 'success';
                $response['message'] = 'We will review the message and send it to the owner. Thank you for staying with us !';
            }
            else{
                #setting response
                $response['status'] = 'failure';
                $response['message'] = 'Something went wrong!';
            }
        }
        else{
            #setting response
            $response['status'] = 'empty';
            $response['message'] = 'Please Fill The Necessary Fields!';
        }
        echo json_encode($response);
    }

    /**
     * Reset password mail will be send after clicking Reset password button
     */
    public function actionResetpasswordmail(){
        $email_id = Yii::$app->request->post('email');
        if($email_id){
            $user_details = User::find()->where(['email' => $email_id])->one();
        } else {
            $user_details = Generic::checkUserDetails();
        }

        $activation_link = Url::toRoute(['/reset-password', 'token' => base64_encode(json_encode($user_details->id))],true);
        $message_body = 'You have requested for reset your password. To change your password please click the link : <br/><br/><a href="'.$activation_link.'">Reset Password</a>';
        Generic::sendMail($message_body,'Reset password on lanoyo.com',$user_details->email);
        $response['status'] = 'success';
        $response['message'] = 'An reset password link has been sent to your mail.';
        $response['link'] = $activation_link;
        echo json_encode($response);
    }

    /**
     * Display Reset password
     */
    public function actionResetpassword(){
        $token = Yii::$app->request->get('token');
        return $this->render('reset-password',array(
            'token' => $token
        ));
    }

    /**
     * Changing password from reset your password form
     */
    public function actionChangepassword(){
        $response = array();
        $user_id =  json_decode(base64_decode(Yii::$app->request->post('token')));
        $new_password = Yii::$app->request->post('new_password');
        $confirm_password = Yii::$app->request->post('confirm_password');


        if ($new_password == $confirm_password) {
            $user = User::findOne($user_id);
            $user->password = Yii::$app->security->generatePasswordHash($new_password);
            if($user->update()){
                $response['status'] = 'success';
                $response['message'] = '<div class="info" style="width:310px;float:left;color: green">You have Updated successfully !</div><br clear="all"><br clear="all">';
            }else{
                $response['status'] = 'error'; // could not register
                $response['message'] = '<div class="info" style="width:310px;float:left;">Could not update, try again later</div><br clear="all"><br clear="all">';
            }
            }else{

                $response['status'] = 'incorrect'; // could not register
                $response['message'] = '<div class="info" style="width:310px;float:left;">Your Current Password is Incorrect !</div><br clear="all"><br clear="all">';
            }



        echo json_encode($response);

    }

    /**
     * Post report (property-details)
     */
    public function actionPostreport(){
        #requests
        $request = Yii::$app->request;

        #values
        $from = $request->post('report_email');
        $name = $request->post('report_name');
        $phone = $request->post('report_phone');
        $report_reason = $request->post('report_reason');
        $property_id = $request->post('report_property_id');

        if(!empty($from) || !empty($name) || !empty($phone) || !empty($report_reason)){
            $report = new ReportHelper();
            $stat = $report->post_report($from,$name,$phone,$report_reason,$property_id);
            if($stat){
                #setting response
                $response['status'] = 'success';
                $response['message'] = 'We will review the report and take necessary steps.';
            }
            else{
                #setting response
                $response['status'] = 'failure';
                $response['message'] = 'Something went wrong!';
            }
        }
        else{
            #setting response
            $response['status'] = 'empty';
            $response['message'] = 'Please Fill The Necessary Fields!';
        }
        echo json_encode($response);
    }

    public function actionPriceplan(){
        $user_details = Generic::checkUserDetails();
        $packages = PlanConfig::find()->all();
        return $this->render('price-plan', ['packages' => $packages,'user_details' => $user_details]);
    }

    public function actionTermsandconditions(){
        return $this->render('terms-n-conditions');
    }
}
