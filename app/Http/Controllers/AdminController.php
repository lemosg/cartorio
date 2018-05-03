<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Http\Controllers\Controller;



class AdminController extends Controller {


	public function convertTable (Request $request) {
		$file = fopen($request->file('csv'), 'r');

		while (($line = fgetcsv($file)) !== FALSE) {
			dd($line);
			if (strtotime($line[18]) === FALSE)
				continue;

			$cartorio = CartorioModel::where('cnpj', $line[1])->first();
			if (!empty($cartorio)) {
				if ($cartorio->ultima_atualizacao < $line[18]) {
					$cartorio->update();
					# UPDATE RELATIONS TOO BY REMOVING AND THEN CREATING AGAIN
				}

				continue;
			}

			$uf = UFModel::where('sigla', $line[0])->first()->id;
			$municipio = MunicipioModel::where('name', $line[8])->first()->id;

			$config = [
				'uf_id' => $uf,
				'cnpj' => $line[1],
				'cns' => $line[2],
				'data_instalacao' => $line[3],
				'nome_oficial' => $line[4],
				'nome_fantasia' => $line[5],
				'endereco' => $line[6],
				'bairro' => $line[7],
				'municipio_id' => $municipio,
				'cep' => $line[9],
				'nome_titular' => $line[10],
				'nome_substituto' => $line[11],
				'nome_juiz' => $line[12],
				'homepage' => $line[13],
				'email' => $line[14],
				'telefone' => $line[15],
				'fax' => $line[16],
				'observacao' => $line[17],
				'ultima_atualizacao' => $line[18],
				'horario_funcionamento' => $line[19],
				'area_abrangencia' => $line[20],
				'atriuicoes' => $line[21],
				'comarca' => $line[22],
				'entrancia' => $line[23],
			];

			$cont = 0;
			for ($x = 28; $x < 57; $x++) {
				$cont++;
				if ($line[$x] === 'true')
					Certidoe::create(['cartorio_id' => $cartorio->id, 'certidao_type_id' => $cont]);
			}
		}

		return redirect()->to_route('admin.panel')->with('message', 'Sucess');
	}


	public function panel () {
		return view('admin/panel');
	}
}
