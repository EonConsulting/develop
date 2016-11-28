<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 8:50 AM
 */

namespace EONConsulting\PHPStencil;


use EONConsulting\PHPStencil\src\Factories\AdapterFactory;
use EONConsulting\PHPStencil\src\Factories\Text\TextEnum;
use EONConsulting\PHPStencil\src\Factories\Text\TextFactory;

class PHPStencil {

    public function hi() {
        return 'hi';
    }

    public function output() {
        // observer
//        $event = new SayHello("Josh Harington");
//        $event->attach(new SayHelloObserver());
//        $event->set_name("Hey there");
//
//        // observer
//        $car_model = new CarModel();
//        $car_model->attach(new CarModelObserver());
//        $car_model->notify();

        // factory - text
        $factory = new TextFactory(new AdapterFactory);
        $text = $factory->make(TextEnum::CSV);

        $xml = [
            'folders' => [
                ['name' => 'Folder 1', 'id' => '1', 'files' => [
                    ['name' => 'File 1', 'id' => '1', 'type' => 'psd'],
                    ['name' => 'File 2', 'id' => '2', 'type' => 'csv'],
                    ['name' => 'File 3', 'id' => '3', 'type' => 'pdf'],
                ]],
                ['name' => 'Folder 2', 'id' => '2'],
                ['name' => 'Folder 3', 'id' => '3', 'files' => [
                    ['name' => 'File 1', 'id' => '1', 'type' => 'txt'],
                    ['name' => 'File 2', 'id' => '2', 'type' => 'csv'],
                ]],
            ],
            'files' => [
                ['name' => 'My public file']
            ]
        ];

        $csv = [
            ['Hey', 'there'],
            ['yo', 'someone'],
            ['Hey', 'there']
        ];

        $json = ['Author' => ['name' => 'Josh Harington', 'gender' => 'male', 'profession' => 'Professonal Nerd.']];

        return $text->output($csv);
    }
//
//    /**
//     * Render the GUI view of choice
//     * @param $type
//     * @param $data
//     * @return mixed|null
//     */
//    public function render($type = 'form', $data) {
//
//        if(($type != 'form' && $type != 'list') || !$data)
//            return null;
//
//        switch($type) {
//            case 'form':
//                $type = GUIEnum::FORM;
//                break;
//            case 'list':
//                $type = GUIEnum::UILIST;
//                break;
//        }
//
//        // factory - GUI
//        $factory = new GUIFactory(new AdapterFactory);
//        $gui = $factory->make(GUIEnum::FORM);
//
//        return $gui->render($data);
//    }
//
//    public function service($type = 'test', $data) {
//
//        if(($type != 'rest' && $type != 'soap') || !$data)
//            return null;
//
//        switch($type) {
//            case 'rest':
//                $type = WebServiceEnum::REST;
//                break;
//            case 'soap':
//                $type = WebServiceEnum::SOAP;
//                break;
//        }
//
//        $factory = new WebServiceFactory(new AdapterFactory);
//        $service = $factory->make($type);
//
//        return $service->output($data);
//    }

}