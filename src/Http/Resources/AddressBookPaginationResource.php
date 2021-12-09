<?php


namespace Mineral\AddressBook\Http\Resources;


use Illuminate\Http\Resources\Json\ResourceCollection;

class AddressBookPaginationResource extends ResourceCollection
{
    public function toArray($request)
    {
//        dd($this->perPage);
//        dd($this->links());
        return [
            'items' => AddressBookResource::collection($this),
            'lastPage' => $this->lastPage(),
            'total' => $this->count(),
            'currentPage' => $this->currentPage(),
            'nextPageUrl' => $this->nextPageUrl(),
            'prevPageUrl' => $this->previousPageUrl(),
        ];
    }
}