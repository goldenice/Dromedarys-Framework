<?hh
namespace System;

class Layout {
    private string $view;
    private string $viewpath;
    
    function __construct(string $view) {
        if (file_exists($view.'.html')) {
            $this->view = $view;
            $this->viewpath = $view.'.html';
            return true;
        }
        else {
            return false;
        }
    }
    
    function render(Array $data, $output = true): ?string {
        $data['baseurl'] = BASEURL;
        $html = file_get_contents($this->viewpath);
        foreach($data as $k=>$v) {
            $html = str_replace('{'.$k.'}', $v, $html);
        }
        if ($output == true) {
            echo $html;
            return null;
        }
        else {
            return $html;
        }
    }
    
    function renderPart(string $view, Array $data): ?string {
        if (file_exists($view.'.html')) {
            $data['baseurl'] = BASEURL;
            $html = file_get_contents($view.'.html');
            foreach($data as $k=>$v) {
                $html = str_replace('{'.$k.'}', $v, $html);
            }
            return $html;
        }
        else {
            return null;
        }
    }
}