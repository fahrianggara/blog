<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $thumbnail
 * @property string $description
 * @property int|null $parent_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Category[] $children
 * @property-read int|null $children_count
 * @property-read Category|null $parent
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category onlyParent()
 * @method static Builder|Category query()
 * @method static Builder|Category search($title)
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereDescription($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereParentId($value)
 * @method static Builder|Category whereSlug($value)
 * @method static Builder|Category whereThumbnail($value)
 * @method static Builder|Category whereTitle($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'thumbnail', 'description', 'parent_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function addData($data)
    {
        DB::table('categories')->insert($data);
    }

    public function scopeOnlyParent($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeSearch($query, $title)
    {
        return $query->where('title', 'LIKE', "%{$title}%");
    }

    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function generation()
    {
        return $this->children()->with('generation');
    }

    public function root()
    {
        return $this->parent ? $this->parent->root() : $this;
    }
}
