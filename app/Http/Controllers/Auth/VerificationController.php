<?php



namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\VerifiesEmails;

use App\Models\User;

use Carbon\Carbon;

use Mail;

use DB;

use Session;

use Illuminate\Http\Request;

use App\Http\Controllers\OTPVerificationController;



class VerificationController extends Controller

{

    /*

    |--------------------------------------------------------------------------

    | Email Verification Controller

    |--------------------------------------------------------------------------

    |

    | This controller is responsible for handling email verification for any

    | user that recently registered with the application. Emails may also

    | be re-sent if the user didn't receive the original email message.

    |

    */



    use VerifiesEmails;



    /**

     * Where to redirect users after verification.

     *

     * @var string

     */

    protected $redirectTo = '/';



    /**

     * Create a new controller instance.

     *

     * @return void

     */

    // public function __construct()

    // {

    //     //$this->middleware('auth');

    //     $this->middleware('signed')->only('verify');

    //     $this->middleware('throttle:6,1')->only('verify', 'resend');

    // }



public function __construct()
{
    // Retrieve the request data from the session
    $requestData = Session::get('request');

    // Check if the data is an array before calling 'all()'
    if (is_array($requestData)) {
        // Check if the 'name' key exists in the array
        if (array_key_exists('name', $requestData)) {
            $name = $requestData['name'];
            $email = $requestData['email'];
            $date = Carbon::now();
            
            $formattedDate = $date->format('d-m-Y');
            //$this->middleware('auth');

            $this->middleware('signed')->only('verify');
            $this->middleware('throttle:6,1')->only('verify', 'resend');

            // Retrieve mail data for user
            $mailData = DB::table('mailnotifications')->where('id', 25)->where('status', 1)->first();

            // Retrieve mail data for admin
            $mailDataAdmin = DB::table('mailnotifications')->where('id', 9)->where('status', 1)->first();

            // Check if mail data is available before proceeding
            if ($mailData) {
                // Assuming $messageBody is defined elsewhere in your code
                $messageBody = str_replace("{{name}}", $name, $mailData->contant);

                $data = [
                    'requestData' => $requestData,
                    'messageBody' => $messageBody,
                ];

                // Send email to user
                Mail::send([], $data, function ($message) use ($requestData, $messageBody, $mailData) {
                    $message->to($requestData['email'])
                        ->subject($mailData->subject)
                        ->from('info@login2design.com', 'Zoobla')
                        ->html($messageBody);
                });
            }

            // Check if mail data for admin is available before proceeding
            if ($mailDataAdmin) {
                // Corrected sequence and added missing arguments
                $messageBodyAdmin = str_replace(["{{name}}", "{{email}}", "{{date}}"], [$name, $email, $formattedDate], $mailDataAdmin->contant);

                $dataAdmin = [
                    'requestData' => $requestData,
                    'messageBodyAdmin' => $messageBodyAdmin,
                ];

                // Send email to admin
                Mail::send([], $dataAdmin, function ($message) use ($messageBodyAdmin, $mailDataAdmin) {
                    $message->to('sandeepjangid@login2design.com')
                        ->subject($mailDataAdmin->subject)
                        ->from('info@login2design.com', 'Zoobla')
                        ->html($messageBodyAdmin);
                });
            }
        }
    }
}





    /**

     * Show the email verification notice.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function show(Request $request)

    {

        if ($request->user()->email != null) {

            return $request->user()->hasVerifiedEmail()

                            ? redirect($this->redirectPath())

                            : view('auth.verify');

        }

        else {

            $otpController = new OTPVerificationController;

            $otpController->send_code($request->user());

            return redirect()->route('verification');

        }

    }





    /**

     * Resend the email verification notification.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function resend(Request $request)

    {

        if ($request->user()->hasVerifiedEmail()) {

            return redirect($this->redirectPath());

        }



        $request->user()->sendEmailVerificationNotification();



        return back()->with('resent', true);

    }



    public function verification_confirmation($code){


        $user = User::where('verification_code', $code)->first();

        if($user != null){

            $user->email_verified_at = Carbon::now();

            $user->save();

            auth()->login($user, true);

            flash(translate('Your email has been verified successfully'))->success();

        }

        else {

            flash(translate('Sorry, we could not verifiy you. Please try again'))->error();

        }

    
      $mailData = DB::table('mailnotifications')->where('id', 29)->where('status', 1)->first();
      $mailDataAdmin = DB::table('mailnotifications')->where('id', 27)->where('status', 1)->first();
     

       if ($mailData) {
                // Assuming $messageBody is defined elsewhere in your code
                $messageBody = str_replace("{{name}}", $user->name, $mailData->contant);

                $data = [
                    'user' => $user,
                    'messageBody' => $messageBody,
                ];

                // Send email to user
                Mail::send([], $data, function ($message) use ($user, $messageBody, $mailData) {
                    $message->to($user->email)
                        ->subject($mailData->subject)
                        ->from('info@login2design.com', 'Zoobla')
                        ->html($messageBody);
                });
            }



             if ($mailDataAdmin) {
                // Corrected sequence and added missing arguments
                $messageBodyAdmin = str_replace(["{{name}}", "{{email}}", "{{date}}"], [$user->name, $user->email, date('d-m-Y')], $mailDataAdmin->contant);

                $dataAdmin = [
                    'user' => $user,
                    'messageBodyAdmin' => $messageBodyAdmin,
                ];

                // Send email to admin
                Mail::send([], $dataAdmin, function ($message) use ($messageBodyAdmin, $mailDataAdmin) {
                    $message->to('sandeepjangid@login2design.com')
                        ->subject($mailDataAdmin->subject)
                        ->from('info@login2design.com', 'Zoobla')
                        ->html($messageBodyAdmin);
                });
            }

        // if($user->user_type == 'seller') {

        //     return redirect()->route('seller.dashboard');

        // }



        return redirect()->route('dashboard');

    }

}

