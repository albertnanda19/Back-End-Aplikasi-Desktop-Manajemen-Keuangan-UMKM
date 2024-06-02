<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transaction";

    protected $fillable = [
        "id",
        "type",
        "amount",
        "category_id",
        "note",
        "created_at",
        "updated_at",
    ];

    public $incrementing = false;
    protected $keyType = "string";

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id", "id");
    }
}
