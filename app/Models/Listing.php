<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Eloquent Model
class Listing extends Model
{
    use HasFactory;

    /*
        - There is two ways to handle mass Assignment Rule:
        1 - Adding the fillable property as shown below and add any property we need to add mass assignment to.
        2 -  Go to (app/providers/AppServiceProvider) and check the boot function to find out.
    */
    protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags', 'logo', 'user_id'];

    public function scopeFilter($query, array $filters) {
        // If there is a tag filter the result otherwise move on.
        if($filters['tag'] ?? false) {
            // Select * FROM listing WHERE tags LIKE tagValue.
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }
        
        if($filters['search'] ?? false) {
            // Select * FROM listing WHERE title LIKE searchValue.
            $query->where('title', 'like', '%' . request('search') . '%')
            // Select * FROM listing WHERE description LIKE searchValue.
            ->orWhere('description', 'like', '%' . request('search') . '%')
            // Select * FROM listing WHERE tags LIKE searchValue.
            ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    // Relationship To User
    public function user() {
        /*
            - (user_id) is not necessary since its the default but we will write it anyway.
            - As a one to many relationship the many belongs to one and thats why we used belongsTo here.
        */
        return $this->belongsTo(User::class, 'user_id');
    }
}
