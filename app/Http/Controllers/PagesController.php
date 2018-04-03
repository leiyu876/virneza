<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Session;

class PagesController extends Controller
{
	public function __construct() {

        $this->middleware('guest');
    }

    public function resume01() {
    	
    	return view('pages.resume01');
    }

    public function contact_post(Request $request) {

    	$this->validate($request, [
    		'name'=>'required',
    		'email'=>'required|email',
    		'subject'=>'required',
    		'bodymessage'=>'required',
    	]);

    	$data = array(
    		'name'=>$request->name,
    		'email'=>$request->email,
    		'subject'=>$request->subject,
    		'bodymessage'=>$request->bodymessage,
    	);

    	Mail::send('email.resume.01', $data, function($message) use ($data) {
    		$message->from($data['email']);
    		$message->to('support@virneza.com');
    		$message->subject($data['subject']);
    	});

    	Session::flash('success', 'Successfully send!. Thank you for messaging me.');

    	return redirect('/');
    }
}
