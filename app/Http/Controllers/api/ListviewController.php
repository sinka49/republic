<?php

namespace republic\Http\Controllers\Api;

use Illuminate\Http\Request;

use republic\Http\Requests;
use republic\Http\Controllers\Controller;
use republic\Place;
use republic\Image;
use republic\City;
use republic\Rest;
use republic\RelationRP;
use republic\Cat_for_app;

class ListviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resultDBArray = Place::select('place_id', 'place_name','place_city')->where('cat_for_app_id','!=', '4')->take(50)->orderBy('views')->get();
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
    public function filter($city=null,$rest=null, $catForApp=null)
    {
        $catForApp = urldecode($catForApp);
        $city = urldecode($city);
        $rest = urldecode($rest);

        $str = "любой";
        strnatcasecmp($rest, $str) == 0 ? $rest = null : false;
        strnatcasecmp($city, $str) == 0 ? $city = null : false;


        $rest != null ? $arrayPlaceId = $this->getPlaceIdByRestId($this->getRestId($rest)) : $arrayPlaceId = null;
        $city != null ? $cityId = $this->getCityId($city) : $cityId = null;

        if($arrayPlaceId != null && $cityId != null){
            if($catForApp != null) $resultDBArray = Place::select('place_id', 'place_name', 'place_city','picture')->wheren('place_id', $arrayPlaceId)->where('cat_for_app_id', $catForApp)->where('place_city', $cityId)->orderBy('views')->get();
            else $resultDBArray = Place::select('place_id', 'place_name', 'place_city','picture')->whereIn('place_id', $arrayPlaceId)->where('place_city', $cityId)->orderBy('views')->get();
        }
        else if($arrayPlaceId != null && $cityId == null){
            if($catForApp != null) $resultDBArray = Place::select('place_id', 'place_name', 'place_city','picture')->where('cat_for_app_id', $catForApp)->whereIn('place_id', $arrayPlaceId)->orderBy('views')->get();
            else $resultDBArray = Place::select('place_id', 'place_name', 'place_city','picture')->whereIn('place_id', $arrayPlaceId)->orderBy('views')->get();
        }
        else if($arrayPlaceId == null && $cityId != null){
            if($catForApp != null) $resultDBArray = Place::select('place_id', 'place_name', 'place_city','picture')->where('cat_for_app_id', $catForApp)->where('place_city', $cityId)->orderBy('views')->get();
            else $resultDBArray = Place::select('place_id', 'place_name', 'place_city','picture')->where('place_city', $cityId)->orderBy('views')->get();
        }
        else{
            if($catForApp != null) $resultDBArray = Place::select('place_id', 'place_name', 'place_city','picture')->where('cat_for_app_id', $catForApp)->orderBy('views')->get();
            else $resultDBArray = Place::select('place_id', 'place_name', 'place_city','picture')->orderBy('views')->get();
        }


        if (count($resultDBArray) > 0){
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
        }
        else  $resultJSON["success"] = "0";
        echo json_encode($resultJSON);
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

    private function getCityId($city_name)
    {
        $cityId = City::select('city_id')->where('city_name','LIKE', '%'.$city_name.'%')->first();
        if(count($cityId)>0) {
            $cityId =  $cityId['city_id'];
        }
        else  $cityId = null;
        return $cityId;

    }

    private function getRestId($rest)
    {
        $restIdDb = Rest::select('rest_id')->where('rest_type','LIKE', '%'.$rest.'%')->get();
        $restId = array();
        if(count($restIdDb)>0){
             for($i=0; $i<count($restIdDb);$i++){
                 $restId[$i]=$restIdDb[$i]['rest_id'];
             }
            return $restId;
        }
        else return $restId = null;


    }

    private function getPlaceIdByRestId($restId)
    {
        $arrayId = RelationRP::select('place_id')->where('rest_id','=', $restId)->get();

        if (count($restId)>0){

            return $arrayId;

        }
        else return $arrayId = null;


    }



}
