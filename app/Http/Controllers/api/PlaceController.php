<?php

namespace republic\Http\Controllers\Api;

use Illuminate\Http\Request;

use republic\Http\Requests;
use republic\Http\Controllers\Controller;
use republic\Place;
use republic\Image;
use republic\City;
use republic\Location;
use republic\WayPoint;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }


    public function place($place_id = null)
    {
        $resultDBArray = Place::select('place_id','place_name','place_desc','place_city', 'picture')->where('place_id','=', $place_id)->first();
        if (count($resultDBArray)>0) {
            $resultJSON["success"] = "1";
            $resultJSON["item"]    = $resultDBArray;
            $resultDBImages = $this->getImages($place_id);
            $locationArray  = $this->getLocation($place_id);
            $city_nameArray = $this->getCityName($resultDBArray['place_city']);
            $pointsArray    = $this->getPoints($place_id);
            $price          = $this->getPrice($place_id);
            $resultJSON["item"]['place_city'] = $city_nameArray['city_name'];
            $resultJSON["item"]['longitude']  = $locationArray['longitude'];
            $resultJSON["item"]['latitude']   = $locationArray['latitude'];
            $resultJSON["item"]['images']     = $resultDBImages;
            $resultJSON["item"]['points']     = $pointsArray;
            $resultJSON["item"]['price']      = $price;
            }
        else $resultJSON["success"] = "0";
        echo json_encode($resultJSON);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    private function getImages($place_id)
    {
        $resultDBImagesArray = array();
        $resultDBImages = Image::select('image_src')->where('place_id','=',$place_id)->get();
        for($i=0; $i<count($resultDBImages->toArray());$i++){
            $resultDBImagesArray[$i] =   $resultDBImages[$i]['image_src'];
        }
        return $resultDBImagesArray;
    }

    private function getCityName($city_id)
    {
        $cityName = City::select('city_name')->where('city_id','=',$city_id)->first();
        return $cityName;
    }
    private function getLocation($place_id)
    {
        $latitude  = Location::select('latitude')->where('place_id','=',$place_id)->first();
        $longitude = Location::select('longitude')->where('place_id','=',$place_id)->first();
        $array ['latitude'] = $latitude['latitude'];
        $array ['longitude'] = $longitude['longitude'];
        return $array;
    }


    private function getPoints($place_id)
    {

        $resultDB = WayPoint::select('point_latitude', 'point_longitude', 'point_number', 'point_caption')->where('place_id','=',$place_id)->get();
        return $resultDB;
    }

    private function getPrice($place_id)
    {
        $resultDB = WayPoint::select('point_price')->where('place_id','=',$place_id)->get();
        $resultPrice = 0;
        for($i=0; $i<count($resultDB->toArray());$i++){
            $resultPrice =  $resultPrice + $resultDB[$i]['point_price'];
        }
        return $resultPrice;
    }
}
