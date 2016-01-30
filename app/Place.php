<?php

namespace republic;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $table = "places";

    // ��������� �������� ������������ �������� ��� ���� �����
    protected $fillable = [ 'place_name', 'place_desc'];

    // ��������� mass assigned ��� ���� �����
    protected $guarded = ['place_id'];

    // Mutated ��������, ������� ����� �������� � toArray()

    // ���������� ��� ������������� ������
    public function rest()
    {
       return $this->belongsToMany('republic\Rest', 'relation_rest_and_places','place_id', 'rest_id');


    }
    public function city()
    {
        return $this->belongsTo('republic\City','place_city', 'city_id');
    }
    public function cat()
    {
        return $this->belongsTo('republic\Cat_for_app','cat_for_app_id', 'cat_for_app_id');
    }
    public function location()
    {
        return $this->hasOne('republic\Location','place_id', 'place_id');
    }
    public function images()
    {
        return $this->hasMany('republic\Image','place_id', 'place_id');
    }

}
