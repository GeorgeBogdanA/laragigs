<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    //dichiarazione campi che si possono inserire sul db massivamente tramite form. X evitare: Add [title] to fillable property to allow mass assignment on [App\Models\Listing].
    //Modo 1
    protected $fillable = ['user_id', 'title', 'tags', 'company', 'location', 'email', 'website', 'description', 'logo'];

    //Modo 2
    //protected $guarded = [];

    public function scopeFilter($query, array $filters) {
        if ($filters['tag'] ?? false) {
            //$query->where('tags', 'like', '%' . request('tag') . '%');
            $query->where('tags', 'like', '%' . $filters['tag'] . '%');
        }
        if ($filters['search'] ?? false) {
            //$query->where('tags', 'like', '%' . request('tag') . '%');
            $query->where('title', 'like', '%' . $filters['search'] . '%')
                ->orWhere('description', 'like', '%' . $filters['search'] . '%')
                ->orWhere('company', 'like', '%' . $filters['search'] . '%')
                ->orWhere('location', 'like', '%' . $filters['search'] . '%')
                ->orWhere('tags', 'like', '%' . $filters['search'] . '%');
        }
    }
    //Relationship To User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}