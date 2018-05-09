<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Http\Controllers\Controller;


use App\Models\Cartorio as CartorioModel;
use App\Models\Certidoe as CertidoeModel;
use App\Models\CertidaoType as CertidaoTypeModel;
use App\Models\Uf as UFModel;
use App\Models\Municipio as MunicipioModel;

class HomeController extends Controller {


	public function index () {
		return view('home/index', [
			'certidoes' => CertidaoTypeModel::orderBy('nome')->get()
		]);
	}

	public function certidao (CertidaoTypeModel $certidao) {

		$estados = UFModel::whereHas('cartorios', function ($q) use ($certidao) {
			$q->whereHas('certidoes_rel', function ($s) use ($certidao) {
				$s->where('certidao_type_id', $certidao->id);	
			});
		})->get();

		return view('home/estados', [
			'estados' => $estados,
			'certidao' => $certidao
		]);
	}

	public function uf (CertidaoTypeModel $certidao, UFModel $uf) {

		$municipios = MunicipioModel::where('uf_id', $uf->id)->whereHas('cartorios', function ($q) use ($certidao) {
			$q->whereHas('certidoes_rel', function ($s) use ($certidao) {
				$s->where('certidao_type_id', $certidao->id);	
			});
		})->get();

		return view('home/municipios', [
			'uf' => $uf,
			'certidao' => $certidao,
			'municipios' => $municipios
		]);
	}

	public function municipio (CertidaoTypeModel $certidao, UFModel $uf, MunicipioModel $municipio) {

		$cartorios = CartorioModel::where(['uf_id' => $uf->id, 'municipio_id' => $municipio->id])->whereHas('certidoes', function ($q) use ($certidao) {
			$q->where('certidao_type_id', $certidao->id);	
		})->get();

		return view('home/cartorios', [
			'uf' => $uf,
			'certidao' => $certidao,
			'municipio' => $municipio,
			'cartorios' => $cartorios
		]);
	}

	public function form (CertidaoTypeModel $certidao, UFModel $uf, MunicipioModel $municipio, CartorioModel $cartorio) {

		$cartorios = CartorioModel::where(['uf_id' => $uf->id, 'municipio_id' => $municipio->id])->whereHas('certidoes', function ($q) use ($certidao) {
			$q->where('certidao_type_id', $certidao->id);	
		})->get();

		return view('home/cartorios', [
			'uf' => $uf,
			'certidao' => $certidao,
			'municipio' => $municipio,
			'cartorios' => $cartorios
		]);
	}
}
