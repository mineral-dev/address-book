<?php

namespace Mineral\AddressBook\Models;

use Dyrynda\Database\Casts\EfficientUuid;

class AddressBook extends \App\Models\BaseModel
{

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->connection = \Illuminate\Support\Facades\Config::get('address-book.database.connection');
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}