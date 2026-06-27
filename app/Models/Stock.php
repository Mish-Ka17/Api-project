<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [

        'date',
        'last_change_date',

        'supplier_article',
        'tech_size',

        'barcode',

        'quantity',
        'quantity_full',

        'is_supply',
        'is_realization',

        'warehouse_name',

        'in_way_to_client',
        'in_way_from_client',

        'nm_id',

        'subject',
        'category',
        'brand',

        'sc_code',

        'price',
        'discount',

        'imported_at',
    ];

    protected $casts = [

        'date' => 'date',
        'last_change_date' => 'date',
        'imported_at' => 'datetime',

        'price' => 'decimal:2',

        'is_supply' => 'boolean',
        'is_realization' => 'boolean',
    ];
}
