<?php

namespace App\Console\Commands;

use App\Models\v1\GoodIndent;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AutomaticDelivery extends Command
{
    /**
     * 自动发货
     *
     * @var string
     */
    protected $signature = 'automatic:delivery';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'System Automated Delivery。';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $GoodIndent = GoodIndent::where('state', GoodIndent::GOOD_INDENT_STATE_DELIVER)->with(['User', 'GoodLocation'])->get();
        if ($GoodIndent) {
            foreach ($GoodIndent as $G) {
                DB::transaction(function () use ($G) {
                    $GoodIndent = GoodIndent::find($G->id);
                    $GoodIndent->dhl_id = 3;
                    $GoodIndent->odd = '777032723314255';
                    $GoodIndent->state = GoodIndent::GOOD_INDENT_STATE_TAKE;
                    $GoodIndent->shipping_time = Carbon::now()->toDateTimeString();
                    $GoodIndent->save();
                });
            }
        }
    }
}
