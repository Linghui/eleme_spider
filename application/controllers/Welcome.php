<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     *
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function fetch_restaurant()
    {
        echo 'ok';

        $xy_set = array(
            'shui' => 'latitude=41.79239&longitude=123.41845',
            'men' => 'latitude=41.7915&longitude=123.38015',
            'yongli' => 'latitude=39.93482&longitude=116.44474',
        );

        $xy_key = 'yongli';

        $xy = $xy_set[$xy_key];

        $limit = 20;
        $offset = 0;

        for ($index = 0; $index < 1000; ++$index) {
            echo "page $index \n";
            $of = $offset * $limit;
            $url = "https://mainsite-restapi.ele.me/shopping/restaurants?$xy&offset=$of&limit=$limit&extras%5B%5D=activities&rand=".rand(0, 100000);
            ++$offset;
            echo "url:$url\n";
            $content = $this->Curl_model->curl_get($url);
            $restaurants = json_decode($content);
            foreach ($restaurants as $one) {
                echo 'deal with name : '.$one->name."\n";

                $condition = array('id' => $one->id);

                $query = $this->Restuarant_model->get_one_by_condition($condition);
                if ($query) {
                    echo 'name : '.$one->name;
                    echo " added before\n";
                    continue;
                }

                if (isset($one->recommend)) {
                    $obj = json_decode($one->recommend->track);
                    echo $obj->rankType;
                    $one->rankType = $obj->rankType;
                    if (isset($one->recommend->reason)) {
                        $one->rankType_reason = $one->recommend->reason;
                    }
                    unset($one->recommend);
                }

                if (isset($one->activities)) {
                    $activities = '';
                    foreach ($one->activities as $act) {
                        $activities .= $act->description;
                    }

                    $one->activities = $activities;
                }

                $keys = array(
                    'activities',
                    'piecewise_agent_fee',
                    'supports',
                    'delivery_mode',
                    // 'activities',
                    'closing_count_down',
                );

                foreach ($keys as $one_key) {
                    if (isset($one->$one_key)) {
                        $temp = json_encode($one->$one_key);
                        $one->$one_key = $temp;
                    }
                }

                $this->Restuarant_model->add($one);
            }
            echo 'dealed '.count($restaurants)."\n";
            if (count($restaurants) < $limit) {
                echo "over\n";
                break;
            }
        }
    }

    public function fetch_menu_and_food()
    {
        $restaurants = $this->Restuarant_model->get_by_condition(null, 'recent_order_num');

        foreach ($restaurants as $one) {
            echo $one->recent_order_num." n \n";

            $id = $one->id;
            $restaurant_name = $one->name;
            $url = 'https://mainsite-restapi.ele.me/shopping/v1/menu?restaurant_id='.$id;
            $content = $this->Curl_model->curl_get($url);

            $menu_list = json_decode($content);
            foreach ($menu_list as $one_menu) {
                echo 'menu name '.$one_menu->name."\n";

                $one_menu->restaurant_name = $restaurant_name;
                $foods = $one_menu->foods;

                foreach ($foods as $one_food) {
                    echo 'food name '.$one_food->name."\n";

                    $condition = array(
                        'restaurant_id' => $id,
                        'name' => $one_food->name,
                    );

                    $query = $this->Food_model->get_one_by_condition($condition);
                    if ($query) {
                        continue;
                    }

                    $keys = array(
                        'limitation',
                        'specifications',
                        // 'specfoods',
                        'display_times',
                        'attributes',
                    );

                    foreach ($keys as $one_key) {
                        if (isset($one_food->$one_key)) {
                            $temp = json_encode($one_food->$one_key);
                            $one_food->$one_key = $temp;
                        }
                    }

                    //
                    // if(){
                    //
                    // }

                    $one_food->specfoods = $one_food->specfoods[0]->price;
                    $one_food->restaurant_name = $restaurant_name;

                    $this->Food_model->add($one_food);
                }

                $keys = array(
                                        'activity',
                                    );

                foreach ($keys as $one_key) {
                    if (isset($one_menu->$one_key)) {
                        $temp = json_encode($one_menu->$one_key);
                        $one_menu->$one_key = $temp;
                    }
                }

                unset($one_menu->foods);

                $this->Menu_model->add($one_menu);
            }
        }
    }
}
