<?php

namespace App\Console\Commands;

use App\Models\Office;
use App\Models\Region;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class UpdateSchoolsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'school:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates Schools List';

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
        $records = $this->getListCSV();
        DB::table('schools')->truncate();
        $this->output->progressStart($records->count());
        foreach ($records as $record) {
            $record = $record->toArray();
            $this->output->progressAdvance();
            DB::table('schools')->insert($record);
        }
        $this->output->progressFinish();
        return 'Completed';
    }

    private function getListJSON()
    {
        $records = json_decode(iconv('EUC-KR', 'UTF-8', file_get_contents(base_path('resources/schools.json'))), true);
        $records = $records['records'];
        $result = [];
        foreach ($records as $record) {
            $REGION = Region::where('name', $record['시도교육청'])->first();
            $OFFICE = Office::where('name_long', $record['지역교육청'])->first();
            if (is_null($OFFICE)) {
                $OFFICE = Office::where('name_long', $record['시도교육청'])->first();
            }
            array_push($result, collect([
                'region_id' => $REGION['id'],
                'office_id' => $OFFICE['id'],
                'name' => $record['학교명'],
                'address' => $record['주소내역'].' '.$record['상세주소내역'],
                'zip_code' => $record['학교도로명우편번호'],
                'latitude' => $record['위도'],
                'longitude' => $record['경도'],
                'found_at' => $record['설립일']
            ]));
        }
        return collect($result);
    }

    private function getListCSV()
    {
        $csv = Reader::createFromPath(base_path('resources/schools.csv'), 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();
        $result = [];
        foreach ($records as $offset => $record) {
            $REGION = Region::where('name', $record['시도교육청'])->first();
            $OFFICE = Office::where('name_long', $record['지역교육청'])->first();
            if ($record['지역교육청'] == '') {
                $OFFICE = Office::where('name_long', $record['시도교육청'])->first();
            }
            if (is_null($OFFICE)) {
                $OFFICE = Office::where('name', $record['지역교육청'])->first();
            }
            array_push($result, collect([
                'region_id' => $REGION['id'],
                'office_id' => $OFFICE['id'],
                'name' => $record['학교명'],
                'address' => $record['주소내역'].' '.$record['상세주소내역'],
                'zip_code' => $record['학교도로명우편번호'],
                'latitude' => $record['위도'],
                'longitude' => $record['경도'],
                'found_at' => $record['설립일']
            ]));
        }
        return collect($result);
    }
}
