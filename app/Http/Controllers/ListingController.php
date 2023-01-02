<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\book;
use App\Models\bookListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Session\Session;
use Illuminate\Validation\ValidationException;

class ListingController extends Controller
{
    //all items
    public function index(){
        return view('listings.index', [
            'listings' => book::filter(request(['search']))->paginate(9)
        ]);
    }
    
    //single item
    public function show(book $listing){
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    //adding book form
    public function create(){
        return view('listings.create');
    }

    // store element in database
    public function store(Request $request){
        $formFields = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher_id' => 'required',
            'cathegory_id' => 'required',
            'age_to_rent' => ['required', 'integer','min:1','max:18']
        ]);
        $author = explode(" ",$request->author);

        if (str_contains($request->author , ' '))
        {
            $formFields['author'] = DB::table('authors')->whereRaw("author_name like '$author[0]' and author_surname like '$author[1]'")->value('id_author');
        }
        else{
            $error = \Illuminate\Validation\ValidationException::withMessages([
                'author' => ['Zły format autora, podaj ze spacją np: "Jan Kowalski"'],
             ]);
             throw $error;
        }

        
        $formFields['publisher_id'] = DB::table('publishers')->whereRaw("publisher_name like '$request->publisher_id'")->value("id_publisher");
        $formFields['cathegory_id'] = DB::table('cathegories')->whereRaw("cathegory_name like '$request->cathegory_id'")->value("id_cathegory");

        if ($formFields['author'] == null){
            if(substr($author[0], -1) == "a"){
                $gender = 'female';
            }
            else{
                $gender = 'male';
            }
            DB::insert('insert into authors (author_name,author_surname,gender) values (?,?,?)',[$author[0],$author[1],$gender]);
            $formFields['author'] = DB::table('authors')->whereRaw("author_name like '$author[0]' and author_surname like '$author[1]'")->value('id_author');
        }
        if ($formFields['publisher_id'] == null){
            DB::insert('insert into publishers (publisher_name) values ( ? )',[$request->publisher_id]);
            $formFields['publisher_id'] = DB::table('publishers')->whereRaw("publisher_name like '$request->publisher_id'")->value("id_publisher");
        }
        if ($formFields['cathegory_id'] == null){
            DB::insert('insert into cathegories (cathegory_name) values ( ? )',[$request->cathegory_id]);
            $formFields['cathegory_id'] = DB::table('cathegories')->whereRaw("cathegory_name like '$request->cathegory_id'")->value("id_cathegory");
        }
        book::create($formFields);

        return redirect('/')->with('message','Książka dodana poprawnie!');
    }

    public function rent(Request $request){
        $user_age = Carbon::parse(auth()->user()->birth_date)->age;
        if($user_age < $request->age_to_rent){
            return redirect('/')->with('message-err','Jesteś za młody aby to wypożyczyć.');
        }
        $id = auth()->user()->id_user;
        $date = date('Y-m-d');
        $books_rented = DB::table('users')->whereRaw("id_user = '$id'")->value('books_rented');
        if($books_rented >= 2){
            return redirect('/')->with('message-err','Możesz mieć max 2 książki na raz');
        }
        DB::update('update users set books_rented = ? where id_user = ?', [$books_rented+1,$id]);
        DB::update('update users set updated_at = ? where id_user = ?', [date('Y-m-d H:i:s'),$id]);
        DB::update('update users set modified_by = ? where id_user = ?', [$id,$id]);
        DB::update('update books set is_rented = ? where id_book = ?', [1,$request->id_book]);
        DB::table('rents')->insert([
            'start_rent'=>date('Y-m-d H:i:s'),
            'return_date'=>date('Y-m-d', strtotime($date. '+ 30 days')),
            'overdue'=>0,
            'book_id'=>$request->id_book,
            'user_id'=>$id
        ]);
        return redirect('/')->with('message','Książka wypożyczona!');
    }
    public function returnbook(Request $request){
        $id = $request['userId'];

        $date = date('Y-m-d');
        $books_rented = DB::table('users')->whereRaw("id_user = '$id'")->value('books_rented');
        DB::update('update users set books_rented = ? where id_user = ?', [$books_rented-1,$id]);
        DB::update('update users set modified_by = ? where id_user = ?', [auth()->user()->id_user,$id]);
        DB::update('update users set updated_at = ? where id_user = ?', [date('Y-m-d H:i:s'),$id]);
        DB::update('update books set is_rented = ? where id_book = ?', [0,$request->id_book]);
        DB::update('update rents set return_date = ?, rent_state="Zwrócono" where id_rent = ?', [$date,$request['id_rent']]);
        return redirect('/allrents')->with('message','Książka zwrócona!');
    }
    public function givebook(Request $request){
        DB::update('update rents set  rent_state="Wydano" where id_rent = ?', [$request['id_rent']]);
        return redirect('/allrents')->with('message','Książka wydana!');
    }
    public function showrents(){
        $rents = DB::table('rents')->
        where('user_id','=',auth()->user()->id_user)
        ->get();
        return view('listings.rented-books',[
            'rents'=>$rents
        ]);
    }

    public function allrents(){
        $rents = DB::table('rents')
        ->get();
        return view('listings.all-rents',[
            'rents'=>$rents
        ]);
    }
    public function removebook(Request $request){
        if($request['is_rented']){
            return redirect('/book/'.$request['id_book'])->with('message-err','Nie możesz usunąć książki, która jest wypożyczona!');
        }
        DB::update('update books set active = ? where id_book = ?', [0,$request->id_book]);
        return redirect('/')->with('message','Książka usunięta!');
    }
}
