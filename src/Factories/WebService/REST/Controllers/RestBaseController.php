<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 9:35 AM
 */

namespace EONConsulting\PHPStencil\src\Factories\WebService\REST\Controllers;


use App\Http\Controllers\Controller;

/**
 * Class RestBaseController
 * @package EONConsulting\PHPStencil\src\Factories\WebService\REST\Controllers
 */
class RestBaseController extends Controller {

    /**
     * RestBaseController constructor.
     */
    public function __construct() {

    }

    /**
     * @param $messages
     * @return array
     */
    protected function return_error($messages) {
        return [
            'success' => false,
            'data' => [
                'success' => false,
                'error_messages' => $messages,
                'count' => count($messages)
            ]
        ];
    }

    /**
     * @param $messages
     * @param array $more_data
     * @return array
     */
    protected function return_success($messages, $more_data = []) {
        $arr = [
            'success' => true,
            'data' => [
                'success' => true,
                'success_messages' => $messages,
                'count' => count($messages)
            ]
        ];

        $data = array_merge($arr['data'], $more_data);
        $arr['data'] = $data;

        return $data;
    }

}