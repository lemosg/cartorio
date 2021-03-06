<?php

namespace App\Http\Controllers;

use DB;
use Auth;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Http\Controllers\Controller;

use App\Lib\Deposit\Stripe\Stripe;

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

		$user = Auth::user();

		return view('home/form', [
			'uf' => $uf,
			'certidao' => $certidao,
			'municipio' => $municipio,
			'cartorio' => $cartorio,
			'user' => $user,
		]);
	}

	public function request(Request $request, CertidaoTypeModel $certidao, UFModel $uf, MunicipioModel $municipio, CartorioModel $cartorio) {

		$dados = $request->all();

		$user = Auth::user();

		$value = (!empty($user->juridico)) ? $certidao->value * 0.9 : $certidao->value;

		$stripe = new Stripe($dados['stripeToken']);
		if ($stripe->charge($value) === FALSE)
			return redirect()->back()->with('error', [$stripe->error->msg]);

		$mail_data = [];

		foreach ($dados as $key => $value) {
			if (!in_array($key, ['stripeToken', '_token']))
				$mail_data[$key] = $value;
		}

		Mail::to('lemos.gabriel.dev@gmail.com')->send(new OrderShipped($mail_data, $user, $certidao, $cartorio));

		return redirect()->back()->with('success', ['Seu pedido foi realizado com sucesso!']);
	}
}
