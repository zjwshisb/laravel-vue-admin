<?php
namespace App\Debug;

use Illuminate\Events\Dispatcher;
use Illuminate\Redis\Connections\Connection;
use Illuminate\Redis\Events\CommandExecuted;
use Lanin\Laravel\ApiDebugger\Collection;

class RedisCollection implements Collection {

    protected $connection;

    protected $queries = [];

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
        $this->connection->setEventDispatcher(app(Dispatcher::class));
        $this->listen();
    }

    /**
     * Collection name.
     *
     * @return string
     */
    public function name(){
        return 'redis';
    }

    /**
     * Returns resulting collection.
     *
     * @return array
     */
    public function items(){
        return [
            'items'=> $this->queries,
            'total'=> sizeof($this->queries)
        ];
    }

    private function listen() {
        $this->connection->listen(function (CommandExecuted $executed){
            $this->logQuery($executed->connection, $executed->command, $executed->parameters, $executed->time);
        });
    }

    private function logQuery($connection, $command, $parameters, $time) {
        $this->queries[] = [
          'connection'=> $connection,
            'command'=> $command . ' ' . implode(" ", $parameters),
            'parameters'=> $parameters,
            'time'=> $time
        ];
    }

}
