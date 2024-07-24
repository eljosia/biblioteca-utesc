<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = (object)[];
        $data->page_title = "Ajustes";
        $data->breadcrumb = [
            ['link' => route('dashboard.index'), 'text' => 'Dashboard'],
            ['text' => 'Ajustes']
        ];
        $data->buttons = [
            // ['modal' => 'kt_modal_create_app', 'class' => 'btn btn-sm fw-bold bg-body btn-color-gray-700 btn-active-color-primary', 'text' => 'Rollover'],
            // ['link' => '#link', 'class' => 'btn btn-sm fw-bold btn-primary', 'text' => 'Boton', 'icon' => 'la-pen']
        ];

        $data->setting = Setting::first();
        return view('pages.dashboards.settings.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function save(Request $request)
    {
        // dd($request->all());
        $user = User::findOrFail(base64_decode($request->by_user_id));
        $setting = Setting::where('id', 1)->first();

        if ($setting) :
            $setting = $setting;
            $setting->updated_by = $user->id;
        else :
            $setting = new Setting();
            $setting->created_by = $user->id;
        endif;

        if (isset($request->pdf)) :
            $pdf_header = $request->pdf['header'];
            $pdf_footer = $request->pdf['footer'];

            if ($pdf_header) :
                // dd("entro");
                // Decodificar la imagen base64
                $imageParts = explode(";base64,", $pdf_header);
                $imageTypeAux = explode("image/", $imageParts[0]);
                $imageType = $imageTypeAux[1];
                $imageBase64 = base64_decode($imageParts[1]);
                $fileName = "header_membrete." . $imageType;
                Storage::disk('images')->put($fileName, $imageBase64);

                // Obtener la URL de la imagen guardada
                $pdf_header_url = image($fileName);
                $setting->pdf_header = $pdf_header_url;
            endif;

            if ($pdf_footer) :
                // Decodificar la imagen base64
                $imageParts = explode(";base64,", $pdf_footer);
                $imageTypeAux = explode("image/", $imageParts[0]);
                $imageType = $imageTypeAux[1];
                $imageBase64 = base64_decode($imageParts[1]);
                $fileName = "footer_membrete." . $imageType;
                Storage::disk('images')->put($fileName, $imageBase64);

                // Obtener la URL de la imagen guardada
                $pdf_footer_url = image($fileName);
                $setting->pdf_footer = $pdf_footer_url;
            endif;
        endif;

        $setting->save();
        $msg = "Se ha guardado la configuración correctamente";
        saveLog('Book', 'save', $msg, $request->all(), $request->ip(), $user->id);
        return response()->json(array('success' => true, 'msg' => $msg));
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
