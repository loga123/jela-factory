<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetMealRequest;
use App\Models\Meal;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(GetMealRequest $request)
    {

        global $relations;
        global $tags;

        //dohvat ovisnosti iz upita
        $perPage = $request['perPage'];
        $with= $request['with'];
        $lang=$request['lang'];
        $ttags=$request['tags'];
        $category=$request['category'];
        $diff_time= $request['diff_time'];


        //ako nema jezika za upit dohvati sve na HRVATSKOM
        if (empty($lang)){
            App::setLocale('hr');
        }
        else{
            App::setLocale($lang);
        }

        //ako nema broja po stranici dohvati 15
        if (empty($perPage)){
            $perPage=15;
        }

        //provjera da li u upitu postoje relacije za jela
        if (!empty($with)){
            $relations = explode(",", $with);
        }else{
            $relations=[];
        }

        //provjera da li u upitu postoje tagovi
        if (!empty($ttags)){
            $tags = explode(",", $ttags);
        }else{
            $tags=[];
        }

        $meals = Meal::where(function( $query) use ($with,$perPage,$tags,$category,$diff_time,$lang) {

            if(!empty($tags)){
                $query->whereHas('tags', function ( $query) use ($tags) {

                   $query->whereIn('id', $tags);

                },'=', count($tags));
            }

            if(!empty($category)){
                if($category=='NULL'){
                        $query->whereNull('category_id');
                }else if($category=='!NULL'){
                        $query->whereNotNull('category_id');
                }else{
                    $query->whereHas('category', function ( $query) use ($category) {
                        $query->where('id',$category);
                    });
                }
            }

            if(!empty($diff_time) && is_numeric($diff_time)){

                $diff_time=intval($diff_time);

                if ($diff_time>0){

                    $diff_time =  gmdate("Y-m-d H:i:s", $diff_time);

                    $query->whereDate('created_at','>',$diff_time)
                        ->orWhereDate('updated_at', '>', 'created_at')
                        ->whereDate('updated_at','>' , $diff_time)
                       ->orWhereDate('deleted_at','>',$diff_time);

                }
            }


        })->TrashedConditional(is_numeric($diff_time) ? true : false)
            ->with($relations)
            ->paginate($perPage);



        $meals->appends(request()->query())->links();

        return response()
            ->json([
                'meta' => [
                    "currentPage"=>$meals->currentPage(),
                    "totalItems"=>$meals->total(),
                    "itemsPerPage"=>$meals->perPage(),
                    "totalPages"=> $meals->lastPage()
                ],
                'data' =>$meals->items(),
                'links' => [
                    "prev"=>$meals->previousPageUrl(),
                    "next"=>$meals->nextPageUrl(),
                    "self"=>$request->fullUrl(),

                ],

            ]);

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
