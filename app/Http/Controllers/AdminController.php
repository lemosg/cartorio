<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Http\Controllers\Controller;


use App\Models\Cartorio as CartorioModel;
use App\Models\Certidoe as CertidoeModel;
use App\Models\Uf as UFModel;
use App\Models\Municipio as MunicipioModel;

class AdminController extends Controller {


	public function convertTable (Request $request) {
		ini_set('max_execution_time', 3000);

		$file = fopen($request->file('csv'), 'r');

		$errors = [];

		while (($line = fgetcsv($file)) !== FALSE) {
			
			$atualizacao = strtotime($line[18]);

			if ($atualizacao === FALSE)
				continue;
			
			/*

			$date_arr = explode('/', $line[18]);
			$atualizacao = implode('-', [$date_arr[2], $date_arr[0], $date_arr[1]]);

			var_dump(strtotime($line[18]));

			dd(strtotime($atualizacao));

			#dd($line);
			*/

			$atualizacao = new Carbon(date('Y-m-d', $atualizacao));
			
			$cartorio = CartorioModel::where('cnpj', $line[1])->first();
			# UPDATE EXISTING CARTORIO
			if (!empty($cartorio)) {
				$curr_atualizacao = new Carbon($cartorio->ultima_atualizacao);
				if ($curr_atualizacao->lessThan($atualizacao)) {
					foreach ($cartorio->certidoes_rel as $certidao) {
						$certidao->delete();
					}
					$cartorio->fill([
						'uf_id' => $uf->id,
						'cnpj' => $line[1],
						'cns' => $line[2],
						'data_instalacao' => date('Y-m-d', strtotime($line[3])),
						'nome_oficial' => $line[4],
						'nome_fantasia' => $line[5],
						'endereco' => $line[6],
						'bairro' => $line[7],
						'municipio_id' => $municipio->id,
						'cep' => $line[9],
						'nome_titular' => $line[10],
						'nome_substituto' => $line[11],
						'nome_juiz' => $line[12],
						'homepage' => $line[13],
						'email' => $line[14],
						'telefone' => $line[15],
						'fax' => $line[16],
						'observacao' => $line[17],
						'ultima_atualizacao' => $atualizacao->format('Y-m-d'),
						'horario_funcionamento' => $line[19],
						'area_abrangencia' => $line[20],
						'atriuicoes' => $line[21],
						'comarca' => $line[22],
						'entrancia' => $line[23],
					]);
					$cartorio->save();
					# UPDATE RELATIONS TOO BY REMOVING AND THEN CREATING AGAIN
					$cont = 0;
					for ($x = 28; $x < 57; $x++) {
						$cont++;
						if ($line[$x] === 'true')
							CertidoeModel::create(['cartorio_id' => $cartorio->id, 'certidao_type_id' => $cont]);
					}
					
				}

				continue;
			}


			# CREATE A NEW CARTORIO
			$uf = UFModel::whereRaw('LOWER(sigla) = ?', mb_convert_case($line[0], MB_CASE_LOWER, "UTF-8"))->first();
			if (empty($uf)) {
				$errors[] = array_merge(['messagem' => 'sigla'], $line);
				continue;
			}

			$municipio = MunicipioModel::whereRaw('LOWER(nome) = ?', mb_convert_case(str_replace("'", "", $line[8]), MB_CASE_LOWER, "UTF-8"))->first();
			if (empty($municipio)){
				$errors[] = array_merge(['messagem' => 'municipio'], $line);
				continue;
			}

			$flag = FALSE;
			foreach ($line as $key => $element) {
				if ($key == 17 || $key == 2 || $key == 19 || $key == 20)
					continue;

				if (($key == 4 || $key == 5 || $key == 6 || $key == 7  || $key == 21) && strlen($element) <= 255)
					continue;

				if (strlen($element) > 100)
					$flag = $key;
			}

			if ($flag) {
				$errors[] = array_merge(['messagem' => $flag], $line);
				continue;
			}


			$config = [
				'uf_id' => $uf->id,
				'cnpj' => $line[1],
				'cns' => $line[2],
				'data_instalacao' => date('Y-m-d', strtotime($line[3])),
				'nome_oficial' => $line[4],
				'nome_fantasia' => $line[5],
				'endereco' => $line[6],
				'bairro' => $line[7],
				'municipio_id' => $municipio->id,
				'cep' => $line[9],
				'nome_titular' => $line[10],
				'nome_substituto' => $line[11],
				'nome_juiz' => $line[12],
				'homepage' => $line[13],
				'email' => $line[14],
				'telefone' => $line[15],
				'fax' => $line[16],
				'observacao' => $line[17],
				'ultima_atualizacao' => $atualizacao->format('Y-m-d'),
				'horario_funcionamento' => $line[19],
				'area_abrangencia' => $line[20],
				'atriuicoes' => $line[21],
				'comarca' => $line[22],
				'entrancia' => $line[23],
			];

			
			$cartorio = CartorioModel::create($config);

			$cont = 0;
			for ($x = 28; $x < 57; $x++) {
				$cont++;
				if ($line[$x] === 'true')
					CertidoeModel::create(['cartorio_id' => $cartorio->id, 'certidao_type_id' => $cont]);
			}			
		}

		dd($errors);

		return redirect()->to_route('admin.panel')->with('message', 'Sucess');
	}


	public function panel () {
		return view('admin/panel');
	}
}
