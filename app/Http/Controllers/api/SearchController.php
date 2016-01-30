<?php

namespace republic\Http\Controllers\Api;

use Illuminate\Http\Request;

use republic\Http\Requests;
use republic\Http\Controllers\Controller;
use republic\Place;
use republic\Image;
use republic\City;


class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($variable_search)
    {
        $variable_search = urldecode($variable_search);
        $resultDBArray = Place::select('place_id', 'place_name','place_city')->whereRaw(
        "MATCH(place_name) AGAINST(? IN BOOLEAN MODE)",
        array($variable_search)
    )->orderBy('views')->get();
        if (count($resultDBArray)>0) {
            $resultJSON["success"] = "1";
            $resultJSON["items"] = $resultDBArray;
            for ($i = 0; $i < count($resultDBArray); $i++) {
                $place_id = $resultJSON["items"][$i]['place_id'];
                $city_id = $resultJSON["items"][$i]['place_city'];
                $resultDBImages = $this->getImages($place_id);
                $city_nameArray = $this->getCityName($city_id);
                $resultJSON["items"][$i]['place_city'] = $city_nameArray['city_name'];
                $resultJSON["items"][$i]['images'] = $resultDBImages;
            }
        } else $resultJSON["success"] = "0";
        echo json_encode($resultJSON);

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
}
