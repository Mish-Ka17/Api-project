<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ImportService;

class ImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-command
                            {--from=}
                            {--to=}
                            {--page=}
                            {--limit=500}
                            ';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ImportCommand import data by API';

    /**
     * Execute the console command.
     */
    public function handle(ImportService $service): int
    {
        $this->info('Структура БД будет обновлена...');
        $this->call('migrate:refresh');
        $this->info("Дата начальная:". $this->option('from'));
        $this->info("Дата конечная:". $this->option('to'));
        $this->info("Страница:". $this->option('page'));
        $this->info("Лимит:". $this->option('limit'));
        $this->warn('Для импорта Stocks (склады) используется по умолчанию сегодняшняя дата');
        $this->info('Импорт начинается...');

        $service->import(
            from: $this->option('from'),
            to: $this->option('to'),
            page: (int) $this->option('page'),
            limit: (int) $this->option('limit'),
        );


        //$this->info('Получено записей: '.count($data));


        $this->info('Таблицы БД успешно обновлены...');
        $this->info('Импорт успешно завершён.');

        return self::SUCCESS;

    // $data = $this->importService->import($from, $to, $page, $limit);

    //$this->info('Получено записей: ');// . count($data));

    }

}
