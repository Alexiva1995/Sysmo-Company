<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('id', 'asc')->get();
        return view('content.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('content.slider.create');
    }

    public function store(Request $request)
    {
        $fields = [
            'img' => 'required',
            'name' => 'string',
            'description' => 'string',
            'status' => 'required'
        ];

        $msj = [
            'img.required' => 'La imagen es requerida',
            'status.required' => 'El Estado es requerido'
        ];
        $validate = $this->validate($request, $fields, $msj);

        try{
            DB::beginTransaction();

            if($validate){
                $slider = Slider::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'status' => $request->status
                ]);
                if ($request->hasFile('img')) {
                    $file = $request->file('img');
                    $name = md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('storage').'/slider',$name);
                    $slider->img = $name;
                }
                $slider->save();
            }
            DB::commit();
            return redirect()->route('slider.index')->with('message', 'Slider creado Satisfactoriamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('SliderController -> Store '.$th);
            return redirect()->back()->with('msj', 'Ocurrio un error, Por favor comunicarse con el administrador');
        }    
    }

    public function edit($slider)
    {
        $slide = Slider::find($slider);
        return view('content.slider.edit', compact('slide'));
    }

    public function update(Request $request, $id)
    {
        $slide = Slider::find($id);
        $fields = [
            'name' => 'string',
            'description' => 'string',
            'status' => 'required'
        ];

        $msj = [
            'img.required' => 'La imagen es requerida',
            'status.required' => 'El Estado es requerido'
        ];
        $validate = $this->validate($request, $fields, $msj);

        try{
            DB::beginTransaction();

            if($validate){
                $slide->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'status' => $request->status
                ]);
                if ($request->hasFile('img')) {
                    $file = $request->file('img');
                    $name = md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('storage').'/slider',$name);
                    $slide->img = $name;
                }
                $slide->save();
            }
            DB::commit();
            return redirect()->route('slider.index')->with('message', 'Slider Actualizado Satisfactoriamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('SliderController -> Store '.$th);
            return redirect()->back()->with('msj', 'Ocurrio un error, Por favor comunicarse con el administrador');
        }    
    }

}
