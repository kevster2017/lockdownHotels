<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class HotelController extends Controller
{

    public function index()
    {

        $hotels = Hotel::where('id', '>', 0)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('hotels.index', [
            'hotels' => $hotels
        ]);
    }


    public function myHotels()
    {

        $userId = auth()->user()->id;

        $hotels = Hotel::where('userId', $userId)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('hotels.myHotels', [
            'hotels' => $hotels
        ]);
    }

    public function myHotelsShow($id)
    {
        $hotel = Hotel::findOrfail($id);

        return view('hotels.myHotelsShow', [
            'hotel' => $hotel
        ]);
    }

    public function fetchData(Request $request)
    {
        // Your PHP logic here - interact with the database, process data, etc.
        // For example, fetching some data from a database

        $hotels = Hotel::where('holidayType', 'City Break')
            ->orderBy('town', 'ASC')
            ->get();

        //  dd($hotels);
        return response()->json(['hotels' => $hotels]); // Return the data as a JSON response
    }

    public function cityIndex()
    {

        $hotels = Hotel::where('holidayType', 'City Break')
            ->orderBy('created_at', 'DESC')
            ->get();

        // dd($hotels);
        return view('hotels.cityIndex', [
            'hotels' => $hotels
        ]);
    }

    public function seasideIndex()
    {

        $hotels = Hotel::where('holidayType', 'Seaside Resort')
            ->orderBy('created_at', 'DESC')
            ->get();



        return view('hotels.seasideIndex', [
            'hotels' => $hotels

        ]);
    }

    public function countryIndex()
    {

        $hotels = Hotel::where('holidayType', 'Country Escape')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('hotels.countryIndex', [
            'hotels' => $hotels
        ]);
    }

    public function show($id)
    {
        $hotel = Hotel::findOrfail($id);

        return view('hotels.show', [
            'hotel' => $hotel
        ]);
    }

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
            'feat1' => 'required',
            'feat2' => 'required',
            'feat3' => 'required',
            'feat4' => 'required',
            'feat1Price' => 'required',
            'feat2Price' => 'required',
            'feat3Price' => 'required',
            'feat4Price' => 'required',
            'upgrade1' => 'required',
            'upgrade2' => 'required',
            'upgrade3' => 'required',
            'upgrade1Price' => 'required',
            'upgrade2Price' => 'required',
            'upgrade3Price' => 'required',
            'package1' => 'required',
            'package2' => 'required',
            'package3' => 'required',
            'package1Price' => 'required',
            'package2Price' => 'required',
            'package3Price' => 'required',
            'currency' => 'required',
            'price' => 'required',
            'numRooms' => 'required',
            'description' => 'required',
            'agreeTerms' => 'required'

        ]);

        $imagePath = (request('image')->store('uploads', 'public'));

        if ($request->hasFile('image') == null) {
            $imagePath = "/images/profileImage.jpg
";
        } else {
            $imagePath = $request->file('image')->store('uploads', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->orientate()->fit(200, 200); //Save updated image as 200 x 200 px
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
        $hotel->feat1 = $request->feat1;
        $hotel->feat2 = $request->feat2;
        $hotel->feat3 = $request->feat3;
        $hotel->feat4 = $request->feat4;
        $hotel->feat1Price = $request->feat1Price;
        $hotel->feat2Price = $request->feat2Price;
        $hotel->feat3Price = $request->feat3Price;
        $hotel->feat4Price = $request->feat4Price;
        $hotel->upgrade1 = $request->upgrade1;
        $hotel->upgrade2 = $request->upgrade2;
        $hotel->upgrade3 = $request->upgrade3;
        $hotel->upgrade1Price = $request->upgrade1Price;
        $hotel->upgrade2Price = $request->upgrade2Price;
        $hotel->upgrade3Price = $request->upgrade3Price;
        $hotel->package1 = $request->package1;
        $hotel->package2 = $request->package2;
        $hotel->package3 = $request->package3;
        $hotel->package1Price = $request->package1Price;
        $hotel->package2Price = $request->package2Price;
        $hotel->package3Price = $request->package3Price;
        $hotel->currency = $request->currency;
        $hotel->price = $request->price;
        $hotel->numRooms = $request->numRooms;
        $hotel->holidayType = $request->holidayType;
        $hotel->description = $request->description;
        $hotel->agreeTerms = $request->agreeTerms;

        $hotel->save();


        return redirect()->back()->with('success', 'Hotel Successfully Uploaded!!');
    }


    public function edit($id)
    {
        $hotel = Hotel::find($id);

        return view('hotels.edit', ['hotel' => $hotel]);
    }

    public function update(Request $request, $id)
    {

        $hotel = Hotel::find($id);

        $hotel->userId = auth()->user()->id;
        $hotel->agreeTerms = 1;

        if (!empty($request->input('name'))) {
            $hotel->name = $request->name;
        }
        if (!empty($request->hasFile('image'))) {

            $hotel->image = (request('image')->store('uploads', 'public'));
            $image = Image::make(public_path("storage/{$hotel->image}"))->orientate()->fit(200, 200); //Save updated image as 200 x 200 px
            $image->save();
        }
        if (!empty($request->input('address'))) {
            $hotel->address = $request->address;
        }
        if (!empty($request->input('town'))) {
            $hotel->town = $request->town;
        }
        if (!empty($request->input('country'))) {
            $hotel->country = $request->country;
        }
        if (!empty($request->input('postCode'))) {
            $hotel->postCode = $request->postCode;
        }
        if (!empty($request->input('accomType'))) {
            $hotel->accomType = $request->accomType;
        }
        if (!empty($request->input('roomType'))) {
            $hotel->roomType = $request->roomType;
        }
        if (!empty($request->input('holidayType'))) {
            $hotel->holidayType = $request->holidayType;
        }
        if (!empty($request->input('feat1'))) {
            $hotel->feat1 = $request->feat1;
        }
        if (!empty($request->input('feat2'))) {
            $hotel->feat2 = $request->feat2;
        }
        if (!empty($request->input('feat3'))) {
            $hotel->feat3 = $request->feat3;
        }
        if (!empty($request->input('feat4'))) {
            $hotel->feat4 = $request->feat4;
        }
        if (!empty($request->input('feat1Price'))) {
            $hotel->feat1Price = $request->feat1Price;
        }
        if (!empty($request->input('feat2Price'))) {
            $hotel->feat2Price = $request->feat2Price;
        }
        if (!empty($request->input('feat3Price'))) {
            $hotel->feat3Price = $request->feat3Price;
        }
        if (!empty($request->input('feat4Price'))) {
            $hotel->feat4Price = $request->feat4Price;
        }
        if (!empty($request->input('upgrade1'))) {
            $hotel->upgrade1 = $request->upgrade1;
        }
        if (!empty($request->input('upgrade2'))) {
            $hotel->upgrade2 = $request->upgrade2;
        }
        if (!empty($request->input('upgrade3'))) {
            $hotel->upgrade3 = $request->upgrade3;
        }
        if (!empty($request->input('upgrade1Price'))) {
            $hotel->upgrade1Price = $request->upgrade1Price;
        }
        if (!empty($request->input('upgrade2Price'))) {
            $hotel->upgrade2Price = $request->upgrade2Price;
        }
        if (!empty($request->input('upgrade1Price'))) {
            $hotel->upgrade3Price = $request->upgrade3Price;
        }
        if (!empty($request->input('package1'))) {
            $hotel->package1 = $request->package1;
        }
        if (!empty($request->input('package2'))) {
            $hotel->package2 = $request->package2;
        }
        if (!empty($request->input('package3'))) {
            $hotel->package3 = $request->package3;
        }
        if (!empty($request->input('package1Price'))) {
            $hotel->package1Price = $request->package1Price;
        }
        if (!empty($request->input('package2Price'))) {
            $hotel->package2Price = $request->package2Price;
        }
        if (!empty($request->input('package1Price'))) {
            $hotel->package3Price = $request->package3Price;
        }
        if (!empty($request->input('currency'))) {
            $hotel->currency = $request->currency;
        }
        if (!empty($request->input('price'))) {
            $hotel->price = $request->price;
        }
        if (!empty($request->input('numRooms'))) {
            $hotel->numRooms = $request->numRooms;
        }
        if (!empty($request->input('description'))) {
            $hotel->description = $request->description;
        }


        $hotel->save();

        return redirect()->route('hotels.myHotelsShow', $hotel->id)->with('success', 'Hotel successfully updated');
    }

    public function destroy($id)
    {
        Hotel::destroy($id);

        return redirect()->route('hotels.myHotels')->with('success', 'Hotel successfully deleted');
    }
}
