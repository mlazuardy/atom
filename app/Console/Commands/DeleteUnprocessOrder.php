<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Order;

class DeleteUnprocessOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:unprocess_order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Unprocess Order';

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
     * @return mixed
     */
    public function handle()
    {
        $orders = Order::where('status','unpaid')->get();
        foreach($orders as $order){
            if($this->parse($order->date)->diffInMinutes(now()) >= 5){
                $order->status = 'canceled';
                $order->save();
            }
        }
        $this->info('deleting unprocess order within 5 minutes');
    }

    public function parse($date)
    {
        return \Carbon\Carbon::parse($date);
    }
}
