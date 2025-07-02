<?php
/**
 * Форма записи
 */
function form_send() {
	$ajax_result = $content = [];
	$data        = $_POST;
	if ( ! empty( $data['action'] ) ) {
		unset( $data['action'] );
	}
	if ( ! empty( $data['clinic'] ) ) {
		unset( $data['clinic'] );
	}
	if ( ! empty( $data['title'] ) ) {
		$title = $data['title'] . '. Стоматология.';
		unset( $data['title'] );
	}
	if (!empty($data['token'])) unset($data['token']);

	foreach ( $data as $k => $item ) {
		$content[] = str_replace( '_', ' ', $k ) . ': ' . $item;
	}
	$args    = [
		'post_title'   => $title ?? '-',
		'post_content' => implode( '<br>', $content ) . '<br> Страница отправки: ' . $_SERVER['HTTP_REFERER'],
	];
	try {
		$email   = [];
		$ajax_result['ok'] = true;
		//$ajax_result['email'] = sendEmail( $args['post_title'], $args['post_content'], $email, $files ?? [] );
		// if ( ! DEBUG_MODE ) calltouchSend();
		wp_send_json_success(['message' => 'Данные успешно отправлены']);
	} catch (Exception $e) {
		wp_send_json_error(['message' => 'Ошибка: ' . $e->getMessage()]);
	}

}

add_action( 'wp_ajax_nopriv_form_send', 'form_send' );
add_action( 'wp_ajax_form_send', 'form_send' );


/*
use Sendpulse\RestApi\ApiClient;
use Sendpulse\RestApi\Storage\FileStorage;

// API credentials from https://login.sendpulse.com/settings/#api
define( 'API_USER_ID', 'a772fcd773da7cd339f87a8156b3d3ff' );
define( 'API_SECRET', '32b8d8fac5cde0794e24aedf205d71d7' );
define( 'PROMOCODE_BOOK', '689281' );

$SPApiClient = new ApiClient( API_USER_ID, API_SECRET, new FileStorage() );

/**
 * @param $title - заголовок
 * @param $content - содержимое
 * @param array $emails_to - список email
 * @param array $files - прикрепленные файлы
 *
 * @return mixed
 */
/*
function sendEmail( $title, $content, $emails_to = [], $files = [] ) {

	checkCaptcha();

	global $SPApiClient;

	addDataToCsv( $title, $content );

	$test_email = preg_match( '#test#msiu', $content );
	$email      = [
		'html'    => $content,
		'text'    => $content,
		'subject' => $title,
		'from'    => [
			'name'  => 'Yourmed',
			'email' => 'service@yourmed.clinic',
		],
		'to'      =>
			! empty( DEBUG_MODE ) || $test_email ? [
				[
					'name'  => 'Юрий',
					'email' => 'kya1982@gmail.com',
				]
			] :
				( ! empty( $emails_to ) ? ( ! empty( $emails_to[0] ) && is_array( $emails_to[0] ) ? $emails_to : [ $emails_to ] ) :

					[
						[
							'name'  => 'Колл-центр',
							'email' => 'callcenter@gippomed.ru',
						],
						[
							'name'  => 'Воронко',
							'email' => 'voronko@gippomed.ru',
						],
					]
				),
	];
	//доп.адрес для кт и мрт
	if ( ( date( 'H' ) >= 22 or date( 'H' ) <= 7 ) && preg_match( "#[магнитно|томография|мрт|\sкт\s]#msiU", $title ) ) {
		$email['to'][] = DEBUG_MODE || $test_email ? [ 'email' => 'kya82@mail.ru' ] : [ 'email' => 'kt@gippomed.ru' ];
	}
	if ( ! empty( $files ) ) {
		$email['attachments'] = $files;
	}
	$res = $SPApiClient->smtpSendMail( $email );

	return $res;
}

function calltouchSend() {
	$call_value = $_COOKIE['_ct_session_id']; /* ID сессии Calltouch, полученный из cookie */
/*
	$ct_site_id = 72817;
	$data       = "fio=" . urlencode( $_POST['ФИО'] ?? '-' )
	              . "&phoneNumber=" . ( $_POST['Телефон'] ?? '' )
	              . "&email=" . ( $_POST['email'] ?? '' )
	              . "&subject=" . urlencode( $_POST['title'] ?? '' )
	              . "" . ( $call_value != 'undefined' ? "&sessionId=" . $call_value : "" );
	$ch         = curl_init();
	curl_setopt( $ch, CURLOPT_HTTPHEADER, array( "Content-type: application/x-www-form-urlencoded;charset=utf-8" ) );
	curl_setopt( $ch, CURLOPT_URL, 'https://api.calltouch.ru/calls-service/RestAPI/requests/' . $ct_site_id . '/register/' );
	curl_setopt( $ch, CURLOPT_POST, 1 );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	$calltouch = curl_exec( $ch );
	curl_close( $ch );
}

*/