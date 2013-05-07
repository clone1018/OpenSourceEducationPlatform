<?php

class ForumController extends BaseController {


    public function getIndex() {
        $topics = Topic::all();

        return View::make('forum.index', array('topics' => $topics));
    }

    public function getCreate(){

    }

    public function postCreate() {

    }




}