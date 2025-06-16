<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Validator;
use Exception;
use App\Models\Expense;
use App\Models\Userex;
use App\Exceptions\ErrorCodeException;
use ErrorException;

class ExpenseController extends Controller
{
    

    public function userHome(Request $request){ 
        return view('expense');
    }



    public function userStore(Request $req){

        try{
            


            $validated = $req->validate([
                'name' => 'required|string',
                'amnt' => 'required|numeric',
                'ctg' => 'required|string',
                'date' => 'required|date',
            ]);

            

              $user = Userex::selectRaw('id')
              ->where('name', $req->name)
              ->first();

            

              if ($user == null) {
                $db = new Userex();

                $db->name = $req->name;

                if (!$db->save()) {
                    throw new ErrorException('Create user');
                }

                $uid = $db->id;
              }else{

                $uid=$user->id;


                $useramount = Expense::user($uid, $req->date);

               
              
                if ($useramount != null) {
                    if ($useramount->total_amount > 500 || (($useramount->total_amount + $req->amnt)  > 500) || ($req->amnt > 500)) {
                        return response()->json([
                            'status' => 'Unsucces',
                            'message' => 'Expense recorded Unsuccessfully! Total amount spent by user on day does not exceed $500.',
                        ], 200);
                    }
                }
                


              }


              
                

                /*
                $response = Http::post('/api/expenses', [
                    'user_id' => 2,
                    'amount' => $req->amnt,
                    'category' => $req->ctg,
                    'date' => $req->date,
                ]);
                
                $result = $response->json();   */

                

                $expense = Expense::create([
                    'user_id' => $uid,
                    'amount' => $validated['amnt'],
                    'category' => $validated['ctg'],
                    'date' => \Carbon\Carbon::parse($validated['date']),
                ]);


                return response()->json([
                    'status' => 'Success',
                    'message' => 'Expense recorded successfully',
                ], 200);

            
    
    
        }catch(Exception $e){
<<<<<<< HEAD
            dd($e);
=======
            
>>>>>>> f0639db (updated task)
            return response()->json([
                'status' => 'Unsuccess',
                'message' => 'Expense created Usuccessfully',
                'data' => ''
            ]);
        }


    
        }



        public function userdatas(Request $req){

            /*
            $response = Http::get('/api/expenses/daily-summary?user_id=2&date=2025-05-03');

            $data = $response->json();*/

            $user = Expense::user($req->user_id, $req->date);
            return response()->json([
                'name' => $user->name,
                'date' => $user->date,
                'total' => $user->total_amount,
                'expenses' => $user->categories,
            ], 200);

        }


        public function usrlist(Request $request){ 

            $emplyee = Expense::employees();
            
            return view('userlist', compact('emplyee'));
    
        }




}
