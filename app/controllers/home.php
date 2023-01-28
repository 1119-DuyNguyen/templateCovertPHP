<?php
//class/ function case-insensitive
class Home extends Controller
{

    public function index()
    {
        $this->view("minima/header", ['page_title' => "Home"]);
        $images_thumbnail = [];

        $imageClass = $this->loadModel("image");

        $data = $imageClass->getAll(5);
        if ($data) {
            //     \myFuncs\show($data);
            foreach ($data as $key => $value) {
                $data[$key]->image = $imageClass->get_thumbnail($value->image);
            }
            $images_thumbnail = $data;
        }
        $prev_page = $this->generate_link($this->current_page_number() - 1);
        $next_page = $this->generate_link($this->current_page_number() + 1);


        $this->view("minima/home", [
            'images_user' => $images_thumbnail,
            "prev_page" => $prev_page,
            "next_page" => $next_page
        ]);

        $this->view("minima/footer");
    }
    //chi tiết của hình ảnh (image ) đó
    public function detail($params = "")
    {
        $isExist = false;

        if (isset($params[0])) {
            $numberUnhash = \myFuncs\unHashNumber($params);

            $imageClass = $this->loadModel("image");
            //$numberUnhash = id


            $data = $imageClass->getOne($numberUnhash);

            if ($data) {
                $this->view("minima/header", ['page_title' => "Detail"]);
                $this->view("minima/detail_image", ['dataImage' => $data]);
                $this->view("minima/footer");
                $isExist = true;
            }

        }
        if (!$isExist) {
            $this->view("404");
        }

    }

    public function current_page_number(): int
    {
        $page = isset($_GET['page']) && ctype_digit($_GET['page'])
            ? (int) $_GET['page']
            : 1;
        return $page;
    }
    // pagination php
    public function generate_link($number)
    {

        $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

        parse_str($query, $params);
        $url = "";
        // Returns a string if the URL has parameters or NULL if not
        if ($query) {
            $url .= "?";
            foreach ($params as $key => $value) {
                if ($key === "page")
                    continue;
                $url .= $key . "=" . $value . "&";
            }
            $url .= 'page=';
        } else {
            $url .= '?page=';
        }

        return ROOT . "home" . $url . $number;


    }
}