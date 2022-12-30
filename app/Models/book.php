<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'author' ,'publisher_id' ,'cathegory_id','age_to_rent', 'is_rented' ];
    public $timestamps = false;
    protected $primaryKey = "id_book";
    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false){
            $query->join('authors', 'authors.id_author', '=', 'books.author')->
            join('publishers', 'publishers.id_publisher', '=', 'books.publisher_id')->
            join('cathegories', 'cathegories.id_cathegory', '=', 'books.cathegory_id')->
            where('authors.author_name', 'like', '%' .request('search') .'%')
            -> orWhere('authors.author_surname', 'like', '%' .request('search') .'%')
            -> orWhere('title', 'like', '%' .request('search') .'%')
            -> orWhere('publishers.publisher_name', 'like', '%' .request('search') .'%')
            -> orWhere('cathegories.cathegory_name', 'like', '%' .request('search') .'%');
        }
        else{
            $query->where('active','=',1);
        }
    }
}
