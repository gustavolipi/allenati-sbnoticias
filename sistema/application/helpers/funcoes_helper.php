<?php
if (!function_exists('clearCache')) {
	function clearCache()
	{

		// create curl resource
		$ch = curl_init();
		// set url
		curl_setopt($ch, CURLOPT_URL, "https://sbnoticias.com.br/clearCache");
		//return the transfer as a string
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// $output contains the output string
		$output = curl_exec($ch);
		// close curl resource to free up system resources
		curl_close($ch);
	}
}
if (!function_exists('countClicksPublicidade')) {
	function countClicksPublicidade($id)
	{
		$CI = &get_instance();

		$CI->load->model('Publicidade_click_model');
		$registros = $CI->Publicidade_click_model->where('publicidade_id', $id)->get_all();
		if ($registros) {
			echo count($registros);
		} else {
			echo 0;
		}
	}
}
if (!function_exists('defineEnsino')) {
	function defineEnsino($id)
	{
		$CI = &get_instance();

		$CI->load->model('Ensino_model');
		$ensino = $CI->Ensino_model->get($id);
		if ($ensino) {
			echo $ensino->titulo;
		} else {
			echo '-';
		}
	}
}
if (!function_exists('defineTipoDepoimento')) {
	function defineTipoDepoimento($id)
	{
		$CI = &get_instance();

		$CI->load->model('Depoimento_tipo_model');
		$tipo = $CI->Depoimento_tipo_model->get($id);
		if ($tipo) {
			echo $tipo->titulo;
		} else {
			echo '-';
		}
	}
}
if (!function_exists('defineTipoParceria')) {
	function defineTipoParceria($id)
	{
		switch ($id) {
			case '1':
				echo 'Parceiro';
				break;
			case '2':
				echo 'Convênio';
				break;
		}
	}
}

if (!function_exists('defineTipoCategoria')) {
	function defineTipoCategoria($id)
	{
		switch ($id) {
			case '1':
				echo 'Classificados';
				break;
		}
	}
}

if (!function_exists('resizeImage')) {
	function resizeImage($source_image, $new_image, $width = 100)
	{
		$CI = &get_instance();
		$CI->load->library('image_lib');

		$config['image_library'] = 'gd2';
		$config['source_image'] = $source_image;
		$config['new_image'] = $new_image;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = $width;
		$CI->image_lib->initialize($config);

		if ($CI->image_lib->resize()) return true;
		else return false;
	}
}
if (!function_exists('delTree')) {
	function delTree($dir)
	{
		$files = array_diff(scandir($dir), array('.', '..'));
		foreach ($files as $file) {
			(is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
		}

		return rmdir($dir);
	}
}
if (!function_exists('saida_impressao')) {
	function removeAcentos($string)
	{

		// matriz de entrada
		$what = array(
			'ä',
			'ã',
			'à',
			'á',
			'â',
			'ê',
			'ë',
			'è',
			'é',
			'ï',
			'ì',
			'í',
			'ö',
			'õ',
			'ò',
			'ó',
			'ô',
			'ü',
			'ù',
			'ú',
			'û',
			'À',
			'Á',
			'É',
			'Í',
			'Ó',
			'Ú',
			'ñ',
			'Ñ',
			'ç',
			'Ç',
		);

		// matriz de saída
		$by = array(
			'a',
			'a',
			'a',
			'a',
			'a',
			'e',
			'e',
			'e',
			'e',
			'i',
			'i',
			'i',
			'o',
			'o',
			'o',
			'o',
			'o',
			'u',
			'u',
			'u',
			'u',
			'A',
			'A',
			'E',
			'I',
			'O',
			'U',
			'n',
			'n',
			'c',
			'C',
		);

		// devolver a string
		return str_replace($what, $by, $string);
	}
}
if (!function_exists('url_exists')) {
	function url_exists($url)
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_exec($ch);
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		return ($code == 200); // verifica se recebe "status OK"
	}
}
if (!function_exists('getPost')) {
	function getPost()
	{
		$CI = &get_instance();
		$post = array();
		foreach ($_POST as $key => $value) {
			$post[$key] = $CI->input->post($key);
		}
		foreach ($_GET as $key => $value) {
			$post[$key] = $CI->input->get($key);
		}
		unset($post['submit']);
		$post = array_filter($post);

		return $post;
	}
}
if (!function_exists('do_upload')) {
	function do_upload($campo, $diretorio)
	{

		$CI = &get_instance();

		$config['upload_path'] = $diretorio;
		$config['encrypt_name'] = true;
		$config['max_size'] = '100000';
		$config['remove_spaces'] = true;
		$config['allowed_types'] = '*';
		$CI->load->library('upload');
		$CI->upload->initialize($config);
		if ($CI->upload->do_upload($campo)) {
			return $CI->upload->data();
		} else {
			return $CI->upload->display_errors();
		}
	}
}
if (!function_exists('DataBRtoMySQL')) {
	function DataBRtoMySQL($DataBR)
	{
		$DataBR = str_replace(array(" – ", "-", " ", " "), " ", $DataBR);
		list($data, $hora) = explode(" ", $DataBR);

		return implode("-", array_reverse(explode("/", $data))) . " " . $hora;
	}
}
if (!function_exists('DataFormatar')) {
	function DataFormatar($data, $formato)
	{
		return date($formato, strtotime($data));
	}
}
if (!function_exists('DataMySQLtoBR')) {
	function DataMySQLtoBR($DataMySQL)
	{
		return date("d/m/Y H:i:s", strtotime($DataMySQL));
	}
}
if (!function_exists('ExcluiDir')) {
	function ExcluiDir($Dir)
	{

		if ($dd = opendir($Dir)) {
			while (false !== ($Arq = readdir($dd))) {
				if ($Arq != "." && $Arq != "..") {
					$Path = "$Dir/$Arq";
					if (is_dir($Path)) {
						ExcluiDir($Path);
					} elseif (is_file($Path)) {
						unlink($Path);
					}
				}
			}
			closedir($dd);
		}
		rmdir($Dir);
	}
}
if (!function_exists('gerar_senha')) {
	function gerar_senha()
	{
		$CI = &get_instance();
		$CI->load->helper('string');

		return random_string('alnum', 5);
	}
}
// if (!function_exists('validaCPF')) {
// 	function validaCPF($cpf = null)
// 	{

// 		// Verifica se um número foi informado
// 		if (empty($cpf)) {
// 			return false;
// 		}

// 		// Elimina possivel mascara
// 		$cpf = ereg_replace('[^0-9]', '', $cpf);
// 		$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

// 		// Verifica se o numero de digitos informados é igual a 11
// 		if (strlen($cpf) != 11) {
// 			return false;
// 		}
// 		// Verifica se nenhuma das sequências invalidas abaixo
// 		// foi digitada. Caso afirmativo, retorna falso
// 		else {
// 			if (
// 				$cpf == '00000000000' ||
// 				$cpf == '11111111111' ||
// 				$cpf == '22222222222' ||
// 				$cpf == '33333333333' ||
// 				$cpf == '44444444444' ||
// 				$cpf == '55555555555' ||
// 				$cpf == '66666666666' ||
// 				$cpf == '77777777777' ||
// 				$cpf == '88888888888' ||
// 				$cpf == '99999999999'
// 			) {
// 				return false;
// 				// Calcula os digitos verificadores para verificar se o
// 				// CPF é válido
// 			} else {

// 				for ($t = 9; $t < 11; $t++) {

// 					for ($d = 0, $c = 0; $c < $t; $c++) {
// 						$d += $cpf{
// 							$c} * (($t + 1) - $c);
// 					}
// 					$d = ((10 * $d) % 11) % 10;
// 					if ($cpf{
// 						$c} != $d) {
// 						return false;
// 					}
// 				}

// 				return true;
// 			}
// 		}
// 	}
// }
if (!function_exists('full_url')) {
	function full_url()
	{
		$ci = &get_instance();
		$return = $ci->config->site_url() . $ci->uri->uri_string();
		if (count($_GET) > 0) {
			$get = array();
			foreach ($_GET as $key => $val) {
				$get[] = $key . '=' . $val;
			}
			$return .= '?' . implode('&', $get);
		}

		return $return;
	}
}