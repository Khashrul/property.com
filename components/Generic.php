<?php
namespace app\components;

use app\models\Company;
use app\models\Countries;
use Yii;
use app\helpers\UserHelper;
use MaxMind\Db\Reader;
use mPDF;

class Generic
{
    /*
     *For Debugging
     */
    public static function _setTrace($param, $debug = true)
    {
        if (is_string($param)) {
            print "$param";
        } else {
            print "<pre>";
            print_r($param);
            print "<pre>";
        }
        print"<hr/>";
        if ($debug) {
            exit();
        }
    }

    public static function getAllProperty(){
        $rows = (new \yii\db\Query())
            ->select(['*'])
            ->from('tbl_property')
            ->orderBy('id DESC')
            ->all();
        return $rows;
    }

    public static function getPropertyfromid($id){
        $rows = (new \yii\db\Query())
            ->select(['*'])
            ->from('tbl_property')
            ->where(['id' => $id])
            ->one();
        return $rows;
    }

    /**
     * Find properties of an user by user_id
     * @param $user_id
     * @param $filter
     * @return array
     */
    public static function getPropertyfromUserId($user_id,$filter=''){
        /*
        $rows = (new \yii\db\Query())
            ->select(['*'])
            ->from('tbl_property')
            ->where(['user_id' => $user_id])
            ->all();
        return $rows;
        */


        if($filter == 'price_low_to_high'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['user_id' => $user_id])
                ->orderBy(['price'=>SORT_ASC])
                ->all();
        }
        elseif($filter == 'price_high_to_low'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['user_id' => $user_id])
                ->orderBy(['price'=>SORT_DESC])
                ->all();
        }
        elseif($filter == 'area_low_to_high'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['user_id' => $user_id])
                ->orderBy(['area'=>SORT_ASC])
                ->all();
        }
        elseif($filter == 'area_high_to_low'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['user_id' => $user_id])
                ->orderBy(['area' => SORT_DESC])
                ->all();
        }
        else{
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['user_id' => $user_id])
                ->all();
        }
        return $rows;
    }

    public static function getFeaturedProperty($limit = 6){
        $rows = (new \yii\db\Query())
            ->select(['*'])
            ->from('tbl_property')
            ->where(['is_featured' => '1'])
            ->orderBy('id DESC')
            ->limit($limit)
            ->all();
        return $rows;
    }

    public static function getApartmentProperty($filter = ''){
        if($filter == 'price_low_to_high'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '1'])
                ->orderBy(['price'=>SORT_ASC])
                ->all();
        }
        elseif($filter == 'price_high_to_low'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '1'])
                ->orderBy(['price'=>SORT_DESC])
                ->all();
        }
        elseif($filter == 'area_low_to_high'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '1'])
                ->orderBy(['area'=>SORT_ASC])
                ->all();
        }
        elseif($filter == 'area_high_to_low'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '1'])
                ->orderBy(['area' => SORT_DESC])
                ->all();
        }
        elseif($filter === 'sale'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '1','transaction_type' => 'Sale'])
                ->orderBy(['id' => SORT_DESC])
                ->all();
        }
        elseif($filter === 'rent'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '1','transaction_type' => 'Rent'])
                ->orderBy(['id' => SORT_DESC])
                ->all();
        }
        else{
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '1'])
                ->orderBy(['id' => SORT_DESC])
                ->all();
        }
        return $rows;
    }

    public static function getHouseProperty($filter = ''){

        if($filter == 'price_low_to_high'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '2'])
                ->orderBy(['price'=>SORT_ASC])
                ->all();
        }
        elseif($filter == 'price_high_to_low'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '2'])
                ->orderBy(['price'=>SORT_DESC])
                ->all();
        }
        elseif($filter == 'area_low_to_high'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '2'])
                ->orderBy(['area'=>SORT_ASC])
                ->all();
        }
        elseif($filter == 'area_high_to_low'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '2'])
                ->orderBy(['area' => SORT_DESC])
                ->all();
        }
        elseif($filter === 'sale'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '2','transaction_type' => 'Sale'])
                ->orderBy(['id' => SORT_DESC])
                ->all();
        }
        elseif($filter === 'rent'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '2','transaction_type' => 'Rent'])
                ->orderBy(['id' => SORT_DESC])
                ->all();
        }
        else{
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '2'])
                ->orderBy(['id' => SORT_DESC])
                ->all();
        }

        return $rows;
    }

    public static function getCommercialProperty($filter = ''){
        if($filter == 'price_low_to_high'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '3'])
                ->orderBy(['price'=>SORT_ASC])
                ->all();
        }
        elseif($filter == 'price_high_to_low'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '3'])
                ->orderBy(['price'=>SORT_DESC])
                ->all();
        }
        elseif($filter == 'area_low_to_high'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '3'])
                ->orderBy(['area'=>SORT_ASC])
                ->all();
        }
        elseif($filter == 'area_high_to_low'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '3'])
                ->orderBy(['area' => SORT_DESC])
                ->all();
        }
        elseif($filter === 'sale'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '3','transaction_type' => 'Sale'])
                ->orderBy(['id' => SORT_DESC])
                ->all();
        }
        elseif($filter === 'rent'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '3','transaction_type' => 'Rent'])
                ->orderBy(['id' => SORT_DESC])
                ->all();
        }
        else{
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '3'])
                ->orderBy(['id' => SORT_DESC])
                ->all();
        }

        return $rows;
    }

    public static function getLandProperty($filter = ''){
        if($filter == 'price_low_to_high'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '4'])
                ->orderBy(['price'=>SORT_ASC])
                ->all();
        }
        elseif($filter == 'price_high_to_low'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '4'])
                ->orderBy(['price'=>SORT_DESC])
                ->all();
        }
        elseif($filter == 'area_low_to_high'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '4'])
                ->orderBy(['area'=>SORT_ASC])
                ->all();
        }
        elseif($filter == 'area_high_to_low'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '4'])
                ->orderBy(['area' => SORT_DESC])
                ->all();
        }
        elseif($filter === 'sale'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '4','transaction_type' => 'Sale'])
                ->orderBy(['id' => SORT_DESC])
                ->all();
        }
        elseif($filter === 'rent'){
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '4','transaction_type' => 'Rent'])
                ->orderBy(['id' => SORT_DESC])
                ->all();
        }
        else{
            $rows = (new \yii\db\Query())
                ->select(['*'])
                ->from('tbl_property')
                ->where(['property_type' => '4'])
                ->orderBy(['id' => SORT_DESC])
                ->all();
        }
        return $rows;
    }

    public static function getAllAgency(){
        $rows = (new \yii\db\Query())
            ->select(['*'])
            ->from('tbl_user')
            ->where(['user_type' => '2'])
            ->andWhere(['status' => 1])
            ->orderBy('id desc')
            ->all();
        return $rows;
    }

    public static function getSocialLinks($id){
        $rows = (new \yii\db\Query())
            ->select(['*'])
            ->from('tbl_social_links')
            ->where(['id' => $id])
            ->one();
        return $rows;
    }

    public static function getPropertyMetaFromMetaId($id){
        $rows = (new \yii\db\Query())
            ->select(['*'])
            ->from('tbl_property_meta')
            ->where(['id' => $id])
            ->one();
        return $rows;
    }

    public static function getAllFromPropertyView($property_id,$user_ip){
        $rows = (new \yii\db\Query())
            ->select(['*'])
            ->from('tbl_property_view')
            ->where(['property_id' => $property_id])
            ->andWhere(['ip_address' => $user_ip])
            ->all();
        return $rows;
    }

    public static function getTotalPropertyView($property_id){
        $rows = (new \yii\db\Query())
            ->select(['*'])
            ->from('tbl_property_view')
            ->where(['property_id' => $property_id])
            ->all();
        return $rows;
    }

    public static function deleteProperty($id){
        $rows = (new \yii\db\Query())
            ->createCommand()
            ->delete('tbl_property', ['id' => $id])
            ->execute();
        return $rows;
    }

    public static function deletePropertyMeta($meta_id){
        $rows = (new \yii\db\Query())
            ->createCommand()
            ->delete('tbl_property_meta', ['id' => $meta_id])
            ->execute();
        return $rows;
    }

    public static function propertyType($id){
        $property_type = '';
        switch ($id){
            case 1:
                $property_type = "apartment";
                break;
            case 2:
                $property_type = "house";
                break;
            case 3:
                $property_type = "commercial";
                break;
            case 4:
                $property_type = "land";
                break;
            default:
                break;
        }
        return $property_type;
    }

    public static function propertyUnit($id){
        switch ($id){
            case 1:
                echo "sq ft";
                break;
            case 2:
                echo "sq ft";
                break;
            case 3:
                echo "m<sup>2</sup>";
                break;
            case 4:
                echo "ha";
                break;
        }
    }

    /*
     * print property type alias
     */
    public static function propertyTypeAlias($id){
        switch ($id){
            case 1:
                echo "A";
                break;
            case 2:
                echo "H";
                break;
            case 3:
                echo "C";
                break;
            case 4:
                echo "L";
                break;
        }
    }

    public static function propertyMapMarkerImage($id){
        switch ($id){
            case 1:
                echo "images/pin-apartment.png";
                break;
            case 2:
                echo "images/pin-house.png";
                break;
            case 3:
                echo "images/pin-commercial.png";
                break;
            case 4:
                echo "images/pin-land.png";
                break;
        }
    }

    /*
     * check if the user already logged in
     */
    public static function checkUserDetails(){
        $user_token = \Yii::$app->session->get('user_token');
        if(!isset($user_token)){
            return false;
        }

        $user_data = json_decode(base64_decode($user_token));
        $user_helper = new UserHelper();
        $user = $user_helper->findUserById($user_data->user_id);
        if(!$user){
            return false;
        }
        return $user;
    }

    /*
     * send mail with php mailer
     */
    /*
    * sends otp to email
    */
    public static function sendMail($message, $subject, $to, $from="lanoyo.com <info@lanoyo.com>", $debug = false,$cc=false, $bcc = false ,$style='')
    {
        $current_time = new \DateTime();
        $body = $message;

        // To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: ' . $from . "\r\n";
        if ($cc) {
            $headers .= 'Cc: ' . $cc . " \r\n";
        }
        if ($bcc) {
            $headers .= 'Bcc: ' . $bcc . " \r\n";
        }

        // sending mail
        if (@mail($to, $subject, $body, $headers, '-f info@lanoyo.com')) {
            return true;
        }
        return false;

    }

    /*
     * get visitor ip address
     * @return string $ip
     */
    public static function getUserIP()
    {
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
    }

    /*
	 * Determine user country from ip address
	 */
    public static function determineCountry(){
        $remote_ip = '';
        $region_token = Yii::$app->session->get('region_token');
        if(!isset($region_token)) {
            //Generic::_setTrace($remote_ip);
            $remote_ip = '180.92.226.51';
            //$remote_ip = '8.8.8.8';
            //$remote_ip = '115.117.19.26';

            //$remote_ip = Generic::getUserIP();

            $databaseFile = 'data/maxmind/GeoLite2-Country.mmdb';
            $reader = new Reader($databaseFile);

            $record = $reader->get($remote_ip);

            $reader->close();

            $region_token = md5($record['country']['iso_code']);
            Yii::$app->session->set('region_token',$region_token);
        }
    }

    /*
     * get region and city from geo location
     */
    public static function getRegionAndCity($latitude,$longitude){
        $data = file_get_contents("http://maps.google.com/maps/api/geocode/json?latlng=$latitude,$longitude&sensor=false");
        $data = json_decode($data);
        $add_array  = $data->results;
        $add_array = $add_array[1];
        $location = $add_array->formatted_address;
        $add_array = $add_array->address_components;
        $country = "Not found";
        $state = "Not found";
        $city = "Not found";
        $region = "Not found";
        //Generic::_setTrace($add_array);
        foreach ($add_array as $key) {
            if($key->types[0] == 'locality')
            {
                $city = $key->long_name;
            }
            if($key->types[0] == 'administrative_area_level_1')
            {
                $state = $key->long_name;
            }
            if($key->types[0] == 'country')
            {
                $country = $key->long_name;
            }
            if($key->types[0] == 'neighborhood')
            {
                $region = $key->long_name;
            }
        }
        $info['country'] = $country;
        $info['state'] = $state;
        $info['city'] = $city;
        $info['region'] = $region;
        $info['location'] = $location;
        return $info;
    }

    /*
     * send Invoice to user
     */
    public static function sendInvoice($user_id,$payment_details,$plan)
    {
        $user_helper = new UserHelper();
        $user_details = $user_helper->findUserById($user_id);
        $country_details = Countries::find()->where(['id'=>$user_details->country])->one();
        $transaction_date = new \DateTime($payment_details->transaction_datetime);
        $total_amount = $plan->price;
        $additional_block = '';
        $second_page = '';
        $service_creation_date = new \DateTime();
        $service_expire_date = new \DateTime();
        $service_expire_date->modify('1 month');

        $second_page = '<div style="width:800px; height:90px; background:url(/images/pad_top.jpg); background-size:100%;"></div>
<div style="width:1000px; padding-top:70px; height:768px;">
<p>Package includes:</p>
'.$plan->details.'
</div>
<div style="width:800px; height:45px; background:url(/images/pad_bottom.jpg); background-size:100%;"></div>';


        $remote_ip = Generic::getUserIP();

        $total_amount_in_word = Generic::convertNumber($total_amount);

        $vat_amount = ceil($total_amount * 4.5/100);
        $deducted_total = $total_amount - $vat_amount;
        $payment_method = '';
        if($payment_details->payment_method == 1){
            $payment_method = 'Visa / MasterCard';
        } else if($payment_details->payment_method == 2){
            $payment_method = 'Bank Deposit';
        } else if($payment_details->payment_method == 3){
            $payment_method = 'Cash on Delivery';
        }
        $block = '';
        $description_block = '';
        $subject_block = '';

        $description_block = '<tr>
					<td>Payment for "Subscription ('.$plan->name.')"<br>Duration: ' . $service_creation_date->format("d M, Y") . ' to ' . $service_expire_date->format("d M, Y") . '</td>
					<td align="center">' . number_format($deducted_total, 2) . '</td>
				</tr>';
        $subject_block = 'Thank you for subscription. We really appreciate your proceeding with us. For more details, please contact with us.';
        $html_content = '
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<style>
.options li span{color:green;}
</style>
	</head>
	<body>
		<div style="width:800px; height:90px; background:url(/images/pad_top.jpg); background-size:100%;"></div>
		<div style="width:1000px; padding-top:70px; height:768px;">
			<div style="float: left; width:45%; ">
				<p>INVOICE TO</p>
				<p>
					'.$user_details->name.'<br/>
					N/A<br/>
					'.$user_details->address.'<br/>
					'.$country_details->name.'
				</p>
				<p>
					'.$user_details->email.'<br/>
					'.$user_details->phone.'
				</p>
			</div>
			<div style="float:right; width:55%;">
				<p style="text-align:center; letter-spacing:16px;">INVOICE DETAILS</p>
				<div style="border-right: solid 1px #000; padding: 0 3px; float: left; width:100px; ">
					<span>Total Amount</span><br>
					<span>BDT '.$plan->price.'</span>
				</div>
				<div style="border-right: solid 1px #000; padding: 0 3px; float: left; width:120px;">
					<span>Transaction Date</span><br>
					<span>'.$transaction_date->format("d M, Y").'</span>
				</div>
				<div style="padding: 0 3px;float: left; width:120px;">
					<span>Invoice Id</span><br>
					<span>'.$payment_details->order_id.'</span>
				</div>
				<div style="clear:both"></div>
				<p style="margin-left:3px;">Payment by: '.$payment_method.'</p>
			</div>
			<div style="clear:both"></div>
			<p>Dear Sir/Madam</p>
			<p>'.$subject_block.'</p>
			<table align="center" width="800" border="1">
				<tr>
					<th>Description of the Services</th>
					<th align="center">Amount (BDT)</th>
				</tr>
				'.$description_block.$additional_block.'
				<tr>
					<td>Add: Vat@4.5% under Service</td>
					<td align="center">'.number_format($vat_amount,2).'</td>
				</tr>
				<tr>
					<td>Total Payment</td>
					<td align="center">'.number_format($total_amount,2).'</td>
				</tr>
			</table>
			<br>
			<br>
			<p>Amount In Word: '.ucwords($total_amount_in_word).' only</p>

			<br>
			<div style="float: left; width:200px; border:solid 1px #000; text-align:center;">
				<p>24X7 Support</p>
				<p>info@lanoyo.com</p>
			</div>
			<div style="float: right; width: 160px; margin-top:-15px;">
				<div style="width:120px; height:120px; background:url(); background-size:100%;"></div>
			</div>
			<div style="clear:both"></div>
			<span>Originated ip:'.$remote_ip.'</span>
			</div>
<div style="width:800px; height:45px; background:url(/images/pad_bottom.jpg); background-size:100%;"></div>
'.$second_page.'
	</body>
</html>';

        $temp_file = tempnam(sys_get_temp_dir(), 'Inv');
        //$temp_file = 'D://lanoyo_invoice.pdf';

        $mpdf = new Mpdf();

        $mpdf->WriteHTML($html_content);
        $mpdf->Output($temp_file,'F');


        $create_date = new \DateTime();
        $file_name = 'Invoice_'.$create_date->getTimestamp().'.pdf';
        $content = file_get_contents($temp_file);
        $content = chunk_split(base64_encode($content));
        $uid = md5(uniqid(time()));

        $to = $user_details->email;
        $from = Yii::$app->params['adminEmail'];
        $subject = "Invoice from lanoyo.com";


        $message = "Dear Sir/Madam,\n\nThank you for subscribing for our services. We really appreciate your business with us. Need more help, please contact with us." ;


        // main header (multipart mandatory)
        $headers = "From: lanoyo.com <".$from.">\r\n";
        $headers .= "Reply-To: ".$from."\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";

        // message
        $nmessage = "--".$uid."\r\n";
        $nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
        $nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $nmessage .= $message."\r\n\r\n";
        $nmessage .= "--".$uid."\r\n";
        $nmessage .= "Content-Type: application/octet-stream; name=\"".$file_name."\"\r\n";
        $nmessage .= "Content-Transfer-Encoding: base64\r\n";
        $nmessage .= "Content-Disposition: attachment; filename=\"".$file_name."\"\r\n\r\n";
        $nmessage .= $content."\r\n\r\n";
        $nmessage .= "--".$uid."--";

        @mail($to, $subject, $nmessage, $headers);

        $to = Yii::$app->params['invoiceEmail'];
        $from = Yii::$app->params['adminEmail'];
        $headers = "From: ".$user_details->name." <".$from.">\r\n";
        $headers .= "Reply-To: ".$from."\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";


        @mail($to, $subject, $nmessage, $headers);

    }


    /*
     * send registration paper as attachment in mail
     */
    public static function sendRegistrationPaper($user){

        $current_date = new \DateTime();
        $remote_ip = Generic::getUserIP();
        $enterprise_name_block = '';
        $type_of_business_block = '';
        $country_block = '';
        $country_details = '';
        $designation = 'Owner';
        if($user->user_type == 2){
            $company_details = Company::find()->where(['id' => $user->company])->one();
            $enterprise_name_block = '<tr>
		<td width="200">Company Name</td>
		<td align="left" class="shade_text">'.$company_details->name.'</td>
	</tr><tr>
	<td colspan="2" style="border:none">&nbsp;</td>
	</tr>';
//            $category_details = Category::model()->findByPk($user->business_category_id);
//            $type_of_business_block = '<tr>
//		<td width="200">Type of Business</td>
//		<td align="left" class="shade_text">Computer & Internet</td>
//	</tr><tr>
//	<td colspan="2" style="border:none">&nbsp;</td>
//	</tr>';
        }
//        if($user->country){
//            $country_details = Countries::model()->findByPk($user->country);
//            $country_block = '<tr>
//		<td width="200">Country</td>
//		<td align="left" class="shade_text">'.$country_details->name.'</td>
//	</tr><tr>
//	<td colspan="2" style="border:none">&nbsp;</td>
//	</tr>';
//        }
        if($user->user_type == 2){
            $designation = "Agent";
        }
        $date_of_birth = new \DateTime($user->date_of_birth);
        $html_content = '<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		.shade_text{ color: gray}
		td{border-bottom:dotted 1px black; padding:0px 10px; }
	</style>
</head>
<body>
<div style="width:800px; height:90px; background:url(/images/pad_top.jpg); background-size:100%;"></div>
<div style="width:1000px; height:850px;">
<h2>Registration Paper</h2>
<div style="float:right; width:50%;">
<table width="95" align="right">
<tr>
	<td>Date:</td>
	<td>'.$current_date->format("d-m-Y H:i:s").'</td>
</tr>
</table>
</div>
<div style="clear:both"></div>
<p>Dear Sir/Madam</p>
<p>Thank you for your registration. For more details, please contact with us.</p>
<div style="border:solid 0.5px black; border-radius:5px; padding:5px;">
<table align="center" width="800" border="0">
	<tr>
		<th align="center" colspan="2">User Information</th>
	</tr>
	<tr>
		<td width="200">Full Name</td>
		<td align="left" class="shade_text">'.$user->name.'</td>
	</tr>
	<tr>
	<td colspan="2" style="border:none">&nbsp;</td>
	</tr>
	<tr>
		<td width="200">Designation</td>
		<td align="left" class="shade_text">'.$designation.'</td>
	</tr>
	<tr>
	<td colspan="2" style="border:none">&nbsp;</td>
	</tr>
	<tr>
		<td width="200">Date of Birth</td>
		<td align="left" class="shade_text">'.$date_of_birth->format("d M Y").'</td>
	</tr>
	<tr>
	<td colspan="2" style="border:none">&nbsp;</td>
	</tr>
	'.$enterprise_name_block.'
	'.$type_of_business_block.'
	<tr>
		<td width="200">Address</td>
		<td align="left" class="shade_text">'.$user->address.'</td>
	</tr>
	<tr>
	<td colspan="2" style="border:none">&nbsp;</td>
	</tr>
	<tr>
		<td width="200">Email</td>
		<td align="left" class="shade_text">'.$user->email.'</td>
	</tr>
	<tr>
	<td colspan="2" style="border:none">&nbsp;</td>
	</tr>
	<tr>
		<td width="200">Contact Number</td>
		<td align="left" class="shade_text">'.$user->phone.'</td>
	</tr>
	<tr>
	<td colspan="2" style="border:none">&nbsp;</td>
	</tr>
	<tr>
		<td width="200">Status</td>
		<td align="left" class="shade_text">Active</td>
	</tr>
</table>
</div>
<br>
<br>

<span>Originated ip: '.$remote_ip.'</span>
</div>
<div style="width:800px; height:45px; background:url(/images/pad_bottom.jpg); background-size:100%;"></div>
</body>
</html>';
        $from = $user->email;
        $to = Yii::$app->params['adminEmail'];
        $subject = 'Registration successful';
        $message = 'An user has successfully completed registration process. Please find details in attachment.';
        self::sendMailWithAttachment($subject,$from,$to,$message,$html_content,$user->name);

        $from = Yii::$app->params['adminEmail'];
        $to = $user->email;
        $subject = 'User registration successful';
        $message = 'You have successfully completed registration process. Please find details in attachment.';
        self::sendMailWithAttachment($subject,$from,$to,$message,$html_content);
    }

    /*
     * Generic function to send email with attachment
     */
    public static function sendMailWithAttachment($subject,$from,$to,$message,$html_content,$from_name = 'lanoyo.com'){

        $create_date = new \DateTime();
        $temp_file = tempnam(sys_get_temp_dir(), 'Registration');
        //$temp_file = 'D://registration_test400.pdf';
        //$temp_file = 'd://Registration_'.$create_date->getTimestamp().'.pdf';;
        $mpdf = new mPDF();

        $mpdf->WriteHTML($html_content);
        $mpdf->Output($temp_file,'F');



        $file_name = 'Registration_'.$create_date->getTimestamp().'.pdf';
        $content = file_get_contents($temp_file);
        $content = chunk_split(base64_encode($content));
        $uid = md5(uniqid(time()));

        // main header (multipart mandatory)
        $headers = "From: ".$from_name." <".$from.">\r\n";
        $headers .= "Reply-To: ".$from."\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";

        // message
        $nmessage = "--".$uid."\r\n";
        $nmessage .= "Content-type:text/plain; charset=iso-8859-1\r\n";
        $nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $nmessage .= $message."\r\n\r\n";
        $nmessage .= "--".$uid."\r\n";
        $nmessage .= "Content-Type: application/octet-stream; name=\"".$file_name."\"\r\n";
        $nmessage .= "Content-Transfer-Encoding: base64\r\n";
        $nmessage .= "Content-Disposition: attachment; filename=\"".$file_name."\"\r\n\r\n";
        $nmessage .= $content."\r\n\r\n";
        $nmessage .= "--".$uid."--";

        @mail($to, $subject, $nmessage, $headers);
    }


    public static function convertNumber($number)
    {
        if(strpos($number,'.')){
            list($integer, $fraction) = explode(".", (string) $number);
        } else {
            $integer = $number;
            $fraction = 0;
        }


        $output = "";

        if ($integer{0} == "-")
        {
            $output = "negative ";
            $integer    = ltrim($integer, "-");
        }
        else if ($integer{0} == "+")
        {
            $output = "positive ";
            $integer    = ltrim($integer, "+");
        }

        if ($integer{0} == "0")
        {
            $output .= "zero";
        }
        else
        {
            $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
            $group   = rtrim(chunk_split($integer, 3, " "), " ");
            $groups  = explode(" ", $group);

            $groups2 = array();
            foreach ($groups as $g)
            {
                $groups2[] = Generic::convertThreeDigit($g{0}, $g{1}, $g{2});
            }

            for ($z = 0; $z < count($groups2); $z++)
            {
                if ($groups2[$z] != "")
                {
                    $output .= $groups2[$z] . Generic::convertGroup(11 - $z) . (
                        $z < 11
                        && !array_search('', array_slice($groups2, $z + 1, -1))
                        && $groups2[11] != ''
                        && $groups[11]{0} == '0'
                            ? " and "
                            : ", "
                        );
                }
            }

            $output = rtrim($output, ", ");
        }

        if ($fraction > 0)
        {
            $output .= " point";
            for ($i = 0; $i < strlen($fraction); $i++)
            {
                $output .= " " . Generic::convertDigit($fraction{$i});
            }
        }

        return $output;
    }

    public static function convertGroup($index)
    {
        switch ($index)
        {
            case 11:
                return " decillion";
            case 10:
                return " nonillion";
            case 9:
                return " octillion";
            case 8:
                return " septillion";
            case 7:
                return " sextillion";
            case 6:
                return " quintrillion";
            case 5:
                return " quadrillion";
            case 4:
                return " trillion";
            case 3:
                return " billion";
            case 2:
                return " million";
            case 1:
                return " thousand";
            case 0:
                return "";
        }
    }

    public static function convertThreeDigit($digit1, $digit2, $digit3)
    {
        $buffer = "";

        if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0")
        {
            return "";
        }

        if ($digit1 != "0")
        {
            $buffer .= Generic::convertDigit($digit1) . " hundred";
            if ($digit2 != "0" || $digit3 != "0")
            {
                $buffer .= " and ";
            }
        }

        if ($digit2 != "0")
        {
            $buffer .= Generic::convertTwoDigit($digit2, $digit3);
        }
        else if ($digit3 != "0")
        {
            $buffer .= Generic::convertDigit($digit3);
        }

        return $buffer;
    }

    public static function convertTwoDigit($digit1, $digit2)
    {
        if ($digit2 == "0")
        {
            switch ($digit1)
            {
                case "1":
                    return "ten";
                case "2":
                    return "twenty";
                case "3":
                    return "thirty";
                case "4":
                    return "forty";
                case "5":
                    return "fifty";
                case "6":
                    return "sixty";
                case "7":
                    return "seventy";
                case "8":
                    return "eighty";
                case "9":
                    return "ninety";
            }
        } else if ($digit1 == "1")
        {
            switch ($digit2)
            {
                case "1":
                    return "eleven";
                case "2":
                    return "twelve";
                case "3":
                    return "thirteen";
                case "4":
                    return "fourteen";
                case "5":
                    return "fifteen";
                case "6":
                    return "sixteen";
                case "7":
                    return "seventeen";
                case "8":
                    return "eighteen";
                case "9":
                    return "nineteen";
            }
        } else
        {
            $temp = Generic::convertDigit($digit2);
            switch ($digit1)
            {
                case "2":
                    return "twenty-$temp";
                case "3":
                    return "thirty-$temp";
                case "4":
                    return "forty-$temp";
                case "5":
                    return "fifty-$temp";
                case "6":
                    return "sixty-$temp";
                case "7":
                    return "seventy-$temp";
                case "8":
                    return "eighty-$temp";
                case "9":
                    return "ninety-$temp";
            }
        }
    }

    public static function convertDigit($digit)
    {
        switch ($digit)
        {
            case "0":
                return "zero";
            case "1":
                return "one";
            case "2":
                return "two";
            case "3":
                return "three";
            case "4":
                return "four";
            case "5":
                return "five";
            case "6":
                return "six";
            case "7":
                return "seven";
            case "8":
                return "eight";
            case "9":
                return "nine";
        }
    }

    public static function viewCount($property_id){
        $current_time = date('Y-m-d H:i:s');
        $user_ip = Generic::GetUserIP();
        $property_view = Generic::getAllFromPropertyView($property_id, $user_ip);
        $check_ip = isset($property_view[0]['ip_address']) ? $property_view[0]['ip_address'] : '';

        $last_viewed = isset($property_view[0]['last_viewed']) ? $property_view[0]['last_viewed']: '';
        $new_time = date("Y-m-d H:i:s", strtotime('+2 minutes',strtotime($last_viewed)));

        $connection = Yii::$app->db;
        if ($current_time > $new_time) {
            if ($check_ip >= 1) {
                $command = $connection->createCommand(
                    "UPDATE tbl_property_view SET last_viewed='$current_time',view_count=view_count+1 WHERE property_id='$property_id' AND ip_address='$check_ip'");

            } else {
                $command = $connection->createCommand(
                    "insert into tbl_property_view SET property_id='$property_id',ip_address='$user_ip',last_viewed='$current_time',view_count= 1");
            }
            $command->execute();
        }

        $property_views = Generic::getTotalPropertyView($property_id);
        $view_count = array_sum(array_column($property_views, 'view_count'));

        return $view_count;
    }

}
