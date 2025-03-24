<?php
require_once 'models/HocPhan.php';
require_once 'config/database.php';

class HocPhanController
{
    private $hocPhan;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->hocPhan = new HocPhan($db);
    }

    public function index()
    {
        $hocphans = $this->hocPhan->getAll();
        require_once 'views/hocphan/index.php';
    }
}
