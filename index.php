<?php declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config/config.php';

use App\Classes\SendService;
$phoneNumberFormated = '';
if ( isset( $_POST['phone_number']) && $_POST['phone_number'] != '' ) {
    $phoneNumberUtil = \libphonenumber\PhoneNumberUtil::getInstance();
    $sendService = new SendService();
    try {
        $smsCode = 'Confirm code: ' . uniqid();
        $phoneNumber = $phoneNumberUtil->parse($_POST['phone_number'], null, null, true);
        $validNumber = $phoneNumberUtil->isValidNumber($phoneNumber);
        $phoneNumberRegion = $phoneNumberUtil->getRegionCodeForNumber($phoneNumber);
        $phoneNumberFormated = $phoneNumberUtil->format($phoneNumber, \libphonenumber\PhoneNumberFormat::E164);
        switch($phoneNumberRegion){
            case in_array($phoneNumberRegion, PHONES_EUROPE):
                $resp = $sendService->sendWithEuropeanService()->setMessage($smsCode)->setPhoneNumber($phoneNumberFormated)->send();;
                break;
            case in_array($phoneNumberRegion, PHONES_AMERICA):
                $resp = $sendService->sendWithAmericanService()->setMessage($smsCode)->setPhoneNumber($phoneNumberFormated)->send();;
                break;
            case in_array($phoneNumberRegion, PHONES_ASIA):
                $resp = $sendService->sendWithAsianService()->setMessage($smsCode)->setPhoneNumber($phoneNumberFormated)->send();;
                break;
            default:
                $error = 'Error: Sorry, Service for this country ('. $phoneNumberRegion . ') not found.';
                break;
        }
    } catch (\libphonenumber\NumberParseException $e) {
        $error = $e;
    }
} else {
    $error = 'Error: Phone number is empty';
}
?>

<html>
    <body>
        <form action="index.php" method="post">
            <input type="text" name="phone_number" placeholder="Enter phone number" value=<?php echo $phoneNumberFormated ?> >
            <input type="submit" value="Send">
            <?php if(isset($error)) { ?>
                <div class="error"><?php echo $error ?></div>
            <?php } ?>
        </form>
        <?php if(isset($resp)) { ?>
            <div class="response">
                <div class="response-title">Response</div>
                <div class="response-body"><?php echo $resp ?></div>
            </div>
        <?php } ?>
    </body>
</html>
