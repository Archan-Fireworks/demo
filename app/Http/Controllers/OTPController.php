<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;
use App\Models\OtpConfiguration;

class OTPController extends Controller
{
    public function configure_index(Request $request) {
        return view('backend.otp.config');
    }

    public function credentials_index(Request $request) {
        return view('backend.otp.credentials');
    }

    public function updateActivationSettings(Request $request) {
        $config = OtpConfiguration::where('type', $request->type)->first();
        if($config!=null){
            $config->value = $request->value;
            $config->save();
        }
        else{
            $config = new OtpConfiguration;
            $config->type = $request->type;
            $config->value = $request->value;
            $config->save();
        }

        Artisan::call('cache:clear');
        return '1';
    }

    public function update_credentials(Request $request) {


        $update = new BusinessSettingsController();

        foreach ($request->types as $key => $type) {
            $update->overWriteEnvFile($type, $request[$type]);
        }
        Artisan::call('cache:clear');

        flash(translate("Settings updated successfully"))->success();
        return back();
    }
}
