<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class HotelController extends Controller
{
    public function create()
    {
        return view('hotels.create');
    }

    public function store(Request $request, Hotel $hotel)
    {
        //dd($request);
        $validatedData = $request->validate([

            'userId' => 'required',
            'name' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
            'address' => 'required',
            'town' => 'required',
            'country' => 'required',
            'postCode' => 'required', 'min:3', 'max:4',
            'accomType' => 'required',
            'roomType' => 'required',
            'holidayType' => 'required',
            'currency' => 'required',
            'price' => 'required',
            'numRooms' => 'required',
            'description' => 'required',
            'payOpts' => 'required',
            'agreeTerms' => 'required'

        ]);

        $imagePath = (request('image')->store('uploads', 'public'));

        if ($request->hasFile('image') == null) {
            $imagePath = "/images/profileImage.jpg
";
        } else {
            $imagePath = $request->file('image')->store('uploads', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->orientate()->fit(180, 180); //Save updated image as 180 x 180 px
            $image->save();
        }

        $hotel->userId = $request->userId;
        $hotel->name = $request->name;
        $hotel->image = $imagePath;
        $hotel->address = $request->address;
        $hotel->town = $request->town;
        $hotel->country = $request->country;
        $hotel->postCode = $request->postCode;
        $hotel->accomType = $request->accomType;
        $hotel->roomType = $request->roomType;
        $hotel->currency = $request->currency;
        $hotel->price = $request->price;
        $hotel->numRooms = $request->numRooms;
        $hotel->hotelOptions = $request->hotelOptions;
        $hotel->description = $request->description;
        $hotel->payOpts = $request->payOpts;
        $hotel->agreeTerms = $request->agreeTerms;

        $hotel->save();


        return redirect()->back()->with('success', 'Hotel Successfully Uploaded!!');
    }
}
