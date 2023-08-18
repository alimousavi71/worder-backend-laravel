<?php

namespace App\Http\Controllers;

use App\Models\Word;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Socialite;

class TestController extends Controller
{
    public function translate()
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
            return $e->getMessage();
        }
    }

    public function index()
    {
        return view('test-login');
    }

    public function login()
    {
        return Socialite::with('google')->stateless()->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        dd($user);
    }
}
