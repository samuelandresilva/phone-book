<?php

namespace App\Controllers;

class Home extends BaseController {
    public function index() {
        //echo password_hash("admin", PASSWORD_BCRYPT);
        return redirect()->to("/phone-book");
    }
}
