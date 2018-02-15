<?php

namespace EONConsulting\Student\Progression\Http\Controllers;

use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;
use EONConsulting\Storyline2\Models\Course;
use EONConsulting\Storyline2\Models\Storyline;
use EONConsulting\Storyline2\Models\StorylineItem;
use EONConsulting\Storyline2\Models\Template;
use EONConsulting\Storyline2\Transformers\TemplateTransformer;
use App\Models\StudentProgress;
use GuzzleHttp\Client;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Mailgun\Mailgun;
use mikehaertl\wkhtmlto\Pdf;
use EONConsulting\Storyline2\Controllers\Storyline2ViewsJSON as Storyline2JSON;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class DefaultController extends LTIBaseController {

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function copyleaks(Request $request) {
        $client = new Client();
        $cert = base_path() . '/vendor/guzzlehttp/guzzle/src/cacert.pem';
        $text = $request->get('data');
        $login = $client->request('POST', 'https://api.copyleaks.com/v1/account/login-api', [
            'verify' => false,
            'form_params' => [
                'Email' => 'reggiesta.in@gmail.com',
                'ApiKey' => 'D98A75CC-24DC-4136-ABA0-7B96985651CB'
            ]
        ]);

        if ($login->getStatusCode() == 200) {
            $body = $login->getBody()->getContents();
            $data = json_decode($body);
            $result = $this->createByText($data, $text);
            $msg = 'true';
            $success = $result;
        } else {
            $msg = 'false';
            $success = 'error';
        }

        $response = array(
            'msg' => $msg,
            'success' => $success
        );

        return \Response::json($response);
    }

    /**
     * 
     * @param type $data
     * @param type $text
     * @return string
     */
    public function createByText($data, $text) {
        $client = new Client(['base_uri' => 'https://api.copyleaks.com']);
        $token = $data->access_token;
        $process = $client->request('POST', '/v1/education/create-by-text', ['body' => $text,
            'verify' => false, 'headers' => ['Content-Type' => 'application/json',
                'Authorization' => ['Bearer ' . $token]]
        ]);

        if ($process->getStatusCode() == 200) {
            $body = $process->getBody()->getContents();
            $data = json_decode($body);
            sleep(20);
            $result = $this->result($data, $token);
            return $result;
        } else {
            return 'false';
        }
    }

    /**
     * 
     * @param type $data
     * @param type $token
     * @return string
     */
    public function result($data, $token) {
        $client = new Client();
        //$cert = base_path() . '/vendor/guzzlehttp/guzzle/src/cacert.pem';
        $result = $client->request('GET', 'https://api.copyleaks.com/v1/education/' . $data->ProcessId . '/result', [
            'verify' => false, 'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token]
        ]);

        if ($result->getStatusCode() == 200) {
            $body = $result->getBody()->getContents();
            $data = json_decode($body);
            if (empty($data)) {
                $data = 'Content was Successfully scanned, no matches found.';
            } else {
                $data = "<div class='alert alert-success'><strong>Content was Successfully scanned</strong> </div><br><b>Suspected Website :</b><a href=" . $data[0]->URL . " target='_blank'>" . $data[0]->URL . "</a><br>"
                        . '<b>Result Title :</b>' . $data[0]->Title . '<br>'
                        . '<b>Number Of Copied Words :</b>' . $data[0]->NumberOfCopiedWords . '<br>'
                        //. '<b>Introduction :</b>'.$data[0]->Introduction.'<br>'
                        . "<b>Comparison Report :</b> <a href=" . $data[0]->EmbededComparison . " target='_blank'>" . $data[0]->EmbededComparison . "</a>";

                return $data;
            }
            return $data;
        } else {
            return 'false';
        }
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function supportMail(Request $request) {

        $mgClient = new Mailgun('key-f7003db80706a0ab023d62900ff91f95');
        $domain = "sandboxbbb5161c77b94bdba0db527694aed989.mailgun.org";
        # Make the call to the client.
        $result = $mgClient->sendMessage($domain, array(
            'from' => auth()->user()->name . '<re.ggiestain@gmail.com>',
            'to' => 'Support <' .$_ENV['MAIL_TO'] . '>',
            'subject' => $request->subject,
            'text' => $request->message
        ));

        if ($result->http_response_body->message) {
            $msg = '200';
        } else {
            $msg = 'error';
        }

        $response = array(
            'msg' => $msg
        );

        return \Response::json($response);
    }

    public function wkhtml() {
        $pdf = new Pdf([
            'commandOptions' => [
                'useExec' => false,
                'escapeArgs' => false,
            ],
        ]);

        return $pdf;
    }
    
    /**
     * 
     * @param type $courseId
     * @return type
     */

    public function modulePDF($courseId) {
        $course = Course::find($courseId);
        $SL2JSON = new Storyline2JSON;
        $storyline_id = $course->latest_storyline()->id;
        $items = StorylineItem::with('contents')->where('storyline_id',$storyline_id)->get();
        $items = $this->items_to_tree($items);
        
        $course['template'] = Template::where("id", $course->template_id)
            ->get()
            ->transformWith(new TemplateTransformer())
            ->toArray()['data'][0];
        
        $view = view('student-progression::module.modulepdf', ['items' => $items,'course'=>$course]);
        $contents = $view->render();

        $pdf = $this->wkhtml();
        $globalOptions = array(
            // Make Chrome not complain
            'no-outline',
            // Default page options
            'page-size' => 'Letter'
        );
        $pdf->setOptions($globalOptions);
        $pdf->addPage($contents);
        $pdf->addToc();
        $pdf->binary = storage_path().'/wkhtmltopdf/bin/wkhtmltopdf.exe';
        
        if (!$pdf->saveAs(storage_path() . '/modules/'. $course->title . '.pdf')) {
            $msg = $pdf->getError();
            $file = storage_path() . '/modules/'. $course->title . '.pdf';
            $func = $pdf;
        } else {
            $msg = 'success';
            $file = storage_path() . '/modules/'. $course->title . '.pdf';
            $func = $pdf;
        }

        $response = array(
            'msg' => $msg,
            'course' => $courseId,
            'file' => $file,
            'func' => $func
        );

        return \Response::json($response);
    }

    /**
     * 
     * @param type $courseId
     * @return type
     */
    public function downloadPDF($courseId) {
        $course = Course::find($courseId);
        $file = storage_path() . '/modules/' . $course->title . '.pdf';
        if (File::isFile($file)) {
            $file = File::get($file);
            $response = Response::make($file, 200);
            $response->header('Content-Type', 'application/pdf');
            
            return $response;
        }
    }

    public function storeProgress(Request $request) {
        $progress = StudentProgress::where([['student_id', $request->get('student')],
                    ['storyline_id', $request->get('storyline')]])->first();

        $visited = implode(",", [$request->get('id')]);

        if ($progress == NULL) {
            $StudentProgress = new StudentProgress([
                'student_id' => $request->get('student'),
                'storyline_id' => $request->get('storyline'),
                //'storyline_item_id' => $request->get('id'),
                'visited' => $visited
            ]);

            if ($StudentProgress->save()) {
                $msg = 'saved';
            } else {
                $msg = 'not saved';
            }
        } else {
            $visited = explode(',', $progress->visited);
            if (in_array($request->get('id'), $visited)) {
                $msg = 'visited';
            } else {

                $visited = [$progress->visited, $request->get('id')];
                $commaList = implode(',', $visited);
                $progress = StudentProgress::where([['student_id', $request->get('student')],
                            ['storyline_id', $request->get('storyline')]])
                        ->update(['visited' => $commaList]);

                $msg = 'updated';
            }
        }

        $response = array(
            'msg' => $msg
        );

        return \Response::json($response);
    }

    /**
     *
     * @param type $items
     * @return type
     */
    public function items_to_tree($items) {

        $map = [];

        foreach ($items as $k => $node) {

            $temp = [
                'id' => (string) $node['id'],
                'text' => $node['name'],
                'parent_id' => ($node['parent_id'] === null) ? "#" : $node['parent_id'],
                'rgt' => $node['_rgt'],
                'lft' => $node['_lft'],
            ];
            
             if($node['contents']){
                $temp['body'] = $node['contents']['body'];
                $temp['title'] = $node['contents']['title'];
            }else{
                $temp['body'] = '';
                $temp['title'] = '';
            }
                       
            $map[] = $temp;
        }

        return $map;
    }

    /**
     * 
     * @param type $a
     * @param type $b
     * @return int
     */
    public function compare($a, $b) {
        if ($a['lft'] == $b['lft']) {
            return 0;
        }
        return ($a['lft'] < $b['lft']) ? -1 : 1;
    }

}
