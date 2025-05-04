<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Expense extends Model
{
   // app/Models/Expense.php

    protected $fillable = ['user_id', 'amount', 'category', 'date'];


    public static function employees()
    {
        
        $user = DB::table('expenses as a')
        ->selectRaw('a.user_id, b.name, a.date, GROUP_CONCAT(DISTINCT a.category) as category')
        ->leftJoin('userexes as b', 'b.id', '=', 'a.user_id')
        ->groupBy('a.date', 'a.user_id', 'b.name')
        ->get();


        return $user;
    }

    public static function user($id, $date)
    {
        
        $user = DB::table('expenses as a')
        ->selectRaw('a.date, b.name, SUM(a.amount) as total_amount, GROUP_CONCAT(DISTINCT a.category) as categories')
        ->leftJoin('userexes as b', 'b.id', '=', 'a.user_id')
        ->where('a.user_id', $id)
        ->where('a.date', $date)
        ->groupBy('a.date', 'a.user_id', 'b.name')
        ->first();

        return $user;
    }

}
