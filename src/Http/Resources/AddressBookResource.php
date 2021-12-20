<?php


namespace Mineral\AddressBook\Http\Resources;


use App\Enums\DescriptionType;
use App\Models\ProductVariant;
use App\Models\Description;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Support\Str;

class AddressBookResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'name' => $this->name,
            'mobile' => $this->mobile,
            'address' => $this->address,
            'country' => $this->country,
            'province' => base64_encode($this->province),
            'city' => base64_encode($this->city),
            'district' => base64_encode($this->district),
            'postal_code' => $this->postal_code,
            'default' => $this->default,
        ];
    }
}
