<?php
// custom helper by Wahyu Pratama
if (!function_exists('basedURL')) {
	function basedURL($sub=''){
		return str_replace('://', '://'.$sub.($sub ? '.' : ''), env('APP_URL'));
	}
}

if (!function_exists('returner')) {
	function returner($resource,$need){
		$data = [];
		foreach ($need as $key) {
			switch (true) {
				case (empty($resource[$key])):
					break;
				case (is_array($resource[$key])):
					for ($i=0; $i < count($resource[$key]); $i++) {
						array_push($data, $resource[$key][$i]);
					}
					break;
				
				default:
					array_push($data,$resource[$key]);
					break;
			}
		}
		return $data;
	}
}
if (!function_exists('css')) {

	function css(...$array){

		return returner([
			'ckeditor' => asset('/storage/vendor/ckeditor/sample/styles.css'),
			'select' => 'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
			'table' => 'https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css',
			'cropper' => 'https://cdnjs.cloudflare.com/ajax/libs/cropperjs/2.0.0-alpha.1/cropper.min.css',
			'date' => 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
			'wizard' => 'https://cdn.jsdelivr.net/npm/smartwizard@5/dist/css/smart_wizard_all.min.css',
			'profile' => asset('/storage/css/profile.min.css'),
			'article' => asset('/storage/css/articles.min.css'),
			'owl' => 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css',
			'choices' => 'https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css'
		],$array);

	}
}
if (!function_exists('js')) {
	function js(...$array){

		return returner([
			'ckeditor' => asset('/storage/vendors/ckeditor/build/ckeditor.js'),
			'select' => 'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js',
			'table' => [
				'https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js',
				'https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js'
			],
			'cropper' => 'https://cdnjs.cloudflare.com/ajax/libs/cropperjs/2.0.0-alpha.1/cropper.min.js',
			'date' => [
				'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
				'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.id.min.js'
			],
			'wizard' => 'https://cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js',
			'scanner' => [
				asset('/storage/js/qrcodelib.js'),
				asset('/storage/js/webcodecamjquery.min.js')
			],
			'lazy' => 'https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js',
			'psb' => asset('/storage/vendors/js/psb.min.js'),
			'chart' => 'https://cdn.jsdelivr.net/npm/apexcharts',
			'owl' => 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js',
			'choices' => 'https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js'
		],$array);

	}
}