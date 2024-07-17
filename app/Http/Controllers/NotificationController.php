<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Auth;

use DB;

class NotificationController extends Controller

{

    public function index() {

        $notifications = auth()->user()->notifications()->paginate(15);

        

        auth()->user()->unreadNotifications->markAsRead();

        

        if(Auth::user()->user_type == 'admin') {

            return view('backend.notification.index', compact('notifications'));

        }

        

        if(Auth::user()->user_type == 'seller') {

            return view('seller.notification.index', compact('notifications'));

        }

        

        if(Auth::user()->user_type == 'customer') {

            return view('frontend.user.customer.notification.index', compact('notifications'));

        }

        

    }


     public function notifications()
    {
        $notifications = DB::table('mailnotifications')->paginate(10);
        return view('backend.notification.list',compact('notifications'));
    }

     public function storenotifications()
    {
        return view('backend.notification.storenotifications');
    }


  public function store(Request $request)
{
    $data = [
        'name'    => $request->name,
        'subject'   => $request->subject,
        'contant'  => $request->contant,
        'status' => $request->status,
    ];

    DB::table('mailnotifications')->insert($data);

    return redirect('admin/notifications')->with('status', 'Notifications Added Successfully');
}


  public function editnotifications($id)
    {
       $notifications = DB::table('mailnotifications')->where('id',$id)->first();
        return view('backend.notification.editnotifications', compact('notifications'));
    }
   

   public function updatenotifications(Request $request, $id)
    {
          $data = [
	        'name'    => $request->name,
	        'subject'   => $request->subject,
	        'contant'  => $request->contant,
	        'status' => $request->status,
	    ];

         DB::table('mailnotifications')->where('id', $id)->update($data);

        return redirect('admin/notifications')->with('status','Notifications Updated Successfully');
    }


	public function deletenotifications(Request $request, $id)
{
    DB::table('mailnotifications')->where('id', $id)->delete();
    return redirect('admin/notifications')->with('status', 'Notification deleted successfully');
}



}

