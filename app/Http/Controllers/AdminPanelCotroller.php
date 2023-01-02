<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPanelCotroller extends Controller
{
    public function admin(){
        return view('admin-panel.admin-panel', [
            'allUsers'=> User::all(),
            'allRoles'=> DB::table('roles')->select('name')->get()->pluck('name')
        ]);
    }

    public function userhandle(Request $request){
        $user = User::find($request['userId']);
        if ($request['function'] == "ADD"){
            if($user -> hasRole($request['role'])){
                return redirect('/admin')->with('message-err', 'User już ma tą rolę!');
            }
            $user -> assignRole($request['role']);
            DB::update('update users set modified_by = ? where id_user = ?', [auth()->user()->id_user,$request['userId']]);
            DB::update('update users set updated_at = ? where id_user = ?', [date('Y-m-d H:i:s'),$request['userId']]);
            return redirect('/admin')->with('message', 'Rola Dodana!');
        }
        elseif($request['function'] == "REMOVE"){
            if($user == auth()->user() && $request['role'] == "Admin"){
                return redirect('/admin')->with('message-err', 'Nie możesz usunąć sobie roli administratora!');
            }
            if(!($user -> hasRole($request['role']))){
                return redirect('/admin')->with('message-err', 'Ten user nie ma takiej roli!');
            }
            $user->removeRole($request['role']);
            DB::update('update users set modified_by = ? where id_user = ?', [auth()->user()->id_user,$request['userId']]);
            DB::update('update users set updated_at = ? where id_user = ?', [date('Y-m-d H:i:s'),$request['userId']]);
            return redirect('/admin')->with('message', 'Rola Usunięta!');
        }
        elseif($request['function'] == "DELETE"){
            if($user == auth()->user()){
                return redirect('/admin')->with('message-err', 'Nie możesz usunąć konta na którym jesteś zalogowany!');
            }
            if($user->books_rented > 0){
                return redirect('/admin')->with('message-err', 'Nie możesz usunąć konta które ma coś wypożyczone!');
            }
            $user->delete();
            return redirect('/admin')->with('message', 'User Usunięty!');
        }
        elseif($request['function'] == "block"){
            if($user == null){
                return redirect('/')->with('message-err', 'Nie ma takiego użytkownika!');
            }
            if($user == auth()->user()){
                return redirect('/')->with('message-err', 'Nie możesz zablokować siebie.');
            }
            if(!($user -> hasRole('Klient'))){
                if(($user -> hasRole('Bibliotekarz')) || ($user -> hasRole('Admin'))){
                    return redirect('/')->with('message-err', 'Możesz blokować tylko klientów.');
                }
                return redirect('/')->with('message-err', 'Użytkownik już zablokowany.');
            }
            
            $user->removeRole('Klient');
            DB::update('update users set modified_by = ? where id_user = ?', [auth()->user()->id_user,$request['userId']]);
            DB::update('update users set updated_at = ? where id_user = ?', [date('Y-m-d H:i:s'),$request['userId']]);
            $date = date('Y-m-d');
            $books_rented = DB::table('users')->whereRaw("id_user = '$user'")->value('books_rented');
            $rented_ids = DB::table('rents')->where('user_id','=',$request['userId'])->pluck('id_rent');

            foreach ($rented_ids as $rented_id) {
                DB::update('update users set books_rented = ? where id_user = ?', [0,$request['userId']]);
                DB::update('update users set modified_by = ? where id_user = ?', [auth()->user()->id_user,$request['userId']]);
                DB::update('update users set updated_at = ? where id_user = ?', [date('Y-m-d H:i:s'),$request['userId']]);
                DB::update('update books set is_rented = ? where id_book = ?', [0,DB::table('rents')->where('id_rent','=',$rented_id)->pluck('book_id')[0]]);
                DB::update('update rents set return_date = ?, rent_state="Zwrócono" where user_id = ? and book_id = ?', [$date,$request['userId'], DB::table('rents')->where('id_rent','=',$rented_id)->pluck('book_id')[0]]);
            }
            
            return redirect('/allrents')->with('message', 'Użytkownik zablokowany!');
        }
        
    }
   
}
