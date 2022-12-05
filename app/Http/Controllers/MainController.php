<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Validator;
use Auth;
use Elastic\Elasticsearch;
use Elastic\Elasticsearch\ClientBuilder;
use App\Rules\ReCaptcha;

class MainController extends Controller
{
    function main()
    {
        return view('login');
    }

    function checklogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password'=> 'required|alphaNum|min:6',
            'g-recaptcha-response'=> ['required', new ReCaptcha]
           ]);
      
           $user_data = array(
            'email'  => $request->get('email'),
            'password' => $request->get('password')
           );
           
            if(Auth::attempt($user_data))
            {
            
            if (DB::table('users')->where('email', $request->email)->exists()) {
                $userInfo = Auth::user();
                $userInfo = DB::table('users')->where('email', $request->email)->first();
            }

            if($userInfo != null) {
                $userInfo = Auth::user();
                $result= MailController::VerificationEmail($userInfo->name,$userInfo->email,$userInfo->verification_code);
                $userInfo->verification_code = $result;
                $userInfo->save();
                return redirect()->back()->with('message','Please Check your email for the verification code!');        
           
            }
        }
           else
           {
            return back()->with('error', 'Wrong Login Details');
           }
      
    }

    function successlogin()
    {
        return view('index');
    }
    
    function logout()
    {
        $user = Auth::user();
        $user->is_verified = 0;
        $user->save();
        Auth::logout();
        return redirect('main');
    }

    function register()
    {
        return view('register');
    }

    function signup(Request $request)
    {   
        if (DB::table('users')->where('email', $request->email)->exists()) {
            $userInfo = Auth::user();
            $userInfo = DB::table('users')->where('email', $request->email)->first();
            return redirect()->back()->with('error', 'This user already exists!');
        }
       
        $request->validate([
            'name'             => 'required',
            'email'            => 'required|email',
            'password'         => 'min:6|alphaNum|required_with:confirm_password',
            'confirm_password' => 'min:6|same:password',
        ]);
        $user = User::create([
            'name'         => $request->input('name'),
            'email'        => $request->input('email'),
            'password'     => Hash::make($request->input('password')),
        ]);
        return redirect('/main')->with('message','Successfully Registered and now you can login!');
        //return view('login')->with('message','You have successfully registered and now you can login!');
    }

    function update_info()
    {
        $userInfo = Auth::user();
        return view('update',['userInfo' => $userInfo]);
    }

    function updatedetails(Request $request)
    { 
            $request->validate([
                'name'                 => '',
                'email'                => 'email',
            ]);
            $userInfo=User::find($request->id);
            $userInfo->name=$request->name;
            $userInfo->email=$request->email;
            $userInfo->save();
            return redirect()->back()->with('message', 'You have updated your information succesfully!');
    
    }

    function updatepassword(Request $request)
    { 
            $request->validate([
                
                'new_password'             => 'required|min:6|alphaNum',
                'confirm_password'         => 'required|min:6|same:new_password'
            ]);
            $userInfo=User::find($request->id);
            $userInfo->password=Hash::make($request->input('new_password'));
            $userInfo->save();
            return redirect()->back()->with('message', 'You have updated your information succesfully!');           
    
    }

    function forgotpassword()
    {
        return view('forgotpassword');
    }
    function forgot_password(Request $request)
    {
         
        if (DB::table('users')->where('email', $request->email)->exists()) {
            $userInfo = Auth::user();
            $userInfo = DB::table('users')->where('email', $request->email)->first();

      
    }
        if($userInfo != null)
        {
            MailController::sendForgotPassword($userInfo->name,$userInfo->email,$userInfo->verification_code);
            return redirect()->back()->with('message','Please Check your email to set a new password!');
        }
            
        return redirect()->back()->with('error_message','Please enter a valid email');
    
    }
    public function setnewpassword($email)
    {
        $user=User::where(['email' => $email])->first();
        return view('setnewpassword',['user' => $user]);
    }
    
    public function set_password(Request $request)
    {   
        $request->validate([
         'new_password'         => 'required|min:6|alphaNum|required_with:confirm_password',
         'confirm_password'     => 'required|min:6|same:new_password'
          ]);

          $userInfo=User::find($request->id);
          $userInfo->password=Hash::make($request->input('new_password'));
          $userInfo->save();
          return redirect()->back()->with('message',"You have changed your password successfully!");
    }

    public function verificationpage()
    {
        return view('verificationpage');
    }

    public function verifyuser(Request $request)
    {
         
        $token = $_GET['verification_code'];
        $user = Auth::user();
        if($token == $user->verification_code)
        {        
            $user->is_verified = 1;
            $user->save();
            return view('index');
        }
        else{
            return redirect()->back()->with('error','The two factor code you have entered does not match');
        }
    }
    public function searchpage()
    {
        return view('serp');
    }
    public function seepage()
    {
        return view('see');
    }

    public function searchword(Request $request)
    {   
        $query_string = $request->get("q");
        $q = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $query_string);
          if ($query_string != "") {
              $searchParams = [
                'index' => 'metadata2',
                'from' => 0,
                'size' => 501,
                'type' => '_doc',
                'body' => [
                    'query' => [
                        'multi_match' => [
                            'query' => $q,
                            'fields' => ['$etd_file_id','author','$year','university','degree','program','abstract','title','advisor','wiki_terms']

            ]
                        ]
                ]
                        ];

        return view('serp', ["query_string"=>$query_string])->withquery($searchParams);      
    }
    }

    public function download(Request $request){
        $pdf = $request->get("q");
        $path = "/Users/pavani/web/storage/app/public/PDF";
      
        $dir =scandir($path);
        foreach($dir as $file){
          $fname=$path;
        }
        if(mime_content_type($fname)=='application/pdf')
        {
            $name="/Users/pavani/web/PDF/".$pdf."/".$file;
            return response() -> download($name);
        }
    }

    public function loginsearch(Request $request)
    {

        $query_string = $request->get("q");
        $q = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $query_string);
        if ($query_string != "") {
            $searchParams = [
                'index' => 'metadata2',
                'from' => 0,
                'size' => 501,
                'type' => '_doc',
                'body' => [
                    'query' => [
                        'multi_match' => [
                            'query' => $q,
                            'fields' => ['$etd_file_id','author','$year','university','degree','program','abstract','title','advisor','wiki_terms']

            ]
                        ]
                ]
                        ];

        return view('loginserp', ["query_string"=>$query_string])->withquery($searchParams);  
                    }
    }
    
    public function summary(Request $request)
    {
        $query_string = $request->get("q");
        $q = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $query_string);
      
          if ($query_string != "") {
            $params = [
                'index' => 'metadata2',
                'from' => 0,
                'size' => 501,
                'type' => '_doc',
                'body' => [
                    'query' => [
                        'multi_match' => [
                            'query' => $q,
                            'fields' => ['pdf']
          
                            ]
                        ]
                    ]
                ];
          
        return view('summary',["query_string"=>$query_string])->withquery($params);
    }
    }

    public function loginsummary(Request $request)
    {
        $query_string = $request->get("q");
        $q = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $query_string);
      
          if ($query_string != "") {
            $params = [
                'index' => 'metadata2',
                'from' => 0,
                'size' => 501,
                'type' => '_doc',
                'body' => [
                    'query' => [
                        'multi_match' => [
                            'query' => $q,
                            'fields' => ['pdf']
          
                            ]
                        ]
                    ]
                ];
          
        return view('loginsummary',["query_string"=>$query_string])->withquery($params);
    }
    }

    public function insert(Request $request)
    {
        
        return view('insert');
            
    }

    public function add_data(Request $request)
    {
        $client = ClientBuilder::create()->setHosts(['localhost:9200'])->build();
        
        $title                 = $request->input("title");
        $author                = $request->input('author');
        $degree                = $request->input('degree');
        $program               = $request->input('program');
        $university            = $request->input('university');
        $year                  = $request->input('year');
        $pdf                   = rand(500,1500).".pdf";
        $etd_file_id           = rand(500,1500);
        $abstract              = $request->input('abstract');
        $advisor               = $request->input('advisor');

        $params = [
            'index' => 'metadata2',
            'type' => '_doc',
            'body'  => [
                    'etd_file_id'=>$etd_file_id,
                    'title' => $title,
                    'author' => $author,
                    'degree' => $degree,
                    'program' => $program,
                    'university' => $university,
                    'year'=> $year,
                    'pdf'=> $pdf,
                    'abstract'=> $abstract,
                    'advisor'=> $advisor
                    
            ]
        ];
        
        $response = $client->index($params);
        $pdf_id = trim($pdf,".pdf");

        echo'
        <div class="alert">
        <h3>We have successfully indexed your data!</h3>
        <h3>We have generated a PDF id : '.$pdf_id.'  , please upload your PDF with '.$pdf.' name</h3>
        </div>';
    }

    public function getTokenapi()
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            if ($user->getRememberToken() == null) {
                $token = Str::random(32);
                $user->setRememberToken($token);
                $user->save();
            }
            return response()->json(['success' => $user->getRememberToken()], 200);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function dosearchapi()
    {
      $terms = request('query');
      $limit = request('n');
      $key = request('key');
      $client =  ClientBuilder::create()->build();
      $users = Auth::user();
      $resultids = (array)DB::select('select remember_token from users');
      $resultstr = json_encode($resultids);

      if ($key != NULL && str_contains($resultstr, $key)) {

                  $searchParams = [
                    'index' => 'metadata2',
                    'from' => 0,
                    'size' => $limit,
                    'type' => '_doc',
                    'body' => [
                        'query' => [
                            'multi_match' => [
                                'query' => $terms,
                                'fields' => ['author','title','$etd_file_id','$year','university','degree','program','abstract','advisor'],
    
                                ]
                            ]
                        ]
                    ];

          $results = $client->search($searchParams);
          $count = $results['hits']['total']['value'];
          $res = $results['hits']['hits'];
          $rank = 1;
    
         foreach( $res as $r)
          {       
            if($rank<=$limit)
            {
                $title[$rank]['title'] = $results['hits']['hits'][$rank-1]['_source']['title'];
                $author[$rank]['author'] = $results['hits']['hits'][$rank-1]['_source']['author'];
                $etd[$rank]['etd_file_id'] = $results['hits']['hits'][$rank-1]['_source']['etd_file_id'];
                $year[$rank]['year'] = $results['hits']['hits'][$rank-1]['_source']['year'];
                $university[$rank]['university'] = $results['hits']['hits'][$rank-1]['_source']['university'];
                $degree[$rank]['degree'] = $results['hits']['hits'][$rank-1]['_source']['degree'];
                //$abstract[$rank]['abstract'] = $results['hits']['hits'][$rank-1]['_source']['abstract'];
                $advisor[$rank]['advisor'] = $results['hits']['hits'][$rank-1]['_source']['advisor'];
                $program[$rank]['program'] = $results['hits']['hits'][$rank-1]['_source']['program'];
                $rank+=1;
            }
          }
          return response()->json(['response'=>$title,$author,$advisor,$etd,$year,$university,$degree,$program], 200);
        }else {
          return response()->json(['error' => 'UnAuthorised Access'], 401);
      }
  }

}




