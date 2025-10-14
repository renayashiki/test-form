<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Categoryモデルはcontentフィールドを編集可能にします
    protected $fillable = [
        'content',
    ];

    /**
     * Contactとのリレーション定義
     * 1つのCategoryは複数のContactを持つ
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
