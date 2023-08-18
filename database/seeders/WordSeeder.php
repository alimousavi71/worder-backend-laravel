<?php

namespace Database\Seeders;

use App\Models\Word;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i <= 2000; $i++) {
            Word::query()->create([
                'word' => 'Word '.$i,
                'translate' => 'ترجمه '.$i,
            ]);
        }
    }

    private function realSeed()
    {
        $worksheet = IOFactory::load(storage_path('/app/public/KazioDIC-Excell.xlsx'));

        try {
            $sheet = $worksheet->getSheet(0);
            $nb = 0;

            foreach ($sheet->getRowIterator() as $row) {
                $word = $sheet->getCell("A$nb")->getValue();
                $translate = $sheet->getCell("B$nb")->getValue();

                if (str($translate)->contains('،')) {
                    $ex = explode('،', $translate);
                    if (count($ex) >= 2) {
                        $translate = $ex[0].' ، '.$ex[1];
                    } else {
                        $translate = $ex[0];
                    }
                }

                if (! is_null($translate)) {
                    Word::query()->create([
                        'word' => $word,
                        'translate' => $translate,
                    ]);
                }

                $nb++;
            }
            echo $nb;
        } catch (Exception $e) {
            logger($e->getMessage());
        }
    }
}
