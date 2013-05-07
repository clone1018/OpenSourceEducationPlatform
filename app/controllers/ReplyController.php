<?php

class ReplyController extends \BaseController {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $all = Input::all();

        $rules = array(
            'topic_id' => 'required|exists:topics,id',
            'body' => 'required|min:5',
        );

        $validator = Validator::make($all, $rules);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        $reply = new Reply();

        $reply->topic_id = Input::get('topic_id');
        $reply->body = Input::get('body');
        $reply->user_id = Sentry::getUser()->id;

        $reply->save();


        return Redirect::back();
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