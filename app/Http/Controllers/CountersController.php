<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Rules\VerifDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Counter::latest('id')->first();
        $date1 = new \DateTime($date->dateFinCoursPrepa);
        $date2 = new \DateTime($date->dateFinInscription);
        $dateFinCoursPrepa = $date1->format('F j, Y H:i:s');
        $dateFinInscription = $date2->format('F j, Y H:i:s');

        return [
            'dateFinCoursPrepa' => $dateFinCoursPrepa,
            'dateFinInscription' => $dateFinInscription,
        ];

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = Validator::make($request->all(),[
            'dateFinCoursPrepa' => ['required',new VerifDate],
            'dateFinInscription' => ['required', new VerifDate],
        ]);
        if($validate->fails()){
            return response()->json([
                'failed' => 1,
                'validate_err' => $validate->messages(),
            ]);
        } else {
            Counter::create([
                'dateFinCoursPrepa' => $request->dateFinCoursPrepa,
                'dateFinInscription' => $request->dateFinInscription
            ]);

            return response()->json([
                'success' => 1
            ]);
        }
    }

}
