<?php

namespace App\Models\Products;

use App\Casts\Json;
use App\Models\User;
use App\Enums\ProductType;
use App\Enums\ProductState;
use App\Models\Core\Procedure;
use App\Traits\HasTimeline;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products\Groups\ProductGroup;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Products\Categories\ProductSubCategory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, HasTimeline;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'serial',
        'user_id',
        'manager_id',
        'procedure_id',
        'product_group_id',
        'folder_id',
        'type',
        'state',
        'description',
        'timeline',
    ];

    protected $casts = [
        'state' => ProductState::class,
        'type' => ProductType::class,
        'timeline' => Json::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function procedure(): BelongsTo
    {
        return $this->belongsTo(Procedure::class, 'procedure_id');
    }

    public function productGroup(): BelongsTo
    {
        return $this->belongsTo(ProductGroup::class, 'product_group_id');
    }

    public function folder(): BelongsTo
    {
        return $this->belongsTo(ProductFolder::class, 'folder_id');
    }

    public function avatar(): HasOne
    {
        return $this->hasOne(ProductPicture::class, 'product_id')->where(
            'avatar',
            true,
        );
    }

    public function pictures(): HasMany
    {
        return $this->hasMany(ProductPicture::class, 'product_id')->where(
            'avatar',
            false,
        );
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductSubCategory::class,
            'categories_products',
            'product_id',
            'sub_category_id',
        );
    }
}
