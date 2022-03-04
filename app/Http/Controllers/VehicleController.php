<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Condition;
use App\Models\Make;
use App\Models\MakeModel;
use App\Models\PaymentMethod;
use App\Models\Proprietary;
use App\Models\StatusVehicle;
use App\Models\Transmission;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $vehicles = Vehicle::where('price', 'LIKE', '%' . $request->search . '%')
        //     ->orWhere('year', 'LIKE', '%' . $request->search . '%')
        //     ->paginate();
        // return Inertia::render('InformacionVehiculos', compact('vehicles'));

        return Inertia::render('InformacionVehiculos', [
            'vehicles' => Vehicle::when(
                $request->search,
                function ($query, $search) {
                    $query->where('price', 'LIKE', '%' . $search . '%')->orWhere('year', 'LIKE', '%' . $search . '%');
                }
            )->paginate()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $makes = Make::all();
        $transmissions = Transmission::all();
        $categories = Category::all();
        $proprietaries = Proprietary::all();
        $payment_methods = PaymentMethod::all();
        $status_vehicles = StatusVehicle::all();
        $conditions = Condition::all();
        $models = MakeModel::all();

        return Inertia::render('FormCrear', compact(
            'makes',
            'models',
            'transmissions',
            'categories',
            'proprietaries',
            'payment_methods',
            'status_vehicles',
            'conditions'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'price' => 'required',
            'driven' => 'required',
            'year' => 'required',
            'users_id' => 'required',
            'transmissions_id' => 'required',
            'categories_id' => 'required',
            'proprietaries_id' => 'required',
            'payment_methods_id' => 'required',
            'status_vehicles_id' => 'required',
            'conditions_id' => 'required',
        ]);
        $vehicle = $request->all();

        $noTags = strip_tags(str_replace(["&nbsp;", "."], ['', ' '], $request->get("description")));
        $data = MakeModel::searchMakeModel($request->get("make_models_id"))->first();
        $title = Str::of($data['make_name'])->append(" " . $data['model_name'] . "")->append(" " . $request->get("year") . "")->append(" " . $noTags . "");
        $slug = Str::limit($title, 156);

        $vehicle['slug'] = Str::slug($slug);
        Vehicle::create($vehicle);
        return Redirect::route('vehiculos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle = Vehicle::where('id', $id)->get();
        return Inertia::render('InformacionVehiculo', ['vehicle' => $vehicle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * //@param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $id)
    {
        $vehicle = $id;
        $status_vehicles = StatusVehicle::all();
        $conditions = Condition::all();
        $payment_methods = PaymentMethod::all();
        return Inertia::render('FormEditar', compact('vehicle', 'status_vehicles', 'conditions', 'payment_methods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * //@param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $id)
    {
        $id->update($request->all());
        return Redirect::route('vehiculos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * //@param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $id)
    {
        $id->delete();
        return Redirect::route('vehiculos.index');
    }
}
