<?php

class LinksController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function make()
    {
        $validator = Validator::make(Input::all(),array(
            'url' => 'required|url|max:255'

        ));

        $url = Input::get('url');
        $code = null;
        $exists = Links::where('url', '=', $url);
        if($exists->count() === 1){
            $code = $exists->first()->code;
        }
        else{
            $created = Link::create(array(

                'url' => $url
            ));
            if($created){
                $code = base_convert($created->id,10,36);
                Link::where('id', '=', $created->id)->update(array(
                    'code' => $code
                ));
            }
        }

        return Redirect::action('home')->with('global', 'All done!');
    }

    public function get($code)
    {
        $link = Link::where('code', '=', $code);

        return Redirect::to($link->first()->url);
    }

}