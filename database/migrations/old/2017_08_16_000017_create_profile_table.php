<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'profile';

    /**
     * Run the migrations.
     * @table profile
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('profile_id');
            $table->char('profile_sha256', 64);
            $table->text('profile_key');
            $table->unsignedInteger('key_id');
            $table->text('displayname')->nullable()->default(null);
            $table->text('email')->nullable()->default(null);
            $table->char('locale', 63)->nullable()->default(null);
            $table->smallInteger('subscribe')->nullable()->default(null);
            $table->text('json')->nullable()->default(null);
            $table->timestamp('login_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->unsignedInteger('entity_version')->default('0');

            $table->unique(["profile_id", "profile_sha256"], 'profile_id');

            $table->unique(["profile_sha256"], 'profile_sha256');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
