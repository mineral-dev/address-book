<?php

namespace Mineral\AddressBook\Http\Controllers;

use App\Rules\DistrictFormatRule;
use Illuminate\Validation\ValidationException;
use Mineral\AddressBook\Http\Resources\AddressBookPaginationResource;
use Mineral\AddressBook\Http\Resources\AddressBookResource;
use Mineral\AddressBook\Models\AddressBook;

class AddressBookController extends \App\Http\Controllers\Controller
{
    public function index()
    {
        $addressBook = AddressBook::byUser(auth()->id());

        if($keyword = request()->get("keyword"))
            $addressBook = $addressBook->where('name', 'like', "%$keyword%");

        return response()->json([
            'success' => true,
            'address_book' => new AddressBookPaginationResource($addressBook->paginate(app('config')->get('address-book.paginate')))
        ]);
    }

    public function store()
    {
        $rules = [
            'country' => 'required',
            'province' => 'required',
            'city' => ['required_if:country,indonesia', new DistrictFormatRule],
            'district' => ['required_if:country,indonesia', new DistrictFormatRule],
            'postal_code' => 'required',
            'address' => 'required',
        ];

//        try{
//            $this->validate(request(), $rules);
//        }
//        catch (ValidationException $e) {
//            return response([
//                'success' => false,
//                'errors' => $e->errors()
//            ], 422);
//        }

        $addressBook = new AddressBook;
        $addressBook->user_id = auth()->id();
        $addressBook->name = request()->get('name');
        $addressBook->mobile = request()->get('mobile');
        $addressBook->country = request()->get('country');
        $addressBook->province = base64_decode(request()->get('province'));
        $addressBook->city = base64_decode(request()->get('city'));
        $addressBook->district = base64_decode(request()->get('district'));
        $addressBook->postal_code = request()->get('postal_code');
        $addressBook->address = request()->get('address') ?? 0;
        $addressBook->default = request()->get('default');
        $addressBook->save();

        if($addressBook->default) {
            AddressBook::where('id', '<>', $addressBook->id)
                ->where('user_id', auth()->id())->update(['default' => 0]);
        }

        return response([
            'success' => true,
            'address_book' => new AddressBookResource($addressBook)
        ], 200);
    }

    public function show($id)
    {
        $addressBook = AddressBook::byUser(auth()->id())->whereUuid($id)->first();

        return response()->json([
            'success' => true,
            'address_book' => new AddressBookResource($addressBook)
        ], 200);
        
    }

    public function update($id)
    {
        $rules = [
            'country' => 'required',
            'province' => 'required',
            'city' => ['required_if:country,indonesia', new DistrictFormatRule],
            'district' => ['required_if:country,indonesia', new DistrictFormatRule],
            'postal_code' => 'required',
            'address' => 'required',
        ];

//        try{
//            $this->validate(request(), $rules);
//        }
//        catch (ValidationException $e) {
//            return response([
//                'success' => false,
//                'errors' => $e->errors()
//            ], 422);
//        }

        $addressBook = AddressBook::whereUuid($id)->first();
        $addressBook->name = request()->get('name');
        $addressBook->mobile = request()->get('mobile');
        $addressBook->country = request()->get('country');
        $addressBook->province = base64_decode(request()->get('province'));
        $addressBook->city = base64_decode(request()->get('city'));
        $addressBook->district = base64_decode(request()->get('district'));
        $addressBook->postal_code = request()->get('postal_code');
        $addressBook->address = request()->get('address');
        $addressBook->default = request()->get('default');
        $addressBook->save();

        if($addressBook->default) {
            AddressBook::where('id', '<>', $addressBook->id)
                ->where('user_id', auth()->id())->update(['default' => 0]);
        }

        return response([
            'success' => true,
            'address_book' => new AddressBookResource($addressBook)
        ], 200);
    }

    public function delete($id)
    {
        $addressBook = AddressBook::whereUuid($id)->first();

        if($addressBook)
            $addressBook->delete();

        return response([
            'success' => true,
            'message' => 'data has been deleted',
            'data' => null
        ], 200);
    }

    public function setDefault($id)
    {
        $addressBook = AddressBook::where('user_id', auth()->id())
            ->where('default', 1)
            ->update(['default' => null]);

        $addressBook = AddressBook::where('user_id', auth()->id())
            ->whereUuid($id)
            ->update(['default' => 1]);

        return response([
            'success' => true,
            'message' => 'Success'
        ], 200);
        
    }

    public function getDefault()
    {
        $addressBook = AddressBook::where('user_id', auth()->id())
                ->where('default', 1)->first();

        if(!$addressBook) {
            return response([
                'success' => true,
                'address_book' => null
            ], 200);
        }


        return response([
            'success' => true,
            'address_book' => new AddressBookResource($addressBook)
        ], 200);
    }
}