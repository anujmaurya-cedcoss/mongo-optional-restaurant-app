<?php

use Phalcon\Mvc\Controller;

class UsersController extends Controller
{
    public function indexAction()
    {
        $output = $this->mongo->menu->find();
        $data = [];
        foreach ($output as $value) {
            $data[] = $value;
        }
        $this->view->data = json_encode($data);
    }

    public function orderAction()
    {
        $id = $_GET['id'];
        $uid = $_SESSION['uid'];
        $uname = $_SESSION['name'];
        $arr = [
            'itemID' => $id,
            'uid' => $uid,
            'uname' => $uname,
            'status' => 'placed',

        ];
        $output = $this->mongo->orders->insertOne($arr);
        $success = $output->getInsertedCount();
        if ($success > 0) {
            $this->response->redirect("/users/review?id=$id");
        } else {
            echo "<h3>There was some error</h3>";
            die;
        }
    }

    public function reviewAction() {
        $uid = $_SESSION['id'];
        $id = $_GET['id'];
        echo $id;
        die;
    }
}
