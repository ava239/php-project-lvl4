<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('status_id')
                ->references('id')
                ->on('task_statuses');

            $table->foreign('created_by_id')
                ->references('id')
                ->on('users');

            $table->foreign('assigned_to_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign('tasks_status_id_foreign');
            $table->dropForeign('tasks_created_by_id_foreign');
            $table->dropForeign('tasks_assigned_to_id_foreign');
        });
    }
}
