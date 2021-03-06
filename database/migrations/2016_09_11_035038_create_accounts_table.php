<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('accounts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('account',31)->unique();
            $table->char('password',60);
            $table->unsignedTinyInteger('type');//账号类型：普通用户、企业/机构用户，管理员...
            $table->unsignedTinyInteger('status');//10：等待审核，20：正常/审核通过，30：审核失败，40：被禁
//            $table->unique(['account']);//两种方式建立索引
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('accounts');
	}

}
