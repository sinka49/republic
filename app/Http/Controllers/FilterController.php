<?php

namespace republic\Http\Controllers;

use Illuminate\Http\Request;

use republic\Http\Requests;
use republic\Http\Controllers\Controller;
use republic\Place;
use republic\Image;
use republic\City;
use republic\Rest;
use republic\RelationRP;
class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */

    public function index(Request $request)
    {
         $rest = urldecode( $request->input('typerest') );
         $city = urldecode( $request->input('town') );

         $str = "любой";
         strnatcasecmp($rest, $str) == 0 ? $rest = null : false;
         strnatcasecmp($city, $str) == 0 ? $city = null : false;

         $rest != null ? $arrayPlaceId = $this->getPlaceIdByRestId($this->getRestId($rest)) : $arrayPlaceId = null;
         $city != null ? $cityId = $this->getCityId($city) : $cityId = null;
        if($arrayPlaceId != null && $cityId != null){
              $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','!=', '4')->with('location')->whereIn('place_id', $arrayPlaceId)->where('place_city', $cityId)->get();
        }
        else if($arrayPlaceId != null && $cityId == null){
             $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','!=', '4')->with('location')->whereIn('place_id', $arrayPlaceId)->get();
        }
        else if($arrayPlaceId == null && $cityId != null){
             $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','!=', '4')->with('location')->where('place_city', $cityId)->get();
        }
        else{
             $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','!=', '4')->with('location')->get();
        }
          $title =   "Фильтр: ".$rest.", ".$city;
        if (count($resultDBArray) > 0){
            $content["success"] = $title;
            $resultJSON["items"] = $resultDBArray;
            for ($i = 0; $i < count($resultDBArray); $i++) {
                $lng = $resultJSON["items"][$i]['location']['longitude'];
                $lat = $resultJSON["items"][$i]['location']['latitude'];
                $resultJSON["items"][$i]['longitude'] = $lng;
                $resultJSON["items"][$i]['latitude'] = $lat;
                unset($resultJSON["items"][$i]['location']);

            }
        }

        else  $resultJSON["success"] = "0";
        $cities = City::select('city_name')->distinct()->get();
        $rests  = Rest::select('rest_type')->distinct()->get();
        $content['cities'] =  $cities;
        $content['rests'] =  $rests;
        $content['dbArray'] =  $resultDBArray;
        $content['JSONarray'] =  json_encode($resultJSON);
        return view('filter', $content);


    }


    public function places(Request $request = null)
    {
        if($request->input){
            $rest = urldecode( $request->input('typerest') );
            $city = urldecode( $request->input('town') );

            $str = "любой";
            strnatcasecmp($rest, $str) == 0 ? $rest = null : false;
            strnatcasecmp($city, $str) == 0 ? $city = null : false;

            $rest != null ? $arrayPlaceId = $this->getPlaceIdByRestId($this->getRestId($rest)) : $arrayPlaceId = null;
            $city != null ? $cityId = $this->getCityId($city) : $cityId = null;
            if($arrayPlaceId != null && $cityId != null){
                $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','=', '1')->with('location')->whereIn('place_id', $arrayPlaceId)->where('place_city', $cityId)->get();
            }
            else if($arrayPlaceId != null && $cityId == null){
                $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','=', '1')->with('location')->whereIn('place_id', $arrayPlaceId)->get();
            }
            else if($arrayPlaceId == null && $cityId != null){
                $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','=', '1')->with('location')->where('place_city', $cityId)->get();
            }
            else{
                $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','=', '1')->with('location')->get();
            }
        }
       else{
           $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','=', '1')->with('location')->get();
       }


        if (count($resultDBArray) > 0){
            $content["success"] = "Культура и отдых";
            $content["check"][0] = "Где поесть";
            $content["check"][1] = "Где поспать";
            $content["check"][2] = "Экскурсии";
            $resultJSON["items"] = $resultDBArray;
            for ($i = 0; $i < count($resultDBArray); $i++) {
                $lng = $resultJSON["items"][$i]['location']['longitude'];
                $lat = $resultJSON["items"][$i]['location']['latitude'];
                $resultJSON["items"][$i]['longitude'] = $lng;
                $resultJSON["items"][$i]['latitude'] = $lat;
                unset($resultJSON["items"][$i]['location']);

            }
        }

        else  $resultJSON["success"] = "0";
        $cities = City::select('city_name')->distinct()->get();
        $rests  = Rest::select('rest_type')->distinct()->get();
        $content['cities'] =  $cities;
        $content['rests'] =  $rests;
        $content['dbArray'] =  $resultDBArray;
        $content['JSONarray'] =  json_encode($resultJSON);
        return view('filter', $content);


    }


    public function eat(Request $request = null)
    {
        if($request->input){
            $rest = urldecode( $request->input('typerest') );
            $city = urldecode( $request->input('town') );

            $str = "любой";
            strnatcasecmp($rest, $str) == 0 ? $rest = null : false;
            strnatcasecmp($city, $str) == 0 ? $city = null : false;

            $rest != null ? $arrayPlaceId = $this->getPlaceIdByRestId($this->getRestId($rest)) : $arrayPlaceId = null;
            $city != null ? $cityId = $this->getCityId($city) : $cityId = null;
            if($arrayPlaceId != null && $cityId != null){
                $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','=', '2')->with('location')->whereIn('place_id', $arrayPlaceId)->where('place_city', $cityId)->get();
            }
            else if($arrayPlaceId != null && $cityId == null){
                $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','=', '2')->with('location')->whereIn('place_id', $arrayPlaceId)->get();
            }
            else if($arrayPlaceId == null && $cityId != null){
                $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','=', '2')->with('location')->where('place_city', $cityId)->get();
            }
            else{
                $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','=', '2')->with('location')->get();
            }
        }
        else{
            $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','=', '2')->with('location')->get();
        }


        if (count($resultDBArray) > 0){
            $content["success"] = "Где поесть";
            $content["check"][0] = "Культура и отдых";
            $content["check"][1] = "Где поспать";
            $content["check"][2] = "Экскурсии";
            $resultJSON["items"] = $resultDBArray;
            for ($i = 0; $i < count($resultDBArray); $i++) {
                $lng = $resultJSON["items"][$i]['location']['longitude'];
                $lat = $resultJSON["items"][$i]['location']['latitude'];
                $resultJSON["items"][$i]['longitude'] = $lng;
                $resultJSON["items"][$i]['latitude'] = $lat;
                unset($resultJSON["items"][$i]['location']);

            }
        }

        else  $resultJSON["success"] = "0";
        $cities = City::select('city_name')->distinct()->get();
        $rests  = Rest::select('rest_type')->distinct()->get();
        $content['cities'] =  $cities;
        $content['rests'] =  $rests;
        $content['dbArray'] =  $resultDBArray;
        $content['JSONarray'] =  json_encode($resultJSON);
        return view('filter', $content);


    }


    public function sleep(Request $request = null)
    {
        if($request->input){
            $rest = urldecode( $request->input('typerest') );
            $city = urldecode( $request->input('town') );

            $str = "любой";
            strnatcasecmp($rest, $str) == 0 ? $rest = null : false;
            strnatcasecmp($city, $str) == 0 ? $city = null : false;

            $rest != null ? $arrayPlaceId = $this->getPlaceIdByRestId($this->getRestId($rest)) : $arrayPlaceId = null;
            $city != null ? $cityId = $this->getCityId($city) : $cityId = null;
            if($arrayPlaceId != null && $cityId != null){
                $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','=', '3')->with('location')->whereIn('place_id', $arrayPlaceId)->where('place_city', $cityId)->get();
            }
            else if($arrayPlaceId != null && $cityId == null){
                $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','=', '3')->with('location')->whereIn('place_id', $arrayPlaceId)->get();
            }
            else if($arrayPlaceId == null && $cityId != null){
                $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','=', '3')->with('location')->where('place_city', $cityId)->get();
            }
            else{
                $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','=', '3')->with('location')->get();
            }
        }
        else{
            $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','=', '3')->with('location')->get();
        }


        if (count($resultDBArray) > 0){
            $content["success"] = "Где поспать";
            $content["check"][0] = "Культура и отдых";
            $content["check"][1] = "Где поесть";
            $content["check"][2] = "Экскурсии";
            $resultJSON["items"] = $resultDBArray;
            for ($i = 0; $i < count($resultDBArray); $i++) {
                $lng = $resultJSON["items"][$i]['location']['longitude'];
                $lat = $resultJSON["items"][$i]['location']['latitude'];
                $resultJSON["items"][$i]['longitude'] = $lng;
                $resultJSON["items"][$i]['latitude'] = $lat;
                unset($resultJSON["items"][$i]['location']);

            }
        }

        else  $resultJSON["success"] = "0";
        $cities = City::select('city_name')->distinct()->get();
        $rests  = Rest::select('rest_type')->distinct()->get();
        $content['cities'] =  $cities;
        $content['rests'] =  $rests;
        $content['dbArray'] =  $resultDBArray;
        $content['JSONarray'] =  json_encode($resultJSON);
        return view('filter', $content);


    }
    public function gide(Request $request = null)
    {
        if($request->input){
            $rest = urldecode( $request->input('typerest') );
            $city = urldecode( $request->input('town') );

            $str = "любой";
            strnatcasecmp($rest, $str) == 0 ? $rest = null : false;
            strnatcasecmp($city, $str) == 0 ? $city = null : false;

            $rest != null ? $arrayPlaceId = $this->getPlaceIdByRestId($this->getRestId($rest)) : $arrayPlaceId = null;
            $city != null ? $cityId = $this->getCityId($city) : $cityId = null;
            if($arrayPlaceId != null && $cityId != null){
                $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','=', '4')->with('location')->whereIn('place_id', $arrayPlaceId)->where('place_city', $cityId)->get();
            }
            else if($arrayPlaceId != null && $cityId == null){
                $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','=', '4')->with('location')->whereIn('place_id', $arrayPlaceId)->get();
            }
            else if($arrayPlaceId == null && $cityId != null){
                $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','=', '4')->with('location')->where('place_city', $cityId)->get();
            }
            else{
                $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','=', '4')->with('location')->get();
            }
        }
        else{
            $resultDBArray = Place::select('place_id', 'place_name', 'picture')->where('cat_for_app_id','=', '4')->with('location')->get();
        }


        if (count($resultDBArray) > 0){
            $content["success"] = "Экскурсии";
            $content["check"][0] = "Культура и отдых";
            $content["check"][1] = "Где поспать";
            $content["check"][2] = "Где поспать";
            $resultJSON["items"] = $resultDBArray;
            for ($i = 0; $i < count($resultDBArray); $i++) {
                $lng = $resultJSON["items"][$i]['location']['longitude'];
                $lat = $resultJSON["items"][$i]['location']['latitude'];
                $resultJSON["items"][$i]['longitude'] = $lng;
                $resultJSON["items"][$i]['latitude'] = $lat;
                unset($resultJSON["items"][$i]['location']);

            }
        }

        else  $resultJSON["success"] = "0";
        $cities = City::select('city_name')->distinct()->get();
        $rests  = Rest::select('rest_type')->distinct()->get();
        $content['cities'] =  $cities;
        $content['rests'] =  $rests;
        $content['dbArray'] =  $resultDBArray;
        $content['JSONarray'] =  json_encode($resultJSON);
        return view('filter', $content);


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
    private function getCityId($city_name)
    {
        $cityId = City::select('city_id')->where('city_name','LIKE', '%'.$city_name.'%')->first();
        if(count($cityId)>0) {
            $cityId =  $cityId['city_id'];
        }
        else  $cityId = null;
        return $cityId;

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
