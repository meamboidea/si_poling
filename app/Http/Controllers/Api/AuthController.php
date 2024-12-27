<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Saksi;
use App\Models\Suara;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginSaksi(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->where('role','Saksi')->first();
        if (!$user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Kombinasi email dan password tidak sesuai',
            ], 422);
        }

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json([
            'success' => true,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
            'message' => 'Selamat datang kembali '.$user->saksi->nama_saksi,
        ]);
    }

    public function profilSaksi(Request $request)
    {
        $user = User::where('id', $request->user()->id)->where('role','Saksi')->first();
        $dataSaksi = Saksi::join('tps', 'saksis.tps_id', '=', 'tps.id')
            ->join('desas', 'tps.desa_id', '=', 'desas.id')
            ->join('kecamatans', 'desas.kecamatan_id', '=', 'kecamatans.id')
            ->select('saksis.*','tps.nama_tps','desas.nama_desa','kecamatans.nama_kecamatan','tps.alamat','tps.pemilih_lk','tps.pemilih_pr')
            ->where('saksis.id', $request->user()->id_model)->first();
        return response()->json([
            'success' => true,
            'data' => $dataSaksi,
            'message' => 'Profil saksi'
        ]);
    }

    public function inputHasilHitung(Request $request)
    {
        $request->validate([
            'jumlah_suara1' => 'required|numeric',
            'jumlah_suara2' => 'required|numeric',
            'jml_suara' => 'required|numeric',
            'jml_suara_sah' => 'required|numeric',
            'jml_suara_tidak_sah' => 'required|numeric',
            'jml_suara_tidak_digunakan' => 'required|numeric',
            'jml_suara_cadangan' => 'required|numeric',
        ]);

        $user = User::where('id', $request->user()->id)->where('role','Saksi')->first();
        //ambil tps_id dari user saksi yang login
        $tps_id = $user->saksi->tps_id;

        DB::beginTransaction();
        try {
            //input suara calon 1
            $suaraInput = new Suara;
            $suaraInput->calon_id = 1;
            $suaraInput->tps_id = $tps_id;
            $suaraInput->jumlah_suara = $request->jumlah_suara1;
            $suaraInput->saksi_id = $request->user()->id_model;
            $suaraInput->jml_suara = $request->jml_suara;
            $suaraInput->jml_suara_sah = $request->jml_suara_sah;
            $suaraInput->jml_suara_tidak_sah = $request->jml_suara_tidak_sah;
            $suaraInput->jml_suara_tidak_digunakan = $request->jml_suara_tidak_digunakan;
            $suaraInput->jml_suara_cadangan = $request->jml_suara_cadangan;
            $suaraInput->save();

            //input suara calon 2
            $suaraInput2 = new Suara;
            $suaraInput2->calon_id = 2;
            $suaraInput2->tps_id = $tps_id;
            $suaraInput2->jumlah_suara = $request->jumlah_suara2;
            $suaraInput2->saksi_id = $request->user()->id_model;
            $suaraInput2->jml_suara = $request->jml_suara;
            $suaraInput2->jml_suara_sah = $request->jml_suara_sah;
            $suaraInput2->jml_suara_tidak_sah = $request->jml_suara_tidak_sah;
            $suaraInput2->jml_suara_tidak_digunakan = $request->jml_suara_tidak_digunakan;
            $suaraInput2->jml_suara_cadangan = $request->jml_suara_cadangan;
            $suaraInput2->save();

            DB::commit();

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Gagal input hasil hitung'
            ], 422);

        }
        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'Suara berhasil dikirim'
        ]);
    }

    public function pengumuman(Request $request)
    {
        $content = Pengumuman::all();

        return response()->json([
            'success' => true,
            'data' => $content,
            'message' => 'Pengumuman'
        ]);
    }
}
