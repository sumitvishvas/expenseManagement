<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DayBookLedger; 
use App\Models\Bank; 

class Daybook extends Controller
{


    public function index1()
    {
        $data=[];
        $data['banks']=Bank::where('is_active',1)->get();
        
        $data['ledgers']= DayBookLedger::get();
       
										
        return view('dashboard', $data);
    }
  function index(Request $req)
  {
    $response = array();

    $validator = \Validator::make($req->all(),			
       array(
           
           'type' => 'required',
           'payment_mode' => 'required',
           'amount' => 'required',
           'particular' => 'required',
           'bank' => 'required',
          
       )
   );

   
   if($validator->fails())
   {
    //    dd($validator->getMessageBag());
       $response['flag'] = false;
       $response['errors'] = $validator->getMessageBag();
    //    return response()->json($response);

   }else{ 

       $date=$req->date;

       if(!$req->date){

           $date=date("Y-m-d");
           
       }

       $DayBookLedgers =  new DayBookLedger();
       
       $DayBookLedgers->type = $req->type;
       $DayBookLedgers->mode = $req->payment_mode;
       $DayBookLedgers->date = $date;
       $DayBookLedgers->receipt_no = $req->receipt_no;
       if($req->type==1){
        $DayBookLedgers->credit = $req->amount;
        $DayBookLedgers->debit = 0;
       }else{
        $DayBookLedgers->debit = $req->amount;
        $DayBookLedgers->credit = 0;
       }
  
      
       $DayBookLedgers->particular = $req->particular;
       $DayBookLedgers->bank = $req->bank;
       
       if($DayBookLedgers->save()){
        $response['success'] = true;
        $response['message'] = "Day Book Added Successfully !!";
        }else{
            $response['success'] = false;
            $response['message'] = "Something went wrong!";
        }

}

return response()->json($response);   
}
}
