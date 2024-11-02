<?php

namespace App\Http\Controllers;

use App\Mail\SendQr;
use App\Models\Appointment;
use App\Models\Category;
use App\Models\User;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Imagick;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AppointmentController extends Controller
{
    public function index()
    {
        $workers = Worker::latest()->get();
        $clients = User::where('is_admin', 0)->latest()->get();
        $datas = Appointment::latest()->get();
        return view('admin.appointment.index', compact('workers','clients','datas'));
    }

    public function show($id){}

    public function store(Request $request)
    {
        try {
            $appointment = Appointment::create([
                'start_time'            => Carbon::make($request->start_time),
                'finish_time'           => Carbon::make($request->finish_time),
                'worker_id'             => $request->worker_id,
                'user_id'               => $request->user_id,
                'comment'               => $request->comment
            ]);

            $qr = 'Client: ' . $appointment->user->first_name . ' ' . $appointment->user->last_name . PHP_EOL;
            $qr .= 'Worker: ' . $appointment->worker->first_name . ' ' . $appointment->worker->last_name . PHP_EOL;
            $qr .= 'Service: ' . $appointment->worker->profession_en  . PHP_EOL;
            $qr .= 'Time: ' . \Carbon\Carbon::make($appointment->start_time)->format('Y-m-d') . ' ' . \Carbon\Carbon::make($appointment->start_time)->format('H:i') . '-' .\Carbon\Carbon::make($appointment->finish_time)->format('H:i');
            $file_name = public_path().'/qr/'.uniqid().'.png';
            $svg = QrCode::format('png')->size(300)->margin(5)->generate($qr);
            $im = new Imagick();
            $im->readImageBlob($svg);
            $im->setImageFormat("png24");
            $im->writeImage($file_name);
            Mail::to($appointment->user->email)->send(new SendQr($file_name, $qr));
            return redirect()->route('appointment.index')->with('success', __('Added'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $appointment = Appointment::find($id);

            $appointment->update([
                'start_time'            => Carbon::make($request->start_time),
                'finish_time'           => Carbon::make($request->finish_time),
                'worker_id'             => $request->worker_id,
                'user_id'               => $request->user_id,
            ]);
            return redirect()->route('appointment.index')->with('success', __('Edited'));
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['message' => 'Error']);
        }
    }

    public function edit($id)
    {
        $workers = Worker::latest()->get();
        $clients = User::where('is_admin', 0)->latest()->get();
        $data = Appointment::find($id);
        return view('admin.appointment.edit', compact('data','workers','clients'));
    }

    public function destroy($id)
    {
        try{
            $data = Appointment::find($id);
            $data->delete();
            return redirect()->route('appointment.index')->with('success', __('Deleted'));
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
}
