<?php

use PixieHuge\Controller;
class settingsController extends Controller
{

    public function index($tables) {

        $this->view('settings/settings-list');

    }
}
