<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;
use App\Models\Country;

use Carbon\carbon;

class UserController extends Controller
{
    public function index(){
        return view('index');
    }

    public function getCountry(Request $request){
        $country = Country::where('name', 'ILIKE', '%'.$request->input('term', '').'%')
                    ->orWhere('code', 'ILIKE', '%'.$request->input('term', '').'%')
                    ->get(['id', 'name as text']);

        return ['results' => $country];
    }

    public function storeUser(Request $request){
        $this->validate($request, [
            'name'=>'required',
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    if (User::where('email', $value)->count() > 0) {
                        $fail('Email is already being used. Please try another email');
                    }
                },
            ],
            'password'=>'required',
            'dob'=>'required',
            'country'=>'required'
        ]);

        
            $user = new User([
                'name'=>$request->get('name'),
                'email'=>$request->get('email'),
                'password'=>$request->get('password'),
                'dob' => carbon::createFromFormat('d-m-Y', str_replace('/', '-', $request->get('dob')))->toDateString(),
                'country' => $request->get('country')
            ]);
            $user->save(); 

                   

        echo json_encode($user);
    }

    public function getUser()
	{
		$list['user'] = User::with('countryforuser')->get();
        //dd($list['user']);
        return view('user')->with($list);
	}
}
