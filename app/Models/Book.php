<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Book extends Model
{
    use HasFactory, Searchable;

    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'author',
        'genre',
        'description',
        'isbn',
        'image',
        'published',
        'publisher'
    ];

    protected $appends = [
        'image_url'
    ];

    const STORAGE_PATH = 'storage/images/books/';

    public function getImageUrlAttribute() {
        if($this->image) {
            return asset(self::STORAGE_PATH . $this->image);
        }
        return asset('images/thumbnail.png');
    }

    /**
     * Get the name of the index associated with the model.
     */
    public function searchableAs(): string {
        return 'books_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array {
        $array = $this->toArray();
        // Customize the data array...
        return $array;
    }
}
