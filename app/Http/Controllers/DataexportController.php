<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Config;
use Maatwebsite\Excel\Facades\Excel;
// use App\Models\DataConnecting;


class DataexportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = DB::select('SHOW TABLES');

        return view('dataexpo.index',compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //Connect Data Base

         $db=$request->input('database');

        $dbuser=$request->input('databaseuser');

        $dbpassword=$request->input('databaseuserpassword');

       Config::set("database.connections.mysql1", [
            "driver" => "mysql",
            "host" => "localhost",
            "database" =>$db,
            "username" =>$dbuser,
            "password" =>$dbpassword
]);

        $db_ext = \DB::connection('mysql1');
        $tables = $db_ext->select('SHOW TABLES');
       /* print_r($tables);
exit;*/
         
        return view('import_export',compact('tables','db','dbuser','dbpassword'));

         
    // or just DB::connection()
        if (DB::connection()->getDatabaseName())
         {
         return 'Connected to the DB: ' . DB::connection()->getDatabaseName();
         }

         exit;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function exportdata(Request $request)
    {

   $tbl_info = $request->input("tableinfo");
if (isset($tbl_info)) {
    
    $data = DB::table($tbl_info)->get()->toArray();
    foreach ($data as $trackinfo) {
        $urlinfoArray[] = $trackinfo;
    }
    $array = json_decode(json_encode($urlinfoArray), true);
    return Excel::download(function ($excel) use ($array) {
        $excel->sheet('trackReport', function ($sheet) use ($array) {
            $sheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('#FFFF00');
            $sheet->fromArray($array, null, 'A1', false, false);
        });
    }, $tbl_info . '.xlsx');
}
    


      
    }

  public function promotionLeads()
   {


       $promotiondata=DB::table('flatpages')->select('type')->distinct('type')->get();

       $subscribers=DB::table('subscribers')->where('type','like','%Magazine-Subscription -%')->select('type')->distinct('type')->get();
       
        $webinars=DB::table('webinar_data')->select('type')->distinct('type')->get();
        $downloads=DB::table('downloads')->select('type')->distinct('type')->get();
        $advertise_section=DB::table('forms')->select('type')->distinct('type')->get();
        $magazine_subscribe=DB::table('subscription')->select('type')->distinct('type')->get();
        return view('promotions.promotion',compact('promotiondata','subscribers','webinars','downloads','advertise_section','magazine_subscribe'));

        



   }

   public function promotionleadslist($promotion)
   {



  $leadsinfo=DB::table('flatpages')->select('id','name','firstname','lastname','email','title','company','country','type','phone','created_at')->where('type',$promotion)->orderBy('id', 'desc')->get();
//$leads_form = DB::table('forms')->select('id','firstname','lastname','email','job_title','company','country','phone','type','created_at')->where('type',$promotion)->orderBy('id', 'desc')->get();
  $leads_info=DB::table('flatpages')->select('id','firstname','lastname','email','title','company','country','type','phone','created_at')->where('type',$promotion)->orderBy('id', 'desc')->get();
 return view('promotions.leads',compact('leadsinfo','leads_info'));

   }


   public function promotionForms($promotion){

    $leads_form = DB::table('forms')->select('id','firstname','lastname','email','job_title','company','country','phone','type','created_at')->where('type',$promotion)->orderBy('id', 'desc')->get();
return view('promotions.forms',compact('leads_form'));
   }
   public function promotionformleadslist($promotion)
   {



    $leadsinfo=DB::table('subscribers')->select('id','fullname','email','designation','industry','address','country_name','type','telephone','created_at')->where('type',$promotion)->orderBy('id', 'desc')->get();

      return view('promotions.subscriptions',compact('leadsinfo'));

  }
  public function promotiondownloadleadslist($promotion)
   {
    $leadsinfo=DB::table('downloads')->select('id','fullname','email','designation','country_name','type','telephone','created_at')->where('type',$promotion)->orderBy('id', 'desc')->get();
      return view('promotions.download',compact('leadsinfo'));
   }
  
  public function promotionwebinars($webinar)
   {

     $leadsinfo=DB::table('webinar_data')->select('id','firstname','lastname','email','job_title','company','address1','address2','country','city','state','zip','type','phone','email_updates','representative','quotation','created_at')->where('type',$webinar)->orderBy('id', 'desc')->get();
      return view('promotions.webinars',compact('leadsinfo'));
  }
  public function promotionsubscribe($promotion)
   {
    $leadsinfo=DB::table('subscription')->select('id','name','email','job_title','company','country','type','telephone','created_at')->where('type',$promotion)->orderBy('id', 'desc')->get();

      return view('promotions.magazine_subscribe',compact('leadsinfo'));
  }

}