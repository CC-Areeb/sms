# SMS template

**Composer command** 

```
composer require cooperativecomputing/sms-boiler-plate
```


#

**Publishing the configurations**

```
php artisan vendor:publish --tag=CC-SMS
```

#

**Installation command**

```
php artisan install:sms
```
---

## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`TWILIO_ACCOUNT_SID`

`TWILIO_AUTH_TOKEN`

`TWILIO_SENDER`

#

### After setting the environment variables, you can start your local development server and start sending sms by just clicking on the send button.

## Code snippets

#### You can send OTP numbers in your sms
```
class SmsController extends Controller
{
    public function index()
    {
        return view('sms.index');
    }

    public function sendSMS()
    {
        $otp = $this->generateOTP(5);

        $request = (object) [
            'sms_message' => 'Text message with OTP: '. $otp,
            'sms_receiver' => '<The registered phone number(s)>',
        ];

        try {
            $sid = config('sms.sid', 'some_sid');
            $sender = config('sms.sender', 'some_sender');
            $authToken = config('sms.auth', 'some_token');
            $twilio = new Client($sid, $authToken);
            $twilio->messages->create(
                $request->sms_receiver,
                [
                    "body" => $request->sms_message,
                    "from" => $sender,
                    "mediaUrl" => ["https://demo.twilio.com/owl.png"]
                ]
            );
            return 'SMS was sent';
        } catch (TwilioException $e) {
            throw $e;
        }
    }

    public function generateOTP($otpDigits)
    {
        return rand(pow(10, $otpDigits-1), pow(10, $otpDigits)-1);
    }
}
```

# 


#### More examples

**https://www.twilio.com/blog/create-sms-portal-laravel-php-twilio**
