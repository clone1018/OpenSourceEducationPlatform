<?php

class TopicController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $topics = Topic::all();

        return View::make('topic.index', array('topics' => $topics));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->beforeFilter('auth');

        return View::make('topic.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $this->beforeFilter('auth');

        $all = Input::all();

        $rules = array(
            'topic' => 'required|min:1|max:255',
            'body' => 'required'
        );

        $validator = Validator::make($all, $rules);

        if($validator->fails()) {
            return Redirect::action('TopicController@create')->withErrors($validator->messages());
        }

        $topic = new Topic();

        $topic->topic = Input::get('topic');
        $topic->slug = Topic::makeSlug(Input::get('topic'));
        $topic->body = Input::get('body');
        $topic->user_id = Sentry::getUser()->id;

        $topic->save();


        return Redirect::to('/topic/'.$topic->slug.'/'.$topic->id);
	}

    /**
     * @param $slug
     * @param $id
     */
    public function show($slug, $id)
	{
		$topic = Topic::where('id', $id)->first();
        if(!$topic) return Redirect::to('/');

        $replies = Reply::where('topic_id', $topic->id)->orderBy('created_at','asc')->get();

        return View::make('topic.show', array('topic' => $topic, 'replies' => $replies));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}