<?php

use Illuminate\Database\Migrations\Migration;

class AddGroups extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        $group = Sentry::getGroupProvider()->create(array(
            'name'        => 'Admins',
            'permissions' => array(
            ),
        ));
        $group = Sentry::getGroupProvider()->create(array(
            'name'        => 'Users',
            'permissions' => array(
            ),
        ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        $admins = Sentry::getGroupProvider()->findByName('Admins');
        $users = Sentry::getGroupProvider()->findByName('Users');

        // Delete the group
        $admins->delete();
        $users->delete();
	}

}